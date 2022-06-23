// Initializing swipers
const swiper = new Swiper('.default-swiper', {
    // Default parameters
    slidesPerView: 1.2,
    spaceBetween: 20,

    // Optional parameters
    loop: false,
    grabCursor: true,

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
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
        }
    },

});

const albumSwiper = new Swiper('.album-swiper', {
    // Default parameters
    slidesPerView: 2.1,
    spaceBetween: 10,

    // Optional parameters
    loop: false,
    grabCursor: true,

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
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
        }
    },

});