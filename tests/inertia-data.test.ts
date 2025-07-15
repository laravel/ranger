import { Inertia } from "@ranger/types";
import { expect, it } from "vitest";

it("can generate inertia data types", () => {
    const data: Inertia.Pages.Home = {
        showNav: true,
        title: "Home",
        keywords: ["home", "page"],
        date: new Date().toISOString(),
        url: "https://example.com",
    };

    expect(data).not.toBeNull();
});

it("can generate multi return inertia data types", () => {
    const data: Inertia.Pages.Multi[] = [
        {
            first: true,
            second: "second",
            third: 3,
        },
        {
            first: false,
            second: null,
        },
    ];

    expect(data).not.toBeNull();
});

it("can determine params", () => {
    const data: Inertia.Pages.Posts.Show = {
        isPublished: true,
        isOwner: true,
        title: "Post",
        post: {
            owner: "Joe",
        },
    };

    expect(data).not.toBeNull();
});

it("can determine variables", () => {
    const data: Inertia.Pages.Posts.Variable = {
        isPublished: true,
        isOwner: true,
        title: "Post",
        post: {
            owner: "Joe",
        },
    };

    expect(data).not.toBeNull();
});
