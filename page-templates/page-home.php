<?php
/**
 * Template Name: Home Page
 *
 * @package YY_Bunker
 */

get_header();

$hero_heading    = yyb_option( 'yyb_hero_heading',    'Precision Duct Fabrication. Every Type. Any Scale.' );
$hero_subheading = yyb_option( 'yyb_hero_subheading', 'YYBunker is a Brooklyn-based sheet metal duct fabrication shop specializing in the design and manufacturing of HVAC and ventilation ductwork for commercial, residential, and industrial projects. With a 20,000 sq. ft. facility and a devoted team of fabricators, we deliver precision-built ductwork — on time and to spec.' );
$hero_bg_id      = yyb_option( 'yyb_hero_bg', '' );
$hero_bg_url     = $hero_bg_id
    ? wp_get_attachment_image_url( $hero_bg_id, 'yyb-hero' )
    : get_template_directory_uri() . '/images/hero-bg.webp';
?>

<!-- ========================================================
     HERO SECTION
     ======================================================== -->
<section class="home-hero" id="hero" aria-label="Hero">
    <div class="home-hero__bg">
        <?php if ( $hero_bg_url ) : ?>
            <img src="<?php echo esc_url( $hero_bg_url ); ?>" alt="" aria-hidden="true">
        <?php endif; ?>
        <div class="home-hero__overlay"></div>
        <div class="home-hero__grid-pattern" aria-hidden="true"></div>
    </div>

    <div class="container">
        <div class="home-hero__content">

            <h1 class="home-hero__heading animate-fade-up" style="animation-delay:0.1s;">
                Precision Duct<br>
                Fabrication.<br>
                <span class="text-accent">Every Type. Any Scale</span>
            </h1>

            <p class="home-hero__sub animate-fade-up" style="animation-delay:0.2s;">
                <?php echo esc_html( $hero_subheading ); ?>
            </p>

            <div class="home-hero__actions animate-fade-up" style="animation-delay:0.3s;">
                <a href="<?php echo esc_url( home_url( '/contact-us' ) ); ?>" class="btn btn--primary btn--lg">
                    <?php esc_html_e( 'Request a Quote', 'yy-bunker' ); ?>
                </a>
                <a href="<?php echo esc_url( home_url( '/products' ) ); ?>" class="btn btn--outline btn--lg">
                    <?php esc_html_e( 'View Our Products', 'yy-bunker' ); ?>
                    <?php echo yyb_icon( 'arrow', 18 ); ?>
                </a>
            </div>

        </div><!-- .home-hero__content -->

        <div class="home-hero__corner home-hero__corner--tl" aria-hidden="true"></div>
        <div class="home-hero__corner home-hero__corner--br" aria-hidden="true"></div>
    </div>

    <div class="home-hero__scroll" aria-hidden="true">
        <span><?php esc_html_e( 'Scroll', 'yy-bunker' ); ?></span>
        <div class="home-hero__scroll-line"></div>
    </div>
</section>

<!-- ========================================================
     THE YYBUNKER DIFFERENCE
     ======================================================== -->
<section class="section section--light yyb-difference" id="difference">
    <div class="container">
        <div class="section-header section-header--center">
            <h2><?php esc_html_e( 'The YYBunker Difference', 'yy-bunker' ); ?></h2>
        </div>
        <div class="yyb-difference__body">
            <p class="yyb-difference__text">
                <?php esc_html_e( 'When your project demands accuracy, speed, and craftsmanship, you need a fabrication shop that treats every order as a priority. At YYBunker, we combine hands-on expertise with a fully equipped 20,000 sq. ft. production facility to deliver sheet metal ductwork that\'s built right — the first time.', 'yy-bunker' ); ?>
            </p>
            <p class="yyb-difference__text">
                <?php esc_html_e( 'We work directly from your shop drawings, mechanical plans, or hand sketches. Our team performs the full material takeoff and manages the fabrication process from start to finish — so you can stay focused on the job site.', 'yy-bunker' ); ?>
            </p>
            <div class="yyb-difference__cta">
                <a href="<?php echo esc_url( home_url( '/about-us' ) ); ?>" class="btn btn--primary">
                    <?php esc_html_e( 'About Company', 'yy-bunker' ); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ========================================================
     WHAT WE FABRICATE
     ======================================================== -->
<section class="section fabricate-section" id="fabricate">
    <div class="container">
        <div class="section-header section-header--center">
            <h2><?php esc_html_e( 'What We Fabricate', 'yy-bunker' ); ?></h2>
        </div>
        <div class="fabricate-grid">
            <?php
            $fab_products = [
                [
                    'title'    => 'Oval Duct',
                    'modifier' => 'oval',
                    'default'  => 'fab-oval.webp',
                ],
                [
                    'title'    => 'Spiral Round Duct',
                    'modifier' => 'spiral',
                    'default'  => 'fab-spiral.webp',
                ],
                [
                    'title'    => 'Rectangular Duct',
                    'modifier' => 'rect',
                    'default'  => 'fab-rect.webp',
                ],
                [
                    'title'    => 'Black Iron Sheet Metal Duct',
                    'modifier' => 'black-iron',
                    'default'  => 'fab-blackiron.webp',
                ],
                [
                    'title'    => 'Aluminum Sheet Metal Duct',
                    'modifier' => 'aluminum',
                    'default'  => 'fab-aluminum.webp',
                ],
                [
                    'title'    => 'Custom Duct & Specialty Fabrication',
                    'modifier' => 'custom',
                    'default'  => 'fab-custom.webp',
                ],
            ];
            foreach ( $fab_products as $prod ) :
                $img_key     = 'yyb_fab_img_' . $prod['modifier'];
                $img_id      = yyb_option( $img_key, '' );
                $img_url     = $img_id
                    ? wp_get_attachment_image_url( $img_id, 'yyb-card' )
                    : get_template_directory_uri() . '/images/' . $prod['default'];
            ?>
            <div class="fabricate-card">
                <div class="fabricate-card__title"><?php echo esc_html( $prod['title'] ); ?></div>
                <div class="fabricate-card__image fabricate-card__image--<?php echo esc_attr( $prod['modifier'] ); ?>">
                    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $prod['title'] ); ?>">
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ========================================================
     OUR PROCESS
     ======================================================== -->
<section class="section section--light process-section" id="process">
    <div class="container">
        <div class="section-header section-header--center">
            <h2><?php esc_html_e( 'Our Process', 'yy-bunker' ); ?></h2>
        </div>
        <div class="process-steps">
            <?php
            $steps = [
                [
                    'num'   => '1',
                    'title' => 'Submit Your Plans',
                    'desc'  => 'Send us shop drawings, mechanical plans, or hand sketches — we work with whatever format you have.',
                ],
                [
                    'num'   => '2',
                    'title' => 'We Handle the Takeoff',
                    'desc'  => 'Our team performs a thorough material takeoff, ensuring accurate quantities and eliminating costly errors before fabrication begins.',
                ],
                [
                    'num'   => '3',
                    'title' => 'Fabrication in Our Shop',
                    'desc'  => 'Your ductwork is fabricated in our 20,000 sq. ft. facility with precision forming equipment and rigorous quality checks at every stage.',
                ],
                [
                    'num'   => '4',
                    'title' => 'Delivery & Installation',
                    'desc'  => 'We deliver directly to your job site and offer installation services for qualifying projects — anywhere you need us.',
                ],
            ];
            foreach ( $steps as $step ) : ?>
            <div class="process-step">
                <div class="process-step__dot" aria-hidden="true"></div>
                <div class="process-step__label">
                    <?php
                    /* translators: %s: step number */
                    printf( esc_html__( 'Step %s:', 'yy-bunker' ), esc_html( $step['num'] ) );
                    ?>
                </div>
                <h3 class="process-step__title"><?php echo esc_html( $step['title'] ); ?></h3>
                <p class="process-step__desc"><?php echo esc_html( $step['desc'] ); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ========================================================
     WHO WE SERVE
     ======================================================== -->
<section class="section serve-section" id="serve">
    <div class="container">
        <div class="section-header section-header--center serve-header">
            <h2 class="serve-section__heading"><?php esc_html_e( 'Who We Serve', 'yy-bunker' ); ?></h2>
        </div>
        <div class="serve-tags" role="list">
            <?php
            $clients = [
                'Mechanical Contractors',
                'General Contractors',
                'Real Estate Developer',
                'Property Managers',
                'Commercial Kitchen Contractors',
            ];
            foreach ( $clients as $client ) : ?>
            <span class="serve-tag" role="listitem"><?php echo esc_html( $client ); ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ========================================================
     WHY PROFESSIONALS CHOOSE YYBUNKER
     ======================================================== -->
<section class="section section--light why-section" id="why">
    <div class="container">
        <div class="section-header section-header--center">
            <h2>
                <?php esc_html_e( 'Why Professionals Choose ', 'yy-bunker' ); ?>
                <span class="text-accent"><?php esc_html_e( 'YYBunker', 'yy-bunker' ); ?></span>
            </h2>
        </div>
        <div class="why-list">
            <?php
            $reasons = [
                '20,000 sq. ft. fabrication facility in Brooklyn, NY',
                'Full range of sheet metal duct types under one roof',
                'Complete takeoff service from drawings, plans, or sketches',
                'Fast turnaround — we understand construction schedules',
                'Delivery to your job site, wherever the project is',
                'Installation services available',
                'Experienced team with deep knowledge of the trade',
            ];
            foreach ( $reasons as $i => $reason ) : ?>
            <div class="why-item">
                <span class="why-item__num"><?php echo esc_html( str_pad( $i + 1, 2, '0', STR_PAD_LEFT ) ); ?>/</span>
                <span class="why-item__text"><?php echo esc_html( $reason ); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ========================================================
     BOTTOM HERO / WORKSHOP IMAGE
     ======================================================== -->
<section class="bottom-hero" aria-label="<?php esc_attr_e( 'YYBunker fabrication workshop', 'yy-bunker' ); ?>">
    <?php
    $bottom_bg_id  = yyb_option( 'yyb_bottom_bg', '' );
    $bottom_bg_url = $bottom_bg_id
        ? wp_get_attachment_image_url( $bottom_bg_id, 'full' )
        : get_template_directory_uri() . '/images/bottom-hero.webp'; ?>
    <img src="<?php echo esc_url( $bottom_bg_url ); ?>" alt="<?php esc_attr_e( 'YYBunker workshop team', 'yy-bunker' ); ?>" class="bottom-hero__img">
    <div class="bottom-hero__overlay"></div>
    <div class="bottom-hero__placeholder-pattern" aria-hidden="true"></div>
</section>

<?php get_footer(); ?>
