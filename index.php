<?php
/**
 * The main template file.
 * Fallback for all pages without specific templates.
 *
 * @package YY_Bunker
 */

get_header();
?>

<section class="page-hero">
    <div class="page-hero__bg"></div>
    <div class="container">
        <div class="page-hero__content">
            <h1 class="page-hero__title">
                <?php
                if ( is_home() ) {
                    bloginfo( 'name' );
                } elseif ( is_archive() ) {
                    the_archive_title();
                } elseif ( is_search() ) {
                    printf( esc_html__( 'Search Results for: %s', 'yy-bunker' ), get_search_query() );
                } else {
                    the_title();
                }
                ?>
            </h1>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <div class="grid-3">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'card' ); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="card__image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'yyb-card' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="card__body">
                            <div class="card__label"><?php echo get_the_date(); ?></div>
                            <h2 class="card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p class="card__text"><?php the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn--outline btn--sm" style="margin-top:1rem;">
                                <?php esc_html_e( 'Read More', 'yy-bunker' ); ?>
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            <?php the_posts_navigation(); ?>
        <?php else : ?>
            <div style="text-align:center; padding: 4rem 0;">
                <p><?php esc_html_e( 'No content found.', 'yy-bunker' ); ?></p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
