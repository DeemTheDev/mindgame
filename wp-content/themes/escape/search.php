<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
					<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'escape' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
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
                    /**
                     * Run the loop for the search to output the results.
                     * If you want to overload this in a child theme then include a file
                     * called content-search.php and that will be used instead.
                     */
                    get_template_part( 'template-parts/content', 'search' );
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
