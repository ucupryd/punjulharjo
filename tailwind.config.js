import defaultTheme from "tailwindcss/defaultTheme";

export default {
    content: [
        "./resources/views/**/*.blade.php",
        "./resources/css/**/*.css",
        "./resources/js/**/*.js",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Poppins", ...defaultTheme.fontFamily.sans],
                heading: ["'The Last Trunks'", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],
};
