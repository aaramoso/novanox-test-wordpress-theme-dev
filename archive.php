<?php
/**
 * Archive / Category / Tag Template
 * YY Bunker Theme
 */
get_header(); ?>

<main class="yyb-archive">

    <!-- Archive Header -->
    <section class="yyb-archive__hero">
        <div class="yyb-archive__hero-grid"></div>
        <div class="container">
            <p class="yyb-archive__label">
                <?php
                if (is_category())      echo '[ CATEGORY ]';
                elseif (is_tag())       echo '[ TAG ]';
                elseif (is_author())    echo '[ AUTHOR ]';
                elseif (is_date())      echo '[ ARCHIVE ]';
                elseif (is_post_type_archive('yyb_product')) echo '[ PRODUCTS ]';
                elseif (is_tax('yyb_product_cat')) echo '[ PRODUCT CATEGORY ]';
                else                    echo '[ ARCHIVE ]';
                ?>
            </p>
            <h1 class="yyb-archive__title">
                <?php
                if (is_category())      single_cat_title();
                elseif (is_tag())       single_tag_title();
                elseif (is_author())    the_author();
                elseif (is_year())      the_date('Y');
                elseif (is_month())     the_date('F Y');
                elseif (is_day())       the_date('F j, Y');
                elseif (is_post_type_archive()) post_type_archive_title();
                elseif (is_tax())       single_term_title();
                else                    the_archive_title();
                ?>
            </h1>
            <?php
            $desc = get_the_archive_description();
            if ($desc) : ?>
                <p class="yyb-archive__desc"><?php echo wp_kses_post($desc); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Archive Grid -->
    <section class="yyb-archive__body">
        <div class="container">

            <?php if (have_posts()) : ?>

                <?php if (is_post_type_archive('yyb_product') || is_tax('yyb_product_cat')) : ?>
                <!-- PRODUCT ARCHIVE GRID -->
                <div class="yyb-product-grid">
                    <?php while (have_posts()) : the_post();
                        $price = get_post_meta(get_the_ID(), '_yyb_price', true);
                        $sku   = get_post_meta(get_the_ID(), '_yyb_sku', true);
                    ?>
                    <article class="yyb-product-card">
                        <a href="<?php the_permalink(); ?>" class="yyb-product-card__img-wrap">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium_large', ['class' => 'yyb-product-card__img']); ?>
                            <?php else : ?>
                                <div class="yyb-product-card__no-img">
                                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none"><rect x="1" y="1" width="46" height="46" stroke="#C8A84B" stroke-opacity="0.3"/><path d="M12 36l8-14 8 9 6-9 6 14H12Z" stroke="#C8A84B" stroke-opacity="0.5" fill="none" stroke-width="1.5"/></svg>
                                </div>
                            <?php endif; ?>
                            <div class="yyb-product-card__overlay">View Product</div>
                        </a>
                        <div class="yyb-product-card__body">
                            <?php if ($sku) : ?>
                                <span class="yyb-product-card__sku">SKU: <?php echo esc_html($sku); ?></span>
                            <?php endif; ?>
                            <h2 class="yyb-product-card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <?php if ($price) : ?>
                                <div class="yyb-product-card__price">₱<?php echo esc_html(number_format((float)$price, 2)); ?></div>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>" class="btn btn--outline btn--sm">View Details</a>
                        </div>
                    </article>
                    <?php endwhile; ?>
                </div>

                <?php else : ?>
                <!-- BLOG ARCHIVE LIST -->
                <div class="yyb-blog-grid">
                    <?php while (have_posts()) : the_post(); ?>
                    <article class="yyb-blog-card">
                        <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" class="yyb-blog-card__thumb">
                            <?php the_post_thumbnail('medium_large'); ?>
                        </a>
                        <?php endif; ?>
                        <div class="yyb-blog-card__body">
                            <div class="yyb-blog-card__meta">
                                <?php $cats = get_the_category(); if ($cats) : ?>
                                    <a href="<?php echo esc_url(get_category_link($cats[0]->term_id)); ?>" class="yyb-blog-card__cat"><?php echo esc_html($cats[0]->name); ?></a>
                                <?php endif; ?>
                                <span class="yyb-blog-card__date"><?php echo get_the_date(); ?></span>
                            </div>
                            <h2 class="yyb-blog-card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="yyb-blog-card__excerpt"><?php the_excerpt(); ?></div>
                            <a href="<?php the_permalink(); ?>" class="yyb-blog-card__more">Read More →</a>
                        </div>
                    </article>
                    <?php endwhile; ?>
                </div>
                <?php endif; ?>

                <!-- Pagination -->
                <div class="yyb-pagination">
                    <?php
                    echo paginate_links([
                        'prev_text' => '← Prev',
                        'next_text' => 'Next →',
                        'type'      => 'list',
                    ]);
                    ?>
                </div>

            <?php else : ?>
                <div class="yyb-no-results">
                    <p class="yyb-no-results__label">[ EMPTY SECTOR ]</p>
                    <h2>Nothing Found</h2>
                    <p>No content matches this archive. Try searching or return to base.</p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary">Return to Base</a>
                </div>
            <?php endif; ?>

        </div>
    </section>

</main>

<style>
.yyb-archive { background: var(--color-black); }

/* Hero */
.yyb-archive__hero {
    position: relative; padding: 120px 0 60px;
    border-bottom: 1px solid var(--color-border);
    overflow: hidden;
}
.yyb-archive__hero-grid {
    position: absolute; inset: 0;
    background-image: linear-gradient(rgba(200,168,75,0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(200,168,75,0.04) 1px, transparent 1px);
    background-size: 60px 60px; pointer-events: none;
}
.yyb-archive__label {
    font-size: 11px; font-weight: 600; letter-spacing: 0.3em;
    text-transform: uppercase; color: var(--color-accent); margin-bottom: 12px;
}
.yyb-archive__title {
    font-size: clamp(36px, 5vw, 64px); font-weight: 900; text-transform: uppercase;
    color: var(--color-off-white); letter-spacing: -0.02em; line-height: 1.1;
}
.yyb-archive__desc {
    font-size: 16px; color: var(--color-gray); max-width: 600px;
    line-height: 1.7; margin-top: 16px;
}

/* Body */
.yyb-archive__body { padding: 60px 0 80px; }

/* Product grid */
.yyb-product-grid {
    display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-bottom: 60px;
}
.yyb-product-card { background: var(--color-dark); border: 1px solid var(--color-border); }
.yyb-product-card__img-wrap {
    display: block; position: relative; aspect-ratio: 1/1; overflow: hidden;
}
.yyb-product-card__img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
.yyb-product-card__img-wrap:hover .yyb-product-card__img { transform: scale(1.05); }
.yyb-product-card__no-img {
    width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;
    background: var(--color-black);
}
.yyb-product-card__overlay {
    position: absolute; inset: 0; background: rgba(200,168,75,0.85);
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.12em;
    color: var(--color-black); opacity: 0; transition: opacity 0.3s;
}
.yyb-product-card__img-wrap:hover .yyb-product-card__overlay { opacity: 1; }
.yyb-product-card__body { padding: 20px; }
.yyb-product-card__sku { font-size: 10px; text-transform: uppercase; letter-spacing: 0.15em; color: var(--color-gray); }
.yyb-product-card__title { margin: 6px 0 12px; }
.yyb-product-card__title a {
    font-size: 15px; font-weight: 700; text-transform: uppercase;
    color: var(--color-off-white); text-decoration: none; transition: color 0.2s;
}
.yyb-product-card__title a:hover { color: var(--color-accent); }
.yyb-product-card__price { font-size: 18px; font-weight: 700; color: var(--color-accent); margin-bottom: 16px; }

/* Blog grid */
.yyb-blog-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 32px; margin-bottom: 60px; }
.yyb-blog-card { background: var(--color-dark); border: 1px solid var(--color-border); }
.yyb-blog-card__thumb { display: block; overflow: hidden; aspect-ratio: 16/9; }
.yyb-blog-card__thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
.yyb-blog-card__thumb:hover img { transform: scale(1.05); }
.yyb-blog-card__body { padding: 24px; }
.yyb-blog-card__meta { display: flex; align-items: center; gap: 12px; margin-bottom: 12px; }
.yyb-blog-card__cat {
    font-size: 10px; text-transform: uppercase; letter-spacing: 0.15em;
    color: var(--color-accent); text-decoration: none;
}
.yyb-blog-card__date { font-size: 11px; color: var(--color-gray); }
.yyb-blog-card__title { margin-bottom: 12px; }
.yyb-blog-card__title a {
    font-size: 18px; font-weight: 800; text-transform: uppercase;
    color: var(--color-off-white); text-decoration: none; line-height: 1.3;
    transition: color 0.2s;
}
.yyb-blog-card__title a:hover { color: var(--color-accent); }
.yyb-blog-card__excerpt { font-size: 14px; color: var(--color-gray); line-height: 1.7; margin-bottom: 20px; }
.yyb-blog-card__more {
    font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;
    color: var(--color-accent); text-decoration: none; transition: opacity 0.2s;
}
.yyb-blog-card__more:hover { opacity: 0.75; }

/* Pagination */
.yyb-pagination { display: flex; justify-content: center; }
.yyb-pagination .page-numbers {
    list-style: none; display: flex; gap: 8px; padding: 0; margin: 0;
}
.yyb-pagination .page-numbers li a,
.yyb-pagination .page-numbers li span {
    display: flex; align-items: center; justify-content: center;
    width: 44px; height: 44px; background: var(--color-dark); border: 1px solid var(--color-border);
    color: var(--color-gray); text-decoration: none; font-size: 14px; font-weight: 600;
    transition: all 0.2s;
}
.yyb-pagination .page-numbers li a:hover { border-color: var(--color-accent); color: var(--color-accent); }
.yyb-pagination .page-numbers li span.current {
    background: var(--color-accent); border-color: var(--color-accent); color: var(--color-black);
}

/* No results */
.yyb-no-results {
    text-align: center; padding: 80px 20px;
}
.yyb-no-results .yyb-no-results__label {
    font-size: 11px; letter-spacing: 0.3em; color: var(--color-accent); margin-bottom: 16px; text-transform: uppercase;
}
.yyb-no-results h2 {
    font-size: 48px; font-weight: 900; text-transform: uppercase;
    color: var(--color-off-white); margin-bottom: 16px;
}
.yyb-no-results p { color: var(--color-gray); font-size: 16px; margin-bottom: 32px; }

@media (max-width: 1024px) { .yyb-product-grid { grid-template-columns: repeat(3, 1fr); } }
@media (max-width: 768px) {
    .yyb-product-grid { grid-template-columns: repeat(2, 1fr); }
    .yyb-blog-grid { grid-template-columns: 1fr; }
}
@media (max-width: 480px) { .yyb-product-grid { grid-template-columns: 1fr; } }
</style>

<?php get_footer(); ?>
