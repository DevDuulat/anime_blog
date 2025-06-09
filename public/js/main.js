/*  ---------------------------------------------------
    Theme Name: Anime
    Description: Anime video tamplate
    Author: Colorib
    Author URI: https://colorib.com/
    Version: 1.0
    Created: Colorib
---------------------------------------------------------  */

"use strict";

(function ($) {
    /*------------------
        Preloader
    --------------------*/
    $(window).on("load", function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");

        /*------------------
            FIlter
        --------------------*/
        $(".filter__controls li").on("click", function () {
            $(".filter__controls li").removeClass("active");
            $(this).addClass("active");
        });
        if ($(".filter__gallery").length > 0) {
            var containerEl = document.querySelector(".filter__gallery");
            var mixer = mixitup(containerEl);
        }
    });

    /*------------------
        Background Set
    --------------------*/
    $(".set-bg").each(function () {
        var bg = $(this).data("setbg");
        $(this).css("background-image", "url(" + bg + ")");
    });

    // Search model
    $(".search-switch").on("click", function () {
        $(".search-model").fadeIn(400);
    });

    $(".search-close-switch").on("click", function () {
        $(".search-model").fadeOut(400, function () {
            $("#search-input").val("");
        });
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: "#mobile-menu-wrap",
        allowParentLinks: true,
    });

    /*------------------
		Hero Slider
	--------------------*/
    var hero_s = $(".hero__slider");
    hero_s.owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: true,
        nav: true,
        navText: [
            "<span class='arrow_carrot-left'></span>",
            "<span class='arrow_carrot-right'></span>",
        ],
        animateOut: "fadeOut",
        animateIn: "fadeIn",
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        mouseDrag: false,
    });

    /*------------------
        Video Player
    --------------------*/
    const player = new Plyr("#player", {
        controls: [
            "play-large",
            "play",
            "progress",
            "current-time",
            "mute",
            "captions",
            "settings",
            "fullscreen",
        ],
        seekTime: 25,
    });

    /*------------------
        Niceselect
    --------------------*/
    $("select").niceSelect();

    /*------------------
        Scroll To Top
    --------------------*/
    $("#scrollToTopButton").click(function () {
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });
})(jQuery);

/*Шапка сайта выпадающий список */
document.addEventListener("DOMContentLoaded", function () {
    // Основное меню (если нужно по клику)
    const mainLink = document.querySelector(".menu-item > a");
    const mainDropdown = document.querySelector(".menu-item > .dropdown");

    mainLink.addEventListener("click", function (e) {
        e.preventDefault();
        mainDropdown.classList.toggle("show");
    });

    // Подменю "Драмма"
    const subToggle = document.querySelector(".submenu-toggle");
    const subMenu = document.querySelector(".dropdown-sub");

    subToggle.addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation(); // не закрывает всё меню
        subMenu.classList.toggle("show");
    });

    // Закрытие всех меню при клике вне
    document.addEventListener("click", function (e) {
        if (!mainDropdown.contains(e.target) && !mainLink.contains(e.target)) {
            mainDropdown.classList.remove("show");
        }
        if (!subMenu.contains(e.target) && !subToggle.contains(e.target)) {
            subMenu.classList.remove("show");
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".blog-dropdown-toggle").forEach(function (item) {
        item.addEventListener("click", function (e) {
            e.stopPropagation();
            const submenu = this.querySelector(".blog-submenu");
            const isOpen = submenu.style.display === "block";

            // Закрыть все
            document.querySelectorAll(".blog-submenu").forEach(function (sm) {
                sm.style.display = "none";
            });

            // Открыть текущее
            submenu.style.display = isOpen ? "none" : "block";
        });
    });

    // Клик вне — закрыть
    document.addEventListener("click", function () {
        document.querySelectorAll(".blog-submenu").forEach(function (sm) {
            sm.style.display = "none";
        });
    });
});
