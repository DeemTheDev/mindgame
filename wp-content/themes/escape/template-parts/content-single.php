<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Escape
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
   
    <header class="single-post-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
                </div>
            </div>
        </div>
    </header>
        
	<div class="container">
    	<div class="row">
        	<div class="col-lg-9 col-md-9">
				<div class="tc_media">
					<?php if(has_post_format('image')){ ?>
                        <?php $thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id()); ?>
                        <img class="img-responsive" src="<?php  echo esc_url($thumbnail_url); ?>" alt="">
                    <?php } else if(has_post_format('audio')){ ?>
                        <div class="post-format-audio">
                            <?php echo wp_oembed_get( $url ); ?>
                            <div style="clear:both;"></div>
                            <div style="clear:both;"></div>
                        </div>
                    <?php } else if(has_post_format('video')){ ?>
                        <div class="post-format-video">
                            <?php echo wp_oembed_get( $url ); ?>
                            <div style="clear:both;"></div>
                        </div>
                    <?php } else if(has_post_format('link')){ ?>
                            <?php the_content(); ?>
                    <?php } else { ?>	                                   
                        <?php $thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id()); ?>
                        <img class="img-responsive" src="<?php  echo esc_url($thumbnail_url); ?>" alt="">
                    <?php } ?>
                </div>
    
				<header class="entry-header">            
                    <div class="entry-meta">
                        <?php escape_posted_on(); ?>
                    </div><!-- .entry-meta -->
                </header><!-- .entry-header -->

				<div class="entry-content">
					<?php the_content(); ?>
                    <?php
                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'escape' ),
                            'after'  => '</div>'
                        ) );
                    ?>
                </div><!-- .entry-content -->
                
                <footer class="entry-footer">
                    <?php escape_entry_footer(); ?>
                </footer><!-- .entry-footer -->
                
                <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                ?>
                
            </div>
            
             <?php get_sidebar(); ?>
        </div>
    </div>
    
    


</article>
