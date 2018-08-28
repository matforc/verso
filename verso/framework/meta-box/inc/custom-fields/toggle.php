<?php

// Prevent loading this file directly

defined( 'ABSPATH' ) || exit;



if ( ! class_exists( 'RWMB_santos_toggle_Field' ) )

{

	class RWMB_santos_toggle_Field extends RWMB_Field

	{

		/**

		 * Get field HTML

		 *

		 * @param mixed $meta

		 * @param array $field

		 *

		 * @return string

		 */

		static function html( $meta, $field )

		{

		


 
	
			return sprintf(

				'<span class="santos-toggle-button">

				<span class="toggle-handle"></span><input type="hidden" class="rwmb-toggle" name="%s" id="%s" value="%s" placeholder="%s" size="%s" %s>%s</span>',

				$field['field_name'],

				$field['id'],

				$meta,

				$field['placeholder'],

				30,

				'',

				''

			);

		}



		/**

		 * Normalize parameters for field

		 *

		 * @param array $field

		 *

		 * @return array

		 */

		static function normalize_field( $field )

		{

			$field = wp_parse_args( $field, array(

				'size'        => 30,

				'datalist'    => false,

				'placeholder' => '',

			) );



			return $field;

		}



		/**

		 * Create datalist, if any

		 *

		 * @param array $field

		 *

		 * @return array

		 */



	}

}

