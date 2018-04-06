<?php
if ( ! function_exists('kloe_qodef_contact_form_map') ) {
	/**
	 * Map Contact Form 7 shortcode
	 * Hooks on vc_after_init action
	 */
	function kloe_qodef_contact_form_map()
	{

		vc_add_param('contact-form-7', array(
			'type' => 'dropdown',
			'heading' => 'Style',
			'param_name' => 'html_class',
			'value' => array(
				'Default' => 'default',
				'Custom Style 1' => 'cf7_custom_style_1',
				'Custom Style 2' => 'cf7_custom_style_2'
			),
			'description' => 'You can style each form element individually in Qode Options > Contact Form 7'
		));

	}
	add_action('vc_after_init', 'kloe_qodef_contact_form_map');
}
?>