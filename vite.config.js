import path from "path";
import { defineConfig } from "vite";

export default defineConfig({
    test: {
        include: ["tests/*.test.ts"],
        environment: "happy-dom",
        typecheck: {
            enabled: true,
            tsconfig: "./tsconfig.json",
            include: ["tests/*.test.ts"],
        },
    },
    resolve: {
        alias: {
            "@ranger": path.resolve(
                __dirname,
                "./workbench/resources/js/ranger"
            ),
        },
    },
});
