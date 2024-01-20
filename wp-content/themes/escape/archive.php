<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Escape
 */

get_header(); ?>

<div class="single-post-header">
	<div class="container">
		<div class="row">

			<?php if ( have_posts() ) : ?>
    
                <div class="col-lg-12">
                    <div class="blog-page-header text-center">
                        <?php
                            the_archive_title( '<h1 class="page-title">', '</h1>' );
                            the_archive_description( '<div class="taxonomy-description">', '</div>' );
                        ?>
                    </div>
                </div>
    	</div>
    </div>
</div>

<div class="container">
	<div class="row">
               
            <div class="col-lg-9">
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
