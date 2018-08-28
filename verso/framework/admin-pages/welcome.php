<?php
/**
 * Admin View: Page - Status Report
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


$santos_theme = wp_get_theme();
if($santos_theme->parent_theme) {
	$template_dir =  get_template_directory();
	$santos_theme = wp_get_theme($template_dir);
}
$santos_version = $santos_theme->get( 'Version' );

?>

<div class="wrap kp-page-welcome about-wrap santos-wrap">

	<h1><?php echo esc_html__( "Welcome to ", "santos" ) . '<span class="santos-name">'.SANTOS_NAME.'</span> !'; ?></h1>

	<div class="about-text">
		<?php printf(wp_kses(__( "%s is up and running! Get ready to build beautiful site. We hope you enjoy a free imagination with the most powerfull theme for WordPress! ", "santos" ), array( 'br' => '')), SANTOS_NAME); ?>
	</div>
	<div class="wp-badge kp-page-logo">	Version <?php echo SANTOS_VERSION; ?>	</div>
	<h2 class="nav-tab-wrapper">
    <?php
			printf( '<a href="%s" class="nav-tab nav-tab-active">%s</a>', admin_url('themes.php?page=santos-welcome'), esc_html__( "Welcome", "santos" ) );
		/*
			printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'themes.php?page=santos-plugins' ), esc_html__( "Install Plugins", "santos" ) );
		*/	
		if( class_exists( 'Santos_Core_Plugin' ) ) {
			printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'themes.php?page=santos-demos' ), esc_html__( "Install Demo", "santos" ) );
		}
		
		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'themes.php?page=santos-system-status' ), esc_html__( "System Status", "santos" ) );
	
		?>
	</h2>


	
		
		<div class="welcome-step step-1">

			<h3 class="step-title">Install and activate plugins</h3>

			<p>Click the button below to install and activate santos plugins. We highly recommend to activate Santos Core Plugin and other plugins you wish to use before install demo data </p>

			<a href="<?php echo admin_url('themes.php?page=tgmpa-install-plugins') ?>" target="_blank" class="button button-primary">Visit Plugins Page</a>

		</div>
		
	
			<div class="welcome-step step-2">

			<h3 class="step-title"> Download and install demo</h3>
			
			<?php
			if( class_exists( 'Santos_Core_Plugin' ) ) {
				?>
				
			<p>Click the button below to download and install our online demo content.</p>

			<a href="<?php echo admin_url('themes.php?page=santos-demos') ?>" target="_self" class="button button-primary">Visit Demo Installation</a>
	
				
			<?php	
			}else{
			?>
			
			<p>If you activate Santos Core Plugin you will be able to Access One Click Demo Install Otherwise click the button below to import xml demo you wish to use manually .</p>

			<a href="<?php echo admin_url('import.php') ?>" target="_blank" class="button button-primary">Import Demos</a>
			<a href="<?php echo admin_url('themes.php?page=santos-options') ?>" target="_blank" class="button button-primary">Import Theme Options</a>

				
			<?php	
			}
			?>

	
		</div>

		

		<div class="welcome-step step-3">

			<h3 class="step-title">Customize the Theme</h3>

			<p>Click the button below to customize your theme using our advance Theme Options.</p>

			<a href="<?php echo admin_url('themes.php?page=santos-options') ?>" target="_blank" class="button button-primary">Visit Theme Options</a>

		</div>

		  <div class="clearfix"></div>

		<div class="welcome-step step-4">

			<h3 class="step-title"> Learn how to use <?php echo SANTOS_NAME; ?></h3>

			<p>Click the button below to learn all about using <?php echo SANTOS_NAME; ?>.  We have a full docs to help you learn and use <?php echo SANTOS_NAME; ?>'s features and benefits.</p>

			<a href="http://www.uxcode.net/documentation/santos/" target="_blank" class="button button-primary">Visit Theme Documents</a>

		</div>
		
		 

		<div class="welcome-step step-5">

			<h3 class="step-title"> Ask our experts</h3>

			<p>Click the button below to reach our support team if you have any problems with the operation of your <?php echo SANTOS_NAME; ?> Theme.</p>

			<a href="http://themeforest.net/user/uxcode" target="_blank" class="button button-primary">Get Help</a>

		</div>
		
		 <div class="clearfix"></div>

</div>

