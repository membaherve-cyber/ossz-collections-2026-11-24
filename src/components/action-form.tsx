"use client";

import type { ReactNode } from "react";
import { useEffect, useMemo } from "react";
import { useActionState } from "react";
import { useRouter } from "next/navigation";
import { formAction, initialActionState, type ActionState } from "@/lib/api-actions";

/**
 * Generic settings form used across the back office.
 *
 * `action` is the name of a registered server action (see
 * `src/lib/action-registry.ts`); the submission travels through the
 * `/api/actions/[action]` bridge instead of the Server Actions protocol,
 * which the preview gateway blocks.
 */
export function ActionForm({
  action,
  children,
  submitLabel = "Save",
  className = "",
  compact = false,
}: {
  action: string;
  children: ReactNode;
  submitLabel?: string;
  className?: string;
  compact?: boolean;
}) {
  const router = useRouter();
  const submit = useMemo(() => formAction(action), [action]);
  const [state, formActionHandler, pending] = useActionState(submit, initialActionState);

  // Keep the surrounding page in sync after a successful save.
  useEffect(() => {
    if (state.ok && !state.redirectTo) router.refresh();
  }, [state, router]);

  return (
    <form action={formActionHandler} className={className}>
      {children}
      <div className={`flex items-center gap-3 ${compact ? "mt-3" : "mt-6"}`}>
        <button className={`btn btn-primary ${compact ? "btn-sm" : ""}`} disabled={pending}>
          {pending ? "Saving…" : submitLabel}
        </button>
        {state.message ? (
          <span className={`text-xs ${state.ok ? "text-accent" : "text-red-600"}`}>{state.message}</span>
        ) : null}
      </div>
    </form>
  );
}
