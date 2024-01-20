<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Escape
 */

get_header(); ?>

<div class="single-post-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
            	<header class="blog-page-header text-center">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'escape' ); ?></h1>
				</header><!-- .page-header -->
            </div>
        </div>
    </div>
</div>

	<div class="container">
		<div class="row">

			<div class="error-404 not-found col-lg-9">
                
                <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'escape' ); ?></p>
                
			</div><!-- .error-404 -->

			<?php get_sidebar(); ?>

		</div>
	</div>

<?php get_footer(); ?>
