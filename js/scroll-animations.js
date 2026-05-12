(function () {
    'use strict';

    var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* ============================================================
       INTERSECTION OBSERVER — SCROLL REVEAL
       ============================================================ */

    var revealObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('sr-visible');
                revealObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -60px 0px'
    });

    function addReveal(el, type, delay) {
        if (!el || el.hasAttribute('data-sr-done')) return;
        el.setAttribute('data-sr-done', '1');
        el.classList.add('sr-item', type);
        if (delay) el.style.transitionDelay = delay + 's';
        revealObserver.observe(el);
    }

    /* Stagger all direct children of a grid/list container */
    function staggerChildren(parentSelector, type, baseDelay) {
        document.querySelectorAll(parentSelector).forEach(function (parent) {
            Array.from(parent.children).forEach(function (child, i) {
                var delay = (baseDelay || 0) + (i * 0.1);
                addReveal(child, type, delay);
            });
        });
    }

    function initScrollReveal() {

        /* --- Section headers ---------------------------------- */
        document.querySelectorAll('.section-header').forEach(function (el) {
            addReveal(el, 'sr-fade-up', 0);
        });

        /* --- Home page ---------------------------------------- */
        staggerChildren('.fabricate-grid',   'sr-scale-up');
        staggerChildren('.process-steps',    'sr-fade-up');
        staggerChildren('.wws-grid',         'sr-fade-up');
        staggerChildren('.why-list',         'sr-fade-right');

        document.querySelectorAll('.yyb-diff__content').forEach(function (el) {
            addReveal(el, 'sr-fade-up', 0);
        });
        document.querySelectorAll('.bottom-hero__content').forEach(function (el) {
            addReveal(el, 'sr-fade-up', 0.1);
        });

        /* --- About page --------------------------------------- */
        document.querySelectorAll('.about-whatwedo__content').forEach(function (el) {
            addReveal(el, 'sr-fade-right', 0);
        });
        document.querySelectorAll('.about-whatwedo__image').forEach(function (el) {
            addReveal(el, 'sr-fade-left', 0.15);
        });
        staggerChildren('.about-team__carousel', 'sr-scale-up');
        staggerChildren('.about-approach__grid', 'sr-fade-up');
        document.querySelectorAll('.about-facility__content').forEach(function (el) {
            addReveal(el, 'sr-fade-up', 0);
        });

        /* --- Products page ------------------------------------ */
        staggerChildren('.duct-systems__grid',   'sr-scale-up');
        staggerChildren('.ps-services__row--3',  'sr-fade-up');
        staggerChildren('.ps-services__row--2',  'sr-fade-up');
        staggerChildren('.ps-materials__list',   'sr-fade-right');

        /* --- Store page --------------------------------------- */
        staggerChildren('.store-products__grid', 'sr-scale-up');
        staggerChildren('.store-features__list', 'sr-fade-right');

        /* --- Contact page ------------------------------------- */
        document.querySelectorAll('.contact-form-wrap').forEach(function (el) {
            addReveal(el, 'sr-fade-up', 0);
        });
        document.querySelectorAll('.contact-info-wrap').forEach(function (el) {
            addReveal(el, 'sr-fade-left', 0.15);
        });

        /* --- Who we serve pills (home) ----------------------- */
        staggerChildren('.wws-pills', 'sr-fade-up');

        /* --- Ticker ------------------------------------------ */
        document.querySelectorAll('.ticker').forEach(function (el) {
            addReveal(el, 'sr-fade-up', 0);
        });

        /* --- Footer grid ------------------------------------- */
        document.querySelectorAll('.footer-hvac__brand').forEach(function (el) {
            addReveal(el, 'sr-fade-right', 0);
        });
        document.querySelectorAll('.footer-hvac__contact').forEach(function (el) {
            addReveal(el, 'sr-fade-left', 0.1);
        });
    }

    /* ============================================================
       PARALLAX — hero background images
       ============================================================ */

    var parallaxEls = [];
    var rafPending  = false;

    function collectParallax() {
        var selectors = [
            '.home-hero__bg img',
            '.about-hero__bg img',
            '.products-hero__bg img',
            '.store-hero__bg img',
            '.about-facility__bg-img',
            '.bottom-hero__img',
        ];
        selectors.forEach(function (sel) {
            document.querySelectorAll(sel).forEach(function (img) {
                var section = img.closest('section') || img.parentElement.parentElement;
                parallaxEls.push({ img: img, section: section });
            });
        });
    }

    function updateParallax() {
        var scrollY = window.pageYOffset;
        var vh      = window.innerHeight;

        parallaxEls.forEach(function (item) {
            var rect = item.section.getBoundingClientRect();
            if (rect.bottom < -100 || rect.top > vh + 100) return;
            var progress = (scrollY - (scrollY + rect.top - vh)) / (rect.height + vh);
            var offset   = (progress - 0.5) * 120;
            item.img.style.transform = 'translateY(' + offset + 'px) scale(1.18)';
        });

        rafPending = false;
    }

    function onScroll() {
        if (!rafPending) {
            rafPending = true;
            requestAnimationFrame(updateParallax);
        }
    }

    function initParallax() {
        if (prefersReduced) return;
        collectParallax();
        if (!parallaxEls.length) return;
        window.addEventListener('scroll', onScroll, { passive: true });
        updateParallax();
    }

    /* ============================================================
       SMOOTH SECTION TRANSITIONS — add class when entering view
       ============================================================ */

    var sectionObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('section-in-view');
            }
        });
    }, { threshold: 0.05 });

    function initSectionHighlight() {
        document.querySelectorAll('section').forEach(function (s) {
            sectionObserver.observe(s);
        });
    }

    /* ============================================================
       INIT
       ============================================================ */

    document.addEventListener('DOMContentLoaded', function () {
        if (prefersReduced) {
            /* Immediately show everything for accessibility */
            document.querySelectorAll('.sr-item').forEach(function (el) {
                el.classList.add('sr-visible');
            });
            return;
        }
        initScrollReveal();
        initParallax();
        initSectionHighlight();
    });

})();
