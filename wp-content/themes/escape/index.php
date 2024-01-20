<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Escape
 */
 
 
 
get_header(); ?>


<header class="entry-header  tc-blog-header clearfix">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
				<?php if ( have_posts() ) : ?>
                
					<?php if ( is_home() && ! is_front_page() ) : ?>
                    
                    	<h1 class="page-title"><?php single_post_title(); ?></h1>
                
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-lg-9 col-md-9">
                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>
    
                    <?php
    
                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'template-parts/content', get_post_format() );
                    ?>
    
                <?php endwhile; ?>
    
                <?php the_posts_navigation(); ?>
    
            <?php else : ?>
    
                <?php get_template_part( 'template-parts/content', 'none' ); ?>
    
            <?php endif; ?>
    
            </div>

		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
