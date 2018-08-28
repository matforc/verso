<?php

/**
* Add custom menu fields to menu
*/

add_filter( 'wp_setup_nav_menu_item', 'santos_add_custom_nav_fields' );

function santos_add_custom_nav_fields( $menu_item ) {

	$menu_item->megamenu = get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );

	$menu_item->megamenu_cols = get_post_meta( $menu_item->ID, '_menu_item_megamenu_cols', true );

	return $menu_item;

}



// save menu custom fields

add_action( 'wp_update_nav_menu_item', 'santos_update_custom_nav_fields', 10, 3 );

function santos_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

		

		$check = array( 'megamenu', 'megamenu_cols');
		
		foreach ( $check as $key )

		{

			if(!isset($_POST['menu-item-'.$key][$menu_item_db_id]))

			{

				$_POST['menu-item-'.$key][$menu_item_db_id] = "";

			}

			

			$value = $_POST['menu-item-'.$key][$menu_item_db_id];

			update_post_meta( $menu_item_db_id, '_menu_item_'.$key, $value );

		}


}



// edit menu walker

add_filter( 'wp_edit_nav_menu_walker', 'santos_edit_walker', 10, 2 );

function santos_edit_walker($walker,$menu_id) {

	return 'Walker_Nav_Menu_Edit_Custom';	

}



 /**

 *  // A copy of Walker_Nav_Menu_Edit class in core

 * Create HTML list of nav menu input items.

 *

 * @package WordPress

 * @since 3.0.0

 * @uses Walker_Nav_Menu

 */

 

 class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu {

	/**

	 * Starts the list before the elements are added.

	 *

	 * @see Walker_Nav_Menu::start_lvl()

	 *

	 * @since 3.0.0

	 *

	 * @param string $output Passed by reference.

	 * @param int    $depth  Depth of menu item. Used for padding.

	 * @param array  $args   Not used.

	 */

	public function start_lvl( &$output, $depth = 0, $args = array() ) {}



	/**

	 * Ends the list of after the elements are added.

	 *

	 * @see Walker_Nav_Menu::end_lvl()

	 *

	 * @since 3.0.0

	 *

	 * @param string $output Passed by reference.

	 * @param int    $depth  Depth of menu item. Used for padding.

	 * @param array  $args   Not used.

	 */

	public function end_lvl( &$output, $depth = 0, $args = array() ) {}



	/**

	 * Start the element output.

	 *

	 * @see Walker_Nav_Menu::start_el()

	 * @since 3.0.0

	 *

	 * @param string $output Passed by reference. Used to append additional content.

	 * @param object $item   Menu item data object.

	 * @param int    $depth  Depth of menu item. Used for padding.

	 * @param array  $args   Not used.

	 * @param int    $id     Not used.

	 */

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		global $_wp_nav_menu_max_depth,$wp_registered_sidebars;


		ob_start();

		$item_id = esc_attr( $item->ID );

		$removed_args = array(

			'action',

			'customlink-tab',

			'edit-menu-item',

			'menu-item',

			'page-tab',

			'_wpnonce',

		);



		$original_title = '';

		if ( 'taxonomy' == $item->type ) {

			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );

			if ( is_wp_error( $original_title ) )

				$original_title = false;

		} elseif ( 'post_type' == $item->type ) {

			$original_object = get_post( $item->object_id );

			$original_title = get_the_title( $original_object->ID );

		}



		$classes = array(

			'menu-item menu-item-depth-' . $depth,

			'menu-item-' . esc_attr( $item->object ),

			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),

		);



		$title = $item->title;



		if ( ! empty( $item->_invalid ) ) {

			$classes[] = 'menu-item-invalid';

			/* translators: %s: title of menu item which is invalid */

			$title = sprintf( esc_html__( '%s (Invalid)','santos' ), $item->title );

		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {

			$classes[] = 'pending';

			/* translators: %s: title of menu item in draft status */

			$title = sprintf( esc_html__('%s (Pending)','santos'), $item->title );

		}



		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;



		$submenu_text = '';

		if ( 0 == $depth )

			$submenu_text = 'style="display: none;"';



		?>

		<li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo implode(' ', $classes ); ?>">

			<dl class="menu-item-bar">

				<dt class="menu-item-handle">

					<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo esc_attr($submenu_text); ?>><?php esc_html_e( 'sub item','santos' ); ?></span></span>

					<span class="item-controls">

						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>

						<span class="item-order hide-if-js">

							<a href="<?php

								echo wp_nonce_url(

									add_query_arg(

										array(

											'action' => 'move-up-menu-item',

											'menu-item' => $item_id,

										),

										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )

									),

									'move-menu_item'

								);

							?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up','santos'); ?>">&#8593;</abbr></a>

							|

							<a href="<?php

								echo wp_nonce_url(

									add_query_arg(

										array(

											'action' => 'move-down-menu-item',

											'menu-item' => $item_id,

										),

										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )

									),

									'move-menu_item'

								);

							?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down','santos'); ?>">&#8595;</abbr></a>

						</span>

						<a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" title="<?php esc_attr_e('Edit Menu Item','santos'); ?>" href="<?php

							echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );

						?>"><?php esc_html_e( 'Edit Menu Item','santos' ); ?></a>

					</span>

				</dt>

			</dl>



			<div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">

				<?php if( 'custom' == $item->type ) : ?>

					<p class="field-url description description-wide">

						<label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">

							<?php esc_html_e( 'URL','santos' ); ?><br />

							<input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />

						</label>

					</p>

				<?php endif; ?>

				<p class="description description-thin">

					<label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">

						<?php esc_html_e( 'Navigation Label','santos' ); ?><br />

						<input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />

					</label>

				</p>

				<p class="description description-thin">

					<label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">

						<?php esc_html_e( 'Title Attribute','santos' ); ?><br />

						<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />

					</label>

				</p>

				<p class="field-link-target description">

					<label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">

						<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />

						<?php esc_html_e( 'Open link in a new window/tab','santos' ); ?>

					</label>

				</p>

				<p class="field-css-classes description description-thin">

					<label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">

						<?php esc_html_e( 'CSS Classes (optional)','santos' ); ?><br />

						<input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />

					</label>

				</p>

				<p class="field-xfn description description-thin">

					<label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">

						<?php esc_html_e( 'Link Relationship (XFN)','santos' ); ?><br />

						<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />

					</label>

				</p>

				<p class="field-description description description-wide">

					<label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">

						<?php esc_html_e( 'Description','santos' ); ?><br />

						<textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>

						<span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.','santos'); ?></span>

					</label>

				</p>

				

				

				<?php

	            /* New fields start here */

	            ?>      


				<p class="field-megamenu-checkbox description description-wide">

                    <?php 



                        $value = $item->megamenu;

                        if($value != "") $value = "checked='checked'";



                    ?>

                    <label for="edit-menu-item-megamenu-<?php echo esc_attr($item_id); ?>">

                        <input type="checkbox" value="enabled" class="edit-menu-item-kp-megamenu-check" id="edit-menu-item-megamenu-<?php echo esc_attr($item_id); ?>" name="menu-item-megamenu[<?php echo esc_attr($item_id); ?>]" <?php echo esc_attr($value); ?> />

                        <strong><em><?php esc_html_e( 'Make this Item Mega Menu?', 'santos' ); ?></em></strong>

                    </label>

                </p>

				

				

				<p class="field-custom field-megamenu-cols description description-wide">

	                			<label for="edit-menu-item-megamenu-cols-<?php echo esc_attr($item_id); ?>">

	                    		<?php esc_html_e( 'Megamenu Columns', 'santos' ); ?><br />

								<select id="edit-menu-item-megamenu-cols<?php echo esc_attr($item_id); ?>" name="menu-item-megamenu_cols[<?php echo esc_attr($item_id); ?>]">

									<option value="" <?php if(esc_attr($item->megamenu_cols) == ""){echo 'selected="selected"';} ?>></option>

									<option value="columns_3" <?php if(esc_attr($item->megamenu_cols) == "columns_3"){echo 'selected="selected"';} ?>>3 Columns</option>

									<option value="columns_4" <?php if(esc_attr($item->megamenu_cols) == "columns_4"){echo 'selected="selected"';} ?>>4 Columns</option>


								</select>

				                </label>

				</p>

				

							

				<?php

	            /* New fields end here */

	            ?>			



				<p class="field-move hide-if-no-js description description-wide">

					<label>

						<span><?php esc_html_e( 'Move','santos' ); ?></span>

						<a href="#" class="menus-move-up"><?php esc_html_e( 'Up one','santos' ); ?></a>

						<a href="#" class="menus-move-down"><?php esc_html_e( 'Down one','santos' ); ?></a>

						<a href="#" class="menus-move-left"></a>

						<a href="#" class="menus-move-right"></a>

						<a href="#" class="menus-move-top"><?php esc_html_e( 'To the top','santos' ); ?></a>

					</label>

				</p>



				<div class="menu-item-actions description-wide submitbox">

					<?php if( 'custom' != $item->type && $original_title !== false ) : ?>

						<p class="link-to-original">

							<?php printf( esc_html__('Original: %s','santos'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>

						</p>

					<?php endif; ?>

					<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php

					echo wp_nonce_url(

						add_query_arg(

							array(

								'action' => 'delete-menu-item',

								'menu-item' => $item_id,

							),

							admin_url( 'nav-menus.php' )

						),

						'delete-menu_item_' . $item_id

					); ?>"><?php esc_html_e( 'Remove','santos' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );

						?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php esc_html_e('Cancel','santos'); ?></a>

				</div>



				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />

				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />

				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />

				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />

				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />

				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />

			</div><!-- .menu-item-settings-->

			<ul class="menu-item-transport"></ul>

		<?php

		$output .= ob_get_clean();

	}



}
