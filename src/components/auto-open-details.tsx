"use client";

import { useEffect, useRef, type ReactNode } from "react";

/**
 * A <details> element whose initial open state is applied AFTER hydration.
 *
 * Rendering the `open` attribute directly from server data caused a hydration
 * mismatch whenever the HTML a browser held was older than the data inside
 * the flight payload (e.g. a catalogue that was empty on the first render but
 * populated by the time the client hydrated): the server HTML said `open=""`,
 * the client computed `open={false}`, and React logged a "tree hydrated but
 * some attributes of the server rendered HTML didn't match" console error.
 *
 * By always rendering the attribute-absent markup on BOTH the server and the
 * client, the two renders can never disagree — the warning is structurally
 * impossible — while the auto-open UX (reveal the "add a piece" form on an
 * empty catalogue) is preserved by setting the DOM property post-mount.
 */
export function AutoOpenDetails({
  openOnMount = false,
  className,
  children,
}: {
  openOnMount?: boolean;
  className?: string;
  children: ReactNode;
}) {
  const ref = useRef<HTMLDetailsElement>(null);

  useEffect(() => {
    if (openOnMount && ref.current) ref.current.open = true;
  }, [openOnMount]);

  return (
    <details ref={ref} className={className}>
      {children}
    </details>
  );
}
