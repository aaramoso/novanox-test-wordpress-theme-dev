<?php
/**
 * Template Name: About Us Page
 *
 * @package YY_Bunker
 */

get_header();

$hero_bg_id  = yyb_option( 'yyb_about_hero_bg', '' );
$hero_bg_url = $hero_bg_id
    ? wp_get_attachment_image_url( $hero_bg_id, 'yyb-hero' )
    : get_template_directory_uri() . '/images/about-hero-bg.png';
?>

<!-- ========================================================
     ABOUT HERO
     ======================================================== -->
<section class="about-hero" id="about-hero" aria-label="About Hero">
    <div class="about-hero__bg">
        <img src="<?php echo esc_url( $hero_bg_url ); ?>" alt="" aria-hidden="true">
        <div class="about-hero__overlay"></div>
        <div class="about-hero__grid-pattern" aria-hidden="true"></div>
    </div>

    <div class="container">
        <div class="about-hero__content">
            <h1 class="about-hero__heading animate-fade-up" style="animation-delay:0.1s;">
                Built on Precision.<br>
                Driven by<br>
                Craftsmanship.
            </h1>
            <div class="about-hero__body animate-fade-up" style="animation-delay:0.25s;">
                <p><?php esc_html_e( 'YYBunker Is A Sheet Metal Duct Fabrication Shop Headquartered In Brooklyn, New York. We Operate A 20,000 Sq. Ft. Manufacturing Facility Dedicated To The Fabrication Of HVAC And Mechanical Ductwork — Serving Contractors, Engineers, Architects, And Industrial Clients Across A Wide Range Of Project Types And Scales.', 'yy-bunker' ); ?></p>
                <p><?php esc_html_e( 'We Are Fabricators. That Means Every Piece Of Duct That Leaves Our Shop Was Designed, Formed, And Quality-Checked By Our Team — Not Sourced From A Distributor, Not Stock Material Off A Shelf. Your Duct Is Built To Your Project\'s Exact Specifications, Every Time.', 'yy-bunker' ); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- ========================================================
     WHAT WE DO
     ======================================================== -->
<section class="section section--light about-whatwedo" id="about-what-we-do">
    <div class="container">
        <div class="about-whatwedo__grid">

            <div class="about-whatwedo__content">
                <h2 class="about-whatwedo__heading"><?php esc_html_e( 'What We Do', 'yy-bunker' ); ?></h2>
                <p><?php esc_html_e( 'We Fabricate Every Type Of Sheet Metal Ductwork Used In Modern HVAC And Ventilation Systems: Oval Duct, Spiral Round Duct, Rectangular Duct, Black Iron Sheet Metal, Aluminum Sheet Metal, And Fully Custom Configurations. Whether Your Project Is A Residential Building, A Commercial High-Rise, A Restaurant Kitchen Exhaust System, Or A Heavy Industrial Facility — We Have The Capability And The Experience To Deliver.', 'yy-bunker' ); ?></p>
                <p><?php esc_html_e( 'We Accept Submittals In Any Format: Shop Drawings, Stamped Mechanical Plans, Or Contractor Hand Sketches — Our Team Takes It From There, Performing A Full Material Takeoff And Managing Fabrication From First Cut To Final Piece.', 'yy-bunker' ); ?></p>
            </div>

            <div class="about-whatwedo__image">
                <?php
                $wwd_img_id  = yyb_option( 'yyb_about_wwd_img', '' );
                $wwd_img_url = $wwd_img_id
                    ? wp_get_attachment_image_url( $wwd_img_id, 'yyb-card' )
                    : get_template_directory_uri() . '/images/about-whatwedo.jpg';
                ?>
                <img src="<?php echo esc_url( $wwd_img_url ); ?>" alt="<?php esc_attr_e( 'HVAC Ductwork Fabrication', 'yy-bunker' ); ?>">
            </div>

        </div>
    </div>
</section>

<!-- ========================================================
     OUR FACILITY
     ======================================================== -->
<section class="about-facility" id="about-facility" aria-label="Our Facility">
    <?php
    $fac_bg_id  = yyb_option( 'yyb_about_facility_bg', '' );
    $fac_bg_url = $fac_bg_id
        ? wp_get_attachment_image_url( $fac_bg_id, 'full' )
        : get_template_directory_uri() . '/images/about-facility-bg.jpg';
    ?>
    <img src="<?php echo esc_url( $fac_bg_url ); ?>" alt="" class="about-facility__bg-img" aria-hidden="true">
    <div class="about-facility__overlay"></div>

    <div class="container">
        <div class="about-facility__content">
            <h2 class="about-facility__heading"><?php esc_html_e( 'Our Facility', 'yy-bunker' ); ?></h2>
            <p class="about-facility__text"><?php esc_html_e( 'Our 20,000 Sq. Ft. Brooklyn-Based Fabrication Shop Is Equipped With Precision Sheet Metal Forming Machinery, Allowing Us To Produce Ductwork Across A Full Range Of Sizes, Gauges, And Configurations. Every Production Run Goes Through Quality Control To Ensure Dimensional Accuracy, Proper Seaming, And Performance Compliance Before Delivery.', 'yy-bunker' ); ?></p>
        </div>
    </div>
</section>

<!-- ========================================================
     OUR TEAM
     ======================================================== -->
<section class="section section--light about-team" id="about-team">
    <div class="container">

        <div class="section-header section-header--center">
            <h2><?php esc_html_e( 'Our Team', 'yy-bunker' ); ?></h2>
            <p class="about-team__subtitle"><?php esc_html_e( 'At YY BUNKER, Our Strength Lies In Our People.', 'yy-bunker' ); ?></p>
            <p class="about-team__desc"><?php esc_html_e( 'Behind Every Project Is A Devoted Team Of Skilled Fabricators, Estimators, And Project Coordinators Who Take Ownership Of Your Order From Submission To Delivery. We Understand That Delays On The Shop Floor Become Delays On The Job Site — Which Is Why Fast, Accurate Turnaround Is Built Into How We Work, Not Just Promised.', 'yy-bunker' ); ?></p>
        </div>

        <div class="about-team__carousel-wrapper">
            <div class="about-team__carousel">
                <?php
                $team = [
                    [
                        'name'    => 'David Chen',
                        'role'    => 'Senior Systems Engineer',
                        'img_key' => 'yyb_team_img_david',
                        'default' => 'about-team-1.jpg',
                    ],
                    [
                        'name'     => 'Jeffery Mussman',
                        'role'     => 'Founder & CEO',
                        'img_key'  => 'yyb_team_img_jeffery',
                        'default'  => 'about-team-2.jpg',
                        'featured' => true,
                    ],
                    [
                        'name'    => 'Michael "Mike" Davidson',
                        'role'    => 'Project Manager',
                        'img_key' => 'yyb_team_img_mike',
                        'default' => 'about-team-3.jpg',
                    ],
                ];
                foreach ( $team as $member ) :
                    $featured = ! empty( $member['featured'] ) ? ' about-team-card--featured' : '';
                    $img_id   = yyb_option( $member['img_key'], '' );
                    $img_url  = $img_id
                        ? wp_get_attachment_image_url( $img_id, 'yyb-thumb' )
                        : get_template_directory_uri() . '/images/' . $member['default'];
                ?>
                <div class="about-team-card<?php echo esc_attr( $featured ); ?>">
                    <div class="about-team-card__photo">
                        <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $member['name'] ); ?>">
                    </div>
                    <div class="about-team-card__info">
                        <h3 class="about-team-card__name"><?php echo esc_html( $member['name'] ); ?></h3>
                        <p class="about-team-card__role"><?php echo esc_html( $member['role'] ); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="about-team__nav">
                <button class="about-team__nav-btn" aria-label="<?php esc_attr_e( 'Previous', 'yy-bunker' ); ?>">
                    <?php echo yyb_icon( 'chevron-left', 18 ); ?>
                </button>
                <button class="about-team__nav-btn" aria-label="<?php esc_attr_e( 'Next', 'yy-bunker' ); ?>">
                    <?php echo yyb_icon( 'chevron-right', 18 ); ?>
                </button>
            </div>
        </div>

    </div>
</section>

<!-- ========================================================
     OUR APPROACH
     ======================================================== -->
<section class="section about-approach" id="about-approach">
    <div class="container">

        <div class="section-header section-header--center" style="margin-bottom:3rem;">
            <h2><?php esc_html_e( 'Our Approach', 'yy-bunker' ); ?></h2>
        </div>

        <div class="about-approach__grid">
            <?php
            $approaches = [
                [
                    'icon'  => 'target',
                    'title' => 'Precision First',
                    'desc'  => 'Accurate Takeoffs, Tight Tolerances, and Consistent Quality Control Are Not Optional — They Are How We Operate On Every Order, Regardless Of Size.',
                ],
                [
                    'icon'  => 'settings',
                    'title' => 'Flexibility',
                    'desc'  => 'Every Project Is Different. We Fabricate Standard Systems As Efficiently As We Handle Complex Custom Configurations. If You Have A Unique Requirement, Bring It To Us.',
                ],
                [
                    'icon'  => 'handshake',
                    'title' => 'Partnership',
                    'desc'  => 'We Work Closely With Mechanical Contractors, HVAC Subs, GCs, And Design Professionals. We Are Not Just A Vendor — We Are An Extension Of Your Project Team, Invested In The Success Of Your Installation.',
                ],
                [
                    'icon'  => 'shield-check',
                    'title' => 'Reliability',
                    'desc'  => 'When You Submit A Project To YYBunker, You Get A Committed Timeline, Clear Communication, And Ductwork That Arrives Ready For The Field.',
                ],
            ];
            foreach ( $approaches as $item ) :
            ?>
            <div class="about-approach-card">
                <div class="about-approach-card__icon-wrap">
                    <?php echo yyb_icon( $item['icon'], 32 ); ?>
                </div>
                <h3 class="about-approach-card__title"><?php echo esc_html( $item['title'] ); ?></h3>
                <p class="about-approach-card__desc"><?php echo esc_html( $item['desc'] ); ?></p>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<?php get_footer(); ?>
