<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('Redux_Framework_sample_config')) {

    class Redux_Framework_sample_config {
		
		
		

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }
			
			
			

		


	
	
	

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
           
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            
            $sections[] = array(
                'title' => esc_html__('Section via hook', 'santos'),
                'desc' => esc_html__('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'santos'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            
            return $args;
        }
		
		

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'santos'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview','santos'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview','santos'); ?>" />
                <?php endif; ?>

				<h4><?php echo esc_attr($this->theme->display('Name')); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'santos'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'santos'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . esc_html__('Tags', 'santos') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
					 <p class="theme-description"><?php echo esc_attr($this->theme->display('Description')); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . esc_html__('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'santos') . '</p>', esc_html__('http://codex.wordpress.org/Child_Themes', 'santos'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(get_template_directory() . '/framework/options/info-html.html')) {
                Redux_Functions::initWpFilesystem();
                
                global $wp_filesystem;

                $sampleHTML = $wp_filesystem->get_contents( get_template_directory() . '/framework/options/info-html.html');
            }

			// ACTUAL DECLARATION OF SECTIONS
				$this->sections[] = array(
				'icon' => 'el-icon-cogs',
				'title' => esc_html__('General Settings', 'santos'),
				'desc' => '<h4 class="description">'.esc_html__('Welcome to the santos options panel, Please use the left-hand tabs to switch between option.', 'santos').'</h4>',
				'fields' => array(
					array(
						'id'=>'theme_color',
						'type' => 'color',
						'title' => esc_html__('Theme Color', 'santos'), 
						'subtitle' => esc_html__('Pick a Default color for the theme (default: #425bb5).', 'santos'),
						'default' => '#425bb5',
						'validate' => 'color',
						'transparent' => false,
						),
					array(
						'id'=>'wrap_bg_color',
						'type' => 'color',
						'title' => esc_html__('Body Background Color', 'santos'), 
						'subtitle' => esc_html__('Default Page Background (#FFFFFF).', 'santos'),
						'default' => '#ffffff',
						'validate' => 'color',
						'transparent' => false,
						),
						
					array(
						'id'=>'favicon',
						'type' => 'media',
						'compiler'=>true,
						'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
						'title' => esc_html__('Favicon Upload', 'santos'), 
						'subtitle' => esc_html__('Favicon for your website (16px x 16px) .png or .gif image.', 'santos'),
						),
						
					array(
						'id' => 'enable_preloader',
						'type' => 'switch',
						'title' => esc_html__('Enable Preloader', 'santos'),
						'desc' => '',
						'subtitle' => esc_html__('By Default Preloader is Enabled.', 'santos'),
						'on' => 'On',
						'off' => 'Off',
						'default' => '1' 
					),
					
					array(
						'id' => 'enable_smooth_scroll',
						'type' => 'switch',
						'title' => esc_html__('Enable Smooth Scroll', 'santos'),
						'desc' => '',
						'subtitle' => esc_html__('By Default Smooth Scroll is Disable.', 'santos'),
						'on' => 'On',
						'off' => 'Off',
						'default' => '0' 
					),
					
					array(
                        'id'        => 'button_style',
                        'type'      => 'select',
                        'title'     => esc_html__('Button Styling', 'santos'),
						'subtitle' => esc_html__('This will effect overall styling of buttons.', 'santos'),
						'options' => array(
										'50'=>'Round',
                                        '4'=>'Rounded',
										'0'=>'Square',
										   ),
						'default' => '50',    
                    ),	
					
					array(
						'id'=>'contact-email',
						'type' => 'text',
						'title' => esc_html__('Contact us Email Address', 'santos'),
						'subtitle' => esc_html__('Will be used in Santos Contact Form.', 'santos'),
						'desc' => esc_html__('Requires Santos Core Plugin to be activated.', 'santos'),
						'validate' => 'email',
						'default' => 'webmaster@yourdomain.com'
						),	
						
					array(
						'id'=>'custom-js',
						'type' => 'textarea',
						'title' => esc_html__('Custom JS', 'santos'),
						'subtitle' => esc_html__('Quickly add some custom JS to your theme such as Google Analytics.', 'santos'),
						),
						
						array(
						'id'=>'google_map_key',
						'type' => 'text',
						'title' => esc_html__('Google Maps API Key', 'santos'),
						'subtitle' => esc_html__('Using Google maps require to generate an API key.', 'santos'),
						'desc' => '<a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">'. esc_html__('Get API Key', 'santos').'</a>',
						),	
						
						array(
						'id' => 'admin_login_logo',
						'type' => 'media',						
						'title' => esc_html__('WP Login Logo', 'santos'),
						'subtitle' => esc_html__('Upload Custom logo to display at WP Login Screen', 'santos'),
						'desc' => esc_html__('For Best Preview Max Height 90px .', 'santos'),  
						),
					
					array(
						'id' => 'enable_minify',
						'type' => 'switch',
						'title' => esc_html__('Enable CSS/JS minifier', 'santos'),
						'desc' => '',
						'subtitle' => esc_html__('Minify your Css and JS files Will enhance your site Load speed. you can disable this option for debug purposes', 'santos'),
						'on' => 'On',
						'off' => 'Off',
						'default' => '1' 
					),

				)
			);
			
						
			
			
			$this->sections[] = array(
				'icon' => 'el-icon-fontsize',
				'title' => esc_html__('Typography Setting', 'santos'),
				'fields' => array(

					array(
						'id'=>'body-font',
						'type' => 'typography',
						'output' => array('body'),
						'units' =>'px',
						'title' => esc_html__('Body Font', 'santos'),
						'subtitle' => esc_html__('Specify the Body font properties.', 'santos'),
						'google'=>true,
						'default' => array(
							'color'=>'#888888',
							'font-size'=>'14',
							'line-height'=>'24px',
							'font-family'=>'Open Sans',
							'font-weight'=>'400',
							),
						),
					array(
						'id'=>'h1-font',
						'type' => 'typography',
						'output' => array('h1','h1 a'),
						'units' =>'px',
						'title' => esc_html__('Head 1 Font', 'santos'),
						'subtitle' => esc_html__('Specify the Head 1 font properties.', 'santos'),
						'google'=>true,
						'default' => array(
							'color'=>'#222222',
							'font-size'=>'48',
							'line-height'=>'60px',
							'font-family'=>'Playfair Display',
							'font-weight'=>'300',
							),
						),	
					array(
						'id'=>'h2-font',
						'type' => 'typography',
						'output' => array('h2','h2 a'),
						'units' =>'px',
						'title' => esc_html__('Head 2 Font', 'santos'),
						'subtitle' => esc_html__('Specify the Head 2 font properties.', 'santos'),
						'google'=>true,
						'default' => array(
							'color'=>'#333333',
							'font-size'=>'36',
							'line-height'=>'40px',
							'font-family'=>'Playfair Display',
							'font-weight'=>'300',
							),
						),	
					array(
						'id'=>'h3-font',
						'type' => 'typography',
						'output' => array('h3','h3 a'),
						'units' =>'px',
						'title' => esc_html__('Head 3 Font', 'santos'),
						'subtitle' => esc_html__('Specify the Head 3 font properties.', 'santos'),
						'google'=>true,
						'default' => array(
							'color'=>'#333333',
							'font-size'=>'26',
							'line-height'=>'40px',
							'font-family'=>'Playfair Display',
							'font-weight'=>'300',
							),
						),	
					array(
						'id'=>'h4-font',
						'type' => 'typography',
						'output' => array('h4','h4 a'),
						'units' =>'px',
						'title' => esc_html__('Head 4 Font', 'santos'),
						'subtitle' => esc_html__('Specify the Head 4 font properties.', 'santos'),
						'google'=>true,
						'default' => array(
							'color'=>'#333333',
							'font-size'=>'22',
							'line-height'=>'30px',
							'font-family'=>'Playfair Display',
							'font-weight'=>'400',
							),
						),		
					array(
						'id'=>'h5-font',
						'type' => 'typography',
						'output' => array('h5','h5 a'),
						'units' =>'px',
						'title' => esc_html__('Head 5 Font', 'santos'),
						'subtitle' => esc_html__('Specify the Head 5 font properties.', 'santos'),
						'google'=>true,
						'default' => array(
							'color'=>'#555555',
							'font-size'=>'20',
							'line-height'=>'26px',
							'font-family'=>'Open Sans',
							'font-weight'=>'400',
							),
						),
					array(
						'id'=>'h6-font',
						'type' => 'typography',
						'output' => array('h6','h6 a'),
						'units' =>'px',
						'title' => esc_html__('Head 6 Font', 'santos'),
						'subtitle' => esc_html__('Specify the Head 6 font properties.', 'santos'),
						'google'=>true,
						'default' => array(
							'color'=>'#666666',
							'font-size'=>'18',
							'line-height'=>'24px',
							'font-family'=>'Open Sans',
							'font-weight'=>'400',
							),
						),	
						
						array(
						'id'=>'paragraph-font',
						'type' => 'typography',
						'output' => array('p'),
						'units' =>'px',
						'title' => esc_html__('Paragraph Font', 'santos'),
						'subtitle' => esc_html__('Specify Paragraph <p> font properties.', 'santos'),
						'google'=>true,
						'default' => array(
							'color'=>'#888888',
							'font-size'=>'16',
							'line-height'=>'32px',
							'font-family'=>'Open Sans',
							'font-weight'=>'400',
							),
						),
						
						array(
                            'id'       => 'site_link_color',
                            'type'     => 'link_color',
                            'output' => array('a','p a','.widget a'),

                            'title'    => esc_html__( 'Link Color', 'santos' ),
                            'default'  => array(
                                'regular' => '#646464',
                                'hover'   => '#888888',
                                'active'  => false,
                            ),
                        ),	

						array(
						'id'=>'blockquote-font',
						'type' => 'typography',
						'output' => array('blockquote','blockquote p'),
						'units' =>'px',
						'title' => esc_html__('Blockquote Font', 'santos'),
						'subtitle' => esc_html__('Specify the blockquote font properties.', 'santos'),
						'google'=>true,
						'default' => array(
							'color'=>'#333',
							'font-size'=>'22',
							'line-height'=>'33px',
							'font-family'=>'Lora',
							'font-weight'=>'300',
							'font-style'=>'italic',
							),	
						),						
						

				)
			);
			
			$this->sections[] = array(
				'icon' => 'el-icon-lines',
				'title' => esc_html__('Header & Navigation', 'santos'),
				'fields' => array(
					array(
						'id' => 'logo',
						'type' => 'media',						
						'title' => esc_html__('Dark or Colored Logo Upload', 'santos'),
						'url'      => true,
						'subtitle' => esc_html__('Upload a logo to display for "Dark/colored" header skin', 'santos'),
						'desc' => esc_html__('For Best Preview Max Height 60px / Max Width 120px.', 'santos'),  
						'default'  => array(
								'url'=> get_template_directory_uri() . '/img/logo.png'
							),	
					),
					
					array(
						'id' => 'logo_light',
						'type' => 'media',					
						'title' => esc_html__('Light Logo Upload', 'santos'),
						'url'      => true,
						'subtitle' => esc_html__('Choose a logo image to display for "Light" header skin', 'santos'),
						'desc' => esc_html__('For Best Preview Max Height 60px / Max Width 200px.', 'santos'),  
						'default'  => array(
								'url'=> get_template_directory_uri() . '/img/logo-w.png'
							),	
					),
					
					array(
							'id' => 'enable_sticky_header',
							'type' => 'switch',
							'title' => esc_html__('Enable Sticky Header', 'santos'),
							'desc' => '',
							'subtitle' => esc_html__('Sticky header will always remain at the top of the screen even when scrolling down the page. By Sticky Head is Enabled.', 'santos'),
							'on' => 'On',
							'off' => 'Off',
							'default' => '1' 
						),
					
					array(
						'id' => 'logo_sticky',
						'type' => 'media',						
						'title' => esc_html__('Sticky Logo Upload', 'santos'),
						'url'      => true,
						'subtitle' => esc_html__('Upload your Sticky logo', 'santos'),
						'desc' => esc_html__('For Best Preview Max Height 60px / Max Width 120px.', 'santos'), 
						'required' => array('enable_sticky_header','=','1'),	
						'default'  => array(
								'url'=> get_template_directory_uri() . '/img/logo.png'
							),	
					),
					
					array(
                    'id' => 'logo_width',
                    'type' => 'slider',
                    'title' => esc_html__('Logo Width', 'santos'),
                    'subtitle' => esc_html__('Default 90px', 'santos'),
                    'desc' => esc_html__('Min: 50, max: 150, step: 1, default value: 90', 'santos'),
                    "default" => 90,
                    "min" => 50,
                    "step" => 1,
                    "max" => 150,
                    'resolution' => 1,
                    'display_value' => 'text'
					),
					
					array(
                        'id'        => 'header_layout',
                        'type'      => 'image_select',
                        'title'     => esc_html__('Header Layout', 'santos'),
                        'options'   => array(
                            'header-1' => array('title' => '', 'img' => get_template_directory_uri() . '/framework/assets/img/header-1.jpg'),
							'header-2' => array('title' => '', 'img' => get_template_directory_uri() . '/framework/assets/img/header-2.jpg'),
							'header-3' => array('title' => '', 'img' => get_template_directory_uri() . '/framework/assets/img/header-3.jpg'),
                        ), 
                        'default'   => 'header-1'
                    ),
					
					array(
						'id'   => 'header_layout_2_info',
						'type' => 'info',
					   'desc' => '<h4>' . __('Please use Top Left/Right Navigation Menu for Header Layout 2', 'santos') .'</h4>',
					   'required' => array('header_layout','=','header-2'),
						),
					
					
					array(
						'id'       => 'menu_align',
						'type'     => 'select',
						'title'    => esc_html__('Menu Align', 'santos'),
						'options' => array(
							'left' => 'Left',
							'right' => 'Right',
							'center' => 'Center',
						 ),
						'default' => 'center'
						),
						
					array(
						'id'       => 'header_scheme',
						'type'     => 'select',
						'title'    => esc_html__('Header Color Style', 'santos'),
						'subtitle' => esc_html__('Select your Default Menu Links and logo color style regarding to your header background Style.', 'santos'),
						'desc' => esc_html__('Usually light style used with Transparent and No Background Header BG Style', 'santos'), 
						'class'    => 'header_scheme',  
						'options' => array(
							'dark' => 'Dark',
							'light' => 'Light',
						 ),
						'default' => 'dark'
						),

					array(
						'id'       => 'header_bg_scheme',
						'type'     => 'select',
						'title'    => esc_html__('Header Background Style', 'santos'),
						'class'    => 'header_bg_scheme',  
						'options' => array(
							'bg-color' => 'Background Color',
							'no-background' => 'No Background',
							'navbar-transparent' => 'Transparent',
						 ),
						'subtitle' => esc_html__('Select your Default header background Style. Choosing Transparent style will set Background with Opacity', 'santos'),
						'default' => 'no-background'
						),	

					array(
						'id'       => 'header_transparent_style',
						'type'     => 'select',
						'title'    => esc_html__('Header Transparent Style', 'santos'),
						'class'    => 'header_transparent_style',  
						'subtitle' => esc_html__('Select your Default header background Style. Choosing Transparent style will set Background with Opacity', 'santos'),
						'options' => array(
							'white' => 'White',
							'dark' => 'Dark',
						 ),
						'default' => 'white'
						),				
					 
					array(
						'id'=>'header_bg_color',
						'type' => 'color',
						'title' => esc_html__('Header Background Color', 'santos'), 
						'subtitle' => esc_html__('This will be used when Header BG style is Background Color', 'santos'),
						'desc' => esc_html__('Default color: #FFF.', 'santos'), 
						'default' => '#fff',
						'validate' => 'color',
						'transparent' => false,
						),
						
					array(
						'id'=>'menu_link_color',
						'type' => 'color',
						'output' => array('nav.navbar:not(.sticky) ul.nav li > a'),
						'title' => esc_html__('Dark Menu Link Color', 'santos'), 
						'subtitle' => esc_html__('Dark menu color will display for "Dark" header Style Default Value: #333.', 'santos'),
						'default' => '#333',
						'validate' => 'color',
						'transparent' => false,
						),
						
					array( 
						'id'=>'menu_link_light_color',
						'type' => 'color',
						'title' => esc_html__('Light Menu Link', 'santos'), 
						'subtitle' => esc_html__('Light menu color will display for "Light" header Style Default Value: #FFF.', 'santos'),
						'default' => '#fff',
						'validate' => 'color',
						'transparent' => false,
						),			
						
						array(
							'id' => 'enable_head_search',
							'type' => 'switch',
							'title' => esc_html__('Enable Header Search', 'santos'),
							'desc' => '',
							'subtitle' => esc_html__('By Default Head Search is Enabled.', 'santos'),
							'on' => 'On',
							'off' => 'Off',
							'default' => '1' 
						),
						

						
						array(
							'id' => 'enable_head_cart',
							'type' => 'switch',
							'title' => esc_html__('Enable Header Shopping Cart', 'santos'),
							'desc' => esc_html__('Required Woocommerce Plugin to be installed', 'santos'),
							'subtitle' => esc_html__('By Default Head Shopping Cart is Enabled.', 'santos'),
							'on' => 'On',
							'off' => 'Off',
							'default' => '1' 
						),
						
						
						array(
						'id'       => 'menu_dropdown_scheme',
						'type'     => 'select',
						'title'    => esc_html__('Dropdown Menu Color Scheme', 'santos'),
						'options' => array(
							'darckBg' => 'Dark',
							'lightBg' => 'Light',
							'custom' => 'Custom',
						 ),
						'default' => 'darckBg'
						),
						
						array( 
						'id'=>'menu_dropdown_link_color',
						'type' => 'color',
						'output' => array('nav.navbar.bootsnav li.dropdown ul.dropdown-menu li a'),
						'title' => esc_html__('Dropdown Menu Link', 'santos'), 
						'subtitle' => esc_html__('Light menu color will display for "Light" header skin Default Value: #FFF.', 'santos'),
						'default' => '#e4e4e4',
						'validate' => 'color',
						'transparent' => false,
						'required' => array('menu_dropdown_scheme','=','custom'),
						),			
					array(
						'id'=>'menu_dropdown_bg',
						'type' => 'background',
						'title' => esc_html__('Dropdown Menu Background Color', 'santos'), 
						'subtitle' => esc_html__('Pick a Default Background color for Dropdown Menu(default: #FFF).', 'santos'),
						//'required' => array('header_layout','equals',array( 'header-1','header-2','header-3' ) ), // Multiple values 
						'background-repeat' => false,
						'background-attachment' => false,
						'background-position' => false,
						'background-image' => false,
						'background-size' => false,
						'transparent' => false,
						'required' => array('menu_dropdown_scheme','=','custom'),
						'output'    => array('nav.navbar.bootsnav li.dropdown ul.dropdown-menu'),
						'default'  => array(
							'background-color' => '#222225',
						),
						),
						

							



				)
			);
			
			
		

		$this->sections[] = array(
				'icon' => 'el-icon-website-alt',
				'title' => esc_html__('Title Area Settings', 'santos'),
				'fields' => array(
				
				array(
                        'id'        => 'default_titlebar_style',
                        'type'      => 'select',
                        'title'     => esc_html__('Default Title Area Style', 'santos'),
						'subtitle' => esc_html__('This will take effect for all Pages and posts Title Area unless you override from page Title Area Setting ', 'santos'),
						'options' => array(
										'minimal'=>'Minmal',
                                        'bg_img'=>'Background Image',
										'color'=>'Background Color',
										),
						'default' => 'minimal',    
                    ),	
					
			array(
					'id'=>'titlebar_extend_padding',
					'type' => 'text',
					'title' => esc_html__('Title Area Padding', 'santos'), 
					'default' => '200',
					'subtitle' => esc_html__('This will effect Title Area Height with Background color/image', 'santos'),
					'desc' => esc_attr__('Enter value between 60 to 200  (Default Value is 200)', 'santos'), 
			),	
									
			array(
                'id'   => 'titlebar_minimal_info',
                'type' => 'info',
               'desc' => '<h4>' . __('Minimal Title Area Style', 'santos') .'</h4>',
				),
					
				array(
                        'id'       => 'titlebar-minmal-preview',
                        'type'     => 'raw',
                        'title'    => '',
                        'class'    => 'titlebar-preview',      
                        'content'  => '<img src="'.get_template_directory_uri() . '/framework/assets/img/titlebar-1.jpg" />'
                    ),
					
					array( 
						'id'=>'titlebar_color',
						'type' => 'color',
						'output' => array('.titlebar-hed','.titlebar-hed h1','titlebar-hed p','.titlebar-hed ul','.titlebar-hed li'),
						'title' => esc_html__('Minimal Title Area Text Color', 'santos'), 
						'subtitle' => esc_html__('Default color: #333.', 'santos'),
						'default' => '#333',
						'validate' => 'color',
						'transparent' => false,
					),
					
					array( 
						'id'=>'titlebar_breadcrumb_color',
						'type' => 'color',
						'output' => array('.titlebar-hed a','.breadcrumb a'),
						'title' => esc_html__('Minimal Title Area Breadcrumb Color', 'santos'), 
						'subtitle' => esc_html__('Default color: #333.', 'santos'),
						'default' => '#333',
						'validate' => 'color',
						'transparent' => false,
					),
					
		
					array(
					'id'   => 'titlebar_bgimage_info',
					'type' => 'info',
					'desc' => '<h4>' . __('Background Image Title Area Style', 'santos') .'</h4>',
					),
					
					array(
                        'id'       => 'titlebar-bgimage-preview',
                        'type'     => 'raw',
                        'title'    => '',
                        'class'    => 'titlebar-preview',      
                        'content'  => '<img src="'.get_template_directory_uri() . '/framework/assets/img/titlebar-2.jpg" />'
                    ),
					
					
						array(
						'id' => 'titlebar_extend_bg_img',
						'type' => 'media',						
						'title' => esc_html__('Default Title Area Background Image', 'santos'),
						'url'      => true,
						'subtitle' => esc_html__('This will take effect for all pages Title Area', 'santos'),
						'desc' => esc_html__('You can override this option within your Page / Section Title Bar Option.', 'santos'), 
						'default'  => array(
								'url'=> get_template_directory_uri() . '/img/page-banner.jpg'
							),								
					),
					
					

					array(
					'id'   => 'titlebar_bgimage_info',
					'type' => 'info',
					'desc' => '<h4>' . __('Background Color Titlebar Style', 'santos') .'</h4>',
					),
					
					array(
                        'id'       => 'titlebar-bgcolor-preview',
                        'type'     => 'raw',
                        'title'    => '',
                        'class'    => 'titlebar-preview',      
                        'content'  => '<img src="'.get_template_directory_uri() . '/framework/assets/img/titlebar-3.jpg" />'
                    ),
									
					array( 
						'id'       => 'titlebar_extend_bg_color',
						'type'     => 'color',
						'title'    => esc_html__('Default Titlebar Background Color', 'santos'),
						'transparent' => false,
						'default'  => '#425bb5',
					),
					
					
					
					array( 
						'id'=>'titlebar_extend_color',
						'type' => 'color',
						'output' => array('.titlebar-hed.titleHedBgImg','.titlebar-hed.titleHedBgImg h1','titlebar-hed.titleHedBgImg p','.titlebar-hed.titleHedBgImg ul','.titlebar-hed.titleHedBgImg li','.titlebar-hed.titleHedBgImg a','.titleHedBgImg .breadcrumb a'),
						'title' => esc_html__('Title Area with Background color/image Text Color', 'santos'), 
						'subtitle' => esc_html__('Default color: #FFF.', 'santos'),
						'default' => '#fff',
						'validate' => 'color',
						'transparent' => false,
					),
					
		

				)
			);
			
			
			$this->sections[] = array(
				'icon' => 'el-icon-website-alt',
				'title' => esc_html__('Footer Settings', 'santos'),
				'fields' => array(
					array(
						'id' => 'enable_footer',
						'type' => 'switch',
						'title' => esc_html__('Enable Footer', 'santos'),
						'desc' => '',
						'subtitle' => esc_html__('Use widgets areas to add content to your main Footer.', 'santos'),
						'on' => 'On',
						'off' => 'Off',
						'default' => '1' 
					),
					array(
                        'id'        => 'footer_layout',
                        'type'      => 'image_select',
                        'title'     => esc_html__('Footer Layout', 'santos'),
                        'options'   => array(
                            'footer-1' => array('title' => '', 'img' => get_template_directory_uri() . '/framework/assets/img/footer-1.jpg'),
							'footer-2' => array('title' => '', 'img' => get_template_directory_uri() . '/framework/assets/img/footer-2.jpg'),
							'footer-3' => array('title' => '', 'img' => get_template_directory_uri() . '/framework/assets/img/footer-3.jpg'),

                        ), 
                        'default'   => 'footer-1'
                    ),
					
					array(
						'id'       => 'footer_color_scheme',
						'type'     => 'select',
						'title'    => esc_html__('Footer Color Scheme', 'santos'),
						'options' => array(
							'darckBg' => 'Dark',
							'lightBg' => 'Light',
							'custom' => 'Custom',
						 ),
						'default' => 'darckBg'
						),
					
					array( 
						'id'       => 'footer-background',
						'type'     => 'background',
						'title'    => esc_html__('Footer Background', 'santos'),
						'transparent' => false,
						'output'    => array('footer'),
						'required' => array('footer_color_scheme','=','custom'),
						'default'  => array(
							'background-color' => '#222225',
						)
					),
					array(
						'id'=>'footer_txt_color',
						'type' => 'color',
						'output' => array('footer','footer h1','footer h2','footer h3','footer h4','footer h5','footer h6','footer p','footer li','footer .widget'),
						'title' => esc_html__('Footer Text Color', 'santos'), 
						'subtitle' => esc_html__('Default color: #888.', 'santos'),
						'default' => '#888',
						'validate' => 'color',
						'transparent' => false,
						'required' => array('footer_color_scheme','=','custom'),
						),
					array(
						'id'=>'footer_link_color',
						'type' => 'color',
						'output' => array('footer a','footer p a','footer li a'),
						'title' => esc_html__('Footer Link Color', 'santos'), 
						'subtitle' => esc_html__('Default color: #555.', 'santos'),
						'default' => '#555',
						'validate' => 'color',
						'transparent' => false,
						'required' => array('footer_color_scheme','=','custom'),
						),							
					array(
						'id' => 'enable_sub_footer',
						'type' => 'switch',
						'title' => esc_html__('Enable Sub Footer', 'santos'),
						'desc' => '',
						'subtitle' => esc_html__('By Default Sub Footer is Enabled.', 'santos'),
						'on' => 'On',
						'off' => 'Off',
						'default' => '1' 
					),
					
					array( 
						'id'       => 'sub_footer-background',
						'type'     => 'background',
						'title'    => esc_html__('Sub Footer Background', 'santos'),
						'transparent' => false,
						'background-repeat' => false,
						'background-attachment' => false,
						'background-position' => false,
						'background-image' => false,
						'background-size' => false,
						'output'    => array('footer .copyrights'),
						'required' => array('footer_color_scheme','=','custom'),
						'default'  => array(
							'background-color' => '#141417',
						)
					),
					array(
						'id'=>'footer_copyright',
						'type' => 'text',
						'required' => array('enable_sub_footer','=','1'),
						'title' => esc_html__('Footer Copyright Text', 'santos'), 
						'subtitle' => esc_html__('Please enter your copyright text if empty default will be used. e.g. Santos All Rights Reserved.', 'santos'),
						'desc' => esc_attr__('You can use [santos_get_year] and [santos_copyrights_symbol]', 'santos'), 
						),
					array(
						'id' => 'enable_back_top',
						'type' => 'switch',
						'required' => array('enable_sub_footer','=','1'),
						'title' => esc_html__('Enable Back to Top', 'santos'),
						'desc' => '',
						'subtitle' => esc_html__('By Default Back to Top is Enabled.', 'santos'),
						'on' => 'On',
						'off' => 'Off',
						'default' => '1' 
					),	
					
				)
			);
					

			$this->sections[] = array(
				'icon' => 'el-icon-bold',
				'title' => esc_html__('Blog Settings', 'santos'),
				'fields' => array(
				
				    array(
						'id'=>'blog_page_title',
						'type' => 'text',
						'title' => esc_html__('Blog Archive Page Title', 'santos'), 
						'default' => esc_html__('Our Blog', 'santos' ),
                        'subtitle'  => esc_html__('Enter if you wish to use a different archive page title', 'santos'),
						),
					
					array(
                        'id'        => 'blog_titlebar_style',
                        'type'      => 'select',
                        'title'     => esc_html__('Blog Titlebar Style', 'santos'),
						'subtitle' => esc_html__('This will take effect for all Blog Archives Title Bar ', 'santos'),
						'options' => array(
										'default'=>'Default',
                                        'custom_img'=>'Background Image',
										   ),
						'default' => 'custom_img',    
                    ),	
	
					array(
						'id' => 'blog_titlebar_bg_img',
						'type' => 'media',						
						'title' => esc_html__('Blog Titlebar Background Image', 'santos'),
						'url'      => true,
						'required' => array('blog_titlebar_style','=','custom_img'),	
						'default'  => array(
								'url'=> get_template_directory_uri() . '/img/banner.jpg'
							),						
					),	

					array(
						'id'       => 'archive_header_scheme',
						'type'     => 'select',
						'title'    => esc_html__('Archive Header Color Style', 'santos'),
						'subtitle' => esc_html__('Select your Default Menu Links and logo color style regarding to your header background Style.', 'santos'),
						'desc' => esc_html__('Usually light style used with Transparent and No Background Header BG Style', 'santos'), 
						'class'    => 'archive_header_scheme',  
						'options' => array(
							'dark' => 'Dark',
							'light' => 'Light',
						 ),
						'default' => 'light'
						),						

						
					array(
						'id' => 'archive_layout',
						'type' => 'image_select',
						'compiler' => true,
						'title' => esc_html__( 'Default Post Archive Layout', 'santos' ),
						'subtitle' => esc_html__( 'Choose between following layout.', 'santos' ),
						'options' => array(
						'classic' => array(
						'alt' => 'Classic',
						'img' => get_template_directory_uri() . '/framework/assets/img/blog-classic.png'
						),
						'masonry' => array(
						'alt' => 'Masonry',
						'img' => get_template_directory_uri() . '/framework/assets/img/blog-masonry.png'
						),
						),
						'default' => 'classic'
						),
				
					array(
						'id' => 'enable_fullwidth_blog',
						'type' => 'switch',
						'title' => esc_html__('Enable Full Width', 'santos'),
						'desc' => '',
						'subtitle' => esc_html__('Remove Sidebar for Blog Archive Page.', 'santos'),
						'on' => 'On',
						'off' => 'Off',
						'default' => '0' 
					),
					
					 array(
						'id'=>'blog_excerpt_length',
						'type' => 'text',
						'title' => esc_html__('Number of words in Blog', 'santos'), 
                        'subtitle'  => esc_html__('Enter the number of words to be displayed per post in Blog List', 'santos'),
						'default' => esc_html__('45', 'santos'),
						),
						
					
					
				array(
                'id'   => 'single_post_info',
                'type' => 'info',
                'desc' => '<h4>' . __('Single Post Setting', 'santos') .'</h4>',
				),
					
					array(
						'id' => 'post_layout',
						'type' => 'image_select',
						'compiler' => true,
						'title' => esc_html__( 'Default Post Layout', 'santos' ),
						'subtitle' => esc_html__( 'Select main content and sidebar between following layout.', 'santos' ),
						'options' => array(
						'fullwidth' => array(
						'alt' => 'Full Width',
						'img' => ReduxFramework::$_url . 'assets/img/1col.png'
						),
						'left' => array(
						'alt' => 'Left Content',
						'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
						),
						),
						'default' => 'fullwidth'
						),
						
					
					array(
						'id' => 'enable_post_share',
						'type' => 'switch',
						'title' => esc_html__('Enable Single Post Share', 'santos'),
						'desc' => esc_html__('Requires Santos Core Plugin to be activated', 'santos'),
						'on' => 'On',
						'off' => 'Off',
						'default' => '1' 
					),					
						
					array(
						'id' => 'enable_post_related',
						'type' => 'switch',
						'title' => esc_html__('Enable Single Post Related', 'santos'),
						'desc' => '',
						'on' => 'On',
						'off' => 'Off',
						'default' => '1' 
					),
					
				)
			);
			
			
			$this->sections[] = array(
				'icon' => 'el-icon-file-alt',
				'title' => esc_html__('Page Settings', 'santos'),
				'fields' => array(
						   								
					array(
						'id' => 'page_layout',
						'type' => 'image_select',
						'compiler' => true,
						'title' => esc_html__( 'Default Page Layout', 'santos' ),
						'subtitle' => esc_html__( 'Select main content and sidebar between following layout.', 'santos' ),
						'options' => array(
						'fullwidth' => array(
						'alt' => 'Full Width',
						'img' => ReduxFramework::$_url . 'assets/img/1col.png'
						),
						'left' => array(
						'alt' => 'Left Content',
						'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
						),
						),
						'default' => 'fullwidth'
						),
						
					array(
						'id'       => 'page_container',
						'type'     => 'select',
						'title'    => esc_html__('Default Page Container', 'santos'),
						'class'    => 'page_container',  
						'options' => array(
							'container' => 'Containre',
							'no-container' => 'Full Width',
						 ),
						'subtitle'  => esc_html__('If you are going to use our Page Builder it is better to use Full width container for the page ', 'santos'),
						'default' => 'container'
						),		
						
					array(
						'id' => 'enable_page_share',
						'type' => 'switch',
						'title' => esc_html__('Enable Page Share', 'santos'),
						'desc' => esc_html__('Requires Santos Core Plugin to be activated', 'santos'),
						'on' => 'On',
						'off' => 'Off',
						'default' => '0' 
					),					
						
					
				)
			);
			
			$this->sections[] = array(
				'icon' => 'el-icon-folder-sign',
				'title' => esc_html__('Portfolio Settings', 'santos'),
				'fields' => array(
				
					array(
						'id'=>'portfolio_slug',
						'type' => 'text',
						'title' => esc_html__('Portfolio custom URL Slug', 'santos'), 
						'subtitle'  => esc_html__('You will still have to refresh your permalinks after saving this by going to Settings > Permalinks and clicking save. ', 'santos'),
						'desc' => esc_html__('Portfolio post type custom slug in the url', 'santos'),
						),
					array(
						'id' => 'enable_portfolio_share',
						'type' => 'switch',
						'title' => esc_html__('Enable Single Portfolio Share', 'santos'),
						'desc' => esc_html__('Requires Santos Core Plugin to be activated', 'santos'),
						'on' => 'On',
						'off' => 'Off',
						'default' => '1' 
					),					
						
					array(
						'id' => 'enable_portfolio_related',
						'type' => 'switch',
						'title' => esc_html__('Enable Single Portfolio Related', 'santos'),
						'desc' => '',
						'on' => 'On',
						'off' => 'Off',
						'default' => '1' 
					),
				
				)
			);
		
	if ( function_exists( 'is_woocommerce' ) ) {		
			
			$this->sections[] = array(
				'icon' => 'el-icon-shopping-cart-sign',
				'title' => esc_html__('Woocommerce', 'santos'),
				'fields' => array(
				
						array(
                        'id'        => 'shop_titlebar_style',
                        'type'      => 'select',
                        'title'     => esc_html__('Shop Title Area Style', 'santos'),
						'subtitle' => esc_html__('This will take effect for all Shop Archives Title Bar ', 'santos'),
						'options' => array(
										'default'=>'Default',
                                        'custom_img'=>'Background Image',
										   ),
						'default' => 'custom_img',    
                    ),	
	
					array(
						'id' => 'shop_titlebar_bg_img',
						'type' => 'media',						
						'title' => esc_html__('Shop Title Area Background Image', 'santos'),
						'url'      => true,
						'required' => array('shop_titlebar_style','=','custom_img'),						
					),	

					array(
						'id'       => 'shop_header_scheme',
						'type'     => 'select',
						'title'    => esc_html__('Shop Archive Header Color Style', 'santos'),
						'subtitle' => esc_html__('Select your Default Menu Links and logo color style regarding to your header background Style.', 'santos'),
						'desc' => esc_html__('Usually light style used with Transparent and No Background Header BG Style', 'santos'), 
						'class'    => 'shop_header_scheme',  
						'options' => array(
							'dark' => 'Dark',
							'light' => 'Light',
						 ),
						'default' => 'light'
						),	
						
						
				
					array(
						'id' => 'enable_fullwidth_shop',
						'type' => 'switch',
						'title' => esc_html__('Enable Full Width Shop', 'santos'),
						'desc' => '',
						'subtitle' => esc_html__('Remove Sidebar for Shop Archive Page.', 'santos'),
						'on' => 'On',
						'off' => 'Off',
						'default' => '0' 
					),

					array(
						'id' => 'enable_product_titlebar',
						'type' => 'switch',
						'title' => esc_html__('Enable Single Product Title Area', 'santos'),
						'desc' => '',
						'subtitle' => esc_html__('By Default Product Title Area Disable', 'santos'),
						'on' => 'On',
						'off' => 'Off',
						'default' => '0' 
						),


					array(
						'id'       => 'product_header_scheme',
						'type'     => 'select',
						'title'    => esc_html__('Default Single Product Header Color Style', 'santos'),
						'subtitle' => esc_html__('Select your Default Menu Links and logo color style regarding to your header background Style.', 'santos'),
						'class'    => 'product_header_scheme',  
						'options' => array(
							'dark' => 'Dark',
							'light' => 'Light',
						 ),
						'default' => 'dark'
						),							
				
					array(
						'id' => 'enable_product_share',
						'type' => 'switch',
						'title' => esc_html__('Enable Single Product Share', 'santos'),
						'desc' => esc_html__('Requires Santos Core Plugin to be activated', 'santos'),
						'on' => 'On',
						'off' => 'Off',
						'default' => '1' 
					),		

					array(
						'id' => 'enable_product_gallery',
						'type' => 'switch',
						'title' => esc_html__('Enable Single Product Gallery', 'santos'),
						'subtitle' => esc_html__('This option will override default Woocommerce Gallery with Santo Slider.', 'santos'),
						'desc' => '',
						'on' => 'On',
						'off' => 'Off',
						'default' => '1' 
					),					
						
					array(
						'id' => 'enable_product_related',
						'type' => 'switch',
						'title' => esc_html__('Enable Single Product Related', 'santos'),
						'desc' => '',
						'on' => 'On',
						'off' => 'Off',
						'default' => '1' 
					),
				
				)
			);
	}
			
			$this->sections[] = array(
				'icon' => 'el-icon-cloud-alt',
				'title' => esc_html__('Social Network', 'santos'),
				'desc' => '<h4 class="description">'.esc_html__('Please enter your social network sites URL. this will be used when activate social sites widgets', 'santos').'</h4>',
				'fields' => array(
    
					array(
						'id'=>'facebook-url',
						'type' => 'text',
						'title' => esc_html__('Facebook URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Facebook URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://facebook.com'
						),
					array(
						'id'=>'twitter-url',
						'type' => 'text',
						'title' => esc_html__('Twitter URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Twitter URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://twitter.com'
						),
					array(
						'id'=>'google-plus-url',
						'type' => 'text',
						'title' => esc_html__('Google+ URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Google+ URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://plus.google.com'
						),	
					array(
						'id'=>'linkedin-url',
						'type' => 'text',
						'title' => esc_html__('LinkedIn URL', 'santos'),
						'subtitle' => esc_html__('Please enter your LinkedIn URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://www.linkedin.com/'
						),
					array(
						'id'=>'youtube-url',
						'type' => 'text',
						'title' => esc_html__('Youtube URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Youtube URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://www.youtube.com/'
						),
						
					 array(
						'id'=>'vimeo-url',
						'type' => 'text',
						'title' => esc_html__('Vimeo URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Vimeo URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://www.vimeo.com/'
						),
                     
                    	array(
						'id'=>'dribbble-url',
						'type' => 'text',
						'title' => esc_html__('Dribbble URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Dribbble URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://www.dribbble.com/'
						),
                    
                    	array(
						'id'=>'dropbox-url',
						'type' => 'text',
						'title' => esc_html__('Dropbox URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Dropbox URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://www.dropbox.com/'
						),
                    
                    
                    	array(
						'id'=>'github-url',
						'type' => 'text',
						'title' => esc_html__('Github URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Github URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://www.github.com/'
						),
                    
                    	array(
						'id'=>'google-url',
						'type' => 'text',
						'title' => esc_html__('Google URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Google URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://www.google.com/'
						),
                    
                    	array(
						'id'=>'instagram-url',
						'type' => 'text',
						'title' => esc_html__('Instagram URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Instagram URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://www.instagram.com/'
						),
                    
                    	array(
						'id'=>'pinterest-url',
						'type' => 'text',
						'title' => esc_html__('Pinterest URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Pinterest URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://www.pinterest.com/'
						),
                    
                    	array(
						'id'=>'rss-url',
						'type' => 'text',
						'title' => esc_html__('Rss URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Rss URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://www.rss.com/'
						),
                    
                    	array(
						'id'=>'skype-url',
						'type' => 'text',
						'title' => esc_html__('Skype URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Skype URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://www.skype.com/'
						),
						
					 array(
						'id'=>'whatsapp-url',
						'type' => 'text',
						'title' => esc_html__('Whatsapp URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Whatsapp URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://www.whatsapp.com/'
						),
                    
                    	array(
						'id'=>'tumblr-url',
						'type' => 'text',
						'title' => esc_html__('Tumblr URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Tumblr URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://www.tumblr.com/'
						),
                    
                    
                        array(
						'id'=>'wordpress-url',
						'type' => 'text',
						'title' => esc_html__('Wordpress URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Wordpress URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://www.wordpress.com/'
						),
                    
                        array(
						'id'=>'yahoo-url',
						'type' => 'text',
						'title' => esc_html__('Yahoo URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Yahoo URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://www.yahoo.com/'
						),
                    
                      array(
						'id'=>'reddit-url',
						'type' => 'text',
						'title' => esc_html__('Reddit URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Reddit URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://www.reddit.com/'
						),
						
					 array(
						'id'=>'android-url',
						'type' => 'text',
						'title' => esc_html__('Android URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Android URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://www.android.com/'
						),
                    
                    array(
						'id'=>'apple-url',
						'type' => 'text',
						'title' => esc_html__('Apple URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Apple URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://www.apple.com/'
						),
                    
                    array(
						'id'=>'foursquare-url',
						'type' => 'text',
						'title' => esc_html__('Foursquare URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Foursquare URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://www.foursquare.com/'
						),
                    
                    array(
						'id'=>'codepen-url',
						'type' => 'text',
						'title' => esc_html__('Codepen URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Codepen URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://www.codepen.com/'
						),
                                        
                       array(
						'id'=>'octocat-url',
						'type' => 'text',
						'title' => esc_html__('Octocat URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Octocat URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://www.octocat.com/'
						),
						array(
						'id'=>'buffer-url',
						'type' => 'text',
						'title' => esc_html__('Buffer URL', 'santos'),
						'subtitle' => esc_html__('Please enter your Buffer URL.', 'santos'),
						'validate' => 'url',
						'default' => 'https://www.buffer.com/'
						),
						
						
                             

				
				)
			);
			
			$this->sections[] = array(
				'icon' => 'el-icon-envelope-alt',
				'title' => esc_html__('Mailchimp Settings', 'santos'),
				'desc' => '<h4 class="description">'.esc_html__('Please enter your Mailchimp URL and Default messages. this will be used in your footer Subscribe to Our Newsletter Area', 'santos').'</h4>',
				'fields' => array(
				
					array(
						'id'=>'chimp_url',
						'type' => 'text',
						'title' => esc_html__('Mailchimp URL', 'santos'), 						
						'desc' => esc_html__('Just go to your mailchimp account. Then your list. Then Signup forms. Select  Embedded forms. You will find form action URL in this page', 'santos'), 
						),
					array(
						'id'=>'chimp_submit_msg',
						'type' => 'text',
						'title' => esc_html__('submit Message', 'santos'), 						
						'default' => esc_html__('Submitting...', 'santos'),
						),
					array(
						'id'=>'chimp_success_msg',
						'type' => 'text',
						'title' => esc_html__('Success Message', 'santos'), 						
						'default' => esc_html__('We have sent you a confirmation email', 'santos'),
						),	
					array(
						'id'=>'chimp_error_invalid_value',
						'type' => 'text',
						'title' => esc_html__('Error for no value', 'santos'), 						
						'default' => esc_html__('Please enter a value', 'santos'),
						),
					array(
						'id'=>'chimp_error_invalid_sign',
						'type' => 'text',
						'title' => esc_html__('Error for no @ sign', 'santos'), 						
						'default' => esc_html__('An email address must contain a single @', 'santos'),
						),	
					array(
						'id'=>'chimp_error_invalid_domain',
						'type' => 'text',
						'title' => esc_html__('Error for invalid domain', 'santos'), 						
						'default' => esc_html__('The domain portion of the email address is invalid', 'santos'),
						),
					array(
						'id'=>'chimp_error_invalid_username',
						'type' => 'text',
						'title' => esc_html__('Error for invalid username', 'santos'), 						
						'default' => esc_html__('The username portion of the email address is invalid', 'santos'),
						),	
					array(
						'id'=>'chimp_error_invalid_email',
						'type' => 'text',
						'title' => esc_html__('Error for invalid email', 'santos'), 						
						'default' => esc_html__('This email address looks fake or invalid. Please enter a real email address', 'santos'),
						),
						
					
				)
			);		

        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => esc_html__('Theme Information 1', 'santos'),
                'content'   => esc_html__('<p>This is the tab content, HTML is allowed.</p>', 'santos')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => esc_html__('Theme Information 2', 'santos'),
                'content'   => esc_html__('<p>This is the tab content, HTML is allowed.</p>', 'santos')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = esc_html__('<p>This is the sidebar content, HTML is allowed.</p>', 'santos');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'santos_options',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'submenu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => esc_html__('Theme Options', 'santos'),
                'page_title'        => esc_html__('Santos Options', 'santos'),
				                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => false,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
				'update_notice'        => false,
                'customizer'        => true,                    // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => 'santos-options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/uxcode.net',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );


            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
             
            } else {
             
            }

            // Add content after the form.
          
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
