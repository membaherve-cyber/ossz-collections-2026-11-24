"use client";

import Link from "next/link";
import { useActionState, useSyncExternalStore } from "react";
import { formAction, type ActionState } from "@/lib/api-actions";

// Submissions travel through /api/actions/[action] — Server Actions are
// blocked behind the preview gateway.
const loginAction = formAction("loginAction");
const registerAction = formAction("registerAction");

const initial: ActionState = { ok: false, message: "" };

const noopSubscribe = () => () => {};

function framedSnapshot() {
  try {
    return window.self !== window.top;
  } catch {
    return true;
  }
}

function serverSnapshot() {
  return false;
}

/**
 * Some preview panes embed the boutique in a cross-origin iframe. Browsers
 * that block third-party cookies then silently discard the session cookie —
 * sign-in succeeds, the redirect fires, and the visitor lands back on this
 * page as if nothing had happened. Detect that situation and offer the
 * top-level-tab escape.
 */
function IframeHint() {
  const framed = useSyncExternalStore(noopSubscribe, framedSnapshot, serverSnapshot);
  if (!framed) return null;
  return (
    <p className="rounded-sm border border-line bg-paper px-3 py-2 text-xs leading-relaxed text-muted">
      Viewing inside a preview frame? If signing in does nothing, your browser
      may be blocking cookies for embedded sites.{" "}
      <button
        type="button"
        className="text-accent link-underline"
        onClick={() => window.open(window.location.href, "_blank", "noopener")}
      >
        Open the boutique in its own tab
      </button>{" "}
      and sign in there.
    </p>
  );
}

export function LoginForm({ next }: { next: string }) {
  const [state, action, pending] = useActionState(loginAction, initial);
  return (
    <form action={action} className="card space-y-4 p-6">
      <input type="hidden" name="next" value={next} />
      <IframeHint />
      <div>
        <label className="label" htmlFor="email">Email or username</label>
        <input id="email" name="email" type="text" required className="field" autoComplete="username" />
      </div>
      <div>
        <label className="label" htmlFor="password">Password</label>
        <input id="password" name="password" type="password" required className="field" autoComplete="current-password" />
      </div>
      <button className="btn btn-primary w-full" disabled={pending}>{pending ? "Signing in…" : "Sign in"}</button>
      {state.message ? <p className="text-xs text-red-600">{state.message}</p> : null}
      <p className="text-center text-xs text-muted">
        <Link href="/forgot-password" className="text-accent link-underline">Forgotten your password?</Link>
      </p>
      <p className="text-center text-xs text-muted">
        New here? <Link href="/register" className="text-accent link-underline">Create an account</Link>
      </p>
    </form>
  );
}

export function RegisterForm({ next }: { next: string }) {
  const [state, action, pending] = useActionState(registerAction, initial);
  return (
    <form action={action} className="card space-y-4 p-6">
      <input type="hidden" name="next" value={next} />
      <div>
        <label className="label" htmlFor="fullName">Full name</label>
        <input id="fullName" name="fullName" required className="field" />
      </div>
      <div>
        <label className="label" htmlFor="phone">Phone</label>
        <input id="phone" name="phone" className="field" placeholder="+237 6.. .. .. .." />
      </div>
      <div>
        <label className="label" htmlFor="email">Email</label>
        <input id="email" name="email" type="email" required className="field" autoComplete="email" />
      </div>
      <div>
        <label className="label" htmlFor="password">Password (6 characters or more)</label>
        <input id="password" name="password" type="password" minLength={6} required className="field" autoComplete="new-password" />
      </div>
      <button className="btn btn-primary w-full" disabled={pending}>{pending ? "Creating…" : "Create my account"}</button>
      {state.message ? <p className="text-xs text-red-600">{state.message}</p> : null}
      <p className="text-center text-xs text-muted">
        Already with us? <Link href="/login" className="text-accent link-underline">Sign in</Link>
      </p>
    </form>
  );
}
