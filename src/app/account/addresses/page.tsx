import { eq } from "drizzle-orm";
import { db } from "@/db";
import { addresses } from "@/db/schema";
import { getCurrentUser } from "@/lib/auth";
import { AddressForm } from "@/components/account-forms";
import { ApiForm } from "@/components/api-form";

export const dynamic = "force-dynamic";

export default async function AddressesPage() {
  const user = await getCurrentUser();
  if (!user) return null;
  const rows = await db.select().from(addresses).where(eq(addresses.userId, user.id));

  return (
    <div>
      <h1 className="display text-3xl">Saved addresses</h1>
      <p className="mt-2 text-sm text-ink-soft">Saved addresses make repeat checkout a single tap.</p>

      <div className="mt-8 grid gap-4 sm:grid-cols-2">
        {rows.map((address) => (
          <article key={address.id} className="card p-5 text-sm">
            <p className="eyebrow">{address.label}</p>
            <p className="mt-2 font-medium">{address.fullName}</p>
            <p className="text-ink-soft">{address.street}</p>
            <p className="text-ink-soft">{address.area}, {address.city}</p>
            <p className="text-muted">{address.phone}</p>
            <ApiForm action="deleteAddressAction" className="mt-3">
              <input type="hidden" name="id" value={address.id} />
              <button className="text-xs text-red-600 link-underline">Remove</button>
            </ApiForm>
          </article>
        ))}
      </div>

      <h2 className="display mt-10 text-2xl">Add an address</h2>
      <div className="mt-4"><AddressForm /></div>
    </div>
  );
}
