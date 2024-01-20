<?php

    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */


    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "escape_global_var";

	

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'opt_name' => $opt_name,
        'use_cdn' => TRUE,
        'display_name' => 'Escape Theme',
        'global_variable'      => '',
        'dev_mode'             => false,
        'update_notice'        => false,
        'display_version' => '1.0.0',
        'page_slug' => '_options',
        'page_title' => 'Escape Theme Options',
        'update_notice' => TRUE,
        'customizer'           => true,

        'admin_bar' => TRUE,
        'menu_type' => 'menu',
        'menu_title' => 'Escape Theme Options',
        'allow_sub_menu' => TRUE,
        'page_parent_post_type' => 'your_post_type',
        'default_mark' => '*',
        'google_api_key' => 'AIzaSyCSrkdJP31DkXBF0s_99tgXv5tZeaDhJMs',
        'hints' => array(
            'icon' => 'el el-cog',
            'icon_position' => 'right',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        //'compiler' => TRUE,
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'database'             => '',
        'system_info'          => false,
        'transient_time' => '3600',
        'network_sites' => TRUE,
        'page_priority'        => null,
    );

	

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'escape' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'escape' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'escape' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'escape' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'escape' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    //GENERAL SETTINGS
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'General Settings', 'escape' ),
        'id'    => 'basic',
        //'desc'  => esc_html__( 'Basic fields as subsections.', 'escape' ),
        'icon'  => 'el el-home',
        'fields'     => array(
			
			
			 array(
                'id'        => 'preload',
				'type'      => 'switch',
				'title'     => esc_html__('Display Preload', 'escape'),
				'subtitle'  => esc_html__('Display preload', 'escape'),
				'default'  => true,
               
            ),
			
			array(
				'id'        => 'tc_preload_color',
				'type'      => 'color',
				'transparent' => false,                  
				'title'     => esc_html__('Preload Color', 'escape'),
				'subtitle'  => esc_html__('Pick the color for the preload color', 'escape'),
				'required'      => array('preload', '!=', '0'),
				'default'   => '#fdb713',
			),
			
			array(
				'id'        => 'tc_preload_bg_color',
				'type'      => 'color',
				'transparent' => false,                  
				'title'     => esc_html__('Preload Background Color', 'escape'),
				'subtitle'  => esc_html__('Pick the color for the preload background', 'escape'),
				'required'      => array('preload', '!=', '0'),
				'default'   => '#2b2e34',
				
			),
			
			
			array(
				'id'       => 'css_editor',
				'type'     => 'ace_editor',
				'title'    => esc_html__('Custom CSS Code', 'escape'),
				'subtitle' => esc_html__('Paste your CSS code here.', 'escape'),
				'mode'     => 'css',
				'theme'    => 'monokai',
				'desc'     => 'Possible modes can be found at http://ace.c9.io',
				//'default'  => "#header{\nmargin: 0 auto;\n}"
			),
			
			array(
				'id'       => 'js_editor',
				'type'     => 'ace_editor',
				'title'    => esc_html__('Custom JS Code', 'escape'),
				'subtitle' => esc_html__('Paste your JS code here.', 'escape'),
				//'mode'     => 'javascript',
				'theme'    => 'chrome',
				'desc'     => 'Possible modes can be found at http://ace.c9.io',
			),
        )
    ) );
	
	//LOGO AND FAVICON SETTINGS
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Logo and Favicon Settings', 'escape' ),
        'id'    => 'logofavicon',
       // 'desc'  => esc_html__( 'Basic fields as subsections.', 'escape' ),
        'icon'  => 'el el-picture',
        'fields'     => array(
		
			
			array(
                'id'        => 'logo_image',
				'type'      => 'media',
				'url'       => true,
				'title'     => esc_html__('Logo Image', 'escape'),
				'subtitle'  => esc_html__('Upload a logo image. The best size is 127x52px', 'escape'),
				'default'   => array('url' => get_template_directory_uri().'/img/logo.png')
               
            ),
			
			 array(
                'id'        => 'footer_logo',
				'type'      => 'media',
				'url'       => true,
				'title'     => esc_html__('Footer Logo Image', 'escape'),
				'subtitle'  => esc_html__('Upload a logo image. The best size is 127x52px', 'escape'),
				'default'   => array('url' => get_template_directory_uri().'/img/logo.png')
               
            ),
			
			array(
                'id'        => 'favicon',
				'type'      => 'media',
				'url'       => true,
				'title'     => esc_html__('Favicon', 'escape'),
				'subtitle'  => esc_html__('Upload a favicon.', 'escape'),
				'default'   => array('url' => get_template_directory_uri().'/img/favicon.ico')
            ),
			
			array(
                'id'        => 'ipad_icon',
				'type'      => 'media',
				'url'       => true,
				'title'     => esc_html__('IPad Icon', 'escape'),
				'subtitle'  => esc_html__('Upload IPad icon. 76x76px.', 'escape'),
				'default'   => array('url' => get_template_directory_uri().'/img/ipad-icon.png')
            ),
			
			array(
                'id'        => 'iphone_retina_icon',
				'type'      => 'media',
				'url'       => true,
				'title'     => esc_html__('IPhone Retina Icon', 'escape'),
				'subtitle'  => esc_html__('Upload IPhone retina icon. 120x120px', 'escape'),
				'default'   => array('url' => get_template_directory_uri().'/img/iphone-retina-icon.png')
            ),
			
			array(
                'id'        => 'ipad_retina_icon',
				'type'      => 'media',
				'url'       => true,
				'title'     => esc_html__('IPad Retina Icon', 'escape'),
				'subtitle'  => esc_html__('Upload IPad retina icon. 152x152px', 'escape'),
				'default'   => array('url' => get_template_directory_uri().'/img/ipad-retina-icon.png')
            ),
			
			
			 
        )
    ) );
	
	
	//STYLING OPTIONS
	Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Styling and Typography Options', 'escape' ),
        'id'    => 'styling',
        'icon'  => 'el el-brush',
        'fields'     => array(
		
            array(
				'id'        => 'primary_color',
				'type'      => 'color',
				'transparent' => false,                  
				'title'     => esc_html__('Select Primary Color', 'escape'),
				'subtitle'  => esc_html__('Pick the main color for the theme', 'escape'),
				'default'   => '#fdb713',
			),
			
			array(
				'id'        => 'secondary_color',
				'type'      => 'color',
				'transparent' => false,                  
				'title'     => esc_html__('Select Secondary Color', 'escape'),
				'subtitle'  => esc_html__('Pick the secondary color for the theme', 'escape'),
				'default'   => '#2b2e34',
			),
			
			array(
				'id'          => 'typo_nav',
				'type'        => 'typography', 
				'title'       => esc_html__('Navigation font', 'escape'),
				'google'      => true, 
				'font-backup' => false,
				'color'		  => false,
				'font-size'  => true,
				'text-align'  => true,
				'font-weight'  => true,
				'font-style'  => true,
				'line-height'  => true,
				'letter-spacing' => true,
				'output'      => array('.navbar-custom, .navbar-custom-blog'),
				'units'       =>'px',
				'subtitle'    => esc_html__('Choose font for navigation.', 'escape'),
				'default'     => array(
					'font-family' => 'league_spartanregular', 
					'google'      => true,
					'font-size'	  => '14px',
				),
			),
			
			
			
			array(
				'id'          => 'typo_body',
				'type'        => 'typography', 
				'title'       => esc_html__('Body font', 'escape'),
				'google'      => true, 
				'font-backup' => true,
				'color'		  => true,
				'font-size'  => true,
				'text-align'  => false,
				'font-weight'  => true,
				'font-style'  => true,
				'line-height'  => true,
				'letter-spacing' => true,
				'all_styles'	=> true,
				'output'      => array('body'),
				'units'       =>'px',
				'subtitle'    => esc_html__('Choose font for body.', 'escape'),
				'default'     => array(
					'font-family' => 'Open Sans', 
					'google'      => true,
					'color'		=> '#666666',
				),
			),
			
			array(
				'id'          => 'typo_h1',
				'type'        => 'typography', 
				'title'       => esc_html__('Heading 1 (H1) font', 'escape'),
				'google'      => true, 
				'font-backup' => true,
				'color'		  => true,
				'font-size'  => true,
				'text-align'  => false,
				'font-weight'  => true,
				'font-style'  => true,
				'line-height'  => true,
				'letter-spacing' => true,
				'output'      => array('h1, h1 a'),
				'units'       =>'px',
				'subtitle'    => esc_html__('Choose font for Heading 1.', 'escape'),
				'default'     => array(
					'font-family' => 'league_spartanregular', 
					'google'      => true,
					'font-size' => '39px',
					
				),
			),
			
			array(
				'id'          => 'typo_h2',
				'type'        => 'typography', 
				'title'       => esc_html__('Heading 2 (H2) font', 'escape'),
				'google'      => true, 
				'font-backup' => true,
				'color'		  => true,
				'font-size'  => true,
				'text-align'  => false,
				'font-weight'  => true,
				'font-style'  => true,
				'line-height'  => true,
				'letter-spacing' => true,
				'output'      => array('h2, h2 a'),
				'units'       =>'px',
				'subtitle'    => esc_html__('Choose font for Heading 2.', 'escape'),
				'default'     => array(
					'font-family' => 'umbrageregular', 
					'google'      => true,
					'font-size' => '38px',
					
				),
			),
			
			array(
				'id'          => 'typo_h3',
				'type'        => 'typography', 
				'title'       => esc_html__('Heading 3 (H3) font', 'escape'),
				'google'      => true, 
				'font-backup' => true,
				'color'		  => true,
				'font-size'  => true,
				'text-align'  => false,
				'font-weight'  => true,
				'font-style'  => true,
				'line-height'  => true,
				'letter-spacing' => true,
				'output'      => array('h3, h3 a'),
				'units'       =>'px',
				'subtitle'    => esc_html__('Choose font for Heading 3.', 'escape'),
				'default'     => array(
					'font-family' => 'league_spartanregular', 
					'google'      => true,
					'font-weight' => '700',
					'font-size' => '22px',
					
				),
			),
			
			array(
				'id'          => 'typo_h4',
				'type'        => 'typography', 
				'title'       => esc_html__('Heading 4 (H4) font', 'escape'),
				'google'      => true, 
				'font-backup' => true,
				'color'		  => true,
				'font-size'  => true,
				'text-align'  => false,
				'font-weight'  => true,
				'font-style'  => true,
				'line-height'  => true,
				'letter-spacing' => true,
				'output'      => array('h4, h4 a'),
				'units'       =>'px',
				'subtitle'    => esc_html__('Choose font for Heading 4.', 'escape'),
				'default'     => array(
					'font-family' => 'league_spartanregular', 
					'google'      => true,
					'font-weight' => '400',
					
				),
			),
			
			array(
				'id'          => 'typo_h5',
				'type'        => 'typography', 
				'title'       => esc_html__('Heading 5 (H5) font', 'escape'),
				'google'      => true, 
				'font-backup' => true,
				'color'		  => true,
				'font-size'  => true,
				'text-align'  => false,
				'font-weight'  => true,
				'font-style'  => true,
				'line-height'  => true,
				'letter-spacing' => true,
				'output'      => array('h5, h5 a, #rooms-carousel .item figure.effect-apollo p, #room-layout .item figure.effect-apollo p'),
				'units'       =>'px',
				'subtitle'    => esc_html__('Choose font for Heading 5.', 'escape'),
				'default'     => array(
					'font-family' => 'league_spartanregular', 
					'google'      => true,
					
				),
			),
			
			array(
				'id'          => 'typo_h6',
				'type'        => 'typography', 
				'title'       => esc_html__('Heading 6 (H6) font', 'escape'),
				'google'      => true, 
				'font-backup' => true,
				'color'		  => true,
				'font-size'  => true,
				'text-align'  => false,
				'font-weight'  => true,
				'font-style'  => true,
				'line-height'  => true,
				'letter-spacing' => true,
				'output'      => array('h6, h6 a'),
				'units'       =>'px',
				'subtitle'    => esc_html__('Choose font for Heading 6.', 'escape'),
				'default'     => array(
					'font-family' => 'league_spartanregular', 
					'google'      => true,
					'color' 	  => '#2b2e34',
					
				),
			),
			
			
			
			array(
				'id'          => 'typo_button',
				'type'        => 'typography', 
				'title'       => esc_html__('Button font', 'escape'),
				'google'      => true, 
				'font-backup' => true,
				'color'		  => false,
				'font-size'  => false,
				'text-align'  => false,
				'font-weight'  => true,
				'font-style'  => true,
				'line-height'  => false,
				'letter-spacing' => false,
				'output'      => array('.button, .contact-form .wpcf7-submit, .wpcf7-submit, .read-more-button, a.button '),
				'units'       =>'px',
				'subtitle'    => esc_html__('Choose font for buttons.', 'escape'),
				'default'     => array(
					'font-family' => 'league_spartanregular', 
					'google'      => true,
				),
			),
			
	
		
        )
    ) );
	
	
	
	
	//TESTIMONIAL SETTINGS
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Testimonial Settings', 'escape' ),
        'id'    => 'tc_testimonials',
       // 'desc'  => esc_html__( 'Basic fields as subsections.', 'escape' ),
        'icon'  => 'el el-quote-alt',
        'fields'     => array(
		
			array(
				'id'          => 'typo_testimonial_header',
				'type'        => 'typography', 
				'title'       => esc_html__('Testimonial header font', 'escape'),
				'google'      => true, 
				'font-backup' => false,
				'color'		  => true,
				'font-size'  => true,
				'text-align'  => true,
				'font-weight'  => true,
				'font-style'  => true,
				'line-height'  => true,
				'letter-spacing'=>true,
				'output'      => array('#testimonial-carousel .item h3,  .author-name'),
				'units'       =>'px',
				'subtitle'    => esc_html__('Choose font for testimonial header.', 'escape'),
				'default'     => array(
					'font-family' => 'league_spartanregular',
					'google'      => true,
				),
			),	
		
			array(
				'id'          => 'typo_testimonial',
				'type'        => 'typography', 
				'title'       => esc_html__('Testimonial font', 'escape'),
				'google'      => true, 
				'font-backup' => false,
				'color'		  => true,
				'font-size'  => true,
				'text-align'  => true,
				'font-weight'  => true,
				'font-style'  => true,
				'line-height'  => true,
				'letter-spacing' => true,
				'output'      => array('#testimonial-carousel .item p, #testimonial .item .author-title'),
				'units'       =>'px',
				'subtitle'    => esc_html__('Choose font for testimonial.', 'escape'),
				'default'     => array(
					'font-family' => 'Open Sans',
					'font-weight' => '300',
					'google'      => true,
				),
			),		
			
			
        )
    ) );
	
	
	
	//BLOG SETTINGS
	Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Blog Settings', 'escape' ),
        'id'    => 'blog_settings',
        'icon'  => 'el el-th-list',
        'fields'     => array(
		                         
		
		array(
				'id'          => 'blog_metas_typo',
				'type'        => 'typography', 
				'title'       => esc_html__('Blog metas font', 'escape'),
				'google'      => true, 
				'font-backup' => true,
				'color'		  => true,
				'font-size'  => true,
				'text-align'  => false,
				'font-weight'  => true,
				'font-style'  => true,
				'line-height'  => true,
				'output'      => array('.entry-footer, .entry-footer a, .entry-meta, .entry-meta a, .posted-on, .byline, .cat-links, .tags-links'),
				'units'       =>'px',
				'subtitle'    => esc_html__('Choose font for Blog metas.', 'escape'),
				'default'     => array(
					'font-family' => 'league_spartanregular', 
					'google'      => true,
					'color'		  => '#515151',
					'font-weight' => '300'
				),
			),             
		array(
			'id' => 'tc-blog-loop-content-type',
			'type' => 'switch',
			'title' => esc_html__('Blog list loop content', 'escape'),
			'subtitle' => esc_html__('Show the blog content or the excerpt on loop', 'escape'),
			'default' => '1',
			'on' => esc_html__( 'The content', 'escape' ),
			'off' => esc_html__( 'The excerpt', 'escape' ),                        
		),                    
		array(
			'id'            => 'excerpt-max-char-length',
			'type'          => 'text',
			'title'         => esc_html__('The excerpt max chars length', 'escape'),
			'default'       => 300,
			'validate'      => 'numeric',
			'required'      => array('tc-blog-loop-content-type', '!=', '1'),
		),
		array(
			'id'            => 'blog-continue-reading',
			'type'          => 'text',
			'title'         => esc_html__('Continue reading', 'escape'),
			'subtitle'      => esc_html__('Continue reading text', 'escape'),
			'default'       => esc_html__( 'Read more', 'escape' ),
			'required'      => array('tc-blog-loop-content-type', '!=', '1'),
		),
		
	
	    )
    ) );
	
	//SOCIAL MEDIA  SETTINGS
	Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Social Accounts', 'escape' ),
        'id'    => 'tc_social_accounts',
        'icon'  => 'el el-facebook',
        'fields'     => array(
			
			array(
                'id'       => 'facebook',
                'type'     => 'text',
                'title'    => esc_html__( 'Facebook', 'escape' ),
                'subtitle' => esc_html__( 'Add facebook link', 'escape' ),
				'placeholder' => esc_html__('http://','escape'),
				'default' => '#',
               // 'validate'  => 'url',
			 
			   
            ),
            array(
                'id'       => 'twitter',
                'type'     => 'text',
                'title'    => esc_html__( 'Twitter', 'escape' ),
                'subtitle' => esc_html__( 'Add Twitter link', 'escape' ),
				'placeholder' => esc_html__('http://','escape'),
				'default' => '#',
              //  'validate'  => 'url',
            ),
			array(
                'id'       => 'instagram',
                'type'     => 'text',
                'title'    => esc_html__( 'Instagram', 'escape' ),
                'subtitle' => esc_html__( 'Add Instagram link', 'escape' ),
				'placeholder' => esc_html__('http://','escape'),
				'default' => '#',
              //  'validate'  => 'url',
            ),
			array(
                'id'       => 'google-plus',
                'type'     => 'text',
                'title'    => esc_html__( 'Google Plus', 'escape' ),
                'subtitle' => esc_html__( 'Add Google+ link', 'escape' ),
				'placeholder' => esc_html__('http://','escape'),
				'default' => '#',
              //  'validate'  => 'url',
            ),
			array(
                'id'       => 'pinterest',
                'type'     => 'text',
                'title'    => esc_html__( 'Pinterest', 'escape' ),
                'subtitle' => esc_html__( 'Add Pinterest link', 'escape' ),
				'placeholder' => esc_html__('http://','escape'),
				'default' => '#',
               // 'validate'  => 'url',
            ),
			array(
                'id'       => 'youtube',
                'type'     => 'text',
                'title'    => esc_html__( 'Youtube', 'escape' ),
                'subtitle' => esc_html__( 'Add Youtube link', 'escape' ),
				'placeholder' => esc_html__('http://','escape'),
				'default' => '#',
               // 'validate'  => 'url',
            ),
			array(
                'id'       => 'vimeo',
                'type'     => 'text',
                'title'    => esc_html__( 'Vimeo', 'escape' ),
                'subtitle' => esc_html__( 'Add Vimeo link', 'escape' ),
				'placeholder' => esc_html__('http://','escape'),
				'default' => '#',
              //  'validate'  => 'url',
			  
            ),
			array(
                'id'       => 'tripadvisor',
                'type'     => 'text',
                'title'    => esc_html__( 'Tripadvisor', 'escape' ),
                'subtitle' => esc_html__( 'Add Tripadvisor link', 'escape' ),
				'placeholder' => esc_html__('http://','escape'),
				'default' => '#',
              //  'validate'  => 'url',
            ),
			array(
                'id'       => 'yelp',
                'type'     => 'text',
                'title'    => esc_html__( 'Yelp', 'escape' ),
                'subtitle' => esc_html__( 'Add Yelp link', 'escape' ),
				'placeholder' => esc_html__('http://','escape'),
				'default' => '#',
              //  'validate'  => 'url',
            ),
			array(
                'id'       => 'flickr',
                'type'     => 'text',
                'title'    => esc_html__( 'Flickr', 'escape' ),
                'subtitle' => esc_html__( 'Add Flickr link', 'escape' ),
				'placeholder' => esc_html__('http://','escape'),
				'default' => '#',
               // 'validate'  => 'url',
            ),
						
			
        )
    ) );
	
	
	//GOOGLE MAP SETTINGS
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Map Settings', 'escape' ),
        'id'    => 'map',
        'icon'  => 'el el-map-marker',
        'fields'     => array(
			 
			 array(
                'id'       => 'map-latitude',
                'type'     => 'text',
                'title'    => esc_html__( 'Map Latitude', 'escape' ),
                'desc'     => esc_html__( 'Find your coordinates at <strong>mapcoordinates.net/en</strong>', 'escape' ),
                'default'  => '40.801485408197856',
            ),
			
			array(
                'id'       => 'map-longtitude',
                'type'     => 'text',
                'title'    => esc_html__( 'Map Longtitude', 'escape' ),
                'desc'     => esc_html__( 'Find your coordinates at <strong>mapcoordinates.net/en</strong>', 'escape' ),
                'default'  => '-73.96745953467104',
            ),
			
			 array(
				'id'        => 'map_zoom',
				'type'     => 'spinner', 
				'title'    => esc_html__('Zoom Level', 'escape'),
				'subtitle' => esc_html__('Map zoom level','escape'),
				'desc'     => esc_html__('Min:0, max: 40', 'escape'),
				'default'  => '14',
				'min'      => '0',
				'step'     => '1',
				'max'      => '40',
			 ),
		
			 array(
                'id'       => 'scrollwheel',
				'type'     => 'radio',
				'title'    => esc_html__('Scroll-whell', 'escape'), 
				//Must provide key => value pairs for radio options
				'options'  => array(
					'true' => 'On', 
					'false' => 'Off', 
				),
				'default' => 'false'
            ),
		
            array(
                'id'       => 'map_style',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Map Style', 'escape' ),
                'subtitle' => esc_html__( 'Please visit <strong>snazzymaps.com</strong> for more styles', 'escape' ),
				'default' => '[{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]',
            ),
			
			array(
				'id'       => 'map_type',
				'type'     => 'select',
				'title'    => esc_html__('Select Map Type', 'escape'), 
				// Must provide key => value pairs for select options
				'options'  => array(
					'ROADMAP' => 'Roadmap',
					'HYBRID' => 'Hybrid',
					'SATELLITE' => 'Satellite',
					'TERRAIN' => 'Terrain'
				),
				'default'  => 'ROADMAP',
			),

			array(
                'id'       => 'map-api',
                'type'     => 'text',
                'title'    => __( 'Map API', 'TEXT_DOMAIN' ),
                'desc'     => __( 'Get an API Key from Google  <strong>https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key</strong>', 'TEXT_DOMAIN' ),
                'default'  => '',
            ),
			
			 array(
                'id'        => 'marker_image',
				'type'      => 'media',
				'url'       => true,
				'title'     => esc_html__('Marker Image', 'escape'),
				'subtitle'  => esc_html__('Upload a marker image. The best size is 112x112px', 'escape'),
				'default'   => array('url' => get_template_directory_uri().'/img/map-logo.png')
               
            ),
			
			
        )
    ) );

 	

    /*
     * <--- END SECTIONS
     */


    /*
     * <--- END SECTIONS
     */
