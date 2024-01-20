<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Escape
 */
 
 $escape_global_var = get_option('escape_global_var');
 
 $escape_blog_loop_content_type = 1; // Default show the content
 if ( isset( $escape_global_var['tc-blog-loop-content-type'] ) ) {
    $escape_blog_loop_content_type = $escape_global_var['tc-blog-loop-content-type'];
	}
 $the_excerpt_max_chars = isset( $escape_global_var['excerpt-max-char-length'] ) ? max( 1, intval( $escape_global_var['excerpt-max-char-length'] ) ) : 300;

 $url = esc_url( get_post_meta( get_the_ID(), 'media_embed', 1 ) );

 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
    
	<div class="tc_media">
	<?php if(has_post_format('image')){ ?>
		<?php $thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id()); ?>
        <img class="img-responsive" src="<?php  echo esc_url($thumbnail_url); ?>" alt="">
    <?php } else if(has_post_format('audio')){ ?>
        <div class="post-format-audio">
			<?php echo wp_oembed_get( $url ); ?>
            <div style="clear:both;"></div>
        </div>
    <?php } else if(has_post_format('video')){ ?>
        <div class="post-format-video">
			<?php echo wp_oembed_get( $url ); ?>
            <div style="clear:both;"></div>
        </div>
    <?php } else if(has_post_format('link')){ ?>
           
    <?php } else { ?>	                                   
        <?php $thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id()); ?>
        <img class="img-responsive" src="<?php  echo esc_url($thumbnail_url); ?>" alt="">
    <?php } ?>
	</div>    

	<header class="blog-entry-header">
		<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php escape_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( $escape_blog_loop_content_type == 1 ): // Show the content ?>
                <?php the_content(); ?>
            <?php else: // Show the excerpt ?>
                <div class="content-post the-excerpt-content">
                    <p><?php echo function_exists( 'escape_get_the_excerpt_max_charlength' ) ? escape_get_the_excerpt_max_charlength( $the_excerpt_max_chars ): get_the_excerpt(); ?></p>
                </div>
                <?php
                    $read_more_text = isset( $escape_global_var['blog-continue-reading'] ) ? sanitize_text_field( $escape_global_var['blog-continue-reading'] ) : esc_html__( 'Read more', 'escape' );
                    echo '<p>' . escape_modify_read_more_link() . '</p>' 
                ?>
            <?php endif; ?>

		
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php escape_entry_footer(); ?>
	</footer><!-- .entry-footer -->
    
</article><!-- #post-## -->
