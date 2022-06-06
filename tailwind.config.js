module.exports = {
    mode: 'jit',
    content: ["./frontend/views/**/*.php"],
    theme: {
        extend: {
            colors: {
                'main-dark': '#292A33',
                'secondary-dark': '#1B1C22',
                'main-light': '#F3EFF5',
                'main-accent': '#4EFFA6',
                'secondary-accent': '#5E2BFF',
            },
            fontFamily: {
                'serif': ['Lora', 'serif'],
                'sans': ['Staatliches', 'sans-serif'],
            }
        },
    },
    plugins: [],
}
