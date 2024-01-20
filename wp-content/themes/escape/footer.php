<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Escape
 */

 
$escape_global_var = get_option('escape_global_var');

?>

	
    
    <footer id="site-footer">
    	<div class="container-fluid">
        	<div class="row">
            	<div class="col-lg-3 col-md-3 col-sm-3">
                    <?php if($escape_global_var['footer_logo']){
                	   echo '<img class="footer-logo" src='.$escape_global_var['footer_logo']['url'].' alt="logo"/>'; } ?>
                </div>
                
                <div class="col-lg-9 col-md-9 col-sm-9 text-right">
                	<ul class="social list-unstyled list-inline">
	
						 <?php if($escape_global_var['facebook']){
                         echo '<li><a href='.$escape_global_var['facebook'].'><i class="pe pe-2x pe-so-facebook"></i></a></li>';} ?>
                        
                        <?php 
                        if($escape_global_var['twitter']){
                        echo '<li><a href='.$escape_global_var['twitter'].'><i class="pe pe-2x pe-so-twitter"></i></a></li>';} ?>
                        
                        <?php
                        if($escape_global_var['instagram']){
                        echo '<li><a href='.$escape_global_var['instagram'].'><i class="pe pe-2x pe-so-instagram"></i></a></li>';} ?>
                        
                        <?php
                        if($escape_global_var['google-plus']){
                        echo '<li><a href='.$escape_global_var['google-plus'].'><i class="pe pe-2x pe-so-google-plus"></i></a></li>';} ?>
                        
                        <?php
                        if($escape_global_var['pinterest']){
                        echo '<li><a href='.$escape_global_var['pinterest'].'><i class="pe pe-2x pe-so-pinterest"></i></a></li>';} ?>
                        
                        <?php
                        if($escape_global_var['youtube']){
                        echo '<li><a href='.$escape_global_var['youtube'].'><i class="pe pe-2x pe-so-youtube-1"></i></a></li>';} ?>
                        
                        <?php
                        if($escape_global_var['vimeo']){
                        echo '<li><a href='.$escape_global_var['vimeo'].'><i class="pe pe-2x pe-so-vimeo"></i></a></li>';} ?>
                        
                        <?php
                        if($escape_global_var['tripadvisor']){
                        echo '<li><a href='.$escape_global_var['tripadvisor'].'><i class="pe pe-2x pe-so-tripadvisor"></i></a></li>';} ?>
                        
                        <?php
                        if($escape_global_var['yelp']){
                        echo '<li><a href='.$escape_global_var['yelp'].'><i class="pe pe-2x pe-so-yelp"></i></a></li>';} ?>
                        
                        <?php
                        if($escape_global_var['flickr']){
                        echo '<li><a href='.$escape_global_var['flickr'].'><i class="pe pe-lg pe-so-flickr"></i></a></li>';} ?>
                                         
                                        
                    </ul>
                </div>
            </div>
        </div>
    </footer><!-- #footer -->
    
  
	

<?php wp_footer(); ?>

</body>
</html>
