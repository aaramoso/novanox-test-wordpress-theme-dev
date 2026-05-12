<?php
/**
 * Template Name: Contact Us Page
 *
 * @package YY_Bunker
 */

get_header();
?>

<!-- ========================================================
     HERO
     ======================================================== -->
<section class="contact-hero">
    <div class="container">
        <div class="contact-hero__grid">
            <div>
                <h1 class="contact-hero__heading">LET'S START<br>YOUR PROJECT</h1>
            </div>
            <div>
                <p class="contact-hero__desc">Whether You're Working On A Straightforward Commercial HVAC System Or A Complex Industrial Ventilation Project, YYBunker Has The Capability And The Team To Fabricate Your Ductwork To Spec. Reach Out With Your Plans, Drawings, Or Sketches — And We Will Take It From There.</p>
            </div>
        </div>
    </div>
</section>

<!-- ========================================================
     CONTACT SECTION
     ======================================================== -->
<section class="contact-project">
    <div class="container">
        <div class="contact-project__layout">

            <!-- Form Card -->
            <div class="contact-project__form-card">
                <h2 class="contact-project__form-title"><?php esc_html_e( 'Submit A Project', 'yy-bunker' ); ?></h2>

                <p class="contact-project__form-intro"><?php esc_html_e( 'To Receive An Accurate Quote As Quickly As Possible, Please Include The Following When Reaching Out:', 'yy-bunker' ); ?></p>
                <ul class="contact-project__form-list">
                    <li><?php esc_html_e( 'Shop Drawings, Mechanical Plans, Or Hand Sketches Of Your Duct System', 'yy-bunker' ); ?></li>
                    <li><?php esc_html_e( 'Duct Types, Sizes, And Quantities Required', 'yy-bunker' ); ?></li>
                    <li><?php esc_html_e( 'Material And Gauge Requirements (If Specified)', 'yy-bunker' ); ?></li>
                    <li><?php esc_html_e( 'Delivery Location And Required Timeline', 'yy-bunker' ); ?></li>
                    <li><?php esc_html_e( 'Any Special Fabrication Requirements Or Project Specifications', 'yy-bunker' ); ?></li>
                </ul>
                <p class="contact-project__form-outro"><?php esc_html_e( 'Our Team Will Review Your Submittal, Perform A Takeoff If Needed, And Respond With Pricing And A Production Lead Time. We Prioritize Fast, Accurate Quotes — Because We Know Your Schedule Depends On It.', 'yy-bunker' ); ?></p>

                <form class="contact-project-form" id="contact-form" novalidate>
                    <?php wp_nonce_field( 'yyb_nonce', 'yyb_nonce_field' ); ?>

                    <div class="contact-project-field">
                        <label class="contact-project-label" for="cp-name"><?php esc_html_e( 'Name*:', 'yy-bunker' ); ?></label>
                        <input type="text" id="cp-name" name="name" class="contact-project-input" required>
                    </div>

                    <div class="contact-project-field">
                        <label class="contact-project-label" for="cp-company"><?php esc_html_e( 'Company*:', 'yy-bunker' ); ?></label>
                        <input type="text" id="cp-company" name="company" class="contact-project-input" required>
                    </div>

                    <div class="contact-project-field">
                        <label class="contact-project-label" for="cp-phone"><?php esc_html_e( 'Phone*:', 'yy-bunker' ); ?></label>
                        <input type="tel" id="cp-phone" name="phone" class="contact-project-input" required>
                    </div>

                    <div class="contact-project-field">
                        <label class="contact-project-label" for="cp-email"><?php esc_html_e( 'Email*:', 'yy-bunker' ); ?></label>
                        <input type="email" id="cp-email" name="email" class="contact-project-input" required>
                    </div>

                    <div class="contact-project-field">
                        <label class="contact-project-label" for="cp-project-type"><?php esc_html_e( 'Project Type*:', 'yy-bunker' ); ?></label>
                        <input type="text" id="cp-project-type" name="project_type" class="contact-project-input" required>
                    </div>

                    <div class="contact-project-field">
                        <label class="contact-project-label" for="cp-message"><?php esc_html_e( 'Message*:', 'yy-bunker' ); ?></label>
                        <textarea id="cp-message" name="message" class="contact-project-textarea" required></textarea>
                    </div>

                    <!-- File Upload -->
                    <div class="contact-project-upload" onclick="document.getElementById('cp-files').click()">
                        <div class="contact-project-upload__icon">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><polyline points="9 15 12 12 15 15"/></svg>
                        </div>
                        <p class="contact-project-upload__title"><?php esc_html_e( 'Upload drawings/sketches', 'yy-bunker' ); ?></p>
                        <p class="contact-project-upload__types">JPG, PNG, PDF</p>
                        <span class="contact-project-upload__link"><?php esc_html_e( 'Upload Files', 'yy-bunker' ); ?> &#8593;</span>
                        <input type="file" id="cp-files" name="files[]" multiple accept=".jpg,.jpeg,.png,.pdf" style="display:none;" aria-label="<?php esc_attr_e( 'Upload drawings or sketches', 'yy-bunker' ); ?>">
                    </div>

                    <div id="contact-feedback" class="contact-feedback" aria-live="polite" style="display:none;"></div>

                    <button type="submit" class="btn btn--primary contact-project-submit" id="contact-submit">
                        <span class="btn-text"><?php esc_html_e( 'Send', 'yy-bunker' ); ?></span>
                    </button>
                </form>
            </div><!-- .contact-project__form-card -->

            <!-- Contact Info -->
            <div class="contact-project__info">

                <div class="contact-project__info-item">
                    <div class="contact-project__info-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <div>
                        <div class="contact-project__info-label"><?php esc_html_e( 'Company:', 'yy-bunker' ); ?></div>
                        <div class="contact-project__info-value"><?php esc_html_e( 'YYBunker – Sheet Metal Duct Fabrication', 'yy-bunker' ); ?></div>
                    </div>
                </div>

                <div class="contact-project__info-item">
                    <div class="contact-project__info-icon">
                        <?php echo yyb_icon( 'map', 20 ); ?>
                    </div>
                    <div>
                        <div class="contact-project__info-label"><?php esc_html_e( 'Location:', 'yy-bunker' ); ?></div>
                        <div class="contact-project__info-value"><?php echo nl2br( esc_html( yyb_option( 'yyb_address', 'Brooklyn, New York' ) ) ); ?></div>
                    </div>
                </div>

                <div class="contact-project__info-item">
                    <div class="contact-project__info-icon">
                        <?php echo yyb_icon( 'phone', 20 ); ?>
                    </div>
                    <div>
                        <div class="contact-project__info-label"><?php esc_html_e( 'Phone:', 'yy-bunker' ); ?></div>
                        <div class="contact-project__info-value">
                            <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', yyb_option( 'yyb_phone', '+9293339296' ) ) ); ?>">
                                <?php echo esc_html( yyb_option( 'yyb_phone', '+929 333 9296' ) ); ?>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="contact-project__info-item">
                    <div class="contact-project__info-icon">
                        <?php echo yyb_icon( 'mail', 20 ); ?>
                    </div>
                    <div>
                        <div class="contact-project__info-label"><?php esc_html_e( 'Email:', 'yy-bunker' ); ?></div>
                        <div class="contact-project__info-value">
                            <a href="mailto:<?php echo esc_attr( yyb_option( 'yyb_email', 'contact@coolair.com' ) ); ?>">
                                <?php echo esc_html( yyb_option( 'yyb_email', 'Contact@Coolair.Com' ) ); ?>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="contact-project__info-item">
                    <div class="contact-project__info-icon">
                        <?php echo yyb_icon( 'clock', 20 ); ?>
                    </div>
                    <div>
                        <div class="contact-project__info-label"><?php esc_html_e( 'Business Hours:', 'yy-bunker' ); ?></div>
                        <div class="contact-project__info-value"><?php echo esc_html( yyb_option( 'yyb_hours', 'Mon – Fri 08:00 – 18:00' ) ); ?></div>
                    </div>
                </div>

            </div><!-- .contact-project__info -->

        </div><!-- .contact-project__layout -->
    </div>
</section>

<?php get_footer(); ?>
