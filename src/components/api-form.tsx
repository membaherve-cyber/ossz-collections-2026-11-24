"use client";

import type { FormEvent, ReactNode } from "react";
import { useState } from "react";
import { useRouter } from "next/navigation";
import { callAction, submitFields } from "@/lib/api-actions";

/**
 * Drop-in replacement for `<form action={serverAction}>` rendered on the
 * server. The form keeps its original children (inputs and submit buttons);
 * on submit it POSTs the fields to the registered API action and refreshes
 * the server-rendered tree, so admin/account pages behave as before.
 */
export function ApiForm({
  action,
  children,
  className = "",
}: {
  action: string;
  children: ReactNode;
  className?: string;
}) {
  const router = useRouter();
  const [pending, setPending] = useState(false);
  const [error, setError] = useState("");

  async function onSubmit(event: FormEvent<HTMLFormElement>) {
    event.preventDefault();
    if (pending) return;
    setPending(true);
    setError("");
    const fields: Record<string, string> = {};
    new FormData(event.currentTarget).forEach((value, key) => {
      if (typeof value === "string") fields[key] = value;
    });
    const state = await submitFields(action, fields);
    if (state.ok && state.redirectTo) {
      window.location.assign(state.redirectTo);
      return;
    }
    if (!state.ok) {
      setError(state.message || "Something went wrong. Please try again.");
      setPending(false);
      return;
    }
    setPending(false);
    router.refresh();
  }

  return (
    <form className={className} onSubmit={onSubmit}>
      {children}
      {error ? <p className="mt-2 text-xs text-red-600">{error}</p> : null}
    </form>
  );
}

/** Sign-out button for layouts (replaces `<form action={logoutAction}>`). */
export function LogoutButton({
  className = "",
  label = "Sign out",
}: {
  className?: string;
  label?: string;
}) {
  return (
    <button type="button" className={className} onClick={() => void callAction("logoutAction")}>
      {label}
    </button>
  );
}
