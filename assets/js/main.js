document.documentElement.classList.add("has-js");

document.addEventListener("DOMContentLoaded", () => {
    const DEVICE_STORAGE_KEY =
        "tmpizza-device-view";

    const allowedDeviceModes = [
        "desktop",
        "mobile",
        "tablet",
    ];

    const header =
        document.querySelector(".site-header");

    const menuToggle =
        document.querySelector(
            ".mobile-menu-toggle"
        );

    const navigation =
        document.querySelector(
            ".site-navigation"
        );

    const revealElements =
        document.querySelectorAll(".reveal");

    const interactiveCards =
        document.querySelectorAll(
            ".division-card, .project-card"
        );

    const deviceDialog =
        document.querySelector(
            "#device-dilemma"
        );

    const deviceChoiceButtons =
        document.querySelectorAll(
            "[data-device-choice]"
        );

    const deviceResetButtons =
        document.querySelectorAll(
            "[data-device-reset]"
        );

    const reduceMotion =
        window.matchMedia(
            "(prefers-reduced-motion: reduce)"
        ).matches;

    let currentDeviceSource = null;

    /*
     * Local storage helpers
     */

    const readSavedDeviceMode = () => {
        try {
            const savedMode =
                localStorage.getItem(
                    DEVICE_STORAGE_KEY
                );

            return allowedDeviceModes.includes(
                savedMode
            )
                ? savedMode
                : null;
        } catch (error) {
            return null;
        }
    };

    const saveDeviceMode = (mode) => {
        try {
            localStorage.setItem(
                DEVICE_STORAGE_KEY,
                mode
            );
        } catch (error) {
            /*
             * Continue without saved preference.
             */
        }
    };

    const clearSavedDeviceMode = () => {
        try {
            localStorage.removeItem(
                DEVICE_STORAGE_KEY
            );
        } catch (error) {
            /*
             * Continue without local storage.
             */
        }
    };

    /*
     * Apply selected device layout
     */

    const applyDeviceMode = (
        mode,
        {
            remember = false,
            source = "automatic",
        } = {}
    ) => {
        if (!allowedDeviceModes.includes(mode)) {
            return;
        }

        document.documentElement.classList.remove(
            "view-desktop",
            "view-mobile",
            "view-tablet"
        );

        document.documentElement.classList.add(
            `view-${mode}`
        );

        document.documentElement.dataset.deviceView =
            mode;

        currentDeviceSource = source;

        if (remember) {
            saveDeviceMode(mode);
        }

        document.body.classList.remove(
            "menu-open"
        );

        if (menuToggle) {
            menuToggle.setAttribute(
                "aria-expanded",
                "false"
            );
        }
    };

    /*
     * Device detection
     */

    const detectDeviceMode = () => {
        const viewportWidth =
            window.innerWidth ||
            document.documentElement.clientWidth;

        const screenWidth =
            window.screen?.width ||
            viewportWidth;

        const screenHeight =
            window.screen?.height ||
            viewportWidth;

        const shortestScreenSide =
            Math.min(
                screenWidth,
                screenHeight
            );

        const coarsePointer =
            window.matchMedia(
                "(pointer: coarse)"
            ).matches;

        const finePointer =
            window.matchMedia(
                "(pointer: fine)"
            ).matches;

        const canHover =
            window.matchMedia(
                "(hover: hover)"
            ).matches;

        const touchPoints =
            navigator.maxTouchPoints || 0;

        const hasTouch =
            coarsePointer ||
            touchPoints > 0;

        /*
         * Obvious phone
         */

        if (
            hasTouch &&
            !finePointer &&
            shortestScreenSide <= 600
        ) {
            return "mobile";
        }

        /*
         * Obvious tablet
         */

        if (
            hasTouch &&
            coarsePointer &&
            !finePointer &&
            shortestScreenSide > 600
        ) {
            return "tablet";
        }

        /*
         * Obvious desktop
         */

        if (
            viewportWidth >= 1100 &&
            finePointer &&
            canHover &&
            touchPoints === 0
        ) {
            return "desktop";
        }

        /*
         * Touch laptop, unusual tablet,
         * resized desktop or another
         * uncertain device.
         */

        return null;
    };

    /*
     * Device dilemma modal
     */

    const openDeviceDialog = () => {
        if (!deviceDialog) {
            return;
        }

        deviceDialog.classList.remove(
            "is-closing"
        );

        deviceDialog.hidden = false;

        document.body.classList.add(
            "device-dilemma-open"
        );

        window.requestAnimationFrame(() => {
            const firstButton =
                deviceDialog.querySelector(
                    "[data-device-choice]"
                );

            firstButton?.focus();
        });
    };

    const closeDeviceDialog = () => {
        if (!deviceDialog) {
            return;
        }

        const finishClose = () => {
            deviceDialog.hidden = true;

            deviceDialog.classList.remove(
                "is-closing"
            );

            document.body.classList.remove(
                "device-dilemma-open"
            );
        };

        if (reduceMotion) {
            finishClose();
            return;
        }

        deviceDialog.classList.add(
            "is-closing"
        );

        window.setTimeout(
            finishClose,
            200
        );
    };

    deviceChoiceButtons.forEach((button) => {
        button.addEventListener(
            "click",
            () => {
                const selectedMode =
                    button.dataset.deviceChoice;

                applyDeviceMode(
                    selectedMode,
                    {
                        remember: true,
                        source: "manual",
                    }
                );

                closeDeviceDialog();
            }
        );
    });

    deviceResetButtons.forEach((button) => {
        button.addEventListener(
            "click",
            () => {
                clearSavedDeviceMode();
                openDeviceDialog();
            }
        );
    });

    /*
     * Keep keyboard focus inside modal
     */

    if (deviceDialog) {
        deviceDialog.addEventListener(
            "keydown",
            (event) => {
                if (
                    event.key !== "Tab" ||
                    deviceDialog.hidden
                ) {
                    return;
                }

                const focusableElements =
                    Array.from(
                        deviceDialog.querySelectorAll(
                            "button:not([disabled])"
                        )
                    );

                if (
                    focusableElements.length === 0
                ) {
                    return;
                }

                const firstElement =
                    focusableElements[0];

                const lastElement =
                    focusableElements[
                        focusableElements.length - 1
                    ];

                if (
                    event.shiftKey &&
                    document.activeElement ===
                        firstElement
                ) {
                    event.preventDefault();
                    lastElement.focus();
                } else if (
                    !event.shiftKey &&
                    document.activeElement ===
                        lastElement
                ) {
                    event.preventDefault();
                    firstElement.focus();
                }
            }
        );
    }

    /*
     * Initialize device mode
     */

    const savedDeviceMode =
        readSavedDeviceMode();

    if (savedDeviceMode) {
        applyDeviceMode(
            savedDeviceMode,
            {
                source: "manual",
            }
        );
    } else {
        const detectedDeviceMode =
            detectDeviceMode();

        if (detectedDeviceMode) {
            applyDeviceMode(
                detectedDeviceMode,
                {
                    source: "automatic",
                }
            );
        } else {
            openDeviceDialog();
        }
    }

    /*
     * Re-evaluate automatic selection
     * after significant viewport changes.
     */

    let resizeTimer = null;

    window.addEventListener(
        "resize",
        () => {
            window.clearTimeout(resizeTimer);

            resizeTimer = window.setTimeout(
                () => {
                    if (
                        currentDeviceSource !==
                        "automatic"
                    ) {
                        return;
                    }

                    const newMode =
                        detectDeviceMode();

                    if (newMode) {
                        applyDeviceMode(
                            newMode,
                            {
                                source:
                                    "automatic",
                            }
                        );
                    }
                },
                300
            );
        },
        {
            passive: true,
        }
    );

    /*
     * Header scroll state
     */

    const updateHeader = () => {
        if (!header) {
            return;
        }

        header.classList.toggle(
            "is-scrolled",
            window.scrollY > 25
        );
    };

    updateHeader();

    window.addEventListener(
        "scroll",
        updateHeader,
        {
            passive: true,
        }
    );

    /*
     * Mobile navigation
     */

    if (menuToggle && navigation) {
        menuToggle.addEventListener(
            "click",
            () => {
                const isOpen =
                    document.body.classList.toggle(
                        "menu-open"
                    );

                menuToggle.setAttribute(
                    "aria-expanded",
                    String(isOpen)
                );

                menuToggle.setAttribute(
                    "aria-label",
                    isOpen
                        ? "Menü bezárása"
                        : "Menü megnyitása"
                );
            }
        );

        navigation
            .querySelectorAll("a")
            .forEach((link) => {
                link.addEventListener(
                    "click",
                    () => {
                        document.body.classList.remove(
                            "menu-open"
                        );

                        menuToggle.setAttribute(
                            "aria-expanded",
                            "false"
                        );
                    }
                );
            });
    }

    /*
     * Scroll reveal
     */

    if (
        !reduceMotion &&
        "IntersectionObserver" in window
    ) {
        const revealObserver =
            new IntersectionObserver(
                (entries, observer) => {
                    entries.forEach((entry) => {
                        if (
                            !entry.isIntersecting
                        ) {
                            return;
                        }

                        entry.target.classList.add(
                            "is-visible"
                        );

                        observer.unobserve(
                            entry.target
                        );
                    });
                },
                {
                    threshold: 0.12,
                    rootMargin:
                        "0px 0px -60px 0px",
                }
            );

        revealElements.forEach((element) => {
            revealObserver.observe(element);
        });
    } else {
        revealElements.forEach((element) => {
            element.classList.add(
                "is-visible"
            );
        });
    }

    /*
     * Pointer-following card light
     */

    const supportsFinePointer =
        window.matchMedia(
            "(pointer: fine)"
        ).matches;

    if (
        supportsFinePointer &&
        !reduceMotion
    ) {
        interactiveCards.forEach((card) => {
            card.addEventListener(
                "pointermove",
                (event) => {
                    const bounds =
                        card.getBoundingClientRect();

                    const x =
                        ((event.clientX -
                            bounds.left) /
                            bounds.width) *
                        100;

                    const y =
                        ((event.clientY -
                            bounds.top) /
                            bounds.height) *
                        100;

                    card.style.setProperty(
                        "--pointer-x",
                        `${x}%`
                    );

                    card.style.setProperty(
                        "--pointer-y",
                        `${y}%`
                    );
                }
            );

            card.addEventListener(
                "pointerleave",
                () => {
                    card.style.setProperty(
                        "--pointer-x",
                        "50%"
                    );

                    card.style.setProperty(
                        "--pointer-y",
                        "50%"
                    );
                }
            );
        });
    }
});