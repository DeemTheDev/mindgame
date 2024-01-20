<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Escape
 */
 
 $image = wp_get_attachment_url( get_post_meta( get_the_ID(), '_tc_header_bg_id', 1 ), 'full' );
 $overlay_bg = get_post_meta( get_the_ID(), '_tc_overlay_bg', true );
 $subhead = get_post_meta( get_the_ID(), '_tc_subhead', true );
 $title_color = get_post_meta( get_the_ID(), '_tc_title_color', true );
 $html ='';

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
    <header class="entry-header  tc-page-header clearfix" style="color:<?php echo esc_attr($title_color) ?>;background-image:url(<?php echo esc_attr($image) ?>) !important;">
    	<div class="overlay dotted_bg" style="background-color:<?php echo esc_attr($overlay_bg) ?>">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                        <?php if($subhead){ 
                            echo '<p class="lead">'.$subhead.'</p>'; } 
                        ?>
                    </div>
                </div>
            </div>
        </div>
	</header><!-- .entry-header -->

	<div class="container">
    <div class="row">
        
    <div class="entry-content col-lg-9 col-md-9">
        <?php the_content(); ?>
        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'escape' ),
                'after'  => '</div>',
            ) );
        ?>
       	
        <footer class="entry-footer">
			<?php
                edit_post_link(
                    sprintf(
                        /* translators: %s: Name of current post */
                        esc_html__( 'Edit %s', 'escape' ),
                        the_title( '<span class="screen-reader-text">"', '"</span>', false )
                    ),
                    '<span class="edit-link">',
                    '</span>'
                );
            ?>
        </footer>
        
        <?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		?>
    
    </div><!-- .entry-content -->

    
	<?php get_sidebar(); ?>
    
    </div>
    </div>
    
</div><!-- #post -->
