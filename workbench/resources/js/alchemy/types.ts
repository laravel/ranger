export namespace App {
    export namespace Models {
        export type Post = {
            id: number;
            title: string;
            content: string;
            user_id: number;
            created_at: string | null;
            updated_at: string | null;
            user: App.Models.User;
        };

        export type User = {
            id: number;
            name: string;
            email: string;
            email_verified_at: string | null;
            password: string;
            remember_token: string | null;
            created_at: string | null;
            updated_at: string | null;
            post: App.Models.Post;
            posts: App.Models.Post[];
            notifications: Illuminate.Notifications.DatabaseNotification;
        };
    }

    export namespace Http {
        export namespace Requests {
            export type UserRegistrationRequest = {
                name: string;
                email: string;
                password: string;
                terms: boolean;
                age: number;
            };

            export type UserUpdateRequest = {
                name: string;
                email: string;
                bio?: string | null;
                avatar?: string | null;
                phone?: string | null;
            };
        }
    }

    export namespace Enums {
        export type Status = {
            ACTIVE: 'active';
            INACTIVE: 'inactive';
            PENDING: 'pending';
            SUSPENDED: 'suspended';
            DRAFT: 'draft';
            PUBLISHED: 'published';
            ARCHIVED: 'archived';
        };

        export type UserRole = {
            ADMIN: 'admin';
            MODERATOR: 'moderator';
            USER: 'user';
            GUEST: 'guest';
            EDITOR: 'editor';
            VIEWER: 'viewer';
        };
    }
}

export namespace Illuminate {
    export namespace Notifications {
        export type DatabaseNotification = {
            notifiable: Illuminate.Notifications.DatabaseNotification;
        };
    }
}

export namespace Inertia {
    export namespace Pages {
        export type Home = {
            showNav: boolean
            title: string
            keywords: string[]
            date: string
            url: string
        };

        export type Multi = {
            first: boolean
            second: null | string
            third?: number
        };

        export namespace Posts {
            export type Show = {
                isPublished: boolean
                isOwner: boolean
                title: string
                post: {
                    [key: string]: any;
                    owner: string;
                }
            };

            export type Variable = {
                isPublished: boolean
                isOwner: boolean
                title: string
                post: {
                    [key: string]: any;
                    owner: string;
                }
            };

            export type NestedReturns = {
                statuses: string[]
            };
        }
    }
}