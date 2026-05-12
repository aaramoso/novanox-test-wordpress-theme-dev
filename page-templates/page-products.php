<?php
/**
 * Template Name: Products & Services Page
 *
 * @package YY_Bunker
 */

get_header();

$hero_bg_id  = yyb_option( 'yyb_products_hero_bg', '' );
$hero_bg_url = $hero_bg_id
    ? wp_get_attachment_image_url( $hero_bg_id, 'yyb-hero' )
    : get_template_directory_uri() . '/images/about-facility-bg.jpg';
?>

<!-- ========================================================
     PRODUCTS HERO
     ======================================================== -->
<section class="products-hero" id="products-hero" aria-label="Products Hero">
    <div class="products-hero__bg">
        <img src="<?php echo esc_url( $hero_bg_url ); ?>" alt="" aria-hidden="true">
        <div class="products-hero__overlay"></div>
    </div>

    <div class="container">
        <div class="products-hero__content">
            <h1 class="products-hero__heading animate-fade-up" style="animation-delay:0.1s;">
                Complete Duct<br>
                Fabrication<br>
                Capabilities
            </h1>
            <p class="products-hero__sub animate-fade-up" style="animation-delay:0.25s;">
                <?php esc_html_e( 'YYBunker Manufactures A Comprehensive Range Of Sheet Metal Ductwork And Ventilation Components From Our 20,000 Sq. Ft. Brooklyn Fabrication Facility. Every Product Is Built To Specification, Fabricated In-House, And Quality-Checked Before Leaving The Shop.', 'yy-bunker' ); ?>
            </p>
        </div>
    </div>
</section>

<!-- ========================================================
     DUCT SYSTEMS WE FABRICATE
     ======================================================== -->
<section class="section section--light duct-systems" id="duct-systems">
    <div class="container">

        <div class="section-header section-header--center" style="margin-bottom:2.5rem;">
            <h2 class="duct-systems__heading"><?php esc_html_e( 'Duct Systems We Fabricate', 'yy-bunker' ); ?></h2>
        </div>

        <div class="duct-systems__grid">
            <?php
            $ducts = [
                [ 'title' => 'Oval Duct',                    'img_key' => 'yyb_prod_img_oval',      'modifier' => 'oval',       'default' => 'fab-oval.png' ],
                [ 'title' => 'Spiral Round Duct',            'img_key' => 'yyb_prod_img_spiral',    'modifier' => 'spiral',     'default' => 'fab-spiral.png' ],
                [ 'title' => 'Rectangular Duct',             'img_key' => 'yyb_prod_img_rect',      'modifier' => 'rect',       'default' => 'fab-rect.png' ],
                [ 'title' => 'Black Iron Sheet Metal Duct',  'img_key' => 'yyb_prod_img_blackiron', 'modifier' => 'black-iron', 'default' => 'fab-blackiron.png' ],
                [ 'title' => 'Aluminum Sheet Metal Duct',    'img_key' => 'yyb_prod_img_aluminum',  'modifier' => 'aluminum',   'default' => 'fab-aluminum.png' ],
                [ 'title' => 'Custom & Specialty Fabrication','img_key' => 'yyb_prod_img_custom',   'modifier' => 'custom',     'default' => 'fab-custom.png' ],
            ];
            foreach ( $ducts as $duct ) :
                $img_id  = yyb_option( $duct['img_key'], '' );
                $img_url = $img_id
                    ? wp_get_attachment_image_url( $img_id, 'yyb-card' )
                    : get_template_directory_uri() . '/images/' . $duct['default'];
            ?>
            <div class="duct-card duct-card--<?php echo esc_attr( $duct['modifier'] ); ?>">
                <div class="duct-card__image">
                    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $duct['title'] ); ?>">
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- ========================================================
     SERVICES
     ======================================================== -->
<section class="section section--light ps-services" id="ps-services">
    <div class="container">

        <div class="section-header section-header--center" style="margin-bottom:2.5rem;">
            <h2 class="ps-services__heading"><?php esc_html_e( 'Services', 'yy-bunker' ); ?></h2>
        </div>

        <!-- Row 1: 3 cards -->
        <div class="ps-services__row ps-services__row--3">
            <?php
            $services_top = [
                [
                    'title'   => 'Material Takeoff From Plans',
                    'desc'    => 'Submit Your Shop Drawings Or Full Mechanical Plans And Our Estimating Team Will Perform A Complete, Accurate Material Takeoff. This Ensures You Receive The Correct Quantities, Minimizes Waste, And Reduces The Risk Of Costly Field Errors.',
                    'img_key' => 'yyb_svc_img_takeoff',
                    'default' => 'svc-takeoff.jpg',
                ],
                [
                    'title'   => 'Fabrication From Hand Sketches',
                    'desc'    => 'We Understand That Field Conditions Don\'t Always Produce Clean Drawings. If You\'re Working From A Hand Sketch, A Redline, Or A Field Measurement — Send It To Us. Our Experienced Team Knows How To Read And Translate Field Information Into Precise Fabricated Ductwork.',
                    'img_key' => 'yyb_svc_img_sketches',
                    'default' => 'svc-fabrication.jpg',
                ],
                [
                    'title'   => 'Delivery',
                    'desc'    => 'Completed Ductwork Is Delivered Directly To Your Job Site On A Schedule Coordinated With Your Installation Timeline. We Are Not Limited To A Specific Geographic Area — We Deliver Wherever Your Project Is Located.',
                    'img_key' => 'yyb_svc_img_delivery',
                    'default' => 'svc-delivery.jpg',
                ],
            ];
            foreach ( $services_top as $svc ) :
                $img_id  = yyb_option( $svc['img_key'], '' );
                $img_url = $img_id
                    ? wp_get_attachment_image_url( $img_id, 'yyb-card' )
                    : get_template_directory_uri() . '/images/' . $svc['default'];
            ?>
            <div class="ps-service-card">
                <div class="ps-service-card__image">
                    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $svc['title'] ); ?>">
                </div>
                <div class="ps-service-card__body">
                    <h3 class="ps-service-card__title"><?php echo esc_html( $svc['title'] ); ?></h3>
                    <p class="ps-service-card__desc"><?php echo esc_html( $svc['desc'] ); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Row 2: 2 cards -->
        <div class="ps-services__row ps-services__row--2">
            <?php
            $services_bot = [
                [
                    'title'   => 'Installation Services',
                    'desc'    => 'For Qualifying Projects, YYBunker Offers Duct Installation Services. Contact Our Team To Discuss The Scope And Logistics Of Your Project.',
                    'img_key' => 'yyb_svc_img_install',
                    'default' => 'svc-install.jpg',
                ],
                [
                    'title'   => 'General Contractor & Subcontractor Coordination',
                    'desc'    => 'We Work Regularly With General Contractors And Mechanical Subcontractors On Phased And Fast-Track Projects. We Understand Procurement Schedules, Phased Material Releases, And The Coordination Demands Of Active Construction Projects. Our Team Communicates Directly With Your Project Management To Keep Material Flowing On Schedule.',
                    'img_key' => 'yyb_svc_img_gc',
                    'default' => 'svc-gc.jpg',
                ],
            ];
            foreach ( $services_bot as $svc ) :
                $img_id  = yyb_option( $svc['img_key'], '' );
                $img_url = $img_id
                    ? wp_get_attachment_image_url( $img_id, 'yyb-card' )
                    : get_template_directory_uri() . '/images/' . $svc['default'];
            ?>
            <div class="ps-service-card">
                <div class="ps-service-card__image">
                    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $svc['title'] ); ?>">
                </div>
                <div class="ps-service-card__body">
                    <h3 class="ps-service-card__title"><?php echo esc_html( $svc['title'] ); ?></h3>
                    <p class="ps-service-card__desc"><?php echo esc_html( $svc['desc'] ); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- ========================================================
     MATERIALS & FINISHES
     ======================================================== -->
<section class="section section--light ps-materials" id="ps-materials">
    <div class="container">

        <div class="section-header section-header--center" style="margin-bottom:2.5rem;">
            <h2 class="ps-materials__heading"><?php esc_html_e( 'Materials & Finishes', 'yy-bunker' ); ?></h2>
        </div>

        <div class="ps-materials__list">
            <?php
            $materials = [
                [ 'num' => '01', 'name' => 'Galvanized Steel' ],
                [ 'num' => '02', 'name' => 'Black Iron (Mild Steel)' ],
                [ 'num' => '03', 'name' => 'Aluminum' ],
                [ 'num' => '04', 'name' => 'Stainless Steel' ],
            ];
            foreach ( $materials as $mat ) :
            ?>
            <div class="ps-material-row">
                <span class="ps-material-row__num"><?php echo esc_html( $mat['num'] ); ?>/</span>
                <span class="ps-material-row__name"><?php echo esc_html( $mat['name'] ); ?></span>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<?php get_footer(); ?>
