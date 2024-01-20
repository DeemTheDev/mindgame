<?php
	


	
    // Load the TGM init if it exists
    if ( file_exists( get_template_directory() . '/admin/tgm/tgm-init.php' ) ) {
        require_once get_template_directory() . '/admin/tgm/tgm-init.php';
    }

   


    //Load the theme/plugin options
    if ( file_exists( get_template_directory() . '/admin/options-init.php' ) ) {
        require_once get_template_directory() . '/admin/options-init.php';
    }

    
