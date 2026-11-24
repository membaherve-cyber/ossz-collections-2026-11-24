/**
 * Server-side registry backing the `/api/actions/[action]` bridge.
 *
 * Client mutations arrive as JSON at a plain API route (never as Server
 * Actions, which the preview gateway blocks). Each entry whitelists one
 * server function and declares how its arguments must be reconstructed:
 *
 * - "form-state": server signature `(_prev: ActionState, formData: FormData)`.
 * - "form":       server signature `(formData: FormData)`.
 * - "args":       plain JSON arguments passed straight through.
 */

import * as publicActions from "@/lib/actions";
import * as adminActions from "@/lib/admin-actions";
import * as paymentActions from "@/lib/payment-actions";
import type { ActionState } from "@/lib/actions";

type ActionMode = "form-state" | "form" | "args";

type RegisteredAction = {
  fn: (...args: unknown[]) => unknown;
  mode: ActionMode;
};

const registry: Record<string, RegisteredAction> = {
  /* ------------------- Storefront — src/lib/actions.ts ------------------- */
  addToCart: { fn: publicActions.addToCart, mode: "args" },
  updateCartLine: { fn: publicActions.updateCartLine, mode: "args" },
  removeCartLine: { fn: publicActions.removeCartLine, mode: "args" },
  applyCoupon: { fn: publicActions.applyCoupon, mode: "form-state" },
  registerAction: { fn: publicActions.registerAction, mode: "form-state" },
  loginAction: { fn: publicActions.loginAction, mode: "form-state" },
  logoutAction: { fn: publicActions.logoutAction, mode: "args" },
  updateProfileAction: { fn: publicActions.updateProfileAction, mode: "form-state" },
  saveAddressAction: { fn: publicActions.saveAddressAction, mode: "form-state" },
  deleteAddressAction: { fn: publicActions.deleteAddressAction, mode: "form" },
  toggleWishlist: { fn: publicActions.toggleWishlist, mode: "args" },
  placeOrderAction: { fn: publicActions.placeOrderAction, mode: "form-state" },
  bookAppointmentAction: { fn: publicActions.bookAppointmentAction, mode: "form-state" },
  cancelAppointmentAction: { fn: publicActions.cancelAppointmentAction, mode: "form" },
  newsletterAction: { fn: publicActions.newsletterAction, mode: "form-state" },
  contactAction: { fn: publicActions.contactAction, mode: "form-state" },
  sendMessageReplyAction: { fn: publicActions.sendMessageReplyAction, mode: "form-state" },
  lookupOrder: { fn: publicActions.lookupOrder, mode: "args" },
  getProductImage: { fn: publicActions.getProductImage, mode: "args" },
  inlineLoginAction: { fn: publicActions.inlineLoginAction, mode: "form-state" },
  requestPasswordResetAction: { fn: publicActions.requestPasswordResetAction, mode: "form-state" },
  completePasswordResetAction: {
    fn: publicActions.completePasswordResetAction,
    mode: "form-state",
  },

  /* ------------------- Checkout — src/lib/payment-actions.ts ------------- */
  createPendingOrderAction: { fn: paymentActions.createPendingOrderAction, mode: "form-state" },
  finalizeOrderAction: { fn: paymentActions.finalizeOrderAction, mode: "form-state" },

  /* ------------------- Back office — src/lib/admin-actions.ts ------------ */
  trackOrderAction: { fn: adminActions.trackOrderAction, mode: "form" },
  updateOrderStatusAction: { fn: adminActions.updateOrderStatusAction, mode: "form" },
  updatePaymentStatusAction: { fn: adminActions.updatePaymentStatusAction, mode: "form" },
  updateStockAction: { fn: adminActions.updateStockAction, mode: "form" },
  saveProductAction: { fn: adminActions.saveProductAction, mode: "form-state" },
  deleteProductAction: { fn: adminActions.deleteProductAction, mode: "form" },
  saveCollectionAction: { fn: adminActions.saveCollectionAction, mode: "form-state" },
  saveJournalAction: { fn: adminActions.saveJournalAction, mode: "form-state" },
  saveHomeBlockAction: { fn: adminActions.saveHomeBlockAction, mode: "form-state" },
  deleteHomeBlockAction: { fn: adminActions.deleteHomeBlockAction, mode: "form" },
  saveLookAction: { fn: adminActions.saveLookAction, mode: "form-state" },
  deleteLookAction: { fn: adminActions.deleteLookAction, mode: "form" },
  addMediaAction: { fn: adminActions.addMediaAction, mode: "form-state" },
  deleteMediaAction: { fn: adminActions.deleteMediaAction, mode: "form" },
  saveCouponAction: { fn: adminActions.saveCouponAction, mode: "form-state" },
  toggleCouponAction: { fn: adminActions.toggleCouponAction, mode: "form" },
  setAppointmentStatusAction: { fn: adminActions.setAppointmentStatusAction, mode: "form" },
  saveSettingsAction: { fn: adminActions.saveSettingsAction, mode: "form-state" },
  saveZoneAction: { fn: adminActions.saveZoneAction, mode: "form-state" },
  saveFaqAction: { fn: adminActions.saveFaqAction, mode: "form-state" },
  saveStaffAction: { fn: adminActions.saveStaffAction, mode: "form-state" },
};

export function getRegisteredAction(name: string): RegisteredAction | null {
  return Object.prototype.hasOwnProperty.call(registry, name) ? registry[name] : null;
}

export const emptyActionState: ActionState = { ok: false, message: "" };

export function fieldsToFormData(fields: Record<string, unknown>): FormData {
  const formData = new FormData();
  for (const [key, value] of Object.entries(fields)) {
    formData.append(key, value === undefined || value === null ? "" : String(value));
  }
  return formData;
}
