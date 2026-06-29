(function () {
    "use strict";

    // Preloader hide function
    window.addEventListener("load", () => {
        setTimeout(() => {
            document.getElementById("preloader").classList.add("hide");
        }, 2000);
    });

    // Search Toggler
    const searchTogglers = document.querySelectorAll(".search-toggler");
    if (searchTogglers.length > 0) {
        searchTogglers.forEach((searchToggler) => {
            searchToggler.addEventListener("click", function (e) {
                e.preventDefault();

                const searchPopup = document.querySelector(".search-popup");
                if (searchPopup) searchPopup.classList.toggle("active");

                const mobileNavWrapper = document.querySelector(".mobile-nav-wrapper");
                if (mobileNavWrapper) mobileNavWrapper.classList.remove("expanded");
            });
        });
    }

    // Counter Js
    document.addEventListener("DOMContentLoaded", function () {
        try {
            if ("IntersectionObserver" in window) {
                let counterObserver = new IntersectionObserver(function (
                    entries,
                    observer
                ) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            let counter = entry.target;
                            let target = parseInt(counter.innerText);
                            let step = target / 200;
                            let current = 0;
                            let timer = setInterval(function () {
                                current += step;
                                counter.innerText = Math.floor(current);
                                if (parseInt(counter.innerText) >= target) {
                                    clearInterval(timer);
                                }
                            }, 10);
                            counterObserver.unobserve(counter);
                        }
                    });
                });

                let counters = document.querySelectorAll(".counter");
                counters.forEach(function (counter) {
                    counterObserver.observe(counter);
                });
            }
        } catch (err) {}
    });

    // Swiper Sliders
    const partnerSwiper = new Swiper(".partnerSlider", {
        slidesPerView: 1,
        spaceBetween: 100,
        loop: true,
        speed: 1000,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            576: { slidesPerView: 2 },
            768: { slidesPerView: 2 },
            992: { slidesPerView: 3 },
            1200: { slidesPerView: 5 },
        },
    });

    const servicesSwiper = new Swiper(".servicesSlider", {
        slidesPerView: 1,
        spaceBetween: 25,
        loop: true,
        speed: 1000,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            768: { slidesPerView: 2 },
            992: { slidesPerView: 2 },
            1200: { slidesPerView: 3 },
        },
    });

    const testimonialsSwiper = new Swiper(".testimonialsSlider", {
        slidesPerView: 1,
        spaceBetween: 25,
        loop: true,
        speed: 1000,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    const reviewSwiper = new Swiper(".reviewSlider", {
        slidesPerView: 1,
        spaceBetween: 25,
        loop: true,
        speed: 1000,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            992: { slidesPerView: 2 },
            1200: { slidesPerView: 2 },
        },
    });

    const projectsSwiper = new Swiper(".projectsSlider", {
        slidesPerView: 1,
        spaceBetween: 25,
        loop: true,
        speed: 1500,
        pagination: {
            el: ".projects-pagination",
            clickable: true,
        },
        breakpoints: {
            992: { slidesPerView: 2 },
            1200: { slidesPerView: 2 },
            1400: { slidesPerView: 3 },
        },
    });

    const worksSwiper = new Swiper(".worksSlider", {
        slidesPerView: 1,
        spaceBetween: 25,
        loop: true,
        speed: 1000,
        breakpoints: {
            768: { slidesPerView: 2 },
            992: { slidesPerView: 2 },
            1200: { slidesPerView: 3 },
        },
    });

    const feedbackSwiper = new Swiper(".feedbackSlider", {
        slidesPerView: 1,
        spaceBetween: 25,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

    // Scroll Event go Top
    try {
        document.addEventListener("DOMContentLoaded", function () {
            const backToTopButton = document.querySelector(".back-to-top");
            if (!backToTopButton) return;

            window.addEventListener("scroll", function () {
                if (window.pageYOffset > 300) {
                    backToTopButton.classList.add("show");
                } else {
                    backToTopButton.classList.remove("show");
                }
            });

            backToTopButton.addEventListener("click", function (e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: "smooth",
                });
            });
        });
    } catch (err) {}

    // Hover Effect
    try {
        var elements = document.querySelectorAll("[id^='my-element']");
        elements.forEach(function (element) {
            element.addEventListener("mouseover", function () {
                elements.forEach(function (el) {
                    el.classList.remove("active");
                });
                element.classList.add("active");
            });
        });
    } catch (err) {}

    // scrollCue Init
    if (typeof scrollCue !== "undefined") {
        scrollCue.init();
    }

})();

// Mobile Navbar Accordion
const list = document.querySelectorAll(".mobile-menu-list");
function accordion(e) {
    e.stopPropagation();
    if (this.classList.contains("active")) {
        this.classList.remove("active");
    } else if (this.parentElement.parentElement.classList.contains("active")) {
        this.classList.add("active");
    } else {
        for (let i = 0; i < list.length; i++) {
            list[i].classList.remove("active");
        }
        this.classList.add("active");
    }
}
for (let i = 0; i < list.length; i++) {
    list[i].addEventListener("click", accordion);
}

// Header Sticky
const getHeaderId = document.getElementById("navbar");
if (getHeaderId) {
    window.addEventListener("scroll", (event) => {
        const height = 150;
        const { scrollTop } = event.target.scrollingElement;
        getHeaderId.classList.toggle("sticky", scrollTop >= height);
    });
}
