// Initializing swipers
const swiper = new Swiper(".default-swiper", {
    // Default parameters
    slidesPerView: 1.2,
    spaceBetween: 20,

    // Optional parameters
    loop: false,
    grabCursor: true,

    // Navigation arrows
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },

    autoplay: {
        delay: 7500,
    },

    breakpoints: {
        720: {
            slidesPerView: 2.3,
            spaceBetween: 20,
        },
        1280: {
            slidesPerView: 3.3,
            spaceBetween: 30,
        },
        1600: {
            slidesPerView: 3.7,
            spaceBetween: 50,
        },
    },
});

const albumSwiper = new Swiper(".album-swiper", {
    // Default parameters
    slidesPerView: 2.1,
    spaceBetween: 10,

    // Optional parameters
    loop: false,
    grabCursor: true,

    // Navigation arrows
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },

    autoplay: {
        delay: 7500,
    },

    breakpoints: {
        720: {
            slidesPerView: 2.3,
            spaceBetween: 20,
        },
        1280: {
            slidesPerView: 4.3,
            spaceBetween: 30,
        },
        1600: {
            slidesPerView: 5.6,
            spaceBetween: 40,
        },
    },
});

const albumViewSwiper = new Swiper(".album-view-swiper", {
    slidesPerView: 2.5,
    spaceBetween: 10,
    grabCursor: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    autoplay: {
        delay: 7500,
    },
    breakpoints: {
        1080: {
            slidesPerView: 3.5,
            spaceBetween: 30,
        },
        1600: {
            slidesPerView: 4.5,
            spaceBetween: 40,
        },
    },
});

const userSwiper = new Swiper(".user-swiper", {
    slidesPerView: 2.1,
    spaceBetween: 20,
    grabCursor: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    autoplay: {
        delay: 7500,
    },
    breakpoints: {
        1020: {
            slidesPerView: 3.6,
        },
        1280: {
            slidesPerView: 4.3,
            spaceBetween: 30,
        },
        1600: {
            slidesPerView: 6.3,
            spaceBetween: 40,
        },
    },
});
