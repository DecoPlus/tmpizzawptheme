document.documentElement.classList.add("has-js");

document.addEventListener("DOMContentLoaded", () => {
    const header = document.querySelector(".site-header");

    const menuToggle = document.querySelector(
        ".mobile-menu-toggle"
    );

    const navigation = document.querySelector(
        ".site-navigation"
    );

    const revealElements = document.querySelectorAll(
        ".reveal"
    );

    const interactiveCards = document.querySelectorAll(
        ".division-card, .project-card"
    );

    const reduceMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    ).matches;

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
     * Mobile menu
     */

    if (menuToggle && navigation) {
        menuToggle.addEventListener("click", () => {
            const isOpen =
                document.body.classList.toggle("menu-open");

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
        });

        navigation
            .querySelectorAll("a")
            .forEach((link) => {
                link.addEventListener("click", () => {
                    document.body.classList.remove(
                        "menu-open"
                    );

                    menuToggle.setAttribute(
                        "aria-expanded",
                        "false"
                    );
                });
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
                        if (!entry.isIntersecting) {
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
            element.classList.add("is-visible");
        });
    }

    /*
     * Pointer-following card light
     */

    const supportsFinePointer =
        window.matchMedia("(pointer: fine)").matches;

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