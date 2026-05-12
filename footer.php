</main><!-- #main-content -->

<!-- ========================================================
     TICKER MARQUEE
     ======================================================== -->
<div class="ticker" aria-hidden="true">
    <div class="ticker__track">
        <?php
        $ticker_items = [
            'HVAC Ductwork',
            'Custom Fabrication',
            'Sheet Metal',
            'Brooklyn NY',
            'Commercial HVAC',
            'Industrial Ventilation',
            'Precision Fabrication',
            'On-Time Delivery',
        ];
        $all_items = array_merge( $ticker_items, $ticker_items );
        foreach ( $all_items as $item ) :
        ?>
            <span class="ticker__item">
                <?php echo esc_html( $item ); ?>
                <span class="ticker__dot"></span>
            </span>
        <?php endforeach; ?>
    </div>
</div>

<!-- ========================================================
     SITE FOOTER
     ======================================================== -->
<footer class="site-footer site-footer--hvac" id="site-footer" role="contentinfo">

    <div class="site-footer__main">
        <div class="container">

            <div class="footer-hvac__grid">

                <!-- Left: Brand tagline -->
                <div class="footer-hvac__brand">
                    <p class="footer-hvac__tagline">
                        YYBunker &mdash;<br>
                        Fabricated in Brooklyn. Built for the Field.
                    </p>
                </div>

                <!-- Right: Contact info -->
                <div class="footer-hvac__contact">
                    <p class="footer-hvac__emergency">
                        <?php esc_html_e( '24 Hours &amp; Emergencies', 'yy-bunker' ); ?>
                    </p>

                    <a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', yyb_option( 'yyb_phone', '+9293339296' ) ) ); ?>" class="footer-hvac__contact-item">
                        <span class="footer-hvac__contact-icon"><?php echo yyb_icon( 'phone', 16 ); ?></span>
                        <span class="footer-hvac__contact-value">
                            <?php echo esc_html( yyb_option( 'yyb_phone', '+929 333 9296' ) ); ?>
                        </span>
                    </a>

                    <a href="https://maps.google.com/?q=<?php echo urlencode( yyb_option( 'yyb_address', '100 S Main St, New York, NY' ) ); ?>" class="footer-hvac__contact-item" target="_blank" rel="noopener noreferrer">
                        <span class="footer-hvac__contact-icon"><?php echo yyb_icon( 'map', 16 ); ?></span>
                        <span class="footer-hvac__contact-value">
                            <?php echo esc_html( yyb_option( 'yyb_address', '100 S Main St, New York, NY' ) ); ?>
                        </span>
                    </a>

                    <a href="mailto:<?php echo esc_attr( yyb_option( 'yyb_email', 'hvac@yybunker.com' ) ); ?>" class="footer-hvac__contact-item">
                        <span class="footer-hvac__contact-icon"><?php echo yyb_icon( 'mail', 16 ); ?></span>
                        <span class="footer-hvac__contact-value">
                            <?php echo esc_html( yyb_option( 'yyb_email', 'hvac@yybunker.com' ) ); ?>
                        </span>
                    </a>
                </div>

            </div><!-- .footer-hvac__grid -->

            <!-- Bottom row: logo + social -->
            <div class="footer-hvac__bottom">

                <div class="footer-hvac__logo-row">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" style="text-decoration:none;">
                        <?php if ( has_custom_logo() ) : ?>
                            <?php the_custom_logo(); ?>
                        <?php else : ?>
                            <img
                                src="<?php echo esc_url( get_template_directory_uri() . '/images/logomain.svg' ); ?>"
                                alt="<?php bloginfo( 'name' ); ?>"
                                class="site-logo__img"
                                width="140"
                                height="14"
                            >
                        <?php endif; ?>
                    </a>
                </div>

                <div class="footer-hvac__social">
                    <a href="#" class="footer-social__link" aria-label="Facebook">
                        <?php echo yyb_icon( 'fb', 16 ); ?>
                    </a>
                    <a href="#" class="footer-social__link" aria-label="TikTok">
                        <?php echo yyb_icon( 'tiktok', 16 ); ?>
                    </a>
                    <a href="#" class="footer-social__link" aria-label="Instagram">
                        <?php echo yyb_icon( 'ig', 16 ); ?>
                    </a>
                    <a href="#" class="footer-social__link" aria-label="YouTube">
                        <?php echo yyb_icon( 'youtube', 16 ); ?>
                    </a>
                </div>

            </div><!-- .footer-hvac__bottom -->

        </div><!-- .container -->
    </div><!-- .site-footer__main -->

    <!-- Footer Bottom Bar -->
    <div class="site-footer__bottom">
        <div class="container">
            <div class="site-footer__bottom-inner">
                <p class="site-footer__copyright">
                    &copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
                    <?php bloginfo( 'name' ); ?>.
                    <?php esc_html_e( 'All rights reserved.', 'yy-bunker' ); ?>
                </p>
                <nav class="site-footer__legal" aria-label="<?php esc_attr_e( 'Legal', 'yy-bunker' ); ?>">
                    <a href="#"><?php esc_html_e( 'Privacy Policy', 'yy-bunker' ); ?></a>
                    <a href="#"><?php esc_html_e( 'Terms of Service', 'yy-bunker' ); ?></a>
                </nav>
            </div>
        </div>
    </div><!-- .site-footer__bottom -->

</footer><!-- .site-footer -->

<?php wp_footer(); ?>
</body>
</html>
