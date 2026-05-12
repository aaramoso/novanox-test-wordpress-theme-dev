<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="sr-only" href="#main-content"><?php esc_html_e( 'Skip to main content', 'yy-bunker' ); ?></a>

<!-- ========================================================
     SITE HEADER
     ======================================================== -->
<header class="site-header" id="site-header" role="banner">
    <div class="container">
        <div class="site-header__inner">

            <!-- Logo -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <img
                        src="<?php echo esc_url( get_template_directory_uri() . '/images/logomain.svg' ); ?>"
                        alt="<?php bloginfo( 'name' ); ?>"
                        class="site-logo__img"
                        width="160"
                        height="16"
                    >
                <?php endif; ?>
            </a>

            <!-- Primary Navigation -->
            <nav class="site-nav" id="site-nav" aria-label="<?php esc_attr_e( 'Primary Navigation', 'yy-bunker' ); ?>">
                <?php
                wp_nav_menu( [
                    'theme_location' => 'primary',
                    'menu_class'     => 'site-nav__list',
                    'container'      => false,
                    'walker'         => new YYB_Walker_Nav_Menu(),
                    'fallback_cb'    => function() {
                        echo '<ul class="site-nav__list">';
                        $pages = [ 'Home' => '/', 'About Us' => '/about-us', 'Products &amp; Services' => '/products', 'Supply Store' => '/supply-store', 'Contact Us' => '/contact-us' ];
                        foreach ( $pages as $label => $url ) {
                            $current = ( $_SERVER['REQUEST_URI'] === $url ) ? ' class="site-nav__item current-menu-item"' : ' class="site-nav__item"';
                            echo '<li' . $current . '><a href="' . esc_url( home_url( $url ) ) . '" class="site-nav__link">' . $label . '</a></li>';
                        }
                        echo '</ul>';
                    },
                ] );
                ?>
            </nav>

            <!-- Header Actions -->
            <div class="site-header__cta">
                <a href="<?php echo esc_url( home_url( '/contact-us' ) ); ?>" class="btn btn--primary btn--sm">
                    <?php echo yyb_icon( 'clock', 14 ); ?>
                    <?php esc_html_e( 'Schedule Now', 'yy-bunker' ); ?>
                </a>
            </div>

            <!-- Mobile Toggle -->
            <button class="nav-toggle" id="nav-toggle" aria-expanded="false" aria-controls="site-nav" aria-label="<?php esc_attr_e( 'Toggle navigation menu', 'yy-bunker' ); ?>">
                <span class="nav-toggle__bar"></span>
                <span class="nav-toggle__bar"></span>
                <span class="nav-toggle__bar"></span>
            </button>

        </div><!-- .site-header__inner -->
    </div><!-- .container -->
</header><!-- .site-header -->

<main id="main-content" class="site-main" role="main">
