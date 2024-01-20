<?php
 
	$absolute_path = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
	$wp_load = $absolute_path[0] . 'wp-load.php';
	require_once($wp_load);

	header('Content-type: text/css');
  	header('Cache-control: must-revalidate');
  
  


  	if (!function_exists('escape_hex2rgb')){
	function escape_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);
			if(strlen($hex) == 3) {
			  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
			  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
			  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
			} else {
			  $r = hexdec(substr($hex,0,2));
			  $g = hexdec(substr($hex,2,2));
			  $b = hexdec(substr($hex,4,2));
			}
			$rgb = array($r, $g, $b);
			return $rgb; // returns an array with the rgb values
		}
 	}

	global $escape_global_var;

  	$primary = $escape_global_var['primary_color'];
  	$secondary = $escape_global_var['secondary_color'];
  	$header_bg = escape_hex2rgb($escape_global_var['secondary_color']);

  	
  ?> 
	


	.navbar-custom {
	background:rgba(<?php echo esc_attr($header_bg[0]); ?>,<?php echo esc_attr($header_bg[1]); ?>, <?php echo esc_attr($header_bg[2]); ?>, 0.65);
	}


	.navbar-custom .navbar-nav > li > a:hover {
		color:<?php echo esc_attr($primary); ?>;
	}
		


	.navbar-custom .icon-bar,
	.navbar-custom-blog .icon-bar {
		background:<?php echo esc_attr($primary); ?>;
	}


	.tc-page-header {
		background:<?php echo esc_attr($secondary); ?>;
	}


	.tc-blog-header {
		background-color:<?php echo esc_attr($secondary); ?>;
	}


	.navbar-custom .navbar-nav>li>.dropdown-menu {
		background:<?php echo esc_attr($primary); ?>;
	}

	.navbar-custom .dropdown-menu>.active>a,
	.navbar-custom .dropdown-menu>.active>a:hover,
	.navbar-custom .dropdown-menu>.active>a:focus {
		background-color:<?php echo esc_attr($secondary); ?>;
	}



	#rooms-carousel h3 {
		color:<?php echo esc_attr($primary); ?>;
	}


	#rooms-carousel .item i {
		color:<?php echo esc_attr($primary); ?>;
	}


	#rooms-carousel .item figure.effect-apollo {
		background: <?php echo esc_attr($secondary); ?>;
	}


	#room-layout i {
		color:<?php echo esc_attr($primary); ?>;
	}

	#room-layout .item figure.effect-apollo {
		background: <?php echo esc_attr($primary); ?>;
	}


	#room-layout .item figure.effect-apollo i{
		color:<?php echo esc_attr($secondary); ?>;
	}


	.room-img-inner .room-att i {
		color:<?php echo esc_attr($primary); ?>;
	}

	.room-info i {
		color:<?php echo esc_attr($primary); ?>;
	}


	#site-footer ul.social li a:hover,
	#site-footer ul.social li a:focus {
		color:<?php echo esc_attr($primary); ?>;
	}

	.wpcf7-submit {
	    background: <?php echo esc_attr($primary); ?>;
	    border: 1px solid <?php echo esc_attr($primary); ?>;
	}

	.site-footer .wpcf7-submit:hover {
		color:<?php echo esc_attr($primary); ?>;
	}


	.button-dark {
		background:<?php echo esc_attr($primary); ?>;
		border:1px solid <?php echo esc_attr($primary); ?>;
	}

	.button-dark:hover,
	.button-dark:active {
		background: <?php echo esc_attr($primary); ?>;
		border:1px solid <?php echo esc_attr($primary); ?>;
	}

	.button-line-dark {
		color:<?php echo esc_attr($primary); ?>;
		border:1px solid <?php echo esc_attr($primary); ?>;
	}

	.button-line-dark:hover,
	.button-line-dark:active {
		background: <?php echo esc_attr($primary); ?>;
	}


	h3.entry-title a {
		color:<?php echo esc_attr($secondary); ?>;
	}

	h3.entry-title a:hover,
	h3.entry-title a:focus {
		color:<?php echo esc_attr($primary); ?>;
	}

	.entry-meta span i,
	.entry-footer span i {
		color:<?php echo esc_attr($primary); ?>;
	}

	.entry-meta span a:hover,
	.entry-footer span a:hover,
	.entry-meta span a:focus,
	.entry-footer span a:focus {
		color:<?php echo esc_attr($primary); ?>;
	}

	.single-post-header {
		background:<?php echo esc_attr($secondary); ?>;
	}


	.nav-previous a,
	.nav-next a,
	.form-submit #submit,
	.read-more-button {
		border:1px solid <?php echo esc_attr($primary); ?>;
		background:<?php echo esc_attr($primary); ?>;
	}

	.nav-previous a:hover,
	.nav-next a:hover,
	.nav-previous a:focus,
	.nav-next a:focus,
	.read-more-button:hover,
	.read-more-button:focus {
		color:<?php echo esc_attr($primary); ?>;
		border:1px solid <?php echo esc_attr($primary); ?>;
	}

	article table a,
	article table a:hover {
		color:<?php echo esc_attr($primary); ?>;
	}


	#secondary a:hover,
	#secondary a:focus {
		color:<?php echo esc_attr($primary); ?>;
	}

	#secondary aside h3:after {
	    background-color: <?php echo esc_attr($primary); ?>;
	}

	input.search-submit {
		background:<?php echo esc_attr($primary); ?>;
		border:1px solid <?php echo esc_attr($primary); ?>;
	}

	.tagcloud a:hover,
	.tagcloud a:focus {
		background:<?php echo esc_attr($primary); ?>;
		border:1px solid <?php echo esc_attr($primary); ?>;
	}

	#wp-calendar td > a,
	#wp-calendar td > a:hover {
		background:<?php echo esc_attr($primary); ?>;
	}

	.comment-author a:hover,
	.comment-metadata a:hover {
		color:<?php echo esc_attr($primary); ?>;
	}	


