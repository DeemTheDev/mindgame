<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Escape
 */


?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php $escape_global_var = get_option('escape_global_var');	?>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">


<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
    <link rel="shortcut icon" href="<?php if(isset($escape_global_var['favicon']['url'])){ echo esc_url($escape_global_var['favicon']['url']);}else{} ?>" type="image/x-icon"/>
<?php } ?>

<link rel="apple-touch-icon" sizes="76x76" href="<?php if(isset($escape_global_var['ipad_icon']['url'])){ echo esc_url($escape_global_var['ipad_icon']['url']);}else{} ?>">
<link rel="apple-touch-icon" sizes="120x120" href="<?php if(isset($escape_global_var['iphone_retina_icon']['url'])){ echo esc_url($escape_global_var['iphone_retina_icon']['url']);}else{} ?>">
<link rel="apple-touch-icon" sizes="152x152" href="<?php if(isset($escape_global_var['ipad_retina_icon']['url'])){ echo esc_url($escape_global_var['ipad_retina_icon']['url']);}else{} ?>">
    
    
<?php escape_custom_css(); ?>

<?php escape_custom_js(); ?>



<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<?php if (true == $escape_global_var['preload']): ?>
        <!-- PRELOADING --> 
        <div id="preload" style="background: <?php echo esc_attr($escape_global_var['tc_preload_bg_color']); ?>">
            <div class="preload">
                <span class="cssload-loader" style="border: 4px solid <?php echo esc_attr($escape_global_var['tc_preload_color']); ?>;">
                	<span class="cssload-loader-inner" style="background-color: <?php echo esc_attr($escape_global_var['tc_preload_color']); ?>;"></span>
                </span>
            </div>
        </div>
    <?php endif; ?>
	
    <!-- NAVIGATION -->
    <nav id="nav-primary" class="navbar navbar-custom default">
        <div class="container-fluid">
            <div class="row">
            
                <div class="col-lg-3">
                
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>" class="scroll-to">
                        <?php if($escape_global_var['logo_image']['url']){ ?>
                        <img src="<?php echo esc_url($escape_global_var['logo_image']['url']); ?>" alt="<?php echo bloginfo('name'); ?>"/>
                        <?php } else { ?>	
                        <h3><?php bloginfo('name'); ?></h3>
                        <?php } ?>
                        </a>
                    </div>
                
                </div>
            
                <div class="col-lg-9">
                    <div class="tc-menu">
                        <?php
                            wp_nav_menu( array(
                            'menu'				=> '',
                            'theme_location'    => 'primary',
                            'depth'             => 3,
                            'container'         => 'div',
                            'container_class'   => 'collapse navbar-collapse',
                            'container_id'      => 'nav',
                            'menu_class'        => 'nav navbar-nav navbar-right',
                            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                            'walker'            => new wp_bootstrap_navwalker())
                            );
                        ?>
                    
                    </div>
                </div>
                
            </div>
        </div>
    </nav>