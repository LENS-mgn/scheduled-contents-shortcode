<?php
/**
 * DateTime field for Shortcode UI (Shortcake Support.)
 *
 * @package Scheduled_Contents_Shortcode
 */

namespace Scheduled_Contents_Shortcode;

/**
 * Class ShortcodeUI
 */
class Shortcake_Datetime_Field {

	/**
	 * ShortcodeUI constructor.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_scripts' ] );
		add_filter( 'shortcode_ui_fields', [ $this, 'shortcode_ui_fields' ] );
		add_action( 'print_shortcode_ui_templates', [ $this, 'print_shortcode_ui_templates' ] );
	}

	/**
	 * Admin Style.
	 */
	public function admin_enqueue_scripts() {
		wp_enqueue_style( 'scheduled-contents-shortcode', plugins_url( 'assets/admin.css', PLUGIN_PATH ) );
	}

	/**
	 * Print Theme for
	 */
	public function print_shortcode_ui_templates() {
		?>
		<script type="text/html" id="tmpl-shortcode-ui-field-datetime-local">
			<div class="field-block shortcode-ui-field-datetime-local shortcode-ui-attribute-{{ data.attr }}">
				<label for="{{ data.id }}">{{{ data.label }}}</label>
				<input type="datetime-local" name="{{ data.attr }}" id="{{ data.id }}" value="{{ data.value }}" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}" {{{ data.meta }}}/>
				<span class="validity">
					<span class="dashicons dashicons-no"></span><span class="dashicons dashicons-yes"></span>
				</span>
				<# if ( typeof data.description == 'string' && data.description.length ) { #>
					<p class="description">{{{ data.description }}}</p>
					<# } #>
			</div>
		</script>

		<?php
	}

	/**
	 * Add datetime support.
	 *
	 * @param array $fields ui settings.
	 *
	 * @return array
	 */
	public function shortcode_ui_fields( array $fields ) {
		return array_merge( $fields, [
			'datetime-local' => array(
				'template' => 'shortcode-ui-field-datetime-local',
			),
		] );
	}
}
