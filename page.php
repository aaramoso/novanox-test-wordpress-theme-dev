<?php
/**
 * Default page template.
 *
 * @package YY_Bunker
 */

get_header();

while ( have_posts() ) :
    the_post();
    yyb_page_hero( '', get_the_title() );
    ?>
    <section class="section">
        <div class="container">
            <div class="entry-content" style="max-width:800px;">
                <?php the_content(); ?>
            </div>
        </div>
    </section>
    <?php
endwhile;

get_footer();
