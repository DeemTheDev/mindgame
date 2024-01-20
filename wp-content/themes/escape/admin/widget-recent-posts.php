<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
    exit;
} 


/**
 * Widget Name: ThemeCube Recent Posts
 * Widget Description: Display the lastest posts of selected category
 * Widget Function Name: _recent_posts
 * Widget Text Domain: escape
 * 
 */
 
class escape_widget_recent_posts extends WP_Widget { 
     
    function __construct() {
        $widget_ops = array( 
            'classname'     =>  '', 
            'description'   =>  esc_html__( 'Display the lastest posts of selected category', 'escape' ) 
        );
        
        $control_ops = array( 'width' => 400, 'height' => 0); 
        parent::__construct( 
            'escape_widget_recent_posts', 
            esc_html__('ThemeCube Recent Posts', 'escape'), 
            $widget_ops, $control_ops
        );
        
    }
    
    
    public function widget( $args, $instance ) {
        global $post; 
        
       // $title = apply_filters( 'widget_title', $instance['title'] ); 
	   $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'Pages', 'escape' ) : $instance['title'], $instance, $this->id_base );
        $cat_id = isset( $instance['cat_id'] ) ? intval( $instance['cat_id'] ) : 0;
        $limit = isset( $instance['limit'] ) ? intval( $instance['limit'] ) : 2;
        
        // before and after widget arguments are defined by themes 
        echo (''.$args['before_widget']);   
        
        $query_args = array(
            'showposts'     =>  $limit,
            'post_status'   =>  array( 'publish' )
        );
        
        if ( $cat_id > 0 ) {
            $query_args['cat'] = $cat_id;
        }
        
        $query_posts = new WP_Query( $query_args );
        ?>
        
        <?php if ( trim( $title ) != '' ): ?>
            <?php echo ($args['before_title'] . $title . $args['after_title']); ?>
        <?php endif; ?>
        
        <?php if ( $query_posts->have_posts() ): ?>
            <ul class="news">
            <?php while ( $query_posts->have_posts() ): $query_posts->the_post(); ?>
                
                <?php
                    
                    $thumb_src = '';
                    if ( has_post_thumbnail() ) {                        
                     
					  $thumbnail_url = wp_get_attachment_thumb_url(get_post_thumbnail_id());
                    }
                   
                    $archive_year  = get_the_time('Y'); 
                    $archive_month = get_the_time('M'); 
                    $archive_day   = get_the_time('d');
                    
                ?>
                
                <li>
                    <?php if ( $thumbnail_url != '' ): ?>
                        <a class="tc-news-img" href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" /></a>
                    <?php endif; ?>
                    <div class="tc-news-content">                    
                        <span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
                        <span class="news-date"><?php the_time( 'M j, Y' ); ?></span>
                    </div>    
                </li>
                
            <?php endwhile; ?>
            </ul>
        <?php endif; ?>
        <?php    
        
        wp_reset_postdata();
        
        echo (''.$args['after_widget']); 
    }
    
    
    
    public function form( $instance ) {
        if ( isset( $instance['title'] )) { 
            $title = $instance['title'];  
        }
        else { 
            $title = esc_html__('Recent Posts', 'escape'); 
        }
        
        $cat_id = isset( $instance['cat_id'] ) ? intval( $instance['cat_id'] ) : 0;
        $limit = isset( $instance['limit'] ) ? intval( $instance['limit'] ) : 2;
        
        
        // Widget admin form
        ?> 
        <p>
            <label for="<?php echo (''.$this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title', 'escape' ); ?>: </label> 
            <input class="widefat" id="<?php echo (''.$this->get_field_id( 'title' )); ?>" name="<?php echo (''.$this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"  />
        </p>
        
        <?php if ( function_exists( 'escape_custom_tax_select' ) ): ?>
            <p>
                <label for="<?php echo (''.$this->get_field_id( 'cat_id' )); ?>"><?php esc_html_e( 'Select category', 'escape' ); ?></label>
                <?php 
                    echo escape_custom_tax_select( 
                        array( $cat_id ), 
                        array( 
                            'tax'   => 'category',
                            'class' => 'tc-cat-select widefat', 
                            'id'    => $this->get_field_id( 'cat_id' ),
                            'name'  => $this->get_field_name( 'cat_id' ),
                            'first_option' => true,
                            'first_option_val'  =>  '0',
                            'first_option_text' =>  esc_html__( ' --- All Categories --- ', 'escape' )
                        ) 
                    );
                ?>
            </p>
        <?php else: ?>
            <?php esc_html_e( 'Please install and active plugin ThemeCube Core', 'escape' ); ?>
        <?php endif; ?>
        
        <p>
            <label for="<?php echo (''.$this->get_field_id( 'limit' )); ?>"><?php esc_html_e( 'Limit', 'escape' ); ?>: </label> 
            <input class="widefat" id="<?php echo (''.$this->get_field_id( 'limit' )); ?>" name="<?php echo (''.$this->get_field_name( 'limit' )); ?>" type="text" value="<?php echo esc_attr( $limit ); ?>"  />
        </p>
        
        <?php 
    }
    
    
    
    public function update( $new_instance, $old_instance ) {
        $instance = array(); 
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['cat_id'] = ( ! empty( $new_instance['cat_id'] ) ) ? intval( $new_instance['cat_id'] ) : 0;
        $instance['limit'] = ( ! empty( $new_instance['limit'] ) ) ? intval( $new_instance['limit'] ) : 2;
        return $instance;
    }
    
} // End class escape_widget_lastest_news 

function escape_load_widget_recent_posts() {
    register_widget( 'escape_widget_recent_posts' );
}
add_action( 'widgets_init', 'escape_load_widget_recent_posts' );