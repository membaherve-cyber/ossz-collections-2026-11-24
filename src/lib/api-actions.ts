/**
 * Client-side bridge to server mutations.
 *
 * Why this exists: Server Actions are unusable behind the sandbox preview
 * gateway. The gateway rewrites `x-forwarded-host`, which no longer matches
 * the browser `origin`, so Next.js aborts every Server Action request as a
 * CSRF risk ("Invalid Server Actions request", POST … 500). A form driven by
 * `useActionState` then never receives a reply and hangs forever.
 *
 * Every client mutation therefore travels as a plain `fetch` POST to
 * `/api/actions/<name>` — a normal API route the gateway forwards untouched.
 * The server-side counterpart lives in `src/lib/action-registry.ts`.
 */

export type ActionState = { ok: boolean; message: string; redirectTo?: string };

export const initialActionState: ActionState = { ok: false, message: "" };

async function postAction(name: string, body: unknown): Promise<ActionState> {
  let res: Response;
  try {
    res = await fetch(`/api/actions/${encodeURIComponent(name)}`, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(body),
      cache: "no-store",
    });
  } catch {
    return {
      ok: false,
      message: "We could not reach the boutique. Check your connection and try again.",
    };
  }

  let data: unknown;
  try {
    data = await res.json();
  } catch {
    return { ok: false, message: "The boutique sent an unreadable reply. Please try again." };
  }

  if (!data || typeof data !== "object" || typeof (data as ActionState).ok !== "boolean") {
    return { ok: false, message: "The boutique could not process that. Please try again." };
  }
  return data as ActionState;
}

/**
 * Builds a `useActionState`-compatible submitter for a registered form action
 * (server signature `(prevState, formData) => Promise<ActionState>`).
 *
 * Server-side `redirect()` calls are caught by the API route and returned as
 * `redirectTo`, which we perform client-side. The returned promise never
 * resolves after a redirect, so the submit button stays in its pending state
 * until the navigation replaces the page — matching the old server-action UX.
 */
export function formAction(name: string) {
  return async (_prev: ActionState, formData: FormData): Promise<ActionState> => {
    const fields: Record<string, string> = {};
    formData.forEach((value, key) => {
      if (typeof value === "string") fields[key] = value;
    });
    const state = await postAction(name, { fields });
    if (state.ok && state.redirectTo) {
      window.location.assign(state.redirectTo);
      return new Promise<ActionState>(() => {});
    }
    return state;
  };
}

/**
 * Calls a registered action that takes scalar arguments
 * (e.g. `addToCart(variantId, quantity)`). Results that request a redirect
 * are followed client-side, mirroring `formAction`.
 */
export async function callAction<T = ActionState>(name: string, ...args: unknown[]): Promise<T> {
  const state = await postAction(name, { args });
  if (state.ok && state.redirectTo) {
    window.location.assign(state.redirectTo);
    return new Promise<T>(() => {});
  }
  return state as T;
}

/**
 * Submits an explicit fields object (used by forms rendered on the server via
 * `<ApiForm action="…">`). Redirects are NOT followed here — the caller
 * decides between navigation and `router.refresh()`.
 */
export async function submitFields(
  name: string,
  fields: Record<string, string>,
): Promise<ActionState> {
  return postAction(name, { fields });
}
