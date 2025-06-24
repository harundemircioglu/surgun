import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: [
                "resources/views/**",
                "Modules/**/resources/views/**",
                "Modules/**/resources/assets/js/**",
                "Modules/**/resources/assets/sass/**",
                "tailwind.config.js",
                "vite.config.js",
            ],
        }),
    ],
});
