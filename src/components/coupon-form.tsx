"use client";

import { useEffect } from "react";
import { useActionState } from "react";
import { useRouter } from "next/navigation";
import { formAction, type ActionState } from "@/lib/api-actions";

const applyCoupon = formAction("applyCoupon");

const initial: ActionState = { ok: false, message: "" };

export function CouponForm({ current }: { current: string | null }) {
  const [state, action, pending] = useActionState(applyCoupon, initial);
  const router = useRouter();

  // Totals on the cart page change server-side once the code is applied.
  useEffect(() => {
    if (state.ok && !state.redirectTo) router.refresh();
  }, [state, router]);

  return (
    <form action={action} className="mt-5">
      <label className="label" htmlFor="coupon">
        Coupon code
      </label>
      <div className="flex gap-2">
        <input id="coupon" name="code" defaultValue={current ?? ""} placeholder="WELCOME10" className="field" />
        <button className="btn btn-secondary btn-sm" disabled={pending}>
          {pending ? "…" : "Apply"}
        </button>
      </div>
      {state.message ? (
        <p className={`mt-2 text-xs ${state.ok ? "text-accent" : "text-red-600"}`}>{state.message}</p>
      ) : null}
    </form>
  );
}
