<?php
/**
 * 404 Error Page Template
 * YY Bunker Theme
 */
get_header(); ?>

<main class="yyb-404">
    <div class="container">
        <div class="yyb-404__inner">
            <div class="yyb-404__code">
                <span class="yyb-404__num">4</span>
                <span class="yyb-404__icon">
                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="40" cy="40" r="38" stroke="#C8A84B" stroke-width="2"/>
                        <path d="M40 20V44M40 56V58" stroke="#C8A84B" stroke-width="3" stroke-linecap="round"/>
                    </svg>
                </span>
                <span class="yyb-404__num">4</span>
            </div>
            <div class="yyb-404__grid-bg"></div>
            <p class="yyb-404__label">[ SECTOR NOT FOUND ]</p>
            <h1 class="yyb-404__title">Target Lost</h1>
            <p class="yyb-404__desc">The page you're looking for has been moved, removed, or never existed. Regroup and try again.</p>
            <div class="yyb-404__actions">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary">Return to Base</a>
                <a href="<?php echo esc_url(get_post_type_archive_link('yyb_product') ?: home_url('/supply-store')); ?>" class="btn btn--outline">Browse Supply Store</a>
            </div>
            <div class="yyb-404__search">
                <p class="yyb-404__search-label">Or search for what you need:</p>
                <?php get_search_form(); ?>
            </div>
            <div class="yyb-404__links">
                <span>Quick Nav:</span>
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <a href="<?php echo esc_url(home_url('/about-us')); ?>">About</a>
                <a href="<?php echo esc_url(home_url('/products-services')); ?>">Products</a>
                <a href="<?php echo esc_url(home_url('/contact-us')); ?>">Contact</a>
            </div>
        </div>
    </div>
</main>

<style>
.yyb-404 {
    min-height: 80vh;
    display: flex;
    align-items: center;
    padding: 120px 0 80px;
    position: relative;
    overflow: hidden;
    background: var(--color-black);
}
.yyb-404__grid-bg {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(200,168,75,0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(200,168,75,0.04) 1px, transparent 1px);
    background-size: 60px 60px;
    pointer-events: none;
}
.yyb-404__inner {
    text-align: center;
    position: relative;
    z-index: 1;
    max-width: 640px;
    margin: 0 auto;
}
.yyb-404__code {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px;
    margin-bottom: 24px;
}
.yyb-404__num {
    font-size: clamp(80px, 14vw, 160px);
    font-weight: 900;
    color: var(--color-accent);
    line-height: 1;
    opacity: 0.15;
}
.yyb-404__icon svg {
    opacity: 0.8;
}
.yyb-404__label {
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.3em;
    color: var(--color-accent);
    text-transform: uppercase;
    margin-bottom: 16px;
}
.yyb-404__title {
    font-size: clamp(36px, 6vw, 64px);
    font-weight: 900;
    color: var(--color-off-white);
    text-transform: uppercase;
    letter-spacing: -0.02em;
    margin-bottom: 20px;
}
.yyb-404__desc {
    font-size: 16px;
    color: var(--color-gray);
    line-height: 1.7;
    margin-bottom: 40px;
    max-width: 460px;
    margin-left: auto;
    margin-right: auto;
}
.yyb-404__actions {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 40px;
}
.yyb-404__search {
    margin-bottom: 40px;
}
.yyb-404__search-label {
    font-size: 13px;
    color: var(--color-gray);
    margin-bottom: 12px;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}
.yyb-404__search .search-form {
    display: flex;
    gap: 8px;
    justify-content: center;
}
.yyb-404__search .search-field {
    background: var(--color-dark);
    border: 1px solid var(--color-border);
    color: var(--color-off-white);
    padding: 12px 20px;
    font-family: var(--font-primary);
    font-size: 14px;
    width: 300px;
    max-width: 100%;
    outline: none;
    transition: border-color 0.2s;
}
.yyb-404__search .search-field:focus {
    border-color: var(--color-accent);
}
.yyb-404__search .search-submit {
    background: var(--color-accent);
    color: var(--color-black);
    border: none;
    padding: 12px 24px;
    font-family: var(--font-primary);
    font-weight: 700;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    cursor: pointer;
    transition: opacity 0.2s;
}
.yyb-404__search .search-submit:hover { opacity: 0.85; }
.yyb-404__links {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
    padding-top: 32px;
    border-top: 1px solid var(--color-border);
}
.yyb-404__links span {
    font-size: 12px;
    color: var(--color-gray);
    text-transform: uppercase;
    letter-spacing: 0.1em;
}
.yyb-404__links a {
    font-size: 13px;
    color: var(--color-off-white);
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    transition: color 0.2s;
}
.yyb-404__links a:hover { color: var(--color-accent); }
</style>

<?php get_footer(); ?>
