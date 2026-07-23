<footer class="site-footer">

    <div class="container">

        <div class="site-footer__top">

            <div class="site-footer__brand">

                <a
                    class="site-footer__logo"
                    href="<?php echo esc_url(home_url('/')); ?>"
                >
                    <span></span>
                    TM Pizza
                </a>

                <p>
                    Játékok, filmek és kreatív projektek
                    egy közösségben.
                </p>

            </div>

            <div class="site-footer__navigation">

                <div class="site-footer__column">

                    <span>Felfedezés</span>

                    <a href="#home">Kezdőlap</a>
                    <a href="#divisions">Részlegek</a>
                    <a href="#projects">Projektek</a>
                    <a href="#about">Rólunk</a>

                </div>

                <div class="site-footer__column">

                    <span>Közösség</span>

                    <!-- Ide kerül majd a saját Discord-linked. -->
                    <a href="https://discord.gg/2JyHYtj3xm">Discord ↗</a>

                    <!-- Ide kerülhet majd a GitHub repo linked. -->
                    <a href="https://github.com/DecoPlus/tmpizzawptheme">GitHub ↗</a>

                    <a href="#join">Csatlakozás</a>

                </div>

                <div class="site-footer__column">

                    <span>Részlegek</span>

                    <a href="#divisions">The Monitor Pixel</a>
                    <a href="#divisions">Tárcsa Productions</a>
                    <a href="#divisions">Workshoppies!</a>

                </div>

            </div>

        </div>

        <div class="site-footer__bottom">

            <p>
                © <?php echo esc_html(wp_date('Y')); ?>
                TM Pizza. Minden jog fenntartva.
            </p>

            <div class="site-footer__status">

                <span></span>

                <p>
                    A weboldal saját WordPress témával működik
                </p>

            </div>

            <a href="#home">
                Vissza az elejére ↑
            </a>

        </div>

    </div>

</footer>

<?php wp_footer(); ?>

</body>
</html>