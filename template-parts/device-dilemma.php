<?php
/**
 * Device view selector
 *
 * @package TMPizza
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<div
    class="device-dilemma"
    id="device-dilemma"
    role="dialog"
    aria-modal="true"
    aria-labelledby="device-dilemma-title"
    aria-describedby="device-dilemma-description"
    hidden
>

    <div
        class="device-dilemma__backdrop"
        aria-hidden="true"
    ></div>

    <div class="device-dilemma__panel">

        <div
            class="device-dilemma__glow
                   device-dilemma__glow--red"
            aria-hidden="true"
        ></div>

        <div
            class="device-dilemma__glow
                   device-dilemma__glow--orange"
            aria-hidden="true"
        ></div>

        <div class="device-dilemma__header">

            <span class="device-dilemma__eyebrow">
                TM Pizza eszközfelismerés
            </span>

            <span class="device-dilemma__code">
                DEVICE / UNKNOWN
            </span>

        </div>

        <div class="device-dilemma__content">

            <div class="device-dilemma__title-row">

                <div
                    class="device-dilemma__warning"
                    aria-hidden="true"
                >
                    ?
                </div>

                <div>

                    <h2 id="device-dilemma-title">
                        Dilemma...
                    </h2>

                    <p id="device-dilemma-description">
                        Oldalunk nem tudja biztosan eldönteni,
                        hogy telefonról vagy számítógépről
                        próbálod elérni.
                    </p>

                </div>

            </div>

            <h3>
                Milyen eszközt használsz jelenleg?
            </h3>

            <div class="device-dilemma__options">

                <button
                    class="device-option"
                    type="button"
                    data-device-choice="desktop"
                >

                    <span class="device-option__icon">

                        <svg
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <rect
                                x="3"
                                y="4"
                                width="18"
                                height="12"
                                rx="2"
                            />

                            <path d="M8 20h8" />
                            <path d="M12 16v4" />
                        </svg>

                    </span>

                    <span class="device-option__content">

                        <strong>
                            PC
                        </strong>

                        <small>
                            Egér és nagy kijelző
                        </small>

                    </span>

                    <span
                        class="device-option__arrow"
                        aria-hidden="true"
                    >
                        ↗
                    </span>

                </button>

                <button
                    class="device-option"
                    type="button"
                    data-device-choice="mobile"
                >

                    <span class="device-option__icon">

                        <svg
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <rect
                                x="7"
                                y="2"
                                width="10"
                                height="20"
                                rx="2.5"
                            />

                            <path d="M10.5 18.5h3" />
                        </svg>

                    </span>

                    <span class="device-option__content">

                        <strong>
                            Telefon
                        </strong>

                        <small>
                            Érintés és keskeny kijelző
                        </small>

                    </span>

                    <span
                        class="device-option__arrow"
                        aria-hidden="true"
                    >
                        ↗
                    </span>

                </button>

                <button
                    class="device-option"
                    type="button"
                    data-device-choice="tablet"
                >

                    <span class="device-option__icon">

                        <svg
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <rect
                                x="4"
                                y="2"
                                width="16"
                                height="20"
                                rx="2.5"
                            />

                            <circle
                                cx="12"
                                cy="18.5"
                                r="0.7"
                            />
                        </svg>

                    </span>

                    <span class="device-option__content">

                        <strong>
                            Tablet
                        </strong>

                        <small>
                            Érintés és közepes kijelző
                        </small>

                    </span>

                    <span
                        class="device-option__arrow"
                        aria-hidden="true"
                    >
                        ↗
                    </span>

                </button>

            </div>

            <div class="device-dilemma__note">

                <span aria-hidden="true"></span>

                <p>
                    A választásodat megjegyezzük ezen a
                    böngészőn. Később a footerben található
                    „Nézet módosítása” gombbal megváltoztathatod.
                </p>

            </div>

        </div>

    </div>

</div>