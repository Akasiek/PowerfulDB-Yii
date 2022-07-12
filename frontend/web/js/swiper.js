// Initializing swipers
const swiper = new Swiper(".default-swiper", {
    // Default parameters
    slidesPerView: 1.3,
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
        440: {
            slidesPerView: 1.7,
        },
        640: {
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
    slidesPerView: 1.9,
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
        480: {
            slidesPerView: 2.1,
        },
        640: {
            slidesPerView: 3.3,
        },
        768: {
            slidesPerView: 2.6,
        },
        920: {
            slidesPerView: 3.1,
        },
        1080: {
            slidesPerView: 3.5,
            spaceBetween: 20,
        },
        1280: {
            slidesPerView: 4.3,
            spaceBetween: 30,
        },
        1600: {
            slidesPerView: 4.6,
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
