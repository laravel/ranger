import { App } from "@ranger/App";
import {
    ACTIVE,
    ARCHIVED,
    DRAFT,
    INACTIVE,
    PENDING,
    PUBLISHED,
    SUSPENDED,
} from "@ranger/App/Enums/Status";
import {
    ADMIN,
    EDITOR,
    GUEST,
    MODERATOR,
    USER,
    VIEWER,
} from "@ranger/App/Enums/UserRole";
import { App as AppType } from "@ranger/types";
import { expect, expectTypeOf, it } from "vitest";

it("can generate js for enums", () => {
    expectTypeOf(
        App.Enums.UserRole
    ).toMatchObjectType<AppType.Enums.UserRole>();
    expectTypeOf(App.Enums.Status).toMatchObjectType<AppType.Enums.Status>();

    expect(ACTIVE).toBe("active");
    expect(INACTIVE).toBe("inactive");
    expect(PENDING).toBe("pending");
    expect(SUSPENDED).toBe("suspended");
    expect(DRAFT).toBe("draft");
    expect(PUBLISHED).toBe("published");
    expect(ARCHIVED).toBe("archived");

    const status: AppType.Enums.Status = App.Enums.Status;

    expect(status.ACTIVE).toBe("active");
    expect(status.INACTIVE).toBe("inactive");
    expect(status.PENDING).toBe("pending");
    expect(status.SUSPENDED).toBe("suspended");
    expect(status.DRAFT).toBe("draft");
    expect(status.PUBLISHED).toBe("published");
    expect(status.ARCHIVED).toBe("archived");

    expect(ADMIN).toBe("admin");
    expect(EDITOR).toBe("editor");
    expect(VIEWER).toBe("viewer");
    expect(GUEST).toBe("guest");
    expect(MODERATOR).toBe("moderator");
    expect(USER).toBe("user");

    const userRole: AppType.Enums.UserRole = App.Enums.UserRole;

    expect(userRole.ADMIN).toBe("admin");
    expect(userRole.EDITOR).toBe("editor");
    expect(userRole.VIEWER).toBe("viewer");
    expect(userRole.GUEST).toBe("guest");
    expect(userRole.MODERATOR).toBe("moderator");
    expect(userRole.USER).toBe("user");
});
