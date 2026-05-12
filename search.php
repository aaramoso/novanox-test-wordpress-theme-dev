<?php
/**
 * Search Results Template
 * YY Bunker Theme
 */
get_header(); ?>

<main class="yyb-search">

    <!-- Search Header -->
    <section class="yyb-search__hero">
        <div class="yyb-search__grid-bg"></div>
        <div class="container">
            <p class="yyb-search__label">[ INTEL SEARCH ]</p>
            <h1 class="yyb-search__title">
                <?php if (get_search_query()) : ?>
                    Results for <span class="yyb-search__term">"<?php echo esc_html(get_search_query()); ?>"</span>
                <?php else : ?>
                    Search
                <?php endif; ?>
            </h1>
            <?php if (have_posts()) : ?>
                <p class="yyb-search__count"><?php echo $wp_query->found_posts; ?> result<?php echo $wp_query->found_posts !== 1 ? 's' : ''; ?> found</p>
            <?php endif; ?>
            <!-- Search form -->
            <div class="yyb-search__form-wrap">
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="yyb-search__form">
                    <input type="search" name="s" class="yyb-search__input"
                           placeholder="Search products, services, info..."
                           value="<?php echo esc_attr(get_search_query()); ?>">
                    <button type="submit" class="yyb-search__submit">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <circle cx="8.5" cy="8.5" r="6.5" stroke="currentColor" stroke-width="1.8"/>
                            <path d="M13.5 13.5L18 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Search Results -->
    <section class="yyb-search__body">
        <div class="container">
            <?php if (have_posts()) : ?>

                <div class="yyb-search__results">
                    <?php while (have_posts()) : the_post(); ?>
                    <article class="yyb-search-result" id="post-<?php the_ID(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" class="yyb-search-result__thumb">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </a>
                        <?php endif; ?>
                        <div class="yyb-search-result__body">
                            <div class="yyb-search-result__meta">
                                <span class="yyb-search-result__type">
                                    <?php
                                    $pt = get_post_type();
                                    if ($pt === 'yyb_product') echo 'Product';
                                    elseif ($pt === 'yyb_service') echo 'Service';
                                    elseif ($pt === 'page') echo 'Page';
                                    else echo 'Post';
                                    ?>
                                </span>
                                <?php if (get_post_type() === 'post') : ?>
                                    <span class="yyb-search-result__date"><?php echo get_the_date(); ?></span>
                                <?php endif; ?>
                            </div>
                            <h2 class="yyb-search-result__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="yyb-search-result__excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="yyb-search-result__link">
                                View <?php echo (get_post_type() === 'yyb_product') ? 'Product' : 'Full Article'; ?> →
                            </a>
                        </div>
                    </article>
                    <?php endwhile; ?>
                </div>

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
                <div class="yyb-search__no-results">
                    <div class="yyb-search__no-icon">
                        <svg width="64" height="64" viewBox="0 0 64 64" fill="none">
                            <circle cx="26" cy="26" r="20" stroke="#C8A84B" stroke-opacity="0.3" stroke-width="2"/>
                            <path d="M40 40L56 56" stroke="#C8A84B" stroke-opacity="0.3" stroke-width="2" stroke-linecap="round"/>
                            <path d="M20 26h12M26 20v12" stroke="#C8A84B" stroke-opacity="0.5" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <p class="yyb-search__no-label">[ NO RESULTS ]</p>
                    <h2>Target Not Found</h2>
                    <p>No results for <strong>"<?php echo esc_html(get_search_query()); ?>"</strong>. Try different keywords or browse our store.</p>
                    <div class="yyb-search__suggestions">
                        <p>Try searching for:</p>
                        <div class="yyb-search__chips">
                            <a href="<?php echo esc_url(home_url('/?s=tactical')); ?>" class="yyb-chip">Tactical</a>
                            <a href="<?php echo esc_url(home_url('/?s=military')); ?>" class="yyb-chip">Military</a>
                            <a href="<?php echo esc_url(home_url('/?s=gear')); ?>" class="yyb-chip">Gear</a>
                            <a href="<?php echo esc_url(home_url('/?s=supply')); ?>" class="yyb-chip">Supply</a>
                            <a href="<?php echo esc_url(home_url('/?s=equipment')); ?>" class="yyb-chip">Equipment</a>
                        </div>
                    </div>
                    <a href="<?php echo esc_url(home_url('/supply-store')); ?>" class="btn btn--primary">Browse Full Store</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

</main>

<style>
.yyb-search { background: var(--color-black); }

/* Hero */
.yyb-search__hero {
    position: relative; padding: 120px 0 60px;
    border-bottom: 1px solid var(--color-border); overflow: hidden;
}
.yyb-search__grid-bg {
    position: absolute; inset: 0;
    background-image: linear-gradient(rgba(200,168,75,0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(200,168,75,0.04) 1px, transparent 1px);
    background-size: 60px 60px; pointer-events: none;
}
.yyb-search__label {
    font-size: 11px; font-weight: 600; letter-spacing: 0.3em;
    text-transform: uppercase; color: var(--color-accent); margin-bottom: 12px;
}
.yyb-search__title {
    font-size: clamp(28px, 4.5vw, 56px); font-weight: 900; text-transform: uppercase;
    color: var(--color-off-white); letter-spacing: -0.02em; line-height: 1.1;
    margin-bottom: 8px;
}
.yyb-search__term { color: var(--color-accent); }
.yyb-search__count {
    font-size: 13px; color: var(--color-gray); text-transform: uppercase;
    letter-spacing: 0.1em; margin-bottom: 32px;
}
.yyb-search__form-wrap { max-width: 600px; }
.yyb-search__form {
    display: flex; gap: 0;
    border: 1px solid var(--color-border);
}
.yyb-search__input {
    flex: 1; background: var(--color-dark); border: none;
    padding: 16px 24px; font-family: var(--font-primary); font-size: 16px;
    color: var(--color-off-white); outline: none;
}
.yyb-search__input::placeholder { color: var(--color-gray); }
.yyb-search__submit {
    background: var(--color-accent); border: none; padding: 0 24px;
    color: var(--color-black); cursor: pointer; transition: opacity 0.2s;
    display: flex; align-items: center; justify-content: center;
}
.yyb-search__submit:hover { opacity: 0.85; }

/* Body */
.yyb-search__body { padding: 60px 0 80px; }

/* Results list */
.yyb-search__results { margin-bottom: 60px; }
.yyb-search-result {
    display: flex; gap: 28px; align-items: flex-start;
    padding: 28px 0; border-bottom: 1px solid var(--color-border);
    transition: opacity 0.2s;
}
.yyb-search-result:first-child { border-top: 1px solid var(--color-border); }
.yyb-search-result:hover { opacity: 0.85; }
.yyb-search-result__thumb {
    width: 100px; height: 100px; flex-shrink: 0; overflow: hidden;
    border: 1px solid var(--color-border);
}
.yyb-search-result__thumb img { width: 100%; height: 100%; object-fit: cover; }
.yyb-search-result__meta {
    display: flex; align-items: center; gap: 12px; margin-bottom: 8px;
}
.yyb-search-result__type {
    display: inline-block; padding: 3px 10px;
    background: var(--color-dark); border: 1px solid var(--color-border);
    font-size: 10px; text-transform: uppercase; letter-spacing: 0.12em; color: var(--color-accent);
}
.yyb-search-result__date { font-size: 12px; color: var(--color-gray); }
.yyb-search-result__title { margin-bottom: 8px; }
.yyb-search-result__title a {
    font-size: 20px; font-weight: 800; text-transform: uppercase;
    color: var(--color-off-white); text-decoration: none; transition: color 0.2s; line-height: 1.2;
}
.yyb-search-result__title a:hover { color: var(--color-accent); }
.yyb-search-result__excerpt { font-size: 14px; color: var(--color-gray); line-height: 1.7; margin-bottom: 12px; }
.yyb-search-result__link {
    font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;
    color: var(--color-accent); text-decoration: none; transition: opacity 0.2s;
}
.yyb-search-result__link:hover { opacity: 0.75; }

/* Pagination */
.yyb-pagination { display: flex; justify-content: center; }
.yyb-pagination .page-numbers {
    list-style: none; display: flex; gap: 8px; padding: 0; margin: 0;
}
.yyb-pagination .page-numbers li a,
.yyb-pagination .page-numbers li span {
    display: flex; align-items: center; justify-content: center;
    width: 44px; height: 44px; background: var(--color-dark); border: 1px solid var(--color-border);
    color: var(--color-gray); text-decoration: none; font-size: 14px; font-weight: 600; transition: all 0.2s;
}
.yyb-pagination .page-numbers li a:hover { border-color: var(--color-accent); color: var(--color-accent); }
.yyb-pagination .page-numbers li span.current {
    background: var(--color-accent); border-color: var(--color-accent); color: var(--color-black);
}

/* No results */
.yyb-search__no-results { text-align: center; padding: 80px 20px; }
.yyb-search__no-icon { margin-bottom: 24px; opacity: 0.6; }
.yyb-search__no-label {
    font-size: 11px; letter-spacing: 0.3em; color: var(--color-accent);
    text-transform: uppercase; margin-bottom: 12px;
}
.yyb-search__no-results h2 {
    font-size: 40px; font-weight: 900; text-transform: uppercase;
    color: var(--color-off-white); margin-bottom: 12px;
}
.yyb-search__no-results p { color: var(--color-gray); font-size: 15px; max-width: 480px; margin: 0 auto 32px; }
.yyb-search__no-results strong { color: var(--color-off-white); }
.yyb-search__suggestions { margin-bottom: 32px; }
.yyb-search__suggestions p {
    font-size: 12px; text-transform: uppercase; letter-spacing: 0.1em;
    color: var(--color-gray); margin-bottom: 12px;
}
.yyb-search__chips { display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; }
.yyb-chip {
    padding: 6px 16px; background: var(--color-dark); border: 1px solid var(--color-border);
    font-size: 12px; text-transform: uppercase; letter-spacing: 0.1em;
    color: var(--color-off-white); text-decoration: none; transition: all 0.2s;
}
.yyb-chip:hover { border-color: var(--color-accent); color: var(--color-accent); }

@media (max-width: 600px) {
    .yyb-search-result { flex-direction: column; }
    .yyb-search-result__thumb { width: 100%; height: 200px; }
}
</style>

<?php get_footer(); ?>
