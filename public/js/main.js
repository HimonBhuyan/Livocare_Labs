/**
 * Livocare Labs - Main Interactive Script
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Mobile Menu Drawer
    const mobileToggle = document.getElementById('mobileMenuToggle');
    const mobileDrawer = document.getElementById('mobileNavDrawer');
    const mobileDrawerClose = document.getElementById('mobileNavClose');

    const openDrawer = () => {
        if (mobileDrawer) {
            mobileDrawer.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    };

    const closeDrawer = () => {
        if (mobileDrawer) {
            mobileDrawer.classList.remove('active');
            document.body.style.overflow = '';
        }
    };

    if (mobileToggle) {
        mobileToggle.addEventListener('click', (e) => {
            e.preventDefault();
            openDrawer();
        });
    }

    if (mobileDrawerClose) {
        mobileDrawerClose.addEventListener('click', (e) => {
            e.preventDefault();
            closeDrawer();
        });
    }

    if (mobileDrawer) {
        mobileDrawer.addEventListener('click', (e) => {
            if (e.target === mobileDrawer) {
                closeDrawer();
            }
        });

        mobileDrawer.querySelectorAll('.drawer-nav-link').forEach(link => {
            link.addEventListener('click', () => {
                closeDrawer();
            });
        });
    }

    // Dismiss standard modals when tapping backdrop outside content
    document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
        backdrop.addEventListener('click', (e) => {
            if (e.target === backdrop) {
                backdrop.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    });

    // 2. FAQ Accordion
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const questionBtn = item.querySelector('.faq-question');
        if (questionBtn) {
            questionBtn.addEventListener('click', () => {
                const isActive = item.classList.contains('active');
                faqItems.forEach(el => el.classList.remove('active'));
                if (!isActive) {
                    item.classList.add('active');
                }
            });
        }
    });

    // 3. Fast Package Search Filter (on packages catalog page)
    const packageSearchInput = document.getElementById('livePackageSearch');
    const packageCards = document.querySelectorAll('.package-item-card');

    if (packageSearchInput && packageCards.length > 0) {
        packageSearchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase().trim();
            packageCards.forEach(card => {
                const name = card.getAttribute('data-name')?.toLowerCase() || '';
                const desc = card.getAttribute('data-desc')?.toLowerCase() || '';
                const category = card.getAttribute('data-category')?.toLowerCase() || '';

                if (name.includes(query) || desc.includes(query) || category.includes(query)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    // 4. Modal Triggers
    const modalOpeners = document.querySelectorAll('[data-open-modal]');
    modalOpeners.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const modalId = btn.getAttribute('data-open-modal');
            const targetModal = document.getElementById(modalId);
            if (targetModal) {
                targetModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        });
    });

    const modalClosers = document.querySelectorAll('.modal-close, [data-close-modal]');
    modalClosers.forEach(btn => {
        btn.addEventListener('click', () => {
            const openModals = document.querySelectorAll('.modal-backdrop.active');
            openModals.forEach(m => m.classList.remove('active'));
            document.body.style.overflow = '';
        });
    });

    // 5. Parameter Inspector Modal Populator
    const inspectParamBtns = document.querySelectorAll('[data-inspect-package]');
    inspectParamBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const name = btn.getAttribute('data-pkg-name');
            const testsCount = btn.getAttribute('data-pkg-count');
            const price = btn.getAttribute('data-pkg-price');
            const rawParams = btn.getAttribute('data-pkg-params');

            const titleEl = document.getElementById('modalPkgTitle');
            const countEl = document.getElementById('modalPkgCount');
            const priceEl = document.getElementById('modalPkgPrice');
            const listEl = document.getElementById('modalPkgParamsList');
            const bookLinkEl = document.getElementById('modalPkgBookBtn');
            const pkgId = btn.getAttribute('data-pkg-id');

            if (titleEl) titleEl.textContent = name;
            if (countEl) countEl.textContent = testsCount + ' Tests Included';
            if (priceEl) priceEl.textContent = '₹' + price;

            if (listEl) {
                listEl.innerHTML = '';
                try {
                    const parsed = JSON.parse(rawParams);
                    if (Array.isArray(parsed)) {
                        parsed.forEach(param => {
                            const li = document.createElement('li');
                            li.innerHTML = `<svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> <span>${param}</span>`;
                            listEl.appendChild(li);
                        });
                    }
                } catch (e) {
                    listEl.innerHTML = `<li>${rawParams}</li>`;
                }
            }

            if (bookLinkEl && pkgId) {
                let basePath = '';
                if (window.location.pathname.includes('/labcare/public')) {
                    basePath = '/labcare/public';
                } else if (window.location.pathname.includes('/labcare')) {
                    basePath = '/labcare';
                }
                bookLinkEl.href = `${window.location.origin}${basePath}/book?package_id=${pkgId}`;
            }

            const paramModal = document.getElementById('packageDetailsModal');
            if (paramModal) {
                paramModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        });
    });

    // 6. Set minimum booking date to today
    const datePicker = document.getElementById('preferredDateInput');
    if (datePicker) {
        const today = new Date().toISOString().split('T')[0];
        datePicker.min = today;
    }

    // 7. Dark Mode Toggle
    const themeTriggers = document.querySelectorAll('.theme-toggle-trigger');
    
    function toggleTheme() {
        const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
    }

    themeTriggers.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            toggleTheme();
        });
    });
});
