<?php
/**
 * Template part for displaying single projects.
 *
 * @package Escape
 */

?>

<?php


$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
$thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id(), 'thumbnail');
$difficulty = get_post_meta( get_the_ID(), '_tc_difficulty', true );
$size = get_post_meta( get_the_ID(), '_tc_size', true );
$duration = get_post_meta( get_the_ID(), '_tc_duration', true );
$escape_percentage = get_post_meta( get_the_ID(), '_tc_escape_percentage', true );
$best_time = get_post_meta( get_the_ID(), '_tc_best_time', true );
$project_gallery = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );


function escape_output_file_list( $file_list_meta_key, $img_size = '' ) {
                                
	// Get the list of files
	$files = get_post_meta( get_the_ID(), $file_list_meta_key, 1 );
	
	  if (!empty($files)) {
		echo '<h6>'. esc_html__('GALLERY','escape') .'</h6>';
	  }

	// Loop through them and output an image
	foreach ( (array) $files as $attachment_id => $attachment_url ) {
	$alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
		echo '<div class="room-gallery-image">';
		echo '<a class="image-popup" href="'.$attachment_url.'"><img class="img-responsive" src="'.$attachment_url.'" alt="'.$alt.'" ></a>';
		echo '</div>';
	}
}

?>


<div id="post-<?php the_ID(); ?>" <?php post_class('room-page'); ?>>

	<div class="room-img" style="background-image: url('<?php  echo esc_url($image[0]); ?>')">
    
        <div class="room-img-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <?php the_title( '<h2 class="room-title">', '</h2>' ); ?>
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
    	
    </div>

    <div class="container">
    	<div class="row">
        	
            <div class="col-lg-3 col-md-3"> 
                <div class="room-media">
                
                	<!-- room video -->
					<?php 
                
						$url = esc_url( get_post_meta( get_the_ID(), 'room_video', 1 ) );
						if ( $url ) : ?>
						
						<div class="room-video">
						
							<h6><?php echo esc_html__('VIDEO','escape') ?></h6>   
							<?php echo wp_oembed_get( $url ); ?>
							
						</div>
                        
                    <?php endif; ?>
                          
					
                    <!-- image gallery -->
                    <div class="popup-gallery">
                      <?php  escape_output_file_list( 'room_file_list', 'small' ); ?>
                    </div>
						                    
                    
                
                </div>
            </div>
    
            <div class="col-lg-6 col-md-6">
                <h6><?php echo esc_html__('OVERVIEW', 'escape')?></h6>
                <?php the_content(); ?>
			</div>
        
            <div class="col-lg-3 col-md-3">
                <div class="room-info">
                	
                    <?php if($difficulty) : ?>
                    
                    	<div class="room-att-info">
                        	<div class="icon">
                            	<i class="pe pe-4x pe-va pe-7s-door-lock"></i> 
                            </div>
                            <div class="room-caption">
                            	<h6><?php echo esc_html__('DIFFICULTY','escape') ?></h6>
                        		<p class="lead"><?php echo esc_attr($difficulty); ?></p>
                            </div>
                        </div>
                	
                    <?php endif; ?>
                    
                    <?php if($duration) : ?>
                    	
                        <div class="room-att-info">
                        	<div class="icon">
                            	<i class="pe pe-4x pe-va pe-7s-timer"></i> 
                            </div>
                            <div class="room-caption">
                            	<h6><?php echo esc_html__('DURATION','escape') ?></h6>
                        		<p class="lead"><?php echo esc_attr($duration); ?></p>
                            </div>
                        </div>
                        
                    <?php endif; ?>
                    
                    <?php if($size) : ?>
                    	<div class="room-att-info">
                        	<div class="icon">
                            	<i class="pe pe-4x pe-va pe-7s-user"></i>
                            </div>
                            <div class="room-caption">
                            	<h6><?php echo esc_html__('GROUP SIZE','escape') ?></h6>
                        		<p class="lead"> <?php echo esc_attr($size); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($escape_percentage) : ?>
                    	
                        <div class="room-att-info">
                        	<div class="icon">
                            	<i class="pe pe-4x pe-va pe-7s-upload"></i>
                            </div>
                            <div class="room-caption">
                            	<h6> <?php echo esc_html__('ESCAPE RATE', 'escape') ?></h6>
                        		<p class="lead"><?php echo esc_attr($escape_percentage); ?></p>
                            </div>
                        </div>
                    	
                        
                    <?php endif; ?>
                    
                    <?php if($best_time) : ?>
                    	
                        <div class="room-att-info">
                        	<div class="icon">
                            	<i class="pe pe-4x pe-va pe-7s-cup"></i>
                            </div>
                            <div class="room-caption">
                            	<h6> <?php echo esc_html__('BEST TIME', 'escape') ?></h6>
                        		<p class="lead"><?php echo esc_attr($best_time); ?></p>
                            </div>
                        </div>
                    	
                        
                    <?php endif; ?>
                    
                </div>
            </div>
                            
        </div>
    </div>         
    

</div><!-- #post-## -->

