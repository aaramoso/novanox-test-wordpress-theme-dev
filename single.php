<?php
/**
 * Single Post / Product Template
 * YY Bunker Theme
 */
get_header(); ?>

<main class="yyb-single">
    <?php while (have_posts()) : the_post(); ?>

    <?php if (get_post_type() === 'yyb_product') : ?>
        <!-- ======================== SINGLE PRODUCT ======================== -->
        <div class="yyb-product-single">
            <div class="container">

                <!-- Breadcrumb -->
                <nav class="yyb-breadcrumb" aria-label="Breadcrumb">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                    <span>/</span>
                    <a href="<?php echo esc_url(home_url('/supply-store')); ?>">Supply Store</a>
                    <?php
                    $cats = get_the_terms(get_the_ID(), 'yyb_product_cat');
                    if ($cats && !is_wp_error($cats)) :
                        $cat = reset($cats); ?>
                        <span>/</span>
                        <a href="<?php echo esc_url(get_term_link($cat)); ?>"><?php echo esc_html($cat->name); ?></a>
                    <?php endif; ?>
                    <span>/</span>
                    <span><?php the_title(); ?></span>
                </nav>

                <div class="yyb-product-single__grid">
                    <!-- Product Gallery -->
                    <div class="yyb-product-single__gallery">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="yyb-product-single__main-img">
                                <?php the_post_thumbnail('large'); ?>
                                <div class="yyb-product-single__img-badge">[ IN STOCK ]</div>
                            </div>
                        <?php else : ?>
                            <div class="yyb-product-single__main-img yyb-product-single__placeholder">
                                <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="1" y="1" width="78" height="78" stroke="#C8A84B" stroke-opacity="0.3" stroke-width="1"/>
                                    <path d="M20 60L30 40L42 52L52 36L60 60H20Z" stroke="#C8A84B" stroke-opacity="0.4" stroke-width="1.5" fill="none"/>
                                    <circle cx="28" cy="26" r="6" stroke="#C8A84B" stroke-opacity="0.4" stroke-width="1.5"/>
                                </svg>
                                <span>NO IMAGE</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Product Info -->
                    <div class="yyb-product-single__info">
                        <?php if ($cats && !is_wp_error($cats)) : $cat = reset($cats); ?>
                            <span class="yyb-product-single__category"><?php echo esc_html($cat->name); ?></span>
                        <?php endif; ?>

                        <h1 class="yyb-product-single__title"><?php the_title(); ?></h1>

                        <?php
                        $sku   = get_post_meta(get_the_ID(), '_yyb_sku', true);
                        $price = get_post_meta(get_the_ID(), '_yyb_price', true);
                        $stock = get_post_meta(get_the_ID(), '_yyb_stock', true);
                        $brand = get_post_meta(get_the_ID(), '_yyb_brand', true);
                        ?>

                        <?php if ($price) : ?>
                        <div class="yyb-product-single__price">₱<?php echo esc_html(number_format((float)$price, 2)); ?></div>
                        <?php endif; ?>

                        <div class="yyb-product-single__meta-row">
                            <?php if ($sku) : ?>
                            <div class="yyb-product-single__meta-item">
                                <span class="label">SKU</span>
                                <span class="value"><?php echo esc_html($sku); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if ($brand) : ?>
                            <div class="yyb-product-single__meta-item">
                                <span class="label">Brand</span>
                                <span class="value"><?php echo esc_html($brand); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if ($stock) : ?>
                            <div class="yyb-product-single__meta-item">
                                <span class="label">Stock</span>
                                <span class="value yyb-product-single__stock"><?php echo esc_html($stock); ?> units</span>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="yyb-product-single__desc">
                            <?php the_content(); ?>
                        </div>

                        <div class="yyb-product-single__qty">
                            <label>Quantity</label>
                            <div class="yyb-product-single__qty-ctrl">
                                <button class="qty-btn qty-minus" type="button">−</button>
                                <input type="number" class="qty-input" value="1" min="1" max="<?php echo esc_attr($stock ?: 99); ?>">
                                <button class="qty-btn qty-plus" type="button">+</button>
                            </div>
                        </div>

                        <div class="yyb-product-single__cta">
                            <a href="<?php echo esc_url(home_url('/contact-us')); ?>" class="btn btn--primary btn--full">Inquire Now</a>
                            <a href="<?php echo esc_url(home_url('/contact-us')); ?>" class="btn btn--outline btn--full">Request Bulk Quote</a>
                        </div>

                        <div class="yyb-product-single__badges">
                            <div class="yyb-badge">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M8 1L10 6H15L11 9.5L12.5 14.5L8 11.5L3.5 14.5L5 9.5L1 6H6L8 1Z" stroke="#C8A84B" stroke-width="1.2" fill="none"/></svg>
                                Verified Quality
                            </div>
                            <div class="yyb-badge">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><rect x="1" y="4" width="14" height="10" rx="1" stroke="#C8A84B" stroke-width="1.2"/><path d="M5 4V3a3 3 0 016 0v1" stroke="#C8A84B" stroke-width="1.2"/></svg>
                                Secure Order
                            </div>
                            <div class="yyb-badge">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M1 8h9M7 5l3 3-3 3M11 3h3v10h-3" stroke="#C8A84B" stroke-width="1.2" stroke-linecap="round"/></svg>
                                Fast Dispatch
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    <?php else : ?>
        <!-- ======================== SINGLE BLOG POST ======================== -->
        <article class="yyb-post-single">
            <div class="container">

                <!-- Breadcrumb -->
                <nav class="yyb-breadcrumb" aria-label="Breadcrumb">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                    <span>/</span>
                    <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">Blog</a>
                    <span>/</span>
                    <span><?php the_title(); ?></span>
                </nav>

                <div class="yyb-post-single__grid">
                    <!-- Main Content -->
                    <div class="yyb-post-single__main">
                        <header class="yyb-post-single__header">
                            <?php
                            $cats = get_the_category();
                            if ($cats) : ?>
                                <span class="yyb-post-single__cat"><?php echo esc_html($cats[0]->name); ?></span>
                            <?php endif; ?>
                            <h1 class="yyb-post-single__title"><?php the_title(); ?></h1>
                            <div class="yyb-post-single__byline">
                                <span><?php echo get_the_date(); ?></span>
                                <span class="sep">·</span>
                                <span>By <?php the_author(); ?></span>
                                <span class="sep">·</span>
                                <span><?php comments_number('0 Comments', '1 Comment', '% Comments'); ?></span>
                            </div>
                        </header>

                        <?php if (has_post_thumbnail()) : ?>
                        <div class="yyb-post-single__thumb">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                        <?php endif; ?>

                        <div class="yyb-post-single__content entry-content">
                            <?php the_content(); ?>
                        </div>

                        <div class="yyb-post-single__tags">
                            <?php the_tags('<span class="yyb-tag">', '</span><span class="yyb-tag">', '</span>'); ?>
                        </div>

                        <!-- Post Nav -->
                        <nav class="yyb-post-single__nav">
                            <?php
                            $prev = get_previous_post();
                            $next = get_next_post();
                            if ($prev) : ?>
                                <a href="<?php echo esc_url(get_permalink($prev)); ?>" class="yyb-post-single__nav-item yyb-post-single__nav-item--prev">
                                    <span class="nav-dir">← Previous</span>
                                    <span class="nav-title"><?php echo esc_html(get_the_title($prev)); ?></span>
                                </a>
                            <?php else : ?><div></div><?php endif; ?>
                            <?php if ($next) : ?>
                                <a href="<?php echo esc_url(get_permalink($next)); ?>" class="yyb-post-single__nav-item yyb-post-single__nav-item--next">
                                    <span class="nav-dir">Next →</span>
                                    <span class="nav-title"><?php echo esc_html(get_the_title($next)); ?></span>
                                </a>
                            <?php endif; ?>
                        </nav>
                    </div>

                    <!-- Sidebar -->
                    <aside class="yyb-post-single__sidebar">
                        <div class="yyb-sidebar-widget">
                            <h3 class="yyb-sidebar-widget__title">Recent Posts</h3>
                            <?php
                            $recent = get_posts(['numberposts' => 5, 'post__not_in' => [get_the_ID()]]);
                            foreach ($recent as $rp) : ?>
                                <a href="<?php echo esc_url(get_permalink($rp)); ?>" class="yyb-sidebar-post">
                                    <?php if (has_post_thumbnail($rp)) : ?>
                                        <div class="yyb-sidebar-post__thumb"><?php echo get_the_post_thumbnail($rp, 'thumbnail'); ?></div>
                                    <?php endif; ?>
                                    <div class="yyb-sidebar-post__info">
                                        <span class="yyb-sidebar-post__title"><?php echo esc_html(get_the_title($rp)); ?></span>
                                        <span class="yyb-sidebar-post__date"><?php echo get_the_date('M j, Y', $rp); ?></span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>

                        <div class="yyb-sidebar-widget yyb-sidebar-cta">
                            <p class="yyb-sidebar-cta__label">[ SUPPLY STORE ]</p>
                            <h4>Need Tactical Gear?</h4>
                            <p>Browse our full catalog of military-grade equipment and supplies.</p>
                            <a href="<?php echo esc_url(home_url('/supply-store')); ?>" class="btn btn--primary btn--sm">Shop Now</a>
                        </div>
                    </aside>
                </div>

            </div>
        </article>
    <?php endif; ?>

    <?php endwhile; ?>
</main>

<style>
/* ── Breadcrumb ── */
.yyb-breadcrumb {
    display: flex; align-items: center; gap: 8px;
    padding: 100px 0 32px; font-size: 12px;
    text-transform: uppercase; letter-spacing: 0.08em;
    color: var(--color-gray);
}
.yyb-breadcrumb a { color: var(--color-gray); text-decoration: none; transition: color 0.2s; }
.yyb-breadcrumb a:hover { color: var(--color-accent); }
.yyb-breadcrumb span:last-child { color: var(--color-accent); }

/* ── Product Single ── */
.yyb-product-single { padding-bottom: 80px; background: var(--color-black); }
.yyb-product-single__grid {
    display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: start;
}
.yyb-product-single__main-img {
    position: relative; overflow: hidden; aspect-ratio: 1/1;
    background: var(--color-dark); border: 1px solid var(--color-border);
}
.yyb-product-single__main-img img { width: 100%; height: 100%; object-fit: cover; }
.yyb-product-single__placeholder {
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    gap: 12px; color: var(--color-gray); font-size: 11px; letter-spacing: 0.15em;
}
.yyb-product-single__img-badge {
    position: absolute; top: 16px; left: 16px;
    background: var(--color-accent); color: var(--color-black);
    font-size: 10px; font-weight: 700; letter-spacing: 0.15em;
    padding: 4px 10px; text-transform: uppercase;
}
.yyb-product-single__category {
    display: inline-block; font-size: 11px; font-weight: 600;
    letter-spacing: 0.2em; text-transform: uppercase; color: var(--color-accent);
    margin-bottom: 12px;
}
.yyb-product-single__title {
    font-size: clamp(28px, 3.5vw, 44px); font-weight: 900;
    text-transform: uppercase; color: var(--color-off-white);
    letter-spacing: -0.01em; line-height: 1.1; margin-bottom: 20px;
}
.yyb-product-single__price {
    font-size: 36px; font-weight: 700; color: var(--color-accent);
    margin-bottom: 24px; letter-spacing: -0.02em;
}
.yyb-product-single__meta-row {
    display: flex; gap: 32px; margin-bottom: 24px;
    padding: 20px 0; border-top: 1px solid var(--color-border); border-bottom: 1px solid var(--color-border);
}
.yyb-product-single__meta-item { display: flex; flex-direction: column; gap: 4px; }
.yyb-product-single__meta-item .label {
    font-size: 10px; text-transform: uppercase; letter-spacing: 0.15em; color: var(--color-gray);
}
.yyb-product-single__meta-item .value { font-size: 14px; font-weight: 600; color: var(--color-off-white); }
.yyb-product-single__stock { color: #4caf50 !important; }
.yyb-product-single__desc { color: var(--color-gray); line-height: 1.7; margin-bottom: 28px; font-size: 15px; }
.yyb-product-single__qty { margin-bottom: 24px; }
.yyb-product-single__qty label {
    display: block; font-size: 11px; text-transform: uppercase; letter-spacing: 0.12em;
    color: var(--color-gray); margin-bottom: 8px;
}
.yyb-product-single__qty-ctrl { display: flex; align-items: center; gap: 0; width: fit-content; }
.qty-btn {
    width: 44px; height: 44px; background: var(--color-dark);
    border: 1px solid var(--color-border); color: var(--color-off-white);
    font-size: 20px; cursor: pointer; transition: all 0.2s;
    display: flex; align-items: center; justify-content: center;
}
.qty-btn:hover { background: var(--color-accent); color: var(--color-black); border-color: var(--color-accent); }
.qty-input {
    width: 64px; height: 44px; background: var(--color-dark); border: 1px solid var(--color-border);
    border-left: none; border-right: none; color: var(--color-off-white);
    text-align: center; font-family: var(--font-primary); font-size: 16px; font-weight: 600;
    -moz-appearance: textfield;
}
.qty-input::-webkit-inner-spin-button, .qty-input::-webkit-outer-spin-button { -webkit-appearance: none; }
.yyb-product-single__cta { display: flex; flex-direction: column; gap: 12px; margin-bottom: 28px; }
.btn--full { width: 100%; text-align: center; }
.yyb-product-single__badges { display: flex; gap: 20px; flex-wrap: wrap; }
.yyb-badge {
    display: flex; align-items: center; gap: 6px;
    font-size: 11px; color: var(--color-gray); text-transform: uppercase; letter-spacing: 0.08em;
}

/* ── Blog Post Single ── */
.yyb-post-single { padding-bottom: 80px; background: var(--color-black); }
.yyb-post-single__grid { display: grid; grid-template-columns: 1fr 320px; gap: 60px; align-items: start; }
.yyb-post-single__cat {
    display: inline-block; font-size: 11px; font-weight: 600;
    letter-spacing: 0.2em; text-transform: uppercase; color: var(--color-accent); margin-bottom: 12px;
}
.yyb-post-single__title {
    font-size: clamp(28px, 4vw, 52px); font-weight: 900; color: var(--color-off-white);
    text-transform: uppercase; letter-spacing: -0.02em; line-height: 1.1; margin-bottom: 16px;
}
.yyb-post-single__byline {
    display: flex; align-items: center; gap: 12px;
    font-size: 13px; color: var(--color-gray); margin-bottom: 32px;
}
.yyb-post-single__byline .sep { color: var(--color-border); }
.yyb-post-single__thumb {
    margin-bottom: 40px; overflow: hidden;
    border: 1px solid var(--color-border);
}
.yyb-post-single__thumb img { width: 100%; height: auto; display: block; }
.yyb-post-single__content {
    color: var(--color-gray); font-size: 16px; line-height: 1.8; margin-bottom: 40px;
}
.yyb-post-single__content h2,
.yyb-post-single__content h3 { color: var(--color-off-white); text-transform: uppercase; margin: 32px 0 16px; }
.yyb-post-single__content p { margin-bottom: 20px; }
.yyb-post-single__content a { color: var(--color-accent); }
.yyb-post-single__content img { max-width: 100%; border: 1px solid var(--color-border); }
.yyb-post-single__tags { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 40px; }
.yyb-tag {
    display: inline-block; padding: 4px 12px;
    background: var(--color-dark); border: 1px solid var(--color-border);
    font-size: 11px; text-transform: uppercase; letter-spacing: 0.1em; color: var(--color-gray);
}
.yyb-post-single__nav {
    display: grid; grid-template-columns: 1fr 1fr; gap: 20px;
    padding-top: 32px; border-top: 1px solid var(--color-border);
}
.yyb-post-single__nav-item {
    display: flex; flex-direction: column; gap: 6px;
    padding: 20px; background: var(--color-dark); border: 1px solid var(--color-border);
    text-decoration: none; transition: border-color 0.2s;
}
.yyb-post-single__nav-item:hover { border-color: var(--color-accent); }
.yyb-post-single__nav-item--next { text-align: right; }
.nav-dir { font-size: 11px; text-transform: uppercase; letter-spacing: 0.12em; color: var(--color-accent); }
.nav-title { font-size: 14px; font-weight: 600; color: var(--color-off-white); }

/* ── Sidebar ── */
.yyb-sidebar-widget {
    background: var(--color-dark); border: 1px solid var(--color-border);
    padding: 28px; margin-bottom: 24px; position: sticky; top: 100px;
}
.yyb-sidebar-widget__title {
    font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em;
    color: var(--color-off-white); margin-bottom: 20px;
    padding-bottom: 12px; border-bottom: 1px solid var(--color-border);
}
.yyb-sidebar-post {
    display: flex; gap: 12px; padding: 12px 0;
    border-bottom: 1px solid var(--color-border); text-decoration: none;
    transition: opacity 0.2s;
}
.yyb-sidebar-post:hover { opacity: 0.75; }
.yyb-sidebar-post:last-child { border-bottom: none; }
.yyb-sidebar-post__thumb { width: 60px; height: 60px; flex-shrink: 0; overflow: hidden; }
.yyb-sidebar-post__thumb img { width: 100%; height: 100%; object-fit: cover; }
.yyb-sidebar-post__info { display: flex; flex-direction: column; gap: 4px; }
.yyb-sidebar-post__title { font-size: 13px; font-weight: 600; color: var(--color-off-white); line-height: 1.4; }
.yyb-sidebar-post__date { font-size: 11px; color: var(--color-gray); }
.yyb-sidebar-cta .yyb-sidebar-cta__label {
    font-size: 10px; letter-spacing: 0.2em; color: var(--color-accent);
    text-transform: uppercase; margin-bottom: 8px;
}
.yyb-sidebar-cta h4 {
    font-size: 18px; font-weight: 800; text-transform: uppercase;
    color: var(--color-off-white); margin-bottom: 12px;
}
.yyb-sidebar-cta p { font-size: 13px; color: var(--color-gray); margin-bottom: 20px; line-height: 1.6; }
.btn--sm { padding: 10px 20px; font-size: 12px; }

@media (max-width: 900px) {
    .yyb-product-single__grid,
    .yyb-post-single__grid { grid-template-columns: 1fr; }
    .yyb-post-single__nav { grid-template-columns: 1fr; }
    .yyb-sidebar-widget { position: static; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const minus = document.querySelector('.qty-minus');
    const plus  = document.querySelector('.qty-plus');
    const input = document.querySelector('.qty-input');
    if (!minus) return;
    minus.addEventListener('click', () => { let v = parseInt(input.value); if (v > 1) input.value = v - 1; });
    plus.addEventListener('click',  () => { let v = parseInt(input.value); let max = parseInt(input.max) || 999; if (v < max) input.value = v + 1; });
});
</script>

<?php get_footer(); ?>
