<?php
/**
 * SANTOS Header
 * Displays all of the <head> section and everything up till the end of header>
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
		<!-- Meta Tags -->
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  
	
		<!-- Favicons AND TOUCH ICONS   -->
		<?php santos_favicon(); ?>
			
	
      <?php wp_head(); ?>
    </head>


<body <?php body_class(); ?> >

<svg class="hidden">
        <defs>

            <symbol id="icon-pin">
                <path d="M17.6,2.9L17.6,2.9c-3.1-3.1-8.2-3.1-11.3,0l0,0C3.6,5.7,3.2,11,5.6,14.2l6.4,9.2l6.4-9.2C20.8,11,20.4,5.7,17.6,2.9z M12.1,11.1c-1.5,0-2.6-1.2-2.6-2.6s1.2-2.6,2.6-2.6s2.6,1.2,2.6,2.6S13.5,11.1,12.1,11.1z" />
            </symbol>
            <symbol id="icon-circle">
                <circle cx="8" cy="8" r="6.215"></circle>
            </symbol>
        </defs>
    </svg>
	

 <!-- Preloader -->
 <?php santos_preloader(); ?>
 
 
<!-- Navbar -->
<?php santos_primary_navigation(); ?>
