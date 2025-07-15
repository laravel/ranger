import { App } from "@ranger/types";
import { expect, it } from "vitest";

it("can generate form request types", () => {
    const registrationRequest: App.Http.Requests.UserRegistrationRequest = {
        name: "Joe",
        email: "joe@example.com",
        password: "password",
        terms: true,
        age: 27,
    };

    expect(registrationRequest).not.toBeNull();

    const updateRequests: App.Http.Requests.UserUpdateRequest[] = [
        {
            name: "Joe",
            email: "joe@example.com",
            bio: "I am a software engineer",
            avatar: "joe.png",
            phone: "+1234567890",
        },
        {
            name: "Joe",
            email: "joe@example.com",
            bio: null,
            avatar: null,
            phone: null,
        },
        {
            name: "Joe",
            email: "joe@example.com",
        },
    ];

    expect(updateRequests).not.toBeNull();
});
