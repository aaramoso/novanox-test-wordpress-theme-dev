/**
 * YY Bunker — Main JavaScript
 * @author Anthony Ramoso
 * @version 1.0.0
 */

(function () {
    'use strict';

    // ============================================================
    // DOM READY
    // ============================================================

    document.addEventListener('DOMContentLoaded', function () {
        initHeader();
        initMobileNav();
        initFAQ();
        initContactForm();
        initProductTabs();
        initStoreFilters();
        initScrollAnimations();
        initHeroAnimations();
    });

    // ============================================================
    // HEADER — scroll behavior
    // ============================================================

    function initHeader() {
        var header = document.getElementById('site-header');
        if (!header) return;

        var lastScroll = 0;

        function onScroll() {
            var scrollY = window.pageYOffset;
            if (scrollY > 40) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
            lastScroll = scrollY;
        }

        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    // ============================================================
    // MOBILE NAVIGATION
    // ============================================================

    function initMobileNav() {
        var toggle = document.getElementById('nav-toggle');
        var nav    = document.getElementById('site-nav');
        if (!toggle || !nav) return;

        toggle.addEventListener('click', function () {
            var isOpen = nav.classList.toggle('is-open');
            toggle.classList.toggle('is-active', isOpen);
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            document.body.style.overflow = isOpen ? 'hidden' : '';
        });

        // Close on outside click
        document.addEventListener('click', function (e) {
            if (!toggle.contains(e.target) && !nav.contains(e.target)) {
                nav.classList.remove('is-open');
                toggle.classList.remove('is-active');
                toggle.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            }
        });

        // Close on ESC
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && nav.classList.contains('is-open')) {
                nav.classList.remove('is-open');
                toggle.classList.remove('is-active');
                toggle.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
                toggle.focus();
            }
        });
    }

    // ============================================================
    // FAQ ACCORDION
    // ============================================================

    function initFAQ() {
        var items = document.querySelectorAll('.faq-item__question');
        items.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var answerId = this.getAttribute('aria-controls');
                var answer   = document.getElementById(answerId);
                var expanded = this.getAttribute('aria-expanded') === 'true';

                // Close all others
                items.forEach(function (other) {
                    if (other !== btn) {
                        other.setAttribute('aria-expanded', 'false');
                        var otherId  = other.getAttribute('aria-controls');
                        var otherAns = document.getElementById(otherId);
                        if (otherAns) otherAns.hidden = true;
                    }
                });

                // Toggle current
                this.setAttribute('aria-expanded', !expanded ? 'true' : 'false');
                if (answer) answer.hidden = expanded;
            });
        });
    }

    // ============================================================
    // CONTACT FORM — AJAX
    // ============================================================

    function initContactForm() {
        var form     = document.getElementById('contact-form');
        var feedback = document.getElementById('contact-feedback');
        var submitBtn = document.getElementById('contact-submit');
        if (!form) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            var name    = form.querySelector('[name="name"]').value.trim();
            var email   = form.querySelector('[name="email"]').value.trim();
            var subjectEl = form.querySelector('[name="subject"]');
            var subject = subjectEl ? subjectEl.value : '';
            var message = form.querySelector('[name="message"]').value.trim();
            var nonce   = form.querySelector('[name="yyb_nonce_field"]') ? form.querySelector('[name="yyb_nonce_field"]').value : '';

            if (!name || !email || !message) {
                showFeedback('Please fill in all required fields.', 'error');
                return;
            }

            if (!isValidEmail(email)) {
                showFeedback('Please enter a valid email address.', 'error');
                return;
            }

            // Loading state
            var btnText = submitBtn.querySelector('.btn-text');
            btnText.textContent = 'Sending…';
            submitBtn.disabled  = true;

            var data = new FormData();
            data.append('action',  'yyb_contact');
            data.append('nonce',   nonce);
            data.append('name',    name);
            data.append('email',   email);
            data.append('subject', subject);
            data.append('message', message);

            var ajaxUrl = (typeof YYBunker !== 'undefined') ? YYBunker.ajaxUrl : '/wp-admin/admin-ajax.php';

            fetch(ajaxUrl, { method: 'POST', body: data })
                .then(function (res) { return res.json(); })
                .then(function (res) {
                    if (res.success) {
                        showFeedback(res.data.message || 'Message sent successfully!', 'success');
                        form.reset();
                    } else {
                        showFeedback(res.data.message || 'Failed to send message. Please try again.', 'error');
                    }
                })
                .catch(function () {
                    showFeedback('Network error. Please check your connection and try again.', 'error');
                })
                .finally(function () {
                    btnText.textContent = 'Send';
                    submitBtn.disabled  = false;
                });
        });

        function showFeedback(msg, type) {
            if (!feedback) return;
            feedback.textContent = msg;
            feedback.className   = 'contact-feedback ' + type;
            feedback.style.display = 'block';
            feedback.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    }

    // ============================================================
    // PRODUCT TABS
    // ============================================================

    function initProductTabs() {
        var tabs = document.querySelectorAll('.product-tab');
        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                tabs.forEach(function (t) {
                    t.classList.remove('is-active');
                    t.setAttribute('aria-selected', 'false');
                });
                this.classList.add('is-active');
                this.setAttribute('aria-selected', 'true');
                // In a real implementation, filter products here
            });
        });
    }

    // ============================================================
    // STORE FILTERS
    // ============================================================

    function initStoreFilters() {
        var catBtns = document.querySelectorAll('.store-filter__item');
        catBtns.forEach(function (item) {
            var btn = item.querySelector('.store-filter__cat-btn');
            if (!btn) return;
            btn.addEventListener('click', function () {
                catBtns.forEach(function (i) { i.classList.remove('is-active'); });
                item.classList.add('is-active');
                // Filter logic would go here
            });
        });
    }

    // ============================================================
    // SCROLL ANIMATIONS — IntersectionObserver
    // ============================================================

    function initScrollAnimations() {
        if (!('IntersectionObserver' in window)) return;

        var elements = document.querySelectorAll(
            '.stat-box, .card, .product-card, .service-card, .value-card, ' +
            '.team-card, .category-card, .feature-item, .about-mv__card, ' +
            '.bulk-tier, .faq-item'
        );

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'fadeUp 0.5s ease forwards';
                    entry.target.style.opacity   = '1';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

        elements.forEach(function (el) {
            el.style.opacity = '0';
            observer.observe(el);
        });
    }

    // ============================================================
    // HERO ANIMATIONS — trigger on load
    // ============================================================

    function initHeroAnimations() {
        var animTargets = document.querySelectorAll('.animate-fade-up');
        animTargets.forEach(function (el) {
            // Trigger CSS animation
            el.style.animationName = 'fadeUp';
            el.style.animationDuration = '0.7s';
            el.style.animationFillMode = 'forwards';
            el.style.animationTimingFunction = 'ease';
        });
    }

    // ============================================================
    // UTILITY
    // ============================================================

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

})();
