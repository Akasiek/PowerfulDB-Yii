// Initializing swiper
const swiper = new Swiper('.swiper', {

    // Optional parameters
    loop: false,
    grabCursor: true,

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    autoplay: {
        delay: 5000,
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