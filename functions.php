<?php
/**
 * YY Bunker Theme Functions
 *
 * @package YY_Bunker
 * @author  Anthony Ramoso
 * @version 1.2.2
 */

defined( 'ABSPATH' ) || exit;

// ============================================================
// THEME CONSTANTS
// ============================================================

define( 'YYB_VERSION',   '1.2.2' );
define( 'YYB_DIR',       get_template_directory() );
define( 'YYB_URI',       get_template_directory_uri() );
define( 'YYB_ASSETS',    YYB_URI . '/assets' );

// ============================================================
// THEME SETUP
// ============================================================

if ( ! function_exists( 'yyb_setup' ) ) :
function yyb_setup() {

    load_theme_textdomain( 'yy-bunker', YYB_DIR . '/languages' );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [
        'search-form', 'comment-form', 'comment-list',
        'gallery', 'caption', 'style', 'script'
    ] );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    // Custom logo support
    add_theme_support( 'custom-logo', [
        'height'      => 80,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ] );

    // Image sizes
    add_image_size( 'yyb-hero',    1920, 1080, true );
    add_image_size( 'yyb-card',    800,  600,  true );
    add_image_size( 'yyb-thumb',   400,  300,  true );
    add_image_size( 'yyb-product', 600,  600,  true );

    // Register navigation menus
    register_nav_menus( [
        'primary'   => __( 'Primary Navigation', 'yy-bunker' ),
        'footer-1'  => __( 'Footer Column 1',    'yy-bunker' ),
        'footer-2'  => __( 'Footer Column 2',    'yy-bunker' ),
        'footer-3'  => __( 'Footer Column 3',    'yy-bunker' ),
    ] );
}
endif;
add_action( 'after_setup_theme', 'yyb_setup' );

// ============================================================
// ENQUEUE SCRIPTS & STYLES
// ============================================================

function yyb_enqueue_assets() {
    // Main stylesheet (includes @font-face declarations)
    wp_enqueue_style(
        'yy-bunker-style',
        get_stylesheet_uri(),
        [],
        YYB_VERSION
    );

    // Page-specific styles
    wp_enqueue_style(
        'yy-bunker-pages',
        YYB_URI . '/css/pages.css',
        [ 'yy-bunker-style' ],
        YYB_VERSION
    );

    // Main JS
    wp_enqueue_script(
        'yy-bunker-main',
        YYB_URI . '/js/main.js',
        [],
        YYB_VERSION,
        true
    );

    // Scroll animations
    wp_enqueue_script(
        'yy-bunker-scroll',
        YYB_URI . '/js/scroll-animations.js',
        [],
        YYB_VERSION,
        true
    );

    // Localize script
    wp_localize_script( 'yy-bunker-main', 'YYBunker', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'yyb_nonce' ),
        'homeUrl' => home_url( '/' ),
    ] );

    // Comment reply script
    if ( is_singular() && comments_open() ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'yyb_enqueue_assets' );

// ============================================================
// REGISTER WIDGET AREAS
// ============================================================

function yyb_widgets_init() {
    register_sidebar( [
        'name'          => __( 'Footer Widget Area 1', 'yy-bunker' ),
        'id'            => 'footer-1',
        'description'   => __( 'Footer column 1', 'yy-bunker' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget__title">',
        'after_title'   => '</h4>',
    ] );

    register_sidebar( [
        'name'          => __( 'Footer Widget Area 2', 'yy-bunker' ),
        'id'            => 'footer-2',
        'description'   => __( 'Footer column 2', 'yy-bunker' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget__title">',
        'after_title'   => '</h4>',
    ] );
}
add_action( 'widgets_init', 'yyb_widgets_init' );

// ============================================================
// CUSTOM WALKER FOR NAVIGATION MENU
// ============================================================

class YYB_Walker_Nav_Menu extends Walker_Nav_Menu {

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes   = empty( $item->classes ) ? [] : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="site-nav__item ' . esc_attr( $class_names ) . '"' : ' class="site-nav__item"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= '<li' . $id . $class_names . '>';

        $atts           = [];
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
        $atts['class']  = 'site-nav__link';

        if ( in_array( 'current-menu-item', $classes ) ) {
            $atts['aria-current'] = 'page';
        }

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

        $item_output  = isset( $args->before ) ? $args->before : '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= ( isset( $args->link_before ) ? $args->link_before : '' ) . $title . ( isset( $args->link_after ) ? $args->link_after : '' );
        $item_output .= '</a>';
        $item_output .= isset( $args->after ) ? $args->after : '';

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

// ============================================================
// THEME CUSTOMIZER
// ============================================================

function yyb_customizer( $wp_customize ) {

    // ─── Site Identity Panel ───────────────────────────────
    $wp_customize->add_section( 'yyb_contact', [
        'title'    => __( 'Contact Information', 'yy-bunker' ),
        'priority' => 30,
    ] );

    $fields = [
        'yyb_phone'   => [ 'label' => 'Phone Number',  'default' => '+929 333 9296' ],
        'yyb_email'   => [ 'label' => 'Email Address', 'default' => 'hvac@yybunker.com' ],
        'yyb_address' => [ 'label' => 'Address',       'default' => '100 S Main St, New York, NY' ],
        'yyb_hours'   => [ 'label' => 'Business Hours','default' => '24 Hours / 7 Days' ],
    ];

    foreach ( $fields as $key => $cfg ) {
        $wp_customize->add_setting( $key, [
            'default'           => $cfg['default'],
            'sanitize_callback' => 'sanitize_text_field',
        ] );
        $wp_customize->add_control( $key, [
            'label'   => __( $cfg['label'], 'yy-bunker' ),
            'section' => 'yyb_contact',
            'type'    => 'text',
        ] );
    }

    // ─── Hero section ─────────────────────────────────────
    $wp_customize->add_section( 'yyb_hero', [
        'title'    => __( 'Homepage Hero', 'yy-bunker' ),
        'priority' => 40,
    ] );

    $wp_customize->add_setting( 'yyb_hero_heading', [
        'default'           => 'Precision Duct Fabrication. Every Type. Any Scale.',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'yyb_hero_heading', [
        'label'   => __( 'Hero Heading', 'yy-bunker' ),
        'section' => 'yyb_hero',
        'type'    => 'text',
    ] );

    $wp_customize->add_setting( 'yyb_hero_subheading', [
        'default'           => 'YYBunker is a Brooklyn-based sheet metal duct fabrication shop specializing in the design and manufacturing of HVAC and ventilation ductwork for commercial, residential, and industrial projects.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ] );
    $wp_customize->add_control( 'yyb_hero_subheading', [
        'label'   => __( 'Hero Sub-heading', 'yy-bunker' ),
        'section' => 'yyb_hero',
        'type'    => 'textarea',
    ] );

    $wp_customize->add_setting( 'yyb_hero_bg', [
        'default'           => '',
        'sanitize_callback' => 'absint',
    ] );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'yyb_hero_bg', [
        'label'     => __( 'Hero Background Image', 'yy-bunker' ),
        'section'   => 'yyb_hero',
        'mime_type' => 'image',
    ] ) );

    $wp_customize->add_setting( 'yyb_bottom_bg', [
        'default'           => '',
        'sanitize_callback' => 'absint',
    ] );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'yyb_bottom_bg', [
        'label'     => __( 'Homepage Bottom Workshop Image', 'yy-bunker' ),
        'section'   => 'yyb_hero',
        'mime_type' => 'image',
    ] ) );

    // ─── About Page Section ───────────────────────────────
    $wp_customize->add_section( 'yyb_about', [
        'title'    => __( 'About Page Images', 'yy-bunker' ),
        'priority' => 45,
    ] );

    $about_images = [
        'yyb_about_hero_bg'      => 'About Hero Background',
        'yyb_about_wwd_img'      => 'What We Do — Right Image',
        'yyb_about_facility_bg'  => 'Our Facility Background',
        'yyb_team_img_david'     => 'Team: David Chen Photo',
        'yyb_team_img_jeffery'   => 'Team: Jeffery Mussman Photo',
        'yyb_team_img_mike'      => 'Team: Michael Davidson Photo',
    ];

    foreach ( $about_images as $key => $label ) {
        $wp_customize->add_setting( $key, [
            'default'           => '',
            'sanitize_callback' => 'absint',
        ] );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, $key, [
            'label'     => __( $label, 'yy-bunker' ),
            'section'   => 'yyb_about',
            'mime_type' => 'image',
        ] ) );
    }

    // ─── Products Page Section ────────────────────────────
    $wp_customize->add_section( 'yyb_products', [
        'title'    => __( 'Products Page Images', 'yy-bunker' ),
        'priority' => 50,
    ] );

    $products_images = [
        'yyb_products_hero_bg'   => 'Products Hero Background',
        'yyb_prod_img_oval'      => 'Duct: Oval Duct',
        'yyb_prod_img_spiral'    => 'Duct: Spiral Round Duct',
        'yyb_prod_img_rect'      => 'Duct: Rectangular Duct',
        'yyb_prod_img_blackiron' => 'Duct: Black Iron Sheet Metal',
        'yyb_prod_img_aluminum'  => 'Duct: Aluminum Sheet Metal',
        'yyb_prod_img_custom'    => 'Duct: Custom & Specialty',
        'yyb_svc_img_takeoff'    => 'Service: Material Takeoff',
        'yyb_svc_img_sketches'   => 'Service: Fabrication From Sketches',
        'yyb_svc_img_delivery'   => 'Service: Delivery',
        'yyb_svc_img_install'    => 'Service: Installation',
        'yyb_svc_img_gc'         => 'Service: GC & Subcontractor Coordination',
    ];

    foreach ( $products_images as $key => $label ) {
        $wp_customize->add_setting( $key, [
            'default'           => '',
            'sanitize_callback' => 'absint',
        ] );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, $key, [
            'label'     => __( $label, 'yy-bunker' ),
            'section'   => 'yyb_products',
            'mime_type' => 'image',
        ] ) );
    }

    // ─── Store Page Section ───────────────────────────────
    $wp_customize->add_section( 'yyb_store', [
        'title'    => __( 'Store Page Images', 'yy-bunker' ),
        'priority' => 55,
    ] );

    $store_images = [
        'yyb_store_hero_bg'         => 'Store Hero Background',
        'yyb_store_about_img'       => 'About The Store Image',
        'yyb_store_cat_fittings'    => 'Category: Duct Fittings & Connectors',
        'yyb_store_cat_flex'        => 'Category: Flexible Duct',
        'yyb_store_cat_insulation'  => 'Category: Insulation Products',
        'yyb_store_cat_grilles'     => 'Category: Grilles, Diffusers & Registers',
        'yyb_store_cat_tape'        => 'Category: Tape, Sealant & Adhesives',
        'yyb_store_cat_hangers'     => 'Category: Hangers, Supports & Strapping',
        'yyb_store_cat_sheetmetal'  => 'Category: Sheet Metal Accessories',
        'yyb_store_cat_tools'       => 'Category: HVAC Tools & Equipment',
        'yyb_store_cat_filters'     => 'Category: Filters',
        'yyb_store_cat_misc'        => 'Category: Miscellaneous HVAC Supplies',
        'yyb_store_info_img'        => 'Store Information Image / Map',
    ];

    foreach ( $store_images as $key => $label ) {
        $wp_customize->add_setting( $key, [
            'default'           => '',
            'sanitize_callback' => 'absint',
        ] );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, $key, [
            'label'     => __( $label, 'yy-bunker' ),
            'section'   => 'yyb_store',
            'mime_type' => 'image',
        ] ) );
    }
}
add_action( 'customize_register', 'yyb_customizer' );

// ============================================================
// HELPER FUNCTIONS
// ============================================================

/**
 * Get theme option with fallback
 */
function yyb_option( $key, $default = '' ) {
    return get_theme_mod( $key, $default );
}

/**
 * Output page hero
 */
function yyb_page_hero( $label = '', $title = '', $subtitle = '' ) {
    if ( ! $title ) {
        $title = get_the_title();
    }
    ?>
    <section class="page-hero">
        <div class="page-hero__bg"></div>
        <div class="container">
            <div class="page-hero__content">
                <nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'yy-bunker' ); ?>">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'yy-bunker' ); ?></a>
                    <span class="breadcrumbs__sep">›</span>
                    <span class="breadcrumbs__current"><?php echo esc_html( $title ); ?></span>
                </nav>
                <?php if ( $label ) : ?>
                    <div class="page-hero__label">
                        <span class="label"><?php echo esc_html( $label ); ?></span>
                    </div>
                <?php endif; ?>
                <h1 class="page-hero__title"><?php echo esc_html( $title ); ?></h1>
                <?php if ( $subtitle ) : ?>
                    <p class="page-hero__subtitle"><?php echo esc_html( $subtitle ); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
}

/**
 * Render SVG icon
 */
function yyb_icon( $name, $size = 20 ) {
    $icons = [
        'phone'    => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13 19.79 19.79 0 0 1 1.71 4.34 2 2 0 0 1 3.68 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.16 6.16l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
        'mail'     => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>',
        'map'      => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>',
        'clock'    => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
        'arrow'    => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>',
        'shield'   => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/></svg>',
        'star'     => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
        'check'    => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>',
        'package'  => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>',
        'truck'    => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>',
        'fb'       => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>',
        'ig'       => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>',
        'tiktok'   => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.32 6.32 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.73a8.26 8.26 0 0 0 4.83 1.54V6.8a4.83 4.83 0 0 1-1.06-.11z"/></svg>',
        'youtube'  => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="#111111"/></svg>',
        'duct'         => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="10" rx="1"/><path d="M6 7V5a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v2"/><path d="M6 17v2a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-2"/><line x1="12" y1="7" x2="12" y2="17"/></svg>',
        'target'       => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>',
        'settings'     => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>',
        'handshake'    => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m11 17 2 2a1 1 0 1 0 3-3"/><path d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4"/><path d="m21 3 1 11h-1"/><path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3"/><path d="M3 4h8"/></svg>',
        'shield-check' => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>',
        'chevron-left' => '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>',
        'chevron-right'=> '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>',
    ];

    return isset( $icons[ $name ] ) ? $icons[ $name ] : '';
}

// ============================================================
// EXCERPT LENGTH
// ============================================================

add_filter( 'excerpt_length', function() { return 25; } );
add_filter( 'excerpt_more',   function() { return '&hellip;'; } );

// ============================================================
// REMOVE UNNECESSARY WP HEAD CLUTTER
// ============================================================

remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

// ============================================================
// CUSTOM POST TYPE: PRODUCTS (if not using WooCommerce)
// ============================================================

function yyb_register_cpts() {
    // Products CPT
    register_post_type( 'yyb_product', [
        'labels' => [
            'name'               => __( 'Products',        'yy-bunker' ),
            'singular_name'      => __( 'Product',         'yy-bunker' ),
            'add_new_item'       => __( 'Add New Product',  'yy-bunker' ),
            'edit_item'          => __( 'Edit Product',     'yy-bunker' ),
            'menu_name'          => __( 'Products',        'yy-bunker' ),
        ],
        'public'      => true,
        'has_archive' => false,
        'supports'    => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
        'menu_icon'   => 'dashicons-products',
        'rewrite'     => [ 'slug' => 'products' ],
        'show_in_rest'=> true,
    ] );

    // Services CPT
    register_post_type( 'yyb_service', [
        'labels' => [
            'name'          => __( 'Services',       'yy-bunker' ),
            'singular_name' => __( 'Service',        'yy-bunker' ),
            'add_new_item'  => __( 'Add New Service', 'yy-bunker' ),
            'edit_item'     => __( 'Edit Service',    'yy-bunker' ),
            'menu_name'     => __( 'Services',       'yy-bunker' ),
        ],
        'public'      => true,
        'has_archive' => false,
        'supports'    => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
        'menu_icon'   => 'dashicons-hammer',
        'rewrite'     => [ 'slug' => 'services' ],
        'show_in_rest'=> true,
    ] );
}
add_action( 'init', 'yyb_register_cpts' );

// Product taxonomy
function yyb_register_taxonomies() {
    register_taxonomy( 'yyb_product_cat', 'yyb_product', [
        'labels' => [
            'name'          => __( 'Product Categories', 'yy-bunker' ),
            'singular_name' => __( 'Category',           'yy-bunker' ),
        ],
        'public'       => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => [ 'slug' => 'product-category' ],
    ] );
}
add_action( 'init', 'yyb_register_taxonomies' );

// ============================================================
// CONTACT FORM AJAX HANDLER
// ============================================================

function yyb_handle_contact_form() {
    check_ajax_referer( 'yyb_nonce', 'nonce' );

    $name    = sanitize_text_field( $_POST['name']    ?? '' );
    $email   = sanitize_email(      $_POST['email']   ?? '' );
    $subject = sanitize_text_field( $_POST['subject'] ?? '' );
    $message = sanitize_textarea_field( $_POST['message'] ?? '' );

    if ( ! $name || ! $email || ! $message ) {
        wp_send_json_error( [ 'message' => __( 'Please fill in all required fields.', 'yy-bunker' ) ] );
    }

    if ( ! is_email( $email ) ) {
        wp_send_json_error( [ 'message' => __( 'Invalid email address.', 'yy-bunker' ) ] );
    }

    $to      = get_option( 'admin_email' );
    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $name . ' <' . $email . '>',
        'Reply-To: ' . $email,
    ];

    $body  = '<strong>Name:</strong> '    . esc_html( $name )    . '<br>';
    $body .= '<strong>Email:</strong> '   . esc_html( $email )   . '<br>';
    $body .= '<strong>Subject:</strong> ' . esc_html( $subject ) . '<br><br>';
    $body .= '<strong>Message:</strong><br>' . nl2br( esc_html( $message ) );

    $sent = wp_mail( $to, '[YY Bunker] ' . $subject, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( [ 'message' => __( 'Message sent successfully! We\'ll get back to you soon.', 'yy-bunker' ) ] );
    } else {
        wp_send_json_error( [ 'message' => __( 'Failed to send message. Please try again.', 'yy-bunker' ) ] );
    }
}
add_action( 'wp_ajax_yyb_contact',        'yyb_handle_contact_form' );
add_action( 'wp_ajax_nopriv_yyb_contact', 'yyb_handle_contact_form' );

// ============================================================
// ADD THEME PAGES ON ACTIVATION
// ============================================================

function yyb_create_theme_pages() {
    $pages = [
        'home'            => [ 'title' => 'Home',              'template' => 'page-templates/page-home.php' ],
        'about-us'        => [ 'title' => 'About Us',          'template' => 'page-templates/page-about.php' ],
        'products'        => [ 'title' => 'Products & Services','template' => 'page-templates/page-products.php' ],
        'contact-us'      => [ 'title' => 'Contact Us',        'template' => 'page-templates/page-contact.php' ],
        'supply-store'    => [ 'title' => 'Supply Store',      'template' => 'page-templates/page-store.php' ],
    ];

    foreach ( $pages as $slug => $data ) {
        if ( null === get_page_by_path( $slug ) ) {
            $page_id = wp_insert_post( [
                'post_title'  => $data['title'],
                'post_name'   => $slug,
                'post_status' => 'publish',
                'post_type'   => 'page',
                'meta_input'  => [ '_wp_page_template' => $data['template'] ],
            ] );
        }
    }

    // Set homepage
    $home = get_page_by_path( 'home' );
    if ( $home ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $home->ID );
    }

    // Create and assign primary nav menu
    $menu_name = 'Primary Menu';
    $menu_id   = wp_create_nav_menu( $menu_name );

    if ( ! is_wp_error( $menu_id ) ) {
        $nav_items = [
            'About Us'            => 'about-us',
            'Products & Services' => 'products',
            'Contact Us'          => 'contact-us',
            'Supply Store'        => 'supply-store',
        ];

        foreach ( $nav_items as $label => $slug ) {
            $page = get_page_by_path( $slug );
            if ( $page ) {
                wp_update_nav_menu_item( $menu_id, 0, [
                    'menu-item-title'     => $label,
                    'menu-item-object'    => 'page',
                    'menu-item-object-id' => $page->ID,
                    'menu-item-type'      => 'post_type',
                    'menu-item-status'    => 'publish',
                ] );
            }
        }

        $locations = get_theme_mod( 'nav_menu_locations', [] );
        $locations['primary'] = $menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }
}
add_action( 'after_switch_theme', 'yyb_create_theme_pages' );

// Re-run once on init to catch cases where theme was already active
add_action( 'init', function() {
    if ( ! get_option( 'yyb_pages_created_v2' ) ) {
        yyb_create_theme_pages();
        update_option( 'yyb_pages_created_v2', true );
    }
} );
