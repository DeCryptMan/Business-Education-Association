/**
 * Main Application Script
 * Unified, Optimized, and Error-Free.
 */

document.addEventListener('DOMContentLoaded', () => {
    initStickyHeader();
    initMobileMenu();
    initScrollAnimations();
    initForms();
    initYear();
});

/**
 * 1. Smart Sticky Header
 * Optimized with requestAnimationFrame for performance.
 */
const initStickyHeader = () => {
    const header = document.getElementById('nf-header');
    if (!header) return;

    let ticking = false;
    window.addEventListener('scroll', () => {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                if (window.scrollY > 10) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
                ticking = false;
            });
            ticking = true;
        }
    });
};

/**
 * 2. Mobile Menu Logic
 * Matches IDs from main.php layout.
 */
const initMobileMenu = () => {
    const burger = document.getElementById('nf-burger');
    const drawer = document.getElementById('nf-mobile-drawer');
    const backdrop = document.getElementById('nf-backdrop');
    const closeBtn = document.getElementById('nf-menu-close');

    if (!drawer) return;

    const toggleMenu = (show) => {
        if (show) {
            drawer.classList.add('open');
            if (backdrop) backdrop.classList.add('open');
            document.body.style.overflow = 'hidden'; // Block scroll
        } else {
            drawer.classList.remove('open');
            if (backdrop) backdrop.classList.remove('open');
            document.body.style.overflow = ''; // Enable scroll
        }
    };

    if (burger) burger.addEventListener('click', () => toggleMenu(true));
    if (closeBtn) closeBtn.addEventListener('click', () => toggleMenu(false));
    if (backdrop) backdrop.addEventListener('click', () => toggleMenu(false));

    // Close menu when clicking any link inside it
    drawer.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => toggleMenu(false));
    });
};

/**
 * 3. Scroll Animations (Intersection Observer)
 * Handles .nf-animate elements.
 */
const initScrollAnimations = () => {
    const animatedElements = document.querySelectorAll('.nf-animate');
    if (!animatedElements.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Start animation
                entry.target.style.opacity = '1';
                entry.target.style.animationPlayState = 'running';
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 }); // Trigger when 10% is visible

    animatedElements.forEach(el => {
        el.style.opacity = '0'; // Hide initially
        el.style.animationPlayState = 'paused';
        observer.observe(el);
    });
};

/**
 * 4. Form Handling (AJAX)
 * Optimized for PHP $_POST compatibility using FormData.
 */
const initForms = () => {
    const forms = document.querySelectorAll('.nf-contact-form');

    forms.forEach(form => {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const btn = form.querySelector('button[type="submit"]');
            const statusDiv = form.querySelector('.nf-form-status');
            const endpoint = form.getAttribute('data-endpoint');

            // UI: Loading State
            if (btn) {
                const spinner = btn.querySelector('.spinner-border');
                if (spinner) spinner.classList.remove('d-none');
                btn.disabled = true;
                btn.style.opacity = '0.8';
            }
            if (statusDiv) statusDiv.innerHTML = '';

            try {
                // Use FormData directly. This sends data as 'multipart/form-data',
                // which PHP's $_POST automatically populates.
                const formData = new FormData(form);

                const response = await fetch(endpoint, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                // Verify JSON response
                const contentType = response.headers.get("content-type");
                if (!contentType || !contentType.includes("application/json")) {
                    throw new Error("Server Error: Received non-JSON response.");
                }

                const result = await response.json();

                if (result.success) {
                    // SUCCESS
                    form.reset();
                    if (statusDiv) {
                        statusDiv.innerHTML = `
                            <div class="nf-status-msg nf-status-success">
                                <span class="nf-status-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                </span>
                                <span>${result.message}</span>
                            </div>
                        `;
                    }
                    // Optional Redirect
                    if (result.redirect) {
                        setTimeout(() => window.location.href = result.redirect, 2000);
                    }
                } else {
                    // LOGICAL ERROR (from backend)
                    throw new Error(result.message || 'Error processing request');
                }

            } catch (error) {
                console.error('Form Error:', error);
                if (statusDiv) {
                    statusDiv.innerHTML = `
                        <div class="nf-status-msg nf-status-error">
                            <span class="nf-status-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </span>
                            <span>${error.message}</span>
                        </div>
                    `;
                }
            } finally {
                // Reset Button State
                if (btn) {
                    const spinner = btn.querySelector('.spinner-border');
                    if (spinner) spinner.classList.add('d-none');
                    btn.disabled = false;
                    btn.style.opacity = '1';
                }
            }
        });
    });
};

/**
 * 5. Footer Year
 */
const initYear = () => {
    const el = document.querySelector('#year');
    if (el) el.textContent = new Date().getFullYear();
}; 