import { NextResponse, type NextRequest } from "next/server";
import {
  emptyActionState,
  fieldsToFormData,
  getRegisteredAction,
} from "@/lib/action-registry";
import type { ActionState } from "@/lib/actions";

/**
 * Bridge endpoint for every client-side mutation.
 *
 * Server Actions are blocked behind the preview gateway (`x-forwarded-host`
 * never matches `origin`, so Next.js aborts them as CSRF). This route lets
 * clients `fetch("/api/actions/<name>")` with JSON instead; the registered
 * server function runs here, where `cookies()`, `revalidatePath()` and
 * `redirect()` all behave exactly as they would inside a Server Action.
 *
 * Body: `{ fields?: Record<string, string>, args?: unknown[] }`
 *   - "fields"  → rebuilt into FormData for form actions.
 *   - "args"    → passed as positional arguments for scalar actions.
 * Reply: the action's own `ActionState`, or `{ ok, redirectTo }` when the
 * action called `redirect()`.
 */

function redirectTargetFromError(error: unknown): string | null {
  if (!error || typeof error !== "object" || !("digest" in error)) return null;
  const digest = (error as { digest?: unknown }).digest;
  if (typeof digest !== "string" || !digest.startsWith("NEXT_REDIRECT")) return null;
  // Shape: "NEXT_REDIRECT;replace;/target;307;" — the destination may itself
  // contain ";", so everything between the type and the trailing status wins.
  const parts = digest.split(";");
  const destination = parts.slice(2, -2).join(";");
  return destination || null;
}

export async function POST(
  request: NextRequest,
  context: { params: Promise<{ action: string }> },
) {
  const { action } = await context.params;
  const entry = getRegisteredAction(action);
  if (!entry) {
    return NextResponse.json({ ok: false, message: "Unknown action." }, { status: 404 });
  }

  const body = (await request.json().catch(() => null)) as
    | { fields?: Record<string, unknown>; args?: unknown[] }
    | null;
  if (!body || typeof body !== "object") {
    return NextResponse.json({ ok: false, message: "Invalid request body." }, { status: 400 });
  }

  try {
    const call = entry.fn as (...args: unknown[]) => unknown;
    let result: unknown;
    if (entry.mode === "form-state") {
      result = await call(emptyActionState, fieldsToFormData(body.fields ?? {}));
    } else if (entry.mode === "form") {
      result = await call(fieldsToFormData(body.fields ?? {}));
    } else {
      const args = Array.isArray(body.args) ? body.args : [];
      result = await call(...args);
    }
    return NextResponse.json((result ?? { ok: true, message: "" }) as ActionState);
  } catch (error) {
    const redirectTo = redirectTargetFromError(error);
    if (redirectTo) {
      return NextResponse.json({ ok: true, message: "", redirectTo });
    }
    console.error(`[api/actions] ${action} failed:`, error);
    const message =
      error instanceof Error && error.message
        ? error.message
        : "Something went wrong. Please try again.";
    return NextResponse.json({ ok: false, message }, { status: 500 });
  }
}
