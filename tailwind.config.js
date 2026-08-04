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
                heading: ["'Exo'", "sans-serif"],
                title: ["'Exo'", "sans-serif"],
                exo: ["'Exo'", "sans-serif"],
            },
            colors: {
                brand: {
                    light: '#749db2',  // The soft/muted blue
                    dark: '#0d355e',   // The deep navy blue
                    accent: '#fab831', // The golden yellow
                    muted: '#acb6bd',  // The silver/gray
                }
            }
        },
    },
    plugins: [],
};
