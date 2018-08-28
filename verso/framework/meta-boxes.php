<?php 

/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */
 
add_filter( 'rwmb_meta_boxes', 'santos_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
 
function santos_register_meta_boxes( $meta_boxes )
{
	

	$prefix = 'santos_';
	$santos_options = get_option('santos_options');
	

	
	$meta_boxes[] = array(
		
		'id' => 'santos_page_layout_meta_box',		
		'title' => esc_html__( 'Page Setting', 'santos' ),		
		'pages' => array( 'page' ),		
		'context' => 'normal',		
		'priority' => 'high',		
		'autosave' => true,	
		'fields' => array(
			
			array(
				'name' => esc_html__('Page Content Layout', 'santos'),
				'id'   => "{$prefix}page_layout",
				'class'   => "{$prefix}page_layout",
				'type' => 'image_select',
				'options' => array(
					''		=> get_template_directory_uri() . '/framework/assets/img/default-layout.png',	
					'fullwidth'  => get_template_directory_uri() . '/framework/assets/img/1c.png',
                    'left'		=> get_template_directory_uri() . '/framework/assets/img/2cr.png',
				),
                'std' => '',
			),
		
			array(
				'name' => esc_html__('Page container', 'santos'),
				'id'   => "{$prefix}page_container",
				'class'   => "{$prefix}page_container",
				'type' => 'select',
				'options' => array(
					''		=> '',
					'container'		=> esc_html__('Containre', 'santos'),
					'no-container'		=> esc_html__('Full Width', 'santos'),
				),
				'multiple' => false,
				'std'  => '',
				'desc' => esc_html__('Choose Page Content Container Type. Leave Blank for Theme Options Default', 'santos'),
			),
			
			array(
				'name'      => esc_html__('Sticky Page Content', 'santos' ),
				'id'        => "{$prefix}disable_page_padding",
				'class'    => "{$prefix}disable_page_padding",
				'desc'  => esc_html__( 'Using this option will remove padding after header and before footer.', 'santos' ),
				'type'      => 'santos_toggle',
			),
			
			array(
				'name' => esc_html__('Page Background Color', 'santos'),
				'id'        => "{$prefix}wrap_bg_color",
				'class'        => "{$prefix}wrap_bg_color",
				'clone' => false,
				'type'  => 'color',
				'std' => '',
			),
	
		
		),
	);
	
	
		
	$meta_boxes[] = array(
	
		'id' => 'santos_post_layout_meta_box',		
		'title' => esc_html__( 'Post Setting', 'santos' ),	
		'pages' => array( 'post' ),		
		'context' => 'normal',	
		'priority' => 'high',	
		'autosave' => true,
		'fields' => array(
		

			
			
			
			
			array(
				'name'      => esc_html__('Disable Single Feature Media Area', 'santos' ),
				'id'        => "{$prefix}post_disable_feature",
				'class'    => "{$prefix}post_disable_feature",
				'desc'  => esc_html__( 'Using this option will disable Feature Media Image at your Single Post Page.', 'santos' ),
				'type' => 'santos_toggle',
			),
			
		
			
			array(
				'name' => esc_html__('Post Quote', 'santos'),
				'id'        => "{$prefix}post_quote",
				'class'        => "{$prefix}post_quote",
				'desc' => esc_html__("Quote , will be Shown on the posts archive Page .", 'santos'),
				'clone' => false,
				'type'  => 'textarea',
				'std' => '',

			),
			
			array(
				'name' => esc_html__('Video embed code', 'santos'),
				'id'        => "{$prefix}post_video",
				'class'        => "{$prefix}post_video",
				'desc' => esc_html__("Enter Vimeo or Youtube Iframe code.", 'santos'),
				'clone' => false,
				'type'  => 'textarea',
				'std' => '',

			),
			
			array(
				'name' => esc_html__('Audio embed code', 'santos'),
				'id'        => "{$prefix}post_audio",
				'class'        => "{$prefix}post_audio",
				'desc' => esc_html__("Enter A Soundcloud Iframe code.", 'santos'),
				'clone' => false,
				'type'  => 'textarea',
				'std' => '',

			),
			
						
								
				
		),
	);
	
	
	
	
	$meta_boxes[] = array(
	
		'id' => 'santos_portfolio_info_meta_box',
		'title' => esc_html__( 'Portfolio Setting', 'santos' ),
		'pages' => array( 'santos-portfolio' ),
		'context' => 'normal',	
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
		
			array(
				'name' => esc_html__('Client Name', 'santos'),
				'id'        => "{$prefix}project_client",
				'class'        => "{$prefix}project_client",
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),
			
			
			array(
				'name' => esc_html__('Project Date', 'santos'),
				'id'        => "{$prefix}project_date",
				'class'        => "{$prefix}project_date",
				'clone' => false,
				'type'  => 'date',
				'std' => '',
			),
			
			
			array(
				'name' => esc_html__('Project URL', 'santos'),
				'id'        => "{$prefix}project_url",
				'class'        => "{$prefix}project_url",
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),
			
			array(
				'name' => esc_html__('Intro ', 'santos'),
				'id'        => "{$prefix}project_intro",
				'class'        => "{$prefix}project_intro ",
				'clone' => false,
				'type'  => 'textarea',
				'std' => '',
			),
			
			array(
				'name' => esc_html__('Description ', 'santos'),
				'id'        => "{$prefix}project_description",
				'class'        => "{$prefix}project_description ",
				'clone' => false,
				'type'  => 'textarea',
				'std' => '',
			),
			
	
			array(
				'name' => esc_html__('Display Project Information', 'santos'),
				'id'   => "{$prefix}project_info_position",
				'class'   => "{$prefix}project_info_position",
				'type' => 'select',
				'options' => array(
					'above'		=> esc_html__('Above Page Content', 'santos'),
					'below'		=> esc_html__('Below Page Content', 'santos'),
					'disable'		=> esc_html__('Disable Project Information', 'santos'),
				),
				'multiple' => false,
				'std'  => 'above',
			),
			
			
			
			array(
				'name'      => esc_html__('Disable Single Feature Media Area', 'santos' ),
				'id'        => "{$prefix}project_disable_feature",
				'class'    => "{$prefix}project_disable_feature",
				'desc'  => esc_html__( 'Using this option will disable Feature Media (Image / Gallery / Video) at your Single Post Page.', 'santos' ),
				'type' => 'santos_toggle',
			),
			
			array(
				'name' => esc_html__('Feature Area Media Type', 'santos'),
				'id'   => "{$prefix}project_feature_type",
				'class'   => "{$prefix}project_feature_type",
				'type' => 'select',
				'options' => array(
					'image'		=> esc_html__('Feature Image', 'santos'),
					'gallery'		=> esc_html__('Gallery', 'santos'),
					'video'		=> esc_html__('Video', 'santos'),
				),
				'multiple' => false,
				'std'  => 'image',
				'desc' => esc_html__('Choose the Media type to display in the portfolio.', 'santos'),
			),
			
			
			array(
				'name'      => esc_html__('Gallery Images Upload', 'santos' ),
				'id'        => "{$prefix}project_gallery",
				'class'    => "{$prefix}project_gallery",
				'type'             => 'image_advanced',
				'max_file_uploads' => 8,

			),
			
			
			array(
				'name' => esc_html__('Video Type', 'santos'),
				'id'   => "{$prefix}project_video_type",
				'class'   => "{$prefix}project_video_type",
				'type' => 'select',
				'options' => array(
					'youtube'		=> esc_html__('Youtube', 'santos'),
					'vimeo'		=> esc_html__('Vimeo', 'santos'),
				),
				'multiple' => false,
				'std'  => 'youtube',
				'desc' => esc_html__('Choose video type.', 'santos'),
			),
						
			
			array(
				'name' => esc_html__('Video ID', 'santos'),
				'id'        => "{$prefix}project_video_id",
				'class'        => "{$prefix}project_video_id",
				'desc' => esc_html__("Enter your Video ID .", 'santos'),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),
			
			array(
				'name' => esc_html__('Masonry Image size', 'santos'),
				'id'   => "{$prefix}project_masonry_image_size",
				'class'   => "{$prefix}project_masonry_image_size",
				'type' => 'select',
				'options' => array(
					'default'		=> esc_html__('Default', 'santos'),
					'large_width'		=> esc_html__('Large Width', 'santos'),
				),
				'multiple' => false,
				'std'  => '',
				'desc' => esc_html__('This will be used in Masonry Style only.', 'santos'),
			),
			
			

			
			

			
		
		
		),
	);
	
	
	
	
	$meta_boxes[] = array(
		
		'id' => 'santos_page_header_meta_box',		
		'title' => esc_html__( 'Header Setting', 'santos' ),		
		'pages' => array( 'page','post','santos-portfolio','product' ),	
		'description' => __('Here you can configure how your page header will appear. <br/> Override your theme option setting or Leave Blank for Default Theme Options values.', 'santos'),				
		'context' => 'normal',		
		'priority' => 'high',		
		'autosave' => true,	
		'fields' => array(
			array(
				'name' => esc_html__('Choose Header Layout', 'santos'),
				'id'   => "{$prefix}header_layout",
				'class'   => "{$prefix}header_layout",
				'type' => 'select',
				'options' => array(
					''		=> '',
					'header-1'		=> esc_html__('Header 1', 'santos'),
					'header-2'		=> esc_html__('Header 2', 'santos'),
					'header-3'		=> esc_html__('Header 3', 'santos'),
				),
				'multiple' => false,
				'std'  => '',

			),	
			array(
				'name' => esc_html__('Choose Header Color Style', 'santos'),
				'id'   => "{$prefix}header_scheme",
				'class'   => "{$prefix}header_scheme",
				'type' => 'select',
				'options' => array(
					''		=> '',
					'dark'		=> esc_html__('Dark', 'santos'),
					'light'		=> esc_html__('Light', 'santos'),
				),
				'multiple' => false,
				'std'  => '',
				'desc' => esc_html__('Choose color style for Menu Links and logo.', 'santos'),
			),	
			
			array(
				'name' => esc_html__('Header Background Style', 'santos'),
				'id'   => "{$prefix}header_bg_scheme",
				'class'   => "{$prefix}header_bg_scheme",
				'type' => 'select',
				'options' => array(
					''		=> '',
					'bg-color'		=> esc_html__('Background Color', 'santos'),
					'no-background'		=> esc_html__('No Background', 'santos'),
					'navbar-transparent'		=> esc_html__('Transparent', 'santos'),
				),
				'multiple' => false,
				'std'  => '',
				'desc' => esc_html__('Choose the Header Background Style.', 'santos'),
			),	
			
			array(
				'name' => esc_html__('Custom Header Background Color', 'santos'),
				'id'        => "{$prefix}header_bg_color",
				'class'        => "{$prefix}header_bg_color",
				'clone' => false,
				'type'  => 'color',
				'desc' => esc_html__('This will be used when Header BG style is Background Color.', 'santos'),
				'std' => '',
			),
			
			array(
				'name' => esc_html__('Menu Align', 'santos'),
				'id'   => "{$prefix}menu_align",
				'class'   => "{$prefix}menu_align",
				'type' => 'select',
				'options' => array(
					''		=> '',
					'left'		=> esc_html__('Left', 'santos'),
					'right'		=> esc_html__('Right', 'santos'),
					'center'		=> esc_html__('Center', 'santos'),
				),
				'multiple' => false,
				'std'  => '',
				'desc' => esc_html__('Choose the Header Menu Align.', 'santos'),
			),	
			
			
			array(
				'name' => esc_html__('Main Navigation Location', 'santos'),
				'id'   => "{$prefix}page_menu_location",
				'class'   => "{$prefix}page_menu_location",
				'type' => 'select',
				'options' => array(
				  "primary_menu" => esc_html__('Primary Navigation', 'santos') ,
                  "second_menu" => esc_html__('Second Navigation', 'santos') ,
                  "third_menu" => esc_html__('Third Navigation', 'santos') ,
				),
				'multiple' => false,
				'std'  => 'primary_menu',
			),
			
			
			array(
				'name' => esc_html__('Dropdown Menu Color Scheme', 'santos'),
				'id'   => "{$prefix}menu_dropdown_scheme",
				'class'   => "{$prefix}menu_dropdown_scheme",
				'type' => 'select',
				'options' => array(
					''		=> '',
					'darckBg'		=> esc_html__('Dark', 'santos'),
					'lightBg'		=> esc_html__('Light', 'santos'),
					'custom'		=> esc_html__('Custom', 'santos'),
				),
				'multiple' => false,
				'desc' => esc_html__('Choose the Header Dropdown Menu colors.', 'santos'),
				'std'  => '',
			),	
			
					
			array(
				'name'      => esc_html__('Custom Logo Image', 'santos' ),
				'id'        => "{$prefix}logo_custom_image",
				'class'    => "{$prefix}logo_custom_image",
				'type'             => 'image_advanced',
				'desc' => esc_html__('Override yout default Theme Options Logo.', 'santos'),
				'max_file_uploads' => 1,
			),
			
			
			array(
				'name' => esc_html__('Display Header Icons', 'santos'),
				'id'        => "{$prefix}enable_head_icons",
				'class'        => "{$prefix}enable_head_icons",
				'type' => 'select',
				'options' => array(
                   ''				=> '',
					'true'		=> esc_html__('Enable', 'santos'),
					'false'		=> esc_html__('Disable', 'santos'),
				),
				'multiple' => false,
				'desc' => esc_html__('Display or Remove Header search and shopping icons.', 'santos'),
				'std'  => '',
			),	
			
			
			
		
		),
	);
	
	
	
	
		$meta_boxes[] = array(
		'id' => 'santos_page_titlebar_meta_box',		
		'title' => esc_html__( 'Title Area Setting', 'santos' ),		
		'pages' => array( 'page','post','santos-portfolio','product' ),
		'description' => __('Here you can configure how your page Title Area will appear. <br/> Override your theme option setting or Leave Blank for Default Theme Options values.', 'santos'),				
		'context' => 'normal',		
		'priority' => 'high',		
		'autosave' => true,	
		'fields' => array(
		           
            array(
				'name' => esc_html__('Show Title Area', 'santos'),
				'id'        => "{$prefix}enable_titlebar",
				'class'        => "{$prefix}enable_titlebar",
				'desc' => esc_html__("Enable/Disable Page Titlebar Area .", 'santos'),
				'type' => 'select',
				'options' => array(
                    ''	=> '',
					'true'		=> esc_html__('Enable', 'santos'),
					'false'		=> esc_html__('Disable', 'santos'),
				),
				'desc' => esc_html__('By Default Title Area is Enabled for Pages.', 'santos'),
				'multiple' => false,
				'std'  => '',
			),		
		array(
				'name' => esc_html__('Title Area Style', 'santos'),
				'id'   => "{$prefix}titlebar_style",
				'class'   => "{$prefix}titlebar_style",
				'type' => 'select',
				'options' => array(
					 ''	=> '',
					'minimal'		=> esc_html__('Minimal', 'santos'),
					'feature_image'		=> esc_html__('Feature Image', 'santos'),
					'custom_img'		=> esc_html__('Custom Titlebar Image', 'santos'),
					'color'		=> esc_html__('Background Color', 'santos'),
				),
				'multiple' => false,
				'std'  => '',
				'desc' => esc_html__('Choose From different Title Area Styles.', 'santos'),
			),
			
		
			array(
				'name'      => esc_html__('Custom Titlebar Image', 'santos' ),
				'id'        => "{$prefix}titlebar_custom_image",
				'class'    => "{$prefix}titlebar_custom_image",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),
			
			array(
				'name' => esc_html__('Custom Titlebar Background Color', 'santos'),
				'id'        => "{$prefix}titlebar_bg_color",
				'class'        => "{$prefix}titlebar_bg_color",
				'clone' => false,
				'type'  => 'color',
				'std' => '',
			),
			
			array(
				'name' => esc_html__('Titlebar Padding', 'santos'),
				'id'        => "{$prefix}titlebar_extend_padding",
				'class'        => "{$prefix}titlebar_extend_padding",
				'desc' => esc_html__("This will effect titlebar with Background image or color (ex:200).", 'santos'),
				'clone' => false,
				'type'  => 'number',
				'std' => '',
			),
			
		
		),
	);
	
	


	
	
	
	
		$meta_boxes[] = array(
		
		'id' => 'santos_onepage_navigator_meta_box',		
		'title' => esc_html__( 'One Page Navigator', 'santos' ),		
		'pages' => array( 'page' ),		
		'context' => 'normal',		
		'priority' => 'high',		
		'autosave' => true,	
		'fields' => array(
			
					
			array(
				'name'      => esc_html__('Activate OnePage Rows Navigation', 'santos' ),
				'id'        => "{$prefix}enable_onepage_navigator",
				'class'    => "{$prefix}enable_onepage_navigator",
				'desc'  => esc_html__( 'This will activate dots navigator to Visual Composer Rows.', 'santos' ),
				'type'      => 'santos_toggle',
			),
			
			array(
				'name' => esc_html__('Active Dot Color', 'santos'),
				'id'        => "{$prefix}onepage_active_dot_color",
				'class'        => "{$prefix}onepage_active_dot_color",
				'desc'  => esc_html__( 'By Default it will use Default Theme Color.', 'santos' ),
				'clone' => false,
				'type'  => 'color',
				'std' => '',
			),
	
		
		),
	);
	
	
	
	
	
		$meta_boxes[] = array(
		'id' => 'santos_page_footer_meta_box',		
		'title' => esc_html__( 'Footer Setting', 'santos' ),		
		'pages' => array( 'page','post','santos-portfolio','product' ),	
		'description' => __('Here you can configure how your page footer will appear. <br/> Override your theme option setting or Leave Blank for Default Theme Options values.', 'santos'),		
		'context' => 'normal',		
		'priority' => 'low',		
		'autosave' => true,	
		'fields' => array(
		
				array(
				'name' => esc_html__('Show Footer', 'santos'),
				'id'        => "{$prefix}enable_footer",
				'class'        => "{$prefix}enable_footer",
				'desc' => esc_html__("Enable/Disable Page Footer Area.", 'santos'),
				'type' => 'select',
				'options' => array(
                    ''	=> '',
					'true'		=> esc_html__('Enable', 'santos'),
					'false'		=> esc_html__('Disable', 'santos'),
				),
				'multiple' => false,
				'std'  => '',
				),	
		           
				array(
				'name' => esc_html__('Footer Layout', 'santos'),
				'id'   => "{$prefix}footer_layout",
				'class'   => "{$prefix}footer_layout",
				'type' => 'select',
				'options' => array(
					''		=> '',
					'footer-1'		=> esc_html__('Footer 1', 'santos'),
					'footer-2'		=> esc_html__('Footer 2', 'santos'),
					'footer-3'		=> esc_html__('Footer 3', 'santos'),
				),
				'multiple' => false,
				'std'  => '',
				'desc' => esc_html__('Choose Footer Layout.', 'santos'),
			),
			
			
		array(
				'name' => esc_html__('Footer Color Scheme', 'santos'),
				'id'   => "{$prefix}footer_color_scheme",
				'class'   => "{$prefix}footer_color_scheme",
				'type' => 'select',
				'options' => array(
					''		=> '',
					'darckBg'		=> esc_html__('Dark', 'santos'),
					'lightBg'		=> esc_html__('Light', 'santos'),
					'custom'		=> esc_html__('Custom', 'santos'),
				),
				'multiple' => false,
				'std'  => '',
				'desc' => esc_html__('Choose Footer Color and Background scheme.', 'santos'),
			),
			
			array(
				'name' => esc_html__('Show Sub Footer', 'santos'),
				'id'        => "{$prefix}enable_subfooter",
				'class'        => "{$prefix}enable_subfooter",
				'desc' => esc_html__("Enable/Disable Page Sub Footer Area.", 'santos'),
				'type' => 'select',
				'options' => array(
                    ''	=> '',
					'true'		=> esc_html__('Enable', 'santos'),
					'false'		=> esc_html__('Disable', 'santos'),
				),
				'multiple' => false,
				'std'  => '',
			),	
		
		
		),
	);
	
	
	
	
		$meta_boxes[] = array(
		'id' => 'santos_slider_meta_box',
		'title' => esc_html__( 'Slide', 'santos' ),
		'pages' => array( 'santos-slider' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
		    

			array(
				'name'       => esc_html__( 'Slide Image', 'santos' ),
				'id'        => "{$prefix}slide_image",
				'class'    => "{$prefix}slide_image",
				'desc'  => esc_html__( 'For Best Resolution Images should be 1200 width X 800 Height', 'santos' ),
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),
			
			array(
				'name' => esc_html__('Image Position', 'santos'),
				'id'   => "{$prefix}slide_image_position",
				'class'   => "{$prefix}slide_image_position",
				'type' => 'select',
				'options' => array(
					'right'		=> esc_html__('Right Section', 'santos'),
					'left'		=> esc_html__('Left Section', 'santos'),
				),
				'multiple' => false,
				'std'  => '',
				'desc' => esc_html__('This will be used in Multiscroll slider.', 'santos'),
			),	
			
			
			array(
				'name' => esc_html__('Title Align', 'santos'),
				'id'   => "{$prefix}slide_title_align",
				'class'   => "{$prefix}slide_title_align",
				'type' => 'select',
				'options' => array(
					''		=> '',
					'left'		=> esc_html__('Left', 'santos'),
					'center'		=> esc_html__('Center', 'santos'),
					'right'		=> esc_html__('Right', 'santos'),
				),
				'multiple' => false,
				'std'  => '',
				'desc' => esc_html__('Choose the Title Align.', 'santos'),
			),	
			
			
			array(
				'name' => esc_html__('Title Color', 'santos'),
				'id'        => "{$prefix}slide_title_color",
				'class'        => "{$prefix}slide_title_color",
				'desc' => esc_html__("Select Slide Title Color .", 'santos'),
				'clone' => false,
				'type'  => 'color',
				'std' => '#333',
			),
			
			array(
				'name' => esc_html__('Subtitle', 'santos'),
				'id'        => "{$prefix}slide_subtitle",
				'class'        => "{$prefix}slide_subtitle",
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),
			
			
			array(
				'name' => esc_html__('Subtitle Color', 'santos'),
				'id'        => "{$prefix}slide_subtitle_color",
				'class'        => "{$prefix}slide_subtitle_color",
				'clone' => false,
				'type'  => 'color',
				'std' => '#999',
			),
			

			
		
			
			
			array(
				'name' => esc_html__('Slide Background Color', 'santos'),
				'id'        => "{$prefix}slide_bg_color",
				'class'        => "{$prefix}slide_bg_color",
				'clone' => false,
				'type'  => 'color',
				'std' => '#fff',
			),
			
						
     
			
		),
	);
	
	
	
	return $meta_boxes;
}