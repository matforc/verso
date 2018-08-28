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
	
		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url('themes.php?page=santos-welcome'), esc_html__( "Welcome", "santos" ) );
		
		if( class_exists( 'Santos_Core_Plugin' ) ) {
			printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'themes.php?page=santos-demos' ), esc_html__( "Install Demo", "santos" ) );
		}
		
		
		printf( '<a href="%s" class="nav-tab nav-tab-active">%s</a>', admin_url( 'themes.php?page=santos-system-status' ), esc_html__( "System Status", "santos" ) );
		
	
		?>
	</h2>


	
		<table class="widefat santos_system_status" cellspacing="0">
			<thead>
				<tr>
					<th colspan="3"><?php _e( 'WordPress and Server Environment', 'santos' ); ?></th>
				</tr>
			</thead>
			<tbody>
				
				<tr>
					<td class="title"><?php _e( 'WP Version:', 'santos' ); ?></td>
					<td><?php bloginfo( 'version' ); ?></td>
				</tr>

				<tr>
					<td class="title"><?php _e( 'WP Memory Limit:', 'santos' ); ?></td>
					<td>
						<?php
						$memory = santos_let_to_num( WP_MEMORY_LIMIT );
						if ( $memory < 128000000 ) {
							echo '<mark class="error">' . sprintf( __( '%1$s - We recommend setting memory to at least <strong>128MB</strong>.  <br /> Please define memory limit in <strong>wp-config.php</strong> file. To learn how, see: <a href="%2$s" target="_blank" rel="noopener noreferrer">Increasing memory allocated to PHP.</a>', 'santos' ), size_format( $memory ), 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP' ) . '</mark>';
						} else {
							echo '<mark class="yes">' . size_format( $memory ) . '</mark>';

						}
						?>
					</td>
				</tr>
				
				
				
				<tr>
					<td class="title"><?php _e( 'Server Info:', 'santos' ); ?></td>
					<td><?php echo esc_html( $_SERVER['SERVER_SOFTWARE'] ); ?></td>
				</tr>
				<tr>
					<td class="title"><?php _e( 'PHP Version:', 'santos' ); ?></td>
					<td><?php if ( function_exists( 'phpversion' ) ) { echo esc_html( phpversion() ); } ?>
					<?php
					if ( 5.4 > phpversion() ) {
									echo '<br /><mark class="error">' . __( 'Santos Theme requires PHP Version <strong>5.4</strong> or greater.', 'santos' ) . '</mark>';
								}
					?>
						</td>		
				</tr>
				<?php if ( function_exists( 'ini_get' ) ) : ?>
					<tr>
						<td class="title"><?php _e( 'PHP Post Max Size:', 'santos' ); ?></td>
						<td><?php echo size_format( santos_let_to_num( ini_get( 'post_max_size' ) ) ); ?></td>
					</tr>
					<tr>
						<td class="title"><?php _e( 'PHP Time Limit:', 'santos' ); ?></td>
						
						<td>
							<?php
							$time_limit = ini_get( 'max_execution_time' );

							if ( 180 > $time_limit && 0 != $time_limit ) {
								echo '<mark class="error">' . sprintf( __( '%1$s - We recommend setting max execution time to at least 180. <br /> To import demo content, <strong>300</strong> seconds of max execution time is required.<br />See: <a href="%2$s" target="_blank" rel="noopener noreferrer">Increasing max execution to PHP</a>', 'santos' ), $time_limit, 'http://codex.wordpress.org/Common_WordPress_Errors#Maximum_execution_time_exceeded' ) . '</mark>';
							} else {
								echo '<mark class="yes">' . $time_limit . '</mark>';
								if ( 300 > $time_limit && 0 != $time_limit ) {
									echo '<br /><mark class="error">' . __( 'Current time limit is sufficient, but if you need import demo content, the required time is <strong>300</strong>.', 'santos' ) . '</mark>';
								}
							}
							?>
						</td>
						
						
					</tr>
					<tr>
						<td class="title"><?php _e( 'PHP Max Input Vars:', 'santos' ); ?></td>
						
						<?php
						$registered_navs = get_nav_menu_locations();
						$menu_items_count = array( '0' => '0' );
						foreach ( $registered_navs as $handle => $registered_nav ) {
							$menu = wp_get_nav_menu_object( $registered_nav );
							if ( $menu ) {
								$menu_items_count[] = $menu->count;
							}
						}

						$max_items = max( $menu_items_count );
						$required_input_vars = $max_items * 12;

						?>
						<td>
							<?php
							$max_input_vars = ini_get( 'max_input_vars' );
							$required_input_vars = $required_input_vars + ( 500 + 1000 );
							// 1000 = theme options
							if ( $max_input_vars < $required_input_vars ) {
								echo '<mark class="error">' . sprintf( __( '%1$s - Recommended Value: %2$s.<br />Max input vars limitation will truncate POST data such as menus. See: <a href="%3$s" target="_blank" rel="noopener noreferrer">Increasing max input vars limit.</a>', 'santos' ), $max_input_vars, '<strong>' . $required_input_vars . '</strong>', 'http://sevenspark.com/docs/ubermenu-3/faqs/menu-item-limit' ) . '</mark>';
							} else {
								echo '<mark class="yes">' . $max_input_vars . '</mark>';
							}
							?>
						</td>
						
						
					</tr>


				<?php endif; ?>

				<tr>
					<td class="title"><?php _e( 'MySQL Version:', 'santos' ); ?></td>
					
					<td>
						<?php
						/** @global wpdb $wpdb */
						global $wpdb;
						echo $wpdb->db_version();
						?>
					</td>
					
				</tr>
				<tr>
					<td class="title"><?php _e( 'Max Upload Size:', 'santos' ); ?></td>
					<td><?php echo size_format( wp_max_upload_size() ); ?>
					
					
					
					</td>
				</tr>
				
				


			</tbody>
		</table>
		
		 <div class="clearfix"></div>

</div>

