<?php
/**
 * JetWooBuilder tools class
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Jet_Woo_Builder_Tools' ) ) {

	/**
	 * Define Jet_Woo_Builder_Tools class
	 */
	class Jet_Woo_Builder_Tools {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Returns disable columns gap nad rows gap classes string
		 *
		 * @param string $use_cols_gap [description]
		 * @param string $use_rows_gap [description]
		 *
		 * @return string
		 */
		public function gap_classes( $use_cols_gap = 'yes', $use_rows_gap = 'yes' ) {

			$result = array();

			foreach ( array( 'cols' => $use_cols_gap, 'rows' => $use_rows_gap ) as $element => $value ) {
				if ( 'yes' !== $value ) {
					$result[] = sprintf( 'disable-%s-gap', $element );
				}
			}

			return implode( ' ', $result );

		}

		/**
		 * Returns image size array in slug => name format
		 *
		 * @return array
		 */
		public function get_image_sizes() {

			global $_wp_additional_image_sizes;

			$sizes  = get_intermediate_image_sizes();
			$result = array();

			foreach ( $sizes as $size ) {
				if ( in_array( $size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
					$result[ $size ] = ucwords( trim( str_replace( array( '-', '_' ), array( ' ', ' ' ), $size ) ) );
				} else {
					$result[ $size ] = sprintf(
						'%1$s (%2$sx%3$s)',
						ucwords( trim( str_replace( array( '-', '_' ), array( ' ', ' ' ), $size ) ) ),
						$_wp_additional_image_sizes[ $size ]['width'],
						$_wp_additional_image_sizes[ $size ]['height']
					);
				}
			}

			return array_merge( array( 'full' => esc_html__( 'Full', 'jet-woo-builder' ), ), $result );

		}

		/**
		 * Get categories list.
		 *
		 * @return array
		 */
		public function get_categories() {

			$categories = get_categories();

			if ( empty( $categories ) || ! is_array( $categories ) ) {
				return array();
			}

			return wp_list_pluck( $categories, 'name', 'term_id' );

		}

		/**
		 * Returns allowed order by fields for options
		 *
		 * @return array
		 */
		public function orderby_arr() {
			return [
				'default'      => esc_html__( 'Date', 'jet-woo-builder' ),
				'modified'     => esc_html__( 'Modified Date', 'jet-woo-builder' ),
				'id'           => esc_html__( 'ID', 'jet-woo-builder' ),
				'price'        => esc_html__( 'Price', 'jet-woo-builder' ),
				'title'        => esc_html__( 'Title', 'jet-woo-builder' ),
				'rand'         => esc_html__( 'Random', 'jet-woo-builder' ),
				'sales'        => esc_html__( 'Sales', 'jet-woo-builder' ),
				'rated'        => esc_html__( 'Top Rated', 'jet-woo-builder' ),
				'menu_order'   => esc_html__( 'Menu Order', 'jet-woo-builder' ),
				'sku'          => esc_html__( 'SKU', 'jet-woo-builder' ),
				'current'      => esc_html__( 'Current', 'jet-woo-builder' ),
				'stock_status' => esc_html__( 'Stock Status', 'jet-woo-builder' ),
			];
		}

		/**
		 * Returns allowed order fields for options
		 *
		 * @return array
		 */
		public function order_arr() {
			return [
				'desc' => esc_html__( 'DESC', 'jet-woo-builder' ),
				'asc'  => esc_html__( 'ASC', 'jet-woo-builder' ),
			];
		}

		/**
		 * Returns allowed vertical alignment for options
		 *
		 * @return array
		 */
		public function vertical_align_attr() {
			return [
				'baseline'    => esc_html__( 'Baseline', 'jet-woo-builder' ),
				'top'         => esc_html__( 'Top', 'jet-woo-builder' ),
				'middle'      => esc_html__( 'Middle', 'jet-woo-builder' ),
				'bottom'      => esc_html__( 'Bottom', 'jet-woo-builder' ),
				'sub'         => esc_html__( 'Sub', 'jet-woo-builder' ),
				'super'       => esc_html__( 'Super', 'jet-woo-builder' ),
				'text-top'    => esc_html__( 'Text Top', 'jet-woo-builder' ),
				'text-bottom' => esc_html__( 'Text Bottom', 'jet-woo-builder' ),
			];
		}

		/**
		 * Returns available directions types
		 *
		 * @return array
		 */
		public function get_available_direction_types() {
			return [
				'horizontal' => esc_html__( 'Horizontal', 'jet-woo-builder' ),
				'vertical'   => esc_html__( 'Vertical', 'jet-woo-builder' ),
			];
		}

		/**
		 * Returns array with numbers in $index => $name format for numeric selects
		 *
		 * @param integer $to Max numbers
		 *
		 * @return array
		 */
		public function get_select_range( $to = 10 ) {

			$range = range( 1, $to );

			return array_combine( $range, $range );

		}

		/**
		 * Return attributes string from attributes array.
		 *
		 * @param array $attr Attributes string.
		 *
		 * @return string
		 */
		public function get_attr_string( $attr = array() ) {

			if ( empty( $attr ) || ! is_array( $attr ) ) {
				return null;
			}

			$result = '';

			foreach ( $attr as $key => $value ) {
				$result .= sprintf( ' %s="%s"', esc_attr( $key ), esc_attr( $value ) );
			}

			return $result;

		}

		/**
		 * Returns carousel arrow
		 *
		 * @param array $classes Arrow additional classes list.
		 *
		 * @return string
		 */
		public function get_carousel_arrow( $classes, $html ) {
			$format = apply_filters( 'jet_woo_builder/carousel/arrows_format', '<div class="%s jet-arrow">%s</div>' );

			return sprintf( $format, implode( ' ', $classes ), htmlspecialchars_decode( $html ) );
		}

		/**
		 * Get post types options list
		 *
		 * @return array
		 */
		public function get_post_types() {

			$post_types = get_post_types( array( 'public' => true ), 'objects' );

			$deprecated = apply_filters(
				'jet-woo-builder/post-types-list/deprecated',
				array( 'attachment', 'elementor_library' )
			);

			$result = array();

			if ( empty( $post_types ) ) {
				return $result;
			}

			foreach ( $post_types as $slug => $post_type ) {
				if ( in_array( $slug, $deprecated ) ) {
					continue;
				}

				$result[ $slug ] = $post_type->label;
			}

			return $result;

		}

		/**
		 * Return available rating icon list
		 *
		 * @return mixed|void
		 */
		public function get_available_rating_icons_list() {
			return apply_filters(
				'jet_woo_builder/available_rating_list/icons',
				array(
					'jetwoo-front-icon-rating-1'  => esc_html__( 'Rating 1', 'jet-woo-builder' ),
					'jetwoo-front-icon-rating-2'  => esc_html__( 'Rating 2', 'jet-woo-builder' ),
					'jetwoo-front-icon-rating-3'  => esc_html__( 'Rating 3', 'jet-woo-builder' ),
					'jetwoo-front-icon-rating-4'  => esc_html__( 'Rating 4', 'jet-woo-builder' ),
					'jetwoo-front-icon-rating-5'  => esc_html__( 'Rating 5', 'jet-woo-builder' ),
					'jetwoo-front-icon-rating-6'  => esc_html__( 'Rating 6', 'jet-woo-builder' ),
					'jetwoo-front-icon-rating-7'  => esc_html__( 'Rating 7', 'jet-woo-builder' ),
					'jetwoo-front-icon-rating-8'  => esc_html__( 'Rating 8', 'jet-woo-builder' ),
					'jetwoo-front-icon-rating-9'  => esc_html__( 'Rating 9', 'jet-woo-builder' ),
					'jetwoo-front-icon-rating-10' => esc_html__( 'Rating 10', 'jet-woo-builder' ),
					'jetwoo-front-icon-rating-11' => esc_html__( 'Rating 11', 'jet-woo-builder' ),
					'jetwoo-front-icon-rating-12' => esc_html__( 'Rating 12', 'jet-woo-builder' ),
					'jetwoo-front-icon-rating-13' => esc_html__( 'Rating 13', 'jet-woo-builder' ),
					'jetwoo-front-icon-rating-14' => esc_html__( 'Rating 14', 'jet-woo-builder' ),
				)
			);
		}

		/**
		 * Available down icon list.
		 *
		 * Return available arrows list.
		 *
		 * @since  1.13.0
		 * @access public
		 *
		 * @return array
		 */
		public function get_available_down_arrows_list() {
			return apply_filters(
				'jet-woo-builder/product-ordering/select-arrow/icons',
				[
					'angle'          => __( 'Angle', 'jet-woo-builder' ),
					'chevron'        => __( 'Chevron', 'jet-woo-builder' ),
					'angle-double'   => __( 'Angle Double', 'jet-woo-builder' ),
					'arrow'          => __( 'Arrow', 'jet-woo-builder' ),
					'caret'          => __( 'Caret', 'jet-woo-builder' ),
					'arrow-circle'   => __( 'Arrow Circle', 'jet-woo-builder' ),
					'chevron-circle' => __( 'Chevron Circle', 'jet-woo-builder' ),
					'caret-square'   => __( 'Caret Square', 'jet-woo-builder' ),
				]
			);
		}

		/**
		 * Apply carousel wrappers for shortcode content if carousel is enabled.
		 *
		 * @param string $content  Module content.
		 * @param array  $settings Module settings.
		 *
		 * @return string
		 */
		public function get_carousel_wrapper_atts( $content = null, $settings = [] ) {

			if ( 'yes' !== $settings['carousel_enabled'] ) {
				return $content;
			}

			$carousel_settings = [
				'columns'               => isset( $settings['columns'] ) ? $settings['columns'] : 4,
				'carousel_direction'    => isset( $settings['carousel_direction'] ) ? $settings['carousel_direction'] : 'horizontal',
				'slides_to_scroll'      => isset( $settings['slides_to_scroll'] ) && '1' !== $settings['columns'] ? $settings['slides_to_scroll'] : 1,
				'simulate_touch'        => isset( $settings['simulate_touch'] ) ? filter_var( $settings['simulate_touch'], FILTER_VALIDATE_BOOLEAN ) : false,
				'arrows'                => isset( $settings['arrows'] ) ? filter_var( $settings['arrows'], FILTER_VALIDATE_BOOLEAN ) : false,
				'prev_arrow'            => isset( $settings['prev_arrow'] ) ? $settings['prev_arrow'] : '',
				'next_arrow'            => isset( $settings['next_arrow'] ) ? $settings['next_arrow'] : '',
				'dots'                  => isset( $settings['dots'] ) ? filter_var( $settings['dots'], FILTER_VALIDATE_BOOLEAN ) : false,
				'autoplay'              => isset( $settings['autoplay'] ) ? filter_var( $settings['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
				'autoplay_speed'        => isset( $settings['autoplay_speed'] ) ? $settings['autoplay_speed'] : 5000,
				'pause_on_interactions' => isset( $settings['pause_on_interactions'] ) ? filter_var( $settings['pause_on_interactions'], FILTER_VALIDATE_BOOLEAN ) : false,
				'infinite'              => isset( $settings['infinite'] ) ? filter_var( $settings['infinite'], FILTER_VALIDATE_BOOLEAN ) : false,
				'freemode'              => isset( $settings['freemode'] ) ? filter_var( $settings['freemode'], FILTER_VALIDATE_BOOLEAN ) : false,
				'freemode_velocity'     => isset( $settings['freemode_velocity'] ) ? $settings['freemode_velocity'] : 0.02,
				'centered'              => isset( $settings['centered'] ) ? filter_var( $settings['centered'], FILTER_VALIDATE_BOOLEAN ) : false,
				'effect'                => isset( $settings['effect'] ) ? $settings['effect'] : 'slide',
				'speed'                 => isset( $settings['speed'] ) ? $settings['speed'] : 500,
			];

			$carousel_settings = apply_filters( 'jet-woo-builder/tools/carousel/pre-options', $carousel_settings, $settings );

			$options = [
				'direction'        => $carousel_settings['carousel_direction'],
				'slidesPerGroup'   => absint( $carousel_settings['slides_to_scroll'] ),
				'simulateTouch'    => $carousel_settings['simulate_touch'],
				'loop'             => $carousel_settings['infinite'],
				'freeMode'         => $carousel_settings['freemode'],
				'centeredSlides'   => $carousel_settings['centered'],
				'speed'            => absint( $carousel_settings['speed'] ),
				'paginationEnable' => $carousel_settings['dots'],
				'navigationEnable' => $carousel_settings['arrows'],
			];

			if ( $carousel_settings['freemode'] ) {
				$options['freeModeMinimumVelocity'] = $carousel_settings['freemode_velocity'];
			}

			if ( $carousel_settings['autoplay'] ) {
				$options['autoplay'] = [
					'delay'                => $carousel_settings['autoplay_speed'],
					'disableOnInteraction' => $carousel_settings['pause_on_interactions'],
				];
			}

			if ( 1 === absint( $carousel_settings['columns'] && 'fade' === $carousel_settings['effect'] ) ) {
				$options['effect'] = $carousel_settings['effect'];
			}

			$options           = apply_filters( 'jet-woo-builder/tools/carousel/options', $options, $settings );
			$pagination        = $carousel_settings['dots'] ? '<div class="swiper-pagination"></div>' : '';
			$swiper_prev_arrow = $carousel_settings['arrows'] ? $this->get_carousel_arrow( [ 'prev-arrow', 'jet-swiper-button-prev' ], $carousel_settings['prev_arrow'] ) : '';
			$swiper_next_arrow = $carousel_settings['arrows'] ? $this->get_carousel_arrow( [ 'next-arrow', 'jet-swiper-button-next' ], $carousel_settings['next_arrow'] ) : '';
			$is_rtl            = is_rtl() ? 'rtl' : 'ltr';

			return sprintf(
				'<div class="jet-woo-carousel swiper-container %7$s" data-slider_options="%1$s" dir="%6$s"> %2$s %3$s %4$s %5$s </div>',
				htmlspecialchars( json_encode( $options ) ), $content, $pagination, $swiper_prev_arrow, $swiper_next_arrow, $is_rtl, $carousel_settings['carousel_direction']
			);

		}

		/**
		 * Get term permalink.
		 *
		 * @since  1.0.0
		 * @return string
		 */
		public function get_term_permalink( $id = 0 ) {
			return esc_url( get_category_link( $id ) );
		}

		/**
		 * Trim text
		 *
		 * @since  1.0.0
		 *
		 * @param int    $length
		 * @param string $trimmed_type
		 * @param        $after
		 *
		 * @param string $text
		 *
		 * @return string
		 */
		public function trim_text( $text = '', $length = -1, $trimmed_type = 'word', $after = '' ) {

			$length = intval( $length );

			if ( '' === $text ) {
				return '';
			}

			if ( 0 === $length ) {
				return '';
			}

			if ( -1 !== $length ) {
				if ( 'word' === $trimmed_type ) {
					$text = wp_trim_words( $text, $length, $after );
				} else {
					$text = wp_html_excerpt( $text, $length, $after );
				}
			}

			return $text;

		}

		/**
		 * Return builder saved content status
		 *
		 * @return bool
		 */
		public function is_builder_content_save() {

			if ( ! isset( $_REQUEST['action'] ) || 'elementor_ajax' !== $_REQUEST['action'] ) {
				return false;
			}

			if ( empty( $_REQUEST['actions'] ) ) {
				return false;
			}

			if ( false === strpos( $_REQUEST['actions'], 'save_builder' ) ) {
				return false;
			}

			return true;

		}

		/**
		 * Return available HTML title tags list
		 *
		 * @return array
		 */
		public function get_available_title_html_tags() {
			return array(
				'h1'   => esc_html__( 'H1', 'jet-woo-builder' ),
				'h2'   => esc_html__( 'H2', 'jet-woo-builder' ),
				'h3'   => esc_html__( 'H3', 'jet-woo-builder' ),
				'h4'   => esc_html__( 'H4', 'jet-woo-builder' ),
				'h5'   => esc_html__( 'H5', 'jet-woo-builder' ),
				'h6'   => esc_html__( 'H6', 'jet-woo-builder' ),
				'div'  => esc_html__( 'div', 'jet-woo-builder' ),
				'span' => esc_html__( 'span', 'jet-woo-builder' ),
				'p'    => esc_html__( 'p', 'jet-woo-builder' ),
			);
		}

		/**
		 * Return available title trim types
		 *
		 * @return array
		 */
		public function get_available_title_trim_types() {
			return array(
				'word'    => esc_html__( 'Words', 'jet-woo-builder' ),
				'letters' => esc_html__( 'Letters', 'jet-woo-builder' ),
			);
		}

		/**
		 * Returns available display types
		 *
		 * @return array
		 */
		public function get_available_display_types() {
			return [
				'block'        => esc_html__( 'Block', 'jet-woo-builder' ),
				'inline-block' => esc_html__( 'Inline', 'jet-woo-builder' ),
			];
		}

		/**
		 * Returns available flex-directions types
		 *
		 * @return array
		 */
		public function get_available_flex_directions_types() {
			return [
				'column' => esc_html__( 'Block', 'jet-woo-builder' ),
				'row'    => esc_html__( 'Inline', 'jet-woo-builder' ),
			];
		}

		/**
		 * Returns available horizontal align types
		 *
		 * @param bool $is_text
		 *
		 * @return array
		 */
		public function get_available_h_align_types( $is_text = false ) {

			$align_types = [
				'left'   => [
					'title' => esc_html__( 'Left', 'jet-woo-builder' ),
					'icon'  => 'eicon-text-align-left',
				],
				'center' => [
					'title' => esc_html__( 'Center', 'jet-woo-builder' ),
					'icon'  => 'eicon-text-align-center',
				],
				'right'  => [
					'title' => esc_html__( 'Right', 'jet-woo-builder' ),
					'icon'  => 'eicon-text-align-right',
				],
			];

			if ( $is_text ) {
				$align_types['justify'] = [
					'title' => esc_html__( 'Justified', 'jet-woo-builder' ),
					'icon'  => 'eicon-text-align-justify',
				];
			}

			return $align_types;

		}

		/**
		 * Returns available vertical align types
		 *
		 * @return array
		 */
		public function get_available_v_align_types() {
			return [
				'top'    => [
					'title' => esc_html__( 'Top', 'jet-woo-builder' ),
					'icon'  => 'eicon-v-align-top',
				],
				'middle' => [
					'title' => esc_html__( 'Middle', 'jet-woo-builder' ),
					'icon'  => 'eicon-v-align-middle',
				],
				'bottom' => [
					'title' => esc_html__( 'Bottom', 'jet-woo-builder' ),
					'icon'  => 'eicon-v-align-bottom',
				],
			];
		}

		/**
		 * Flex horizontal align types.
		 *
		 * Returns available flex horizontal align types.
		 *
		 * @since  2.0.0
		 * @access public
		 *
		 * @param bool $is_justify
		 *
		 * @return array
		 */
		public function get_available_flex_h_align_types( $is_justify = false ) {

			$align_types = [
				'flex-start' => [
					'title' => __( 'Start', 'jet-woo-builder' ),
					'icon'  => ! is_rtl() ? 'eicon-align-start-h' : 'eicon-align-end-h',
				],
				'center'     => [
					'title' => __( 'Center', 'jet-woo-builder' ),
					'icon'  => 'eicon-align-center-h',
				],
				'flex-end'   => [
					'title' => __( 'End', 'jet-woo-builder' ),
					'icon'  => ! is_rtl() ? 'eicon-align-end-h' : 'eicon-align-start-h',
				],
			];

			if ( $is_justify ) {
				$align_types['space-between'] = [
					'title' => __( 'Justify', 'jet-woo-builder' ),
					'icon'  => 'eicon-align-stretch-h',
				];
			}

			return $align_types;

		}

		/**
		 * Returns available text decoration types
		 *
		 * @return array
		 */
		public function get_available_text_decoration_types() {
			return [
				'none'         => esc_html__( 'None', 'jet-woo-builder' ),
				'line-through' => esc_html__( 'Line Through', 'jet-woo-builder' ),
				'underline'    => esc_html__( 'Underline', 'jet-woo-builder' ),
				'overline'     => esc_html__( 'Overline', 'jet-woo-builder' ),
			];
		}

		/**
		 * Returns available font weight types
		 *
		 * @return array
		 */
		public function get_available_font_weight_types() {
			return [
				'100' => esc_html__( '100', 'jet-woo-builder' ),
				'200' => esc_html__( '200', 'jet-woo-builder' ),
				'300' => esc_html__( '300', 'jet-woo-builder' ),
				'400' => esc_html__( '400', 'jet-woo-builder' ),
				'500' => esc_html__( '500', 'jet-woo-builder' ),
				'600' => esc_html__( '600', 'jet-woo-builder' ),
				'700' => esc_html__( '700', 'jet-woo-builder' ),
				'800' => esc_html__( '800', 'jet-woo-builder' ),
				'900' => esc_html__( '900', 'jet-woo-builder' ),
			];
		}

		/**
		 * Get product categories.
		 *
		 * Returns the full list of products categories.
		 *
		 * @since  1.9.0
		 * @since  2.0.3 `get_terms()` method parameters changed.
		 *
		 * @access public
		 *
		 * @return array
		 */
		public function get_product_categories() {

			$categories = get_terms( [
				'taxonomy'   => 'product_cat',
				'hide_empty' => false,
			] );

			if ( empty( $categories ) || ! is_array( $categories ) ) {
				return array();
			}

			return wp_list_pluck( $categories, 'name', 'term_id' );

		}

		/**
		 * Get product tags.
		 *
		 * Returns the list of products tags.
		 *
		 * @since  1.9.0
		 *
		 * @access public
		 *
		 * @return array
		 */
		public function get_product_tags() {

			$tags = get_terms( 'product_tag' );

			if ( empty( $tags ) || ! is_array( $tags ) ) {
				return array();
			}

			return wp_list_pluck( $tags, 'name', 'term_id' );

		}

		/**
		 * Checkout forms field types.
		 *
		 * Returns checkout forms field types depending on WooCommerce Customizer settings.
		 *
		 * @return array
		 */
		public function get_checkout_forms_field_type_options() {

			$options = [
				'first_name' => __( 'First Name', 'jet-woo-builder' ),
				'last_name'  => __( 'Last Name', 'jet-woo-builder' ),
				'country'    => __( 'Country', 'jet-woo-builder' ),
				'address_1'  => __( 'Street address', 'jet-woo-builder' ),
				'city'       => __( 'Town / City', 'jet-woo-builder' ),
				'state'      => __( 'District', 'jet-woo-builder' ),
				'postcode'   => __( 'Postcode / ZIP', 'jet-woo-builder' ),
				'email'      => __( 'Email', 'jet-woo-builder' ),
			];

			if ( 'hidden' !== get_option( 'woocommerce_checkout_company_field', 'optional' ) ) {
				$options['company'] = __( 'Company', 'jet-woo-builder' );
			}

			if ( 'hidden' !== get_option( 'woocommerce_checkout_address_2_field', 'optional' ) ) {
				$options['address_2'] = __( 'Apartment address', 'jet-woo-builder' );
			}

			if ( 'hidden' !== get_option( 'woocommerce_checkout_phone_field', 'required' ) ) {
				$options['phone'] = __( 'Phone', 'jet-woo-builder' );
			}

			return $options;

		}

		/**
		 * Checkout forms default field set.
		 *
		 * Returns checkout default forms field set depending on WooCommerce Customizer settings and fields group.
		 *
		 * @param string $fields_group
		 *
		 * @return array[]
		 */
		public function get_checkout_forms_default_fields_set( $fields_group = 'billing' ) {

			$fields = [
				[
					'field_key'           => 'first_name',
					'field_label'         => __( 'First Name', 'jet-woo-builder' ),
					'field_placeholder'   => '',
					'field_default_value' => '',
					'field_validation'    => '',
					'field_class'         => [ 'form-row-first' ],
					'field_required'      => 'yes',
				],
				[
					'field_key'           => 'last_name',
					'field_label'         => __( 'Last Name', 'jet-woo-builder' ),
					'field_placeholder'   => '',
					'field_default_value' => '',
					'field_validation'    => '',
					'field_class'         => [ 'form-row-last' ],
					'field_required'      => 'yes',
				],
				[
					'field_key'           => 'country',
					'field_label'         => __( 'Country', 'jet-woo-builder' ),
					'field_placeholder'   => '',
					'field_default_value' => '',
					'field_validation'    => '',
					'field_class'         => [ 'form-row-wide', 'address-field', 'update_totals_on_change' ],
					'field_required'      => 'yes',
				],
				[
					'field_key'           => 'address_1',
					'field_label'         => __( 'Street address', 'jet-woo-builder' ),
					'field_placeholder'   => '',
					'field_default_value' => '',
					'field_validation'    => '',
					'field_class'         => [ 'form-row-wide', 'address-field' ],
					'field_required'      => 'yes',
				],
				[
					'field_key'           => 'city',
					'field_label'         => __( 'Town / City', 'jet-woo-builder' ),
					'field_placeholder'   => '',
					'field_default_value' => '',
					'field_validation'    => '',
					'field_class'         => [ 'form-row-wide', 'address-field' ],
					'field_required'      => 'yes',
				],
				[
					'field_key'           => 'state',
					'field_label'         => __( 'State / County', 'jet-woo-builder' ),
					'field_placeholder'   => '',
					'field_default_value' => '',
					'field_validation'    => [ 'state' ],
					'field_class'         => [ 'form-row-wide', 'address-field' ],
					'field_required'      => '',
				],
				[
					'field_key'           => 'postcode',
					'field_label'         => __( 'Postcode / ZIP', 'jet-woo-builder' ),
					'field_placeholder'   => '',
					'field_default_value' => '',
					'field_validation'    => [ 'postcode' ],
					'field_class'         => [ 'form-row-wide', 'address-field' ],
					'field_required'      => 'yes',
				],
			];

			if ( 'hidden' !== get_option( 'woocommerce_checkout_company_field', 'optional' ) ) {
				$fields[] = [
					'field_key'           => 'company',
					'field_label'         => __( 'Company name', 'jet-woo-builder' ),
					'field_placeholder'   => '',
					'field_default_value' => '',
					'field_validation'    => '',
					'field_class'         => [ 'form-row-wide' ],
					'field_required'      => '',
				];
			}

			if ( 'hidden' !== get_option( 'woocommerce_checkout_address_2_field', 'optional' ) ) {
				$fields[] = [
					'field_key'           => 'address_2',
					'field_label'         => __( 'Apartment address', 'jet-woo-builder' ),
					'field_placeholder'   => __( 'Apartment, suite, unit etc. (optional)', 'jet-woo-builder' ),
					'field_default_value' => '',
					'field_validation'    => '',
					'field_class'         => [ 'form-row-wide', 'address-field' ],
					'field_required'      => '',
				];
			}

			if ( 'billing' === $fields_group ) {
				if ( 'hidden' !== get_option( 'woocommerce_checkout_phone_field', 'required' ) ) {
					$fields[] = [
						'field_key'           => 'phone',
						'field_label'         => __( 'Phone', 'jet-woo-builder' ),
						'field_placeholder'   => '',
						'field_default_value' => '',
						'field_validation'    => [ 'phone' ],
						'field_class'         => [ 'form-row-wide' ],
						'field_required'      => 'yes',
					];
				}

				$fields[] = [
					'field_key'           => 'email',
					'field_label'         => __( 'Email address', 'jet-woo-builder' ),
					'field_placeholder'   => '',
					'field_default_value' => '',
					'field_validation'    => [ 'email' ],
					'field_class'         => [ 'form-row-wide' ],
					'field_required'      => 'yes',
				];
			}

			return $fields;

		}

		/**
		 * WooCommerce actions.
		 *
		 * Return list of WooCommerce actions based on template where it used.
		 *
		 * @since  2.0.0
		 * @access public
		 *
		 * @return array
		 */
		public function get_woocommerce_actions() {
			return [
				[
					'label'   => __( 'Single Product', 'jet-woo-builder' ),
					'options' => [
						'woocommerce_before_single_product_summary' => __( 'Before Summary', 'jet-woo-builder' ),
						'woocommerce_single_product_summary'        => __( 'Summary', 'jet-woo-builder' ),
						'woocommerce_after_single_product_summary'  => __( 'After Summary', 'jet-woo-builder' ),
					],
				],
				[
					'label'   => __( 'Shop Loop', 'jet-woo-builder' ),
					'options' => [
						'woocommerce_before_shop_loop_item'       => __( 'Before Item', 'jet-woo-builder' ),
						'woocommerce_before_shop_loop_item_title' => __( 'Before Item Title', 'jet-woo-builder' ),
						'woocommerce_shop_loop_item_title'        => __( 'Item Title', 'jet-woo-builder' ),
						'woocommerce_after_shop_loop_item_title'  => __( 'After Item Title', 'jet-woo-builder' ),
						'woocommerce_after_shop_loop_item'        => __( 'After Item', 'jet-woo-builder' ),
					],
				],
			];
		}

		/**
		 * Additional HTML tags validation
		 *
		 * @param $input
		 *
		 * @return mixed|string
		 */
		public function sanitize_html_tag( $input ) {
			$available_tags = [ 'div', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'span', 'a', 'section', 'header', 'footer', 'main', 'b', 'em', 'i', 'nav', 'article', 'aside' ];

			return in_array( strtolower( $input ), $available_tags ) ? $input : 'div';
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 *
		 * @param array $shortcodes
		 *
		 * @return object
		 */
		public static function get_instance( $shortcodes = array() ) {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self( $shortcodes );
			}

			return self::$instance;

		}

	}

}

/**
 * Returns instance of Jet_Woo_Builder_Tools
 *
 * @return object
 */
function jet_woo_builder_tools() {
	return Jet_Woo_Builder_Tools::get_instance();
}
