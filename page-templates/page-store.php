<?php
/**
 * Template Name: Supply Store Page
 *
 * @package YY_Bunker
 */

get_header();

$hero_bg_id  = yyb_option( 'yyb_store_hero_bg', '' );
$hero_bg_url = $hero_bg_id
    ? wp_get_attachment_image_url( $hero_bg_id, 'yyb-hero' )
    : get_template_directory_uri() . '/images/hero-store-optimized.jpg';
?>

<!-- ========================================================
     STORE HERO
     ======================================================== -->
<section class="store-hero" id="store-hero" aria-label="Store Hero">
    <div class="store-hero__bg">
        <img src="<?php echo esc_url( $hero_bg_url ); ?>" alt="" aria-hidden="true">
        <div class="store-hero__overlay"></div>
        <div class="store-hero__grid-pattern" aria-hidden="true"></div>
    </div>

    <div class="container">
        <div class="store-hero__content">
            <h1 class="store-hero__heading animate-fade-up" style="animation-delay:0.1s;">
                Everything You Need<br>
                For The Job.<br>
                Right Next To The Shop.
            </h1>
            <p class="store-hero__sub animate-fade-up" style="animation-delay:0.25s;">
                <?php esc_html_e( 'Located Right Alongside Our Fabrication Facility In Brooklyn, The YYBunker Supply Store Is A Fully Stocked HVAC Supply Counter Serving Mechanical Contractors, HVAC Technicians, And Tradespeople. Pick Up What You Need — When You Need It — Without The Wait.', 'yy-bunker' ); ?>
            </p>
            <div class="store-hero__actions animate-fade-up" style="animation-delay:0.35s;">
                <a href="#store-info" class="btn btn--primary btn--lg">
                    <?php esc_html_e( 'Visit The Store', 'yy-bunker' ); ?>
                </a>
                <a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', yyb_option( 'yyb_phone', '+9293339296' ) ) ); ?>" class="btn btn--outline btn--lg">
                    <?php esc_html_e( 'Call To Check Availability', 'yy-bunker' ); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ========================================================
     ABOUT THE STORE
     ======================================================== -->
<section class="section section--light store-about" id="store-about">
    <div class="container">
        <div class="store-about__grid">

            <div class="store-about__content">
                <h2 class="store-about__heading"><?php esc_html_e( 'About The Store', 'yy-bunker' ); ?></h2>
                <p><?php esc_html_e( 'The YYBunker Supply Store Was Built With One Purpose: To Give The Contractors And Tradespeople Who Work In The Industry A Reliable, Well-Stocked Source For The Materials And Components They Need For Every Job. We Carry A Wide Inventory Of HVAC Supply Products — Duct Fittings, Insulation, Filters, Tape, Tools, Accessories, And More. All In One Place.', 'yy-bunker' ); ?></p>
                <p><?php esc_html_e( 'Walk In With What You Need, And Get Back To The Job. No Long Lead Times. No Minimum Orders. No Runaround.', 'yy-bunker' ); ?></p>
            </div>

            <div class="store-about__image">
                <?php
                $about_img_id  = yyb_option( 'yyb_store_about_img', '' );
                $about_img_url = $about_img_id
                    ? wp_get_attachment_image_url( $about_img_id, 'yyb-card' )
                    : get_template_directory_uri() . '/images/about-whatwedo.jpg';
                ?>
                    <img src="<?php echo esc_url( $about_img_url ); ?>" alt="<?php esc_attr_e( 'YYBunker Supply Store', 'yy-bunker' ); ?>">
            </div>

        </div>
    </div>
</section>

<!-- ========================================================
     WHAT WE CARRY
     ======================================================== -->
<section class="section section--light store-whatwecarry" id="store-whatwecarry">
    <div class="container">

        <div class="section-header section-header--center" style="margin-bottom:0.75rem;">
            <h2 class="store-whatwecarry__heading"><?php esc_html_e( 'What We Carry', 'yy-bunker' ); ?></h2>
            <p class="store-whatwecarry__sub"><?php esc_html_e( 'Our Supply Store Stocks A Comprehensive Range Of Products Across Every Major HVAC Supply Category. Below Is A Full Overview — Remove Any Categories That Don\'t Apply To Your Inventory.', 'yy-bunker' ); ?></p>
        </div>

        <div class="store-cat-grid">
            <?php
            $categories = [
                [
                    'title'   => 'Duct Fittings & Connectors',
                    'img_key' => 'yyb_store_cat_fittings',
                    'mod'     => 'fittings',
                    'default' => 'ducting-fittings-&-connectors.png',
                ],
                [
                    'title'   => 'Flexible Duct',
                    'img_key' => 'yyb_store_cat_flex',
                    'mod'     => 'flex',
                    'default' => 'flexible-duct.png',
                ],
                [
                    'title'   => 'Insulation Products',
                    'img_key' => 'yyb_store_cat_insulation',
                    'mod'     => 'insulation',
                    'default' => 'insulations-products.png',
                ],
                [
                    'title'   => 'Grilles, Diffusers & Registers',
                    'img_key' => 'yyb_store_cat_grilles',
                    'mod'     => 'grilles',
                    'default' => 'grilles-diffusers-&-registers.png',
                ],
                [
                    'title'   => 'Tape, Sealant & Adhesives',
                    'img_key' => 'yyb_store_cat_tape',
                    'mod'     => 'tape',
                    'default' => 'tape-sealant-&-adhesives.png',
                ],
                [
                    'title'   => 'Hangers, Supports & Strapping',
                    'img_key' => 'yyb_store_cat_hangers',
                    'mod'     => 'hangers',
                    'default' => 'hangers-supports-&-strapping.png',
                ],
                [
                    'title'   => 'Sheet Metal Accessories',
                    'img_key' => 'yyb_store_cat_sheetmetal',
                    'mod'     => 'sheetmetal',
                    'default' => 'sheet-metal-accessories.png',
                ],
                [
                    'title'   => 'HVAC Tools & Equipment',
                    'img_key' => 'yyb_store_cat_tools',
                    'mod'     => 'tools',
                    'default' => 'hvac-tools-&-equipment.png',
                ],
                [
                    'title'   => 'Filters',
                    'img_key' => 'yyb_store_cat_filters',
                    'mod'     => 'filters',
                    'default' => 'filters.png',
                ],
                [
                    'title'   => 'Miscellaneous HVAC Supplies',
                    'img_key' => 'yyb_store_cat_misc',
                    'mod'     => 'misc',
                    'default' => 'miscellaneous-hvac-supplies.png',
                ],
            ];
            foreach ( $categories as $cat ) :
                $img_id  = yyb_option( $cat['img_key'], '' );
                $img_url = $img_id
                    ? wp_get_attachment_image_url( $img_id, 'yyb-card' )
                    : get_template_directory_uri() . '/images/' . $cat['default'];
            ?>
            <div class="store-cat-card store-cat-card--<?php echo esc_attr( $cat['mod'] ); ?>">
                <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $cat['title'] ); ?>" class="store-cat-card__bg-img">
                <div class="store-cat-card__overlay"></div>
                <div class="store-cat-card__body">
                    <h3 class="store-cat-card__title"><?php echo esc_html( $cat['title'] ); ?></h3>
                    <a href="<?php echo esc_url( home_url( '/contact-us' ) ); ?>" class="store-cat-card__link">
                        <?php esc_html_e( 'Read More', 'yy-bunker' ); ?>
                        <?php echo yyb_icon( 'chevron-right', 14 ); ?>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="store-catalog-cta">
            <a href="<?php echo esc_url( home_url( '/contact-us' ) ); ?>" class="btn btn--outline store-catalog-btn">
                <?php esc_html_e( 'Download The Full Product Catalog', 'yy-bunker' ); ?>
            </a>
        </div>

    </div>
</section>

<!-- ========================================================
     WHY SHOP WITH US
     ======================================================== -->
<section class="section section--light store-whyshop" id="store-whyshop">
    <div class="container">

        <div class="section-header section-header--center" style="margin-bottom:2.5rem;">
            <h2 class="store-whyshop__heading"><?php esc_html_e( 'Why Shop With Us', 'yy-bunker' ); ?></h2>
        </div>

        <div class="store-why-list">
            <?php
            $reasons = [
                [ 'num' => '01', 'text' => 'Stocked Daily — High-Demand Items Are Consistently Available' ],
                [ 'num' => '02', 'text' => 'Located At The YYBunker Fabrication Facility In Brooklyn' ],
                [ 'num' => '03', 'text' => 'Pick Up Supply Materials At The Same Time As Your Fabricated Duct Orders' ],
                [ 'num' => '04', 'text' => 'Staff Who Know The Trade And Can Help You Find What You Need' ],
                [ 'num' => '05', 'text' => 'No Minimum Purchase Requirements For Walk-In Customers' ],
                [ 'num' => '06', 'text' => 'Contractor Accounts Available — Ask Our Team For Details' ],
            ];
            foreach ( $reasons as $r ) :
            ?>
            <div class="store-why-row">
                <span class="store-why-row__num"><?php echo esc_html( $r['num'] ); ?>/</span>
                <span class="store-why-row__text"><?php echo esc_html( $r['text'] ); ?></span>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- ========================================================
     STORE INFORMATION
     ======================================================== -->
<section class="section section--light store-info-section" id="store-info">
    <div class="container">

        <div class="section-header section-header--center" style="margin-bottom:2.5rem;">
            <h2 class="store-info__heading"><?php esc_html_e( 'Store Information', 'yy-bunker' ); ?></h2>
        </div>

        <div class="store-info__grid">

            <div class="store-info__details">
                <div class="store-info__item">
                    <span class="store-info__icon text-accent"><?php echo yyb_icon( 'package', 18 ); ?></span>
                    <div>
                        <div class="store-info__label"><?php esc_html_e( 'Company', 'yy-bunker' ); ?></div>
                        <div class="store-info__value"><?php esc_html_e( 'YYBunker — Sheet Metal Duct Fabrication', 'yy-bunker' ); ?></div>
                    </div>
                </div>

                <div class="store-info__item">
                    <span class="store-info__icon text-accent"><?php echo yyb_icon( 'map', 18 ); ?></span>
                    <div>
                        <div class="store-info__label"><?php esc_html_e( 'Location', 'yy-bunker' ); ?></div>
                        <div class="store-info__value"><?php echo esc_html( yyb_option( 'yyb_address', '100 S Main St, New York, NY' ) ); ?></div>
                    </div>
                </div>

                <div class="store-info__item">
                    <span class="store-info__icon text-accent"><?php echo yyb_icon( 'phone', 18 ); ?></span>
                    <div>
                        <div class="store-info__label"><?php esc_html_e( 'Phone', 'yy-bunker' ); ?></div>
                        <a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', yyb_option( 'yyb_phone', '+9293339296' ) ) ); ?>" class="store-info__value store-info__value--link">
                            <?php echo esc_html( yyb_option( 'yyb_phone', '+929 333 9296' ) ); ?>
                        </a>
                    </div>
                </div>

                <div class="store-info__item">
                    <span class="store-info__icon text-accent"><?php echo yyb_icon( 'mail', 18 ); ?></span>
                    <div>
                        <div class="store-info__label"><?php esc_html_e( 'Email', 'yy-bunker' ); ?></div>
                        <a href="mailto:<?php echo esc_attr( yyb_option( 'yyb_email', 'hvac@yybunker.com' ) ); ?>" class="store-info__value store-info__value--link">
                            <?php echo esc_html( yyb_option( 'yyb_email', 'hvac@yybunker.com' ) ); ?>
                        </a>
                    </div>
                </div>

                <div class="store-info__item">
                    <span class="store-info__icon text-accent"><?php echo yyb_icon( 'clock', 18 ); ?></span>
                    <div>
                        <div class="store-info__label"><?php esc_html_e( 'Business Hours', 'yy-bunker' ); ?></div>
                        <div class="store-info__value"><?php esc_html_e( 'Mon – Fri 08:00 – 18:00', 'yy-bunker' ); ?></div>
                    </div>
                </div>

                <p class="store-info__note">
                    <?php esc_html_e( 'Call Ahead To Confirm Availability On Specific Items Or For Large-Quantity Orders. Our Team Is Happy To Pull Your Order In Advance So It Is Ready When You Arrive.', 'yy-bunker' ); ?>
                </p>
            </div>

            <div class="store-info__image">
                <?php
                $info_img_id  = yyb_option( 'yyb_store_info_img', '' );
                $info_img_url = $info_img_id
                    ? wp_get_attachment_image_url( $info_img_id, 'yyb-card' )
                    : get_template_directory_uri() . '/images/about-facility-bg.jpg';
                ?>
                    <img src="<?php echo esc_url( $info_img_url ); ?>" alt="<?php esc_attr_e( 'YYBunker Store Location', 'yy-bunker' ); ?>">
            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>
