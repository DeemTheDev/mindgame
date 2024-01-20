<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}




// Button shortcode
add_shortcode('button', 'shortcode_button');
function shortcode_button($atts, $content = null) {
    $atts = shortcode_atts(
        array(
		'size' => '',
		'style' => 'light',
        'position' => 'center',
        'href'  => '#',
		'target' =>'',    
        'class' => '',       
    ), $atts);
    $html ='';
	$size = '';
    if($atts['size'] == 'xsmall') $size = 'button-xsmall';
    if($atts['size'] == 'small') $size  = 'button-small';
	if($atts['size'] == 'medium') $size  = 'button-medium';
    if($atts['size'] == 'big') $size  = 'button-big';
	$style = '';
    if($atts['style'] == 'light') $style = 'button-line-light';
    if($atts['style'] == 'dark') $style = 'button-line-dark';
    $position = '';
    if($atts['position'] == 'left') $position = 'pull-left';
    if($atts['position'] == 'right') $position = 'pull-right';
    if($atts['position'] == 'center') $position = 'text-center';
	$target = '';
    if($atts['target'] == 'yes') $target = '"_blank"';
    if($atts['target'] == 'no') $target = '"_self"';
	

    $html .= '<div class="'.$position.'"><a class="button '.$size.' '.$style.' '.$atts['class'].'" href="'.$atts['href'].'" target="'.$atts['target'].'">'.do_shortcode($content).'</a>';
	$html .= '</div>';
    return $html;
}

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("Button", 'escape'),
   "base" => "button",
   "class" => "",
   "category" => __("ThemeCube Shortcodes", 'escape'),
   "icon" => get_template_directory_uri().'/img/tc_icon/tc_icon_button.svg',
   "description" => __('Add button','escape'),
   "params" => array(
    array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Button Size",'escape'),
         "param_name" => "size",
         "value" => array(   
                __('xsmall', 'escape') => 'xsmall',
                __('small', 'escape') => 'small',
                __('medium', 'escape') => 'medium',
				__('big', 'escape') => 'big',
                ),
    ),
	array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Style",'escape'),
         "param_name" => "style",
         "value" => array(   
                __('light', 'escape') => 'light',
                __('dark', 'escape') => 'dark',
                ),
    ),
    array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Position",'escape'),
         "param_name" => "position",
         "value" => array(   
                __('center', 'escape') => 'center',
                __('left', 'escape') => 'left',
                __('right', 'escape') => 'right',
                ),
    ),
    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Href",'escape'),
         "param_name" => "href",
         "value" => "#",
    ),
	array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Open link in new window",'escape'),
         "param_name" => "target",
         "value" => array(   
                __('yes', 'escape') => '_blank',
                __('no', 'escape') => '_self',
                ),
    ),
     array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Class",'escape'),
         "param_name" => "class",
         "value" => "",
    ),
    array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => __("Content",'escape'),
         "param_name" => "content",
         "value" => "",
    )

   )
) );

}



// InfoBox 2 shortcode
add_shortcode('tc_info_box_2', 'shortcode_tc_info_box_2');
function shortcode_tc_info_box_2($atts, $content=null){
    $atts = shortcode_atts(
        array(
        'iconfont'  => '',
		'icon_color'=>'',
		'iconsize'=>'',
        'title'     => 'The title',
		'title_color'=>'#2b2e34',
		'content_color'=>'#999999',
		'align' => 'center',  
		'class' => ''    
    ), $atts);
    $html ='';
	$align = '';
    if($atts['align'] == 'left') $align = 'text-left';
    if($atts['align'] == 'right') $align = 'text-right';
    if($atts['align'] == 'center') $align = 'text-center';
	
	$iconsize = '';
    if($atts['iconsize'] == '2x') $iconsize = 'pe-2x';
    if($atts['iconsize'] == '3x') $iconsize = 'pe-3x';
    if($atts['iconsize'] == '4x') $iconsize = 'pe-4x';
	if($atts['iconsize'] == '5x') $iconsize = 'pe-5x';
	
    $html .= '<div class="infobox '.$align.' '.$atts['class'].'">
				<div class="icon">
					<i style="color:'.$atts['icon_color'].';" class="'.$atts['iconfont'].' '.$iconsize.'"></i>
				</div>
				<h4 style="color:'.$atts['title_color'].';">'.$atts['title'].'</h4>
				<p style="color:'.$atts['content_color'].';">'.do_shortcode($content).'</p>
			  </div>';
    return $html;                        
}

if(function_exists('vc_map')){
	global $font_icons;

vc_map( array(
   "name" => __("Info Box 2", 'escape'),
   "base" => "tc_info_box_2",
   "category" => __("ThemeCube Shortcodes", 'escape'),
   "icon" => get_template_directory_uri().'/img/tc_icon/tc_icon_infobox.svg',
   "description" => __('Add an infobox','escape'),
   "params" => array(
   array(
		'type'          => 'iconpicker',
		'class'         => '',
		'heading'       => __( 'Icon', 'escape' ),
		'param_name'    => 'iconfont',
		'settings' => array(
			'emptyIcon' => false, // default true, display an "EMPTY" icon?
			'type' => '',
			'source' => $font_icons, 					
		),
		'description' => __( 'Select icon from library.', '' ),                    
	),
	  array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Icon Color",'escape'),
         "param_name" => "icon_color",
         "value" => "#2b2e34",
      ),
	  
	array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => __("Icon Size",'escape'),
         "param_name" => "iconsize",
         "value" => array(   
                __('2x', 'escape') => '2x',
                __('3x', 'escape') => '3x',
                __('4x', 'escape') => '4x',
				__('5x', 'escape') => '5x',
                ),
    ),
	
    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title",'escape'),
         "param_name" => "title",
         "value" => "The title",
      ),
	array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Title Color",'escape'),
         "param_name" => "title_color",
         "value" => "#2b2e34",
      ),
	     
	  array(
		 "type" => "textarea",
		 "holder" => "div",
		 "class" => "",
		 "heading" => __("Content",'escape'),
		 "param_name" => "content",
		 "value" => "",
	  ),
	   array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Content Color",'escape'),
         "param_name" => "content_color",
         "value" => "#999999",
      ),
	   array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => __("Alignment",'escape'),
         "param_name" => "align",
         "value" => array(   
                __('center', 'escape') => 'center',
                __('left', 'escape') => 'left',
                __('right', 'escape') => 'right',
                ),
    ),
	  
   )
) );

}


// Infobox Shortcode
add_shortcode('tc_info_box', 'shortcode_tc_info_box');
function shortcode_tc_info_box($atts, $content=null){
    $atts = shortcode_atts(
        array(
        'iconfont'  => '',
		'icon_color'=>'',
		'icon_bg_color'=>'#fdb713', 
		'iconsize'=>'',
        'title'     => 'The title',
		'title_color'=>'#2b2e34',
		'content_color'=>'#999999',
		'align' => 'center',  
		'class' => ''    
    ), $atts);
    $html ='';
	$align = '';
    if($atts['align'] == 'left') $align = 'text-left';
    if($atts['align'] == 'right') $align = 'text-right';
    if($atts['align'] == 'center') $align = 'text-center';
	
	$iconsize = '';
    if($atts['iconsize'] == '2x') $iconsize = 'pe-2x';
    if($atts['iconsize'] == '3x') $iconsize = 'pe-3x';
    if($atts['iconsize'] == '4x') $iconsize = 'pe-4x';
	if($atts['iconsize'] == '5x') $iconsize = 'pe-5x';
	
    $html .= '<div class="infobox '.$align.' '.$atts['class'].'">
				<div class="icon_bg" style="background-color:'.$atts['icon_bg_color'].'">
					<i style="color:'.$atts['icon_color'].';" class="'.$atts['iconfont'].' '.$iconsize.'"></i>
				</div>
				<h3 style="color:'.$atts['title_color'].';">'.$atts['title'].'</h3>
				<p style="color:'.$atts['content_color'].';">'.do_shortcode($content).'</p>
			  </div>';
    return $html;                        
}

if(function_exists('vc_map')){
	global $font_icons;

vc_map( array(
   "name" => __("Info Box", 'escape'),
   "base" => "tc_info_box",
   "category" => __("ThemeCube Shortcodes", 'escape'),
   "icon" => get_template_directory_uri().'/img/tc_icon/tc_icon_infobox.svg',
   "description" => __('Add an infobox','escape'),
   "params" => array(
   array(
		'type'          => 'iconpicker',
		'class'         => '',
		'heading'       => __( 'Icon', 'escape' ),
		'param_name'    => 'iconfont',
		'settings' => array(
			'emptyIcon' => false, // default true, display an "EMPTY" icon?
			'type' => '',
			'source' => $font_icons, 					
		),
		'description' => __( 'Select icon from library.', '' ),                    
	),
	  array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Icon Color",'escape'),
         "param_name" => "icon_color",
         "value" => "#2b2e34",
      ),
	  
	  array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Icon Background Color",'escape'),
         "param_name" => "icon_bg_color",
         "value" => "#fdb713",
      ),
	array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => __("Icon Size",'escape'),
         "param_name" => "iconsize",
         "value" => array(   
                __('2x', 'escape') => '2x',
                __('3x', 'escape') => '3x',
                __('4x', 'escape') => '4x',
				__('5x', 'escape') => '5x',
                ),
    ),
	
    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title",'escape'),
         "param_name" => "title",
         "value" => "The title",
      ),
	array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Title Color",'escape'),
         "param_name" => "title_color",
         "value" => "#2b2e34",
      ),
	     
	  array(
		 "type" => "textarea",
		 "holder" => "div",
		 "class" => "",
		 "heading" => __("Content",'escape'),
		 "param_name" => "content",
		 "value" => "",
	  ),
	   array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Content Color",'escape'),
         "param_name" => "content_color",
         "value" => "#999999",
      ),
	   array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => __("Alignment",'escape'),
         "param_name" => "align",
         "value" => array(   
                __('center', 'escape') => 'center',
                __('left', 'escape') => 'left',
                __('right', 'escape') => 'right',
                ),
    ),
	  
   )
) );

}


// News Carousel Shortcode
add_shortcode('tc_news_carousel', 'shortcode_tc_news_carousel');
function shortcode_tc_news_carousel($atts, $content=null){
    global $escape_global_var;
    $atts = shortcode_atts(
        array(        
        'class'     => '',
    ), $atts);
    $html ='';
    $html .= '
	<div class="container">
	<div class="row">
	
		<div id="news-carousel" class="owl-carousel '.$atts['class'].' clearfix">';
	
		$args = array('post_type'=>'post','posts_per_page'=> '-1', 'category_name'=>'news');
		$project = new WP_Query($args);
		if($project->have_posts()):
			while($project->have_posts()):$project->the_post();
			$thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id(), 'thumbnail');
			
			//<p>'.get_the_project_excerpt().'</p>
			//<a class="button button-xsmall button-dark" href="'.get_permalink().'">read more</a>
			
			$html .= '<div class="news-item">
						
						<figure>
							<img class="img-responsive" src="'.$thumbnail_url.'" alt="">
						</figure>

						<div class="caption">
							<h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4>
							<p>'.get_the_project_excerpt().'</p>
							<span class="date">'.get_the_date().'</span>
							
						</div>
						
					</div>';
			endwhile;
		endif;
    $html .= '</div></div></div>';
    
    return $html;                        
}

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("News Carousel", 'escape'),
   "base" => "tc_news_carousel",
   "class" => "",
   "category" => __("ThemeCube Shortcodes", 'escape'),
   "icon" => get_template_directory_uri().'/img/tc_icon/tc_icon_news.svg',
   "description" => __('Add news carousel','escape'),
   "params" => array(
    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Class",'escape'),
         "param_name" => "class",
         "value" => "",
      )
     
   )
) );

}


// Rooms Layout Shortcode
add_shortcode('tc_rooms_layout', 'shortcode_tc_rooms_layout');
function shortcode_tc_rooms_layout($atts, $content=null){
    global $escape_global_var;
	global $post;
    $atts = shortcode_atts(
        array(        
        'class'     => '',
		'rooms_column'	=> '',
    ), $atts);
	
	
    $html ='';
	$project_column = '';
    if($atts['rooms_column'] == '2items') $rooms_column  = 'col-md-6 col-lg-6';
    if($atts['rooms_column'] == '3items') $rooms_column  = 'col-md-4 col-lg-4';
	if($atts['rooms_column'] == '4items') $rooms_column  = 'col-md-3 col-lg-3';
    if($atts['rooms_column'] == '6items') $rooms_column  = 'col-md-2 col-lg-2';
    
	
	
	$html .= ' <div class="row">
	
	
	
		<div id="room-layout" class="'.$atts['class'].'">';
	
		$args = array('post_type'=>'room','posts_per_page'=> '-1');
		$room = new WP_Query($args);
		if($room->have_posts()):
			while($room->have_posts()):$room->the_post();
			$thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id(), 'thumbnail');
			$size = get_post_meta( get_the_ID(), '_tc_size', true );
			$duration = get_post_meta( get_the_ID(), '_tc_duration', true );
			$escape_percentage = get_post_meta( get_the_ID(), '_tc_escape_percentage', true );
			
			
		//	$categories = get_the_category();
		//	$catname = $categories[0]->name;
			//<li><p><i class="pe pe-va pe-lg pe-7s-plugin"></i> '.$catname.'</p></li>	

            $title = get_the_title();

            if ($title == "The Great Time Escape" || $title == "Escape to Treasure Island"):
                continue;
			
			
			$html .= '<div class="item '.$rooms_column.'">
						<figure class="effect-apollo">
							<img class="img-responsive" src="'.$thumbnail_url.'" alt="">
							<figcaption>
								<p>
									<span><i class="pe pe-lg pe-7s-user"></i> '.$size.'</span>
									<span><i class="pe pe-lg pe-7s-timer"></i> '.$duration.'</span>
									<span><i class="pe pe-lg pe-7s-upload"></i> '.$escape_percentage.'</span>
								</p>
								<a href="'.get_permalink().'">'. __('BOOK NOW', 'escape'). '</a>
							</figcaption>			
						</figure>
						
						<div class="caption">
							<h3>'.get_the_title().'</h3>
							<p class="desc">'.escape_get_the_room_excerpt().'</p>
							<a class="button button-xsmall button-line-dark" href="'.get_permalink().'">'. __('BOOK NOW', 'escape'). '</a>
							
							
							
						</div>
					</div>';
			endwhile;
		endif;
    $html .= '</div></div>';
	
    
    return $html;                        
}

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("Rooms Layout", 'escape'),
   "base" => "tc_rooms_layout",
   "class" => "",
   "category" => __("ThemeCube Shortcodes", 'escape'),
   "icon" => get_template_directory_uri().'/img/tc_icon/tc_icon_project_layout.svg',
   "description" => __('Add rooms layout','escape'),
   "params" => array(
    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Class",'escape'),
         "param_name" => "class",
         "value" => "",
      ),
	 array(
         "type" => "dropdown",
		 "holder" => "div",
         "class" => "",
         "heading" => __("How many items in a row?",'escape'),
         "param_name" => "rooms_column",
         "value" => array(
		 			'',
                __('2 items', 'escape') => '2items',
                __('3 items', 'escape') => '3items',
                __('4 items', 'escape') => '4items',
				__('6 items', 'escape') => '6items',
                ),
		"default" => "2items",
    ),
     
   )
) );

}

// Rooms Layout Cornubia Shortcode
add_shortcode('tc_rooms_layout_cornubia', 'shortcode_tc_rooms_layout_cornubia');
function shortcode_tc_rooms_layout_cornubia($atts, $content=null){
    global $escape_global_var;
	global $post;
    $atts = shortcode_atts(
        array(        
        'class'     => '',
		'rooms_column'	=> '',
    ), $atts);
	
	
    $html ='';
	$project_column = '';
    if($atts['rooms_column'] == '2items') $rooms_column  = 'col-md-6 col-lg-6';
    if($atts['rooms_column'] == '3items') $rooms_column  = 'col-md-4 col-lg-4';
	if($atts['rooms_column'] == '4items') $rooms_column  = 'col-md-3 col-lg-3';
    if($atts['rooms_column'] == '6items') $rooms_column  = 'col-md-2 col-lg-2';
    
	
	
	$html .= ' <div class="row">
	
	
	
		<div id="room-layout_cornubia" class="'.$atts['class'].'">';
	
		$args = array('post_type'=>'room','posts_per_page'=> '-1');
		$room = new WP_Query($args);
		if($room->have_posts()):
			while($room->have_posts()):$room->the_post();
			$thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id(), 'thumbnail');
			$size = get_post_meta( get_the_ID(), '_tc_size', true );
			$duration = get_post_meta( get_the_ID(), '_tc_duration', true );
			$escape_percentage = get_post_meta( get_the_ID(), '_tc_escape_percentage', true );
			
			
		//	$categories = get_the_category();
		//	$catname = $categories[0]->name;
			//<li><p><i class="pe pe-va pe-lg pe-7s-plugin"></i> '.$catname.'</p></li>	

            $title = get_the_title();

            if ($title != "The Great Time Escape" || $title != "Escape to Treasure Island"):
                continue;
			
			
			$html .= '<div class="item '.$rooms_column.'">
						<figure class="effect-apollo">
							<img class="img-responsive" src="'.$thumbnail_url.'" alt="">
							<figcaption>
								<p>
									<span><i class="pe pe-lg pe-7s-user"></i> '.$size.'</span>
									<span><i class="pe pe-lg pe-7s-timer"></i> '.$duration.'</span>
									<span><i class="pe pe-lg pe-7s-upload"></i> '.$escape_percentage.'</span>
								</p>
								<a href="'.get_permalink().'">'. __('BOOK NOW', 'escape'). '</a>
							</figcaption>			
						</figure>
						
						<div class="caption">
							<h3>'.get_the_title().'</h3>
							<p class="desc">'.escape_get_the_room_excerpt().'</p>
							<a class="button button-xsmall button-line-dark" href="'.get_permalink().'">'. __('BOOK NOW', 'escape'). '</a>
							
							
							
						</div>
					</div>';
			endwhile;
		endif;
    $html .= '</div></div>';
	
    
    return $html;                        
}

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("Rooms Layout Cornubia", 'escape'),
   "base" => "tc_rooms_layout_cornubia",
   "class" => "",
   "category" => __("ThemeCube Shortcodes", 'escape'),
   "icon" => get_template_directory_uri().'/img/tc_icon/tc_icon_project_layout.svg',
   "description" => __('Add rooms layout','escape'),
   "params" => array(
    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Class",'escape'),
         "param_name" => "class",
         "value" => "",
      ),
	 array(
         "type" => "dropdown",
		 "holder" => "div",
         "class" => "",
         "heading" => __("How many items in a row?",'escape'),
         "param_name" => "rooms_column",
         "value" => array(
		 			'',
                __('2 items', 'escape') => '2items',
                __('3 items', 'escape') => '3items',
                __('4 items', 'escape') => '4items',
				__('6 items', 'escape') => '6items',
                ),
		"default" => "2items",
    ),
     
   )
) );

}


// Funfacts shortcode
add_shortcode('tc_funfact', 'shortcode_tc_funfact');
function shortcode_tc_funfact($atts, $content=null){
    $atts = shortcode_atts(
        array(
        'iconfont'  		=> '',
		'icon_color'  		=> '#fdb713',
		'counter'  			=> '',
		'counter_color'		=> '#2b2e34',
		'countertitle'		=> '',
		'ct_title_color' 	=> '#999999',
		'class'				=> '',
		      
    ), $atts);
	
    $html ='';
    $html .= '<div class="funfact-item '.$atts['class'].' text-center">
				
				<div class="caption">
					<p class="nmbr" style="color:'.$atts['counter_color'].'">'.$atts['counter'].'</p>
					<p class="description" style="color:'.$atts['ct_title_color'].'">'.$atts['countertitle'].'</p>
					<i style="color: '.$atts['icon_color'].'" class="pe pe-2x '.$atts['iconfont'].'"></i>
				</div>
			  </div>';
    return $html;                        
}

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("Funfact", 'escape'),
   "base" => "tc_funfact",
   "category" => __("ThemeCube Shortcodes", 'escape'),
   "icon" => get_template_directory_uri().'/img/tc_icon/tc_icon_funfact.svg',
   "description" => __('Add funfacts','escape'),
   "params" => array(
  	array(
		'type'          => 'iconpicker',
		'class'         => '',
		'heading'       => __( 'Icon', 'escape' ),
		'param_name'    => 'iconfont',
		'settings' => array(
			'emptyIcon' => false, // default true, display an "EMPTY" icon?
			'type' => '',
			'source' => $font_icons	
		),
		'description' => __( 'Select icon from library.', '' ),                    
	),
	
	  array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Icon Color",'escape'),
         "param_name" => "icon_color",
         "value" => "#fdb713",
      ),
	  
    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Counter",'escape'),
         "param_name" => "counter",
         "value" => "",
      ),
	   array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Counter Color",'escape'),
         "param_name" => "counter_color",
         "value" => "#ffffff",
      ),
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Counter title",'escape'),
         "param_name" => "countertitle",
         "value" => "",
      ),
	  array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Counter Title Color",'escape'),
         "param_name" => "ct_title_color",
         "value" => "#ffffff",
      ), 
     
   )
) );

}





// ThemeCube Custom Tabs 
    add_action( 'vc_before_init', 'tccustomtabs' );
    function tccustomtabs() {
        global $font_icons;
        vc_map( array(
        	'name' => __( 'ThemeCube Custom Tabs', 'escape' ),
        	'base' => 'vc_tta_tabs',
			"icon" => get_template_directory_uri().'/img/tc_icon/tc_icon_tabs.svg',        	        	        	
        	'as_parent' => array(
        		'only' => 'vc_tta_section'
        	),
        	'category'    => __( 'ThemeCube Shortcodes', 'escape'),
        	'description' => __( 'Tabbed content', 'escape' ),
        	'params' => array(
        		array(
        			'type' => 'textfield',
        			'param_name' => 'title',
        			'heading' => __( 'Widget title', 'escape' ),
        			'description' => __( 'Enter text used as widget title (Note: located above content element).', 'escape' ),
        		),        		        		       		        	
        		array(
        			'type' => 'dropdown',
        			'param_name' => 'spacing',
        			'value' => array(
        				__( 'None', 'escape' ) => '',
        				'1px' => '1',
        				'2px' => '2',
        				'3px' => '3',
        				'4px' => '4',
        				'5px' => '5',
        				'10px' => '10',
        				'15px' => '15',
        				'20px' => '20',
        				'25px' => '25',
        				'30px' => '30',
        				'35px' => '35',
        			),
        			'heading' => __( 'Spacing', 'escape' ),
        			'description' => __( 'Select tabs spacing.', 'escape' ),
        			'std' => '1'
        		),
        		array(
        			'type' => 'dropdown',
        			'param_name' => 'gap',
        			'value' => array(
        				__( 'None', 'escape' ) => '',
        				'1px' => '1',
        				'2px' => '2',
        				'3px' => '3',
        				'4px' => '4',
        				'5px' => '5',
        				'10px' => '10',
        				'15px' => '15',
        				'20px' => '20',
        				'25px' => '25',
        				'30px' => '30',
        				'35px' => '35',
        			),
        			'heading' => __( 'Gap', 'escape' ),
        			'description' => __( 'Select tabs gap.', 'escape' ),
        		),
        		array(
        			'type' => 'dropdown',
        			'param_name' => 'tab_position',
        			'value' => array(
        				__( 'Top', 'escape' ) => 'top',
        				__( 'Bottom', 'escape' ) => 'bottom',
        			),
        			'heading' => __( 'Position', 'escape' ),
        			'description' => __( 'Select tabs navigation position.', 'escape' ),
        		),
        		array(
        			'type' => 'dropdown',
        			'param_name' => 'alignment',
        			'value' => array(
        				__( 'Left', 'escape' ) => 'left',
        				__( 'Right', 'escape' ) => 'right',
        				__( 'Center', 'escape' ) => 'center',
        			),
        			'heading' => __( 'Alignment', 'escape' ),
        			'description' => __( 'Select tabs section title alignment.', 'escape' ),
        		),
        		array(
        			'type' => 'dropdown',
        			'param_name' => 'autoplay',
        			'value' => array(
        				__( 'None', 'escape' ) => 'none',
        				'1' => '1',
        				'2' => '2',
        				'3' => '3',
        				'4' => '4',
        				'5' => '5',
        				'10' => '10',
        				'20' => '20',
        				'30' => '30',
        				'40' => '40',
        				'50' => '50',
        				'60' => '60',
        			),
        			'std' => 'none',
        			'heading' => __( 'Autoplay', 'escape' ),
        			'description' => __( 'Select auto rotate for tabs in seconds (Note: disabled by default).', 'escape' ),
        		),
        		array(
        			'type' => 'textfield',
        			'param_name' => 'active_section',
        			'heading' => __( 'Active section', 'escape' ),
        			'value' => 1,
        			'description' => __( 'Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'escape' ),
        		),        		
        		array(
        			'type' => 'css_editor',
        			'heading' => __( 'CSS box', 'escape' ),
        			'param_name' => 'css',
        			'group' => __( 'Design Options', 'escape' )
        		),
        	),
        	'js_view' => 'VcBackendTtaTabsView',
        	'custom_markup' => '
        <div class="vc_tta-container" data-vc-action="collapse">
        	<div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
        		<div class="vc_tta-tabs-container">'
        	                   . '<ul class="vc_tta-tabs-list">'
        	                   . '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="vc_tta_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">{{ section_title }}</span></a></li>'
        	                   . '</ul>
        		</div>
        		<div class="vc_tta-panels vc_clearfix {{container-class}}">
        		  {{ content }}
        		</div>
        	</div>
        </div>',
        	'default_content' => '
        [vc_tta_section title="' . sprintf( "%s %d", __( 'Tab', 'escape' ), 1 ) . '"][/vc_tta_section]
        [vc_tta_section title="' . sprintf( "%s %d", __( 'Tab', 'escape' ), 2 ) . '"][/vc_tta_section]
        	',
        	'admin_enqueue_js' => array(
        		vc_asset_url( 'lib/vc_tabs/vc-tabs.js' ),
        	)
        ) );
    }



// Testimonial shortcode
add_shortcode('tc_testimonial', 'shortcode_tc_testimonial');
function shortcode_tc_testimonial($atts, $content=null){
    global $escape_global_var;
	global $post;
	
	
    $atts = shortcode_atts(
        array(        
        'class'     => '',
    ), $atts);
    $html ='';
    $html .= '
	<div class="col-lg-12">
		<div class="testimonial-inner">
			<div id="testimonial-carousel" class="owl-carousel'.$atts['class'].'">';
			$args = array('post_type'=>'testimonial','posts_per_page'=> '100');
			$testimonial = new WP_Query($args);
			if($testimonial->have_posts()):
				while($testimonial->have_posts()):$testimonial->the_post();
				$thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id());
				$author_name = get_post_meta($post->ID, "_tc_author_name", true);
				
		
							$html .= '<div class="item">';
										if ($thumbnail_url) {
										$html .= '<div class="author-img">
										<img class="img-circle" src="'.$thumbnail_url.'" alt="">
									  </div>'; }
							$html .= '<h3>'.get_the_title().'</h3>
											<p class="lead">'.get_the_content().'</p>';
										if ($author_name) {
										$html .= '<span class="author-name">'.$author_name.'</span>' ;}
												
							$html .= '</div>';
				endwhile;
			endif;
    $html .= '</div></div></div>';
    
    return $html;                        
}

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("Testimonials", 'escape'),
   "base" => "tc_testimonial",
   "class" => "",
   "category" => __("ThemeCube Shortcodes", 'escape'),
   "icon" => get_template_directory_uri().'/img/tc_icon/tc_icon_testimonials.svg',
   "description" => __('Add testimonials layout','escape'),
   "params" => array(
    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Class",'escape'),
         "param_name" => "class",
         "value" => "",
      )
     
   )
) );

}


// Contact Box Shortcode
add_shortcode('tc_contact_box', 'shortcode_tc_contact_box');
function shortcode_tc_contact_box($atts, $content=null){
    $atts = shortcode_atts(
        array(
        'iconfont'  => '',
		'icon_color'=>'',
		'iconsize'=>'',
		'content' =>'',
		'content_color'=>'#999999',
		'class' => ''    
    ), $atts);
    $html ='';
	
	$iconsize = '';
    if($atts['iconsize'] == '2x') $iconsize = 'pe-2x';
    if($atts['iconsize'] == '3x') $iconsize = 'pe-3x';
    if($atts['iconsize'] == '4x') $iconsize = 'pe-4x';
	if($atts['iconsize'] == '5x') $iconsize = 'pe-5x';
	
    $html .= '<div class="contactbox '.$atts['class'].'">
				<div class="icon">
					<i style="color:'.$atts['icon_color'].';" class="'.$atts['iconfont'].' '.$iconsize.'"></i>
				</div>
				<div class="caption">
					<p class="lead" style="color:'.$atts['content_color'].';">'.do_shortcode($content).'</p>
				</div>
			  </div>';
    return $html;                        
}

if(function_exists('vc_map')){
	global $font_icons;

vc_map( array(
   "name" => __("Contact Box", 'escape'),
   "base" => "tc_contact_box",
   "category" => __("ThemeCube Shortcodes", 'escape'),
   "icon" => get_template_directory_uri().'/img/tc_icon/tc_icon_infobox.svg',
   "description" => __('Add an infobox','escape'),
   "params" => array(
   array(
		'type'          => 'iconpicker',
		'class'         => '',
		'heading'       => __( 'Icon', 'escape' ),
		'param_name'    => 'iconfont',
		'settings' => array(
			'emptyIcon' => false, // default true, display an "EMPTY" icon?
			'type' => '',
			'source' => $font_icons, 					
		),
		'description' => __( 'Select icon from library.', '' ),                    
	),
	  array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Icon Color",'escape'),
         "param_name" => "icon_color",
         "value" => "#2b2e34",
      ),
	  
	array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => __("Icon Size",'escape'),
         "param_name" => "iconsize",
         "value" => array(   
                __('2x', 'escape') => '2x',
                __('3x', 'escape') => '3x',
                __('4x', 'escape') => '4x',
				__('5x', 'escape') => '5x',
                ),
    ),
	
	     
	  array(
		 "type" => "textarea",
		 "holder" => "div",
		 "class" => "",
		 "heading" => __("Content",'escape'),
		 "param_name" => "content",
		 "value" => "",
	  ),
	   array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Content Color",'escape'),
         "param_name" => "content_color",
         "value" => "#999999",
      ),
	  
   )
) );

}

// Rooms Carousel Shortcode
add_shortcode('tc_rooms_carousel', 'shortcode_tc_rooms_carousel');
function shortcode_tc_rooms_carousel($atts, $content=null){
    global $escape_global_var;
    $atts = shortcode_atts(
        array(        
        'class'     => '',
        'slidecount'    => '3',
    ), $atts);
    $html ='';
    $html .= '
    <div class="row">
    <div class="col-lg-12">
    
        <div id="rooms-carousel" class="owl-carousel '.$atts['class'].' clearfix">';
    
        $args = array('post_type'=>'room','posts_per_page'=> '-1');
        $project = new WP_Query($args);
        if($project->have_posts()):
            while($project->have_posts()):$project->the_post();
            $thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id(), 'thumbnail');
            $size = get_post_meta( get_the_ID(), '_tc_size', true );
            $duration = get_post_meta( get_the_ID(), '_tc_duration', true );
            $escape_percentage = get_post_meta( get_the_ID(), '_tc_escape_percentage', true );
            
            
            $html .= '<div class="item">
                        <figure class="effect-apollo">
                            <img class="img-responsive" src="'.$thumbnail_url.'" alt="">
                            <figcaption>
                                <p>
                                    <span><i class="pe pe-lg pe-7s-user"></i> '.$size.'</span>
                                    <span><i class="pe pe-lg pe-7s-timer"></i> '.$duration.'</span>
                                    <span><i class="pe pe-lg pe-7s-upload"></i> '.$escape_percentage.'</span>
                                </p>
                                <a href="'.get_permalink().'">'. __('read more', 'escape'). '</a>
                            </figcaption>           
                        </figure>
                        
                        <div class="caption">
                            <h3>'.get_the_title().'</h3>
                            <p>'.escape_get_the_room_excerpt().'</p>
                            
                            <a class="button button-xsmall button-line-dark" href="'.get_permalink().'">'. __('read more', 'escape'). '</a>
                        </div>
                    </div>';
            endwhile;
        endif;
    $html .= '</div></div></div>';
    $html .='<script>
            jQuery(document).ready(function($){
                $("#rooms-carousel").owlCarousel({
                    itemsCustom : [
                        [0, 1],
                        [450, 1],
                        [600, 2],
                        [700, 3],
                        [1000, '.$atts['slidecount'].'],
                        [1200, '.$atts['slidecount'].'],
                        ],
                    autoPlay: false,                    
                    pagination: true,
                    navigation: false
                });
            });
        </script>';
    return $html;
    
    return $html;                        
}

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("Rooms Carousel", 'escape'),
   "base" => "tc_rooms_carousel",
   "class" => "",
   "category" => __("ThemeCube Shortcodes", 'escape'),
   "icon" => get_template_directory_uri().'/img/tc_icon/tc_icon_project_carousel.svg',
   "description" => __('Add rooms carousel','escape'),
   "params" => array(
    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Class",'escape'),
         "param_name" => "class",
         "value" => "",
      ),

    array(
             "type" => "textfield",
             "class" => "",
             "heading" => __("Slide Count",'escape'),
             "param_name" => "slidecount",
             "value"  => '3',
          ),

    
     
   )
) );

}



// Carousel shortcode
add_shortcode('carousel', 'shortcode_carousel');
function shortcode_carousel($atts, $content=null){

    $atts = shortcode_atts(
        array(        
        'id'    		=> '', 
        'slidecount'    => '5',
        'playdelay'     => 'false',
		'singleitem'	=> 'false',       
    ), $atts);
    $html ='';

    $html ='';
    $html .='<div id="'.$atts['id'].'-carousel">'.do_shortcode( $content ).'</div>';
    $html .='<script>
            jQuery(document).ready(function($){
                $("#'.$atts['id'].'-carousel").owlCarousel({
                    itemsCustom : [
						[0, 1],
						[450, 1],
						[600, 2],
						[700, 3],
						[1000, '.$atts['slidecount'].'],
						[1200, '.$atts['slidecount'].'],
						],
                    autoPlay: '.$atts['playdelay'].',                    
                    pagination: false
                });
            });
        </script>';
	return $html;
}

// Image item
add_shortcode('image', 'shortcode_image');
function shortcode_image($atts, $content=null){
    
    $atts = shortcode_atts(
        array(
        'img_url'   =>'',
        'href'      =>'',
        'alt'       =>'', 
        'class'     =>'',
    ), $atts);
    $html ='';

    if(wp_get_attachment_image_src($atts['img_url'], 'full')){
        $obj_thumbnail = wp_get_attachment_image_src($atts['img_url'], 'full');
        $thumbnail = $obj_thumbnail['0'];
    }else if($atts['img_url']!= ''){
        $thumbnail = $atts['img_url'];
    }

    if($atts['href'] != ''){
        $html .='<div class="image '.$atts['class'].'"><a href="'.$atts['href'].'"><img class="img-responsive" src="'.$thumbnail.'" alt="'.$atts['alt'].'"/></a></div>';

    }else{
        $html .='<div class="image '.$atts['class'].'"><img class="img-responsive" src="'.$thumbnail.'" alt=""'.$atts['alt'].'/></div>';

    }
    
    return $html;
}


if(function_exists('vc_map')){

vc_map( array(
     "name" => __("ThemeCube Carousel", 'escape'),
     "base" => "carousel",
     "as_parent" => array('only' => 'image'),
     "js_view" => 'VcColumnView',
     "content_element" => true,
     "class" => "",
     "category" => __("ThemeCube Shortcodes", 'escape'),
     "icon" => get_template_directory_uri().'/img/tc_icon/tc_icon_carousel.svg',
	 "description" => __('Add carousel','escape'),
     "params" => array(

         array(
             "type" => "textfield",
             "class" => "",
             "heading" => __("ID",'escape'),
             "param_name" => "id",
             "value"  => '',
          ),
          array(
             "type" => "textfield",
             "class" => "",
             "heading" => __("Slide Count",'escape'),
             "param_name" => "slidecount",
             "value"  => '5',
          ),
          array(
             "type" => "textfield",
             "class" => "",
             "heading" => __("Autoplay",'escape'),
             "param_name" => "playdelay",
             "value"  => '',
			 "description" => __("Autoplay: true, false or ex. 3000",'escape'),
          ),
		   array(
             "type" => "textfield",
             "class" => "",
             "heading" => __("Single Item",'escape'),
             "param_name" => "singleitem",
             "value"  => 'false',
			 "description" => __("Single item: true or false",'escape'),
          ),
      
     
)));

vc_map( array(
     "name" => __("Image", 'escape'),
     "base" => "image",
     "content_element" => true,
     "as_child" => array('only' => 'carousel'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
     "class" => "",
     "category" => __("ThemeCube Shortcodes", 'escape'),
     "icon" => get_template_directory_uri().'/img/tc_icon/tc_icon_sponsor.svg',
	 "description" => __('Add an image','escape'),
     "params" => array(
          array(
             "type" => "attach_image",
             "class" => "",
			 "holder" => "img",
             "heading" => __("Path of image",'escape'),
             "param_name" => "img_url",
             "value" => ""
          ),
          array(
               "type" => "textfield",
               "class" => "",
               "heading" => __("Link for image",'escape'),
               "param_name" => "href",
               "value" => "#"
            ),
          array(
               "type" => "textfield",
               "class" => "",
               "heading" => __("Alt",'escape'),
               "param_name" => "alt",
               "value" => "Insert alt here",
               "description" => __("alt",'escape')
         ),
          array(
               "type" => "textfield",
               "class" => "",
               "heading" => __("Class",'escape'),
               "param_name" => "class",
               "value" => ""
            ),
          

     
)));  

  
  if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
      class WPBakeryShortCode_carousel extends WPBakeryShortCodesContainer {
      }
  }
  if ( class_exists( 'WPBakeryShortCode' ) ) {
      class WPBakeryShortCode_sponsor_item extends WPBakeryShortCode {
      }
  }


}



// Social Icons shortcode
add_shortcode('tc_social', 'shortcode_tc_social');
function shortcode_tc_social($atts, $content=null){
    global $escape_global_var;
    $atts = shortcode_atts(
        array(        
        'class'     => '',
    ), $atts);
    $html ='';
    $html .= '
	<ul class="social list-unstyled list-inline">';
	
	if($escape_global_var['facebook']){
	$html .= '<li><a href='.$escape_global_var['facebook'].'><i class="pe pe-lg pe-so-facebook"></i></a></li>';}
	if($escape_global_var['twitter']){
	$html .= '<li><a href='.$escape_global_var['twitter'].'><i class="pe pe-lg pe-so-twitter"></i></a></li>';}
	if($escape_global_var['instagram']){
	$html .= '<li><a href='.$escape_global_var['instagram'].'><i class="pe pe-lg pe-so-instagram"></i></a></li>';}
	if($escape_global_var['google-plus']){
	$html .= '<li><a href='.$escape_global_var['google-plus'].'><i class="pe pe-lg pe-so-google-plus"></i></a></li>';}
	if($escape_global_var['pinterest']){
	$html .= '<li><a href='.$escape_global_var['pinterest'].'><i class="pe pe-lg pe-so-pinterest"></i></a></li>';}
	if($escape_global_var['youtube']){
	$html .= '<li><a href='.$escape_global_var['youtube'].'><i class="pe pe-lg pe-so-youtube-1"></i></a></li>';}
	if($escape_global_var['vimeo']){
	$html .= '<li><a href='.$escape_global_var['vimeo'].'><i class="pe pe-lg pe-so-vimeo"></i></a></li>';}
	if($escape_global_var['tripadvisor']){
	$html .= '<li><a href='.$escape_global_var['tripadvisor'].'><i class="pe pe-lg pe-so-tripadvisor"></i></a></li>';}
	if($escape_global_var['yelp']){
	$html .= '<li><a href='.$escape_global_var['yelp'].'><i class="pe pe-lg pe-so-yelp"></i></a></li>';}
	if($escape_global_var['flickr']){
	$html .= '<li><a href='.$escape_global_var['flickr'].'><i class="pe pe-lg pe-so-flickr"></i></a></li>';}
                            
                        
    $html .= '</ul>';
    
    return $html;                        
}



// Custom Google Map Shortcode
add_shortcode('googlemap', 'shortcode_googlemap');
function shortcode_googlemap($atts, $content=null){
	global $escape_global_var;
     $atts = shortcode_atts(
        array(
        'map_id'			=>'',
		'map_coordinate'	=>'',
		'map_height'		=>'',
		
    ), $atts);

    $html ='';
    $html .='<div id="'.$atts['map_id'].'" style="height:'.$atts['map_height'].';">';
	$html .='</div>';
	$html .='
			<script>
			function initMap() {
        var customMapType = new google.maps.StyledMapType(
            '.$escape_global_var['map_style'].'
          , {
          
        });
        var customMapTypeId = "'.$escape_global_var['map_type'].'";

        var map = new google.maps.Map(document.getElementById("'.$atts['map_id'].'"), {
          zoom: '.$escape_global_var['map_zoom'].',
          scrollwheel: '.$escape_global_var['scrollwheel'].',
          center: {lat: '.$escape_global_var['map-latitude'].', lng: '.$escape_global_var['map-longtitude'].'},  // Brooklyn.
          mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.'.$escape_global_var['map_type'].', customMapTypeId]
          }


        });

        var image = new google.maps.MarkerImage("'.$escape_global_var['marker_image']['url'].'",

                    new google.maps.Size(112, 112),

                    new google.maps.Point(0,0),

                    new google.maps.Point(18, 42)
                );
                
                // Add Marker
                var marker1 = new google.maps.Marker({
                    position: new google.maps.LatLng('.$escape_global_var['map-latitude'].','.$escape_global_var['map-longtitude'].'), 
                    map: map,       
                    icon: image // This path is the custom pin to be shown. Remove this line and the proceeding comma to use default pin
                }); 

        map.mapTypes.set(customMapTypeId, customMapType);
        map.setMapTypeId(customMapTypeId);
      }';
	$html .='</script>';
    $html .='<script src="https://maps.googleapis.com/maps/api/js?key='.$escape_global_var['map-api'].'&callback=initMap"
    async defer></script>
';
	
				
    return $html;
}


if(function_exists('vc_map')){

vc_map( array(
   "name" => __("Custom Google Map", 'escape'),
   "base" => "googlemap",
   "class" => "",
   "category" => __("ThemeCube Shortcodes", 'escape'),
   "icon" => get_template_directory_uri().'/img/tc_icon/tc_icon_gmap.svg',
   "description" => __('Add google map','escape'),
   "params" => array(
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Map ID",'escape'),
         "param_name" => "map_id",
         "value" => "",
      ),
	 
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Map Height",'escape'),
         "param_name" => "map_height",
         "value" => "",
         "description" => __("Ex. 230px",'escape'),
      ),
   )
) );

}



// Instafeed Shortcode
add_shortcode('instafeed', 'shortcode_instafeed');
function shortcode_instafeed($atts, $content=null){
    global $escape_global_var;
     $atts = shortcode_atts(
        array(
        'user_id'       =>'',
        'access_token'  => '',
        'limit'         =>'',
        'resolution'            =>'thumbnail',
        'insta_header' =>'',
        'insta_header_color' =>'#fdb713',
        'insta_content' =>'',
        'insta_content_color' =>'#ffffff',
        
        
    ), $atts);
    
    
    
    $resolution = '';
    if($atts['resolution'] == 'thumbnail') $resolution = 'thumbnail';
    if($atts['resolution'] == 'low_resolution') $resolution = 'low_resolution';
    if($atts['resolution'] == 'standart_resolution') $resolution = 'standart_resolution';

    $html ='';
    $html .='<div class="insta-wrapper">
            <div id="instafeed"></div>
            <div class="insta-overlay">';
            if($atts['insta_header']) {
  $html .='<div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 style="color:'.$atts['insta_header_color'].'">'.$atts['insta_header'].'</h1>
                            <p class="lead" style="color:'.$atts['insta_content_color'].'">'.$atts['insta_content'].'</p>
                        </div>
                    </div>
                </div>';}
                
            $html .='</div>
        </div>';
    $html .='</div>';
    $html .='
            <script>
            jQuery(document).ready(function($){
          
                var feed = new Instafeed({
                    get: "user", ';
            $html .='
                    userId: "'.$atts['user_id'].'",
                    accessToken: "'.$atts['access_token'].'",
                    limit: "'.$atts['limit'].'",
                    resolution: "'.$resolution.'",
                });
                feed.run();
    
                    
                });';
    $html .='</script>';
    
                
    return $html;
}


if(function_exists('vc_map')){

vc_map( array(
   "name" => __("Instagram Feed", 'escape'),
   "base" => "instafeed",
   "class" => "",
   "category" => __("ThemeCube Shortcodes", 'escape'),
   "icon" => get_template_directory_uri().'/img/tc_icon/tc_icon_gmap.svg',
   "description" => __('Add google map','escape'),
   "params" => array(
      
    
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("User ID",'escape'),
         "param_name" => "user_id",
         "value" => "",
         "description" => __("You can find your user Id from here <strong>http://www.otzberg.net/iguserid</strong>",'escape'),
         
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Access Token",'escape'),
         "param_name" => "access_token",
         "value" => "",
         "description" => __("You can find the steps for generate an access token from <br><strong>http://jelled.com/instagram/access-token</strong>",'escape'),
         
      ),

      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Limit",'escape'),
         "param_name" => "limit",
         "value" => "",
         "description" => __("default 60",'escape'),
      ),
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Images resolution",'escape'),
         "param_name" => "resolution",
         "value" => array(   
                __('Thumbnail', 'escape') => 'thumbnail',
                __('Low Resolution', 'escape') => 'low_resolution',
                __('Standart Resolution', 'escape') => 'standart_resolution',
                ),
    ),
     
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Header",'escape'),
         "param_name" => "insta_header",
         "value" => "",
         "description" => __("Optional",'escape'),
      ),
      
      array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Header Color",'escape'),
         "param_name" => "insta_header_color",
         "value" => "#fdb713",
      ),
      
      array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => __("Content",'escape'),
         "param_name" => "insta_content",
         "value" => "",
    ),
    array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Content Color",'escape'),
         "param_name" => "insta_content_color",
         "value" => "#ffffff",
      ),
      
   )
) );

}


