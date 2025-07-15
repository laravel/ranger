import { BroadcastEvent } from "@ranger/broadcast-events";
import { expect, it } from "vitest";

it("can generate BroadcastEvent type", () => {
    const validEvents: Record<BroadcastEvent, true> = {
        UserCreated: true,
        UserUpdated: true,
        PostCreated: true,
    };

    expect(validEvents).not.toBeNull();
});
