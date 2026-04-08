


document.addEventListener('DOMContentLoaded', function () {

    const label = document.querySelector(".block_formula_section .slide_label a");

    const swiper = new Swiper(".naturalSwiper", {
        loop: true,
        centeredSlides: false,
        slidesPerView: "auto",
        spaceBetween: -100,
        speed: 800,
        grabCursor: true,

        navigation: {
            nextEl: ".block_formula_section .swiper-button-next",
            prevEl: ".block_formula_section .swiper-button-prev",
        },

        on: {
            init: function () {
                updateLabel(this);
            },
            slideChange: function () {
                updateLabel(this);
            }
        }
    });

    function updateLabel(swiperInstance) {
        const activeSlide = swiperInstance.slides[swiperInstance.activeIndex];
        const img = activeSlide.querySelector("img");
        const link = activeSlide.getAttribute("data-link");

        if (img && label) {
            label.textContent = img.alt.toUpperCase();
            label.setAttribute("href", link);
        }
    }

});


$(document).on('click', 'a.scroll', function(e) {
    e.preventDefault();

    var target = $(this).attr('href');

    if ($(target).length) {
        $('html, body').animate({
            scrollTop: $(target).offset().top - 150 
        }, 800); 
    }
});