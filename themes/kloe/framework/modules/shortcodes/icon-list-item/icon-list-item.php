<?php
namespace KloeQodef\Modules\IconListItem;

use KloeQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Icon List Item
 */

class IconListItem implements ShortcodeInterface{
	/**
	 * @var string
	 */
	private $base;
	function __construct() {
		$this->base = 'qodef_icon_list_item';
		
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}
	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	
	public function vcMap() {
		vc_map( array(
			'name' => 'Icon List Item',
			'base' => $this->base,
			'icon' => 'icon-wpb-icon-list-item extended-custom-icon',
			'category' => 'by SELECT',
			'params' => array_merge(
				\KloeQodefIconCollections::get_instance()->getVCParamsArray(),
				array(
					array(
						'type' => 'textfield',
						'heading' => 'Icon Size (px)',
						'param_name' => 'icon_size',
						'description' => ''
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Icon Color',
						'param_name' => 'icon_color',
						'description' => ''
					),
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => 'Title',
						'param_name' => 'title',
						'description' => ''
					),
					array(
						'type' => 'textfield',
						'heading' => 'Title size (px)',
						'param_name' => 'title_size',
						'description' => '',
						'dependency' => Array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Title Color',
						'param_name' => 'title_color',
						'description' => '',
						'dependency' => Array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Link Item',
						'param_name'  => 'link_item',
						'admin_label' => true,
						'value'       => array(
							'No'  => 'no',
							'Yes' => 'yes'
						),
						'save_always' => true,
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Title Hover Color',
						'param_name' => 'title_hover_color',
						'description' => '',
						'dependency' => Array('element' => 'link_item', 'value' => 'yes')
					),
					array(
						'type'        => 'textfield',
						'heading'     => 'Link',
						'param_name'  => 'link',
						'value'       => '',
						'admin_label' => true,
						'dependency'  => array('element' => 'link_item', 'value' => 'yes')
					),
					array(
						'type'        => 'checkbox',
						'heading'     => 'Use Link as Anchor',
						'value'       => array('Use this icon as Anchor?' => 'yes'),
						'param_name'  => 'anchor_link',
						'admin_label' => true,
						'description' => 'Check this box to use icon as anchor link (eg. #contact)',
						'dependency'  => Array('element' => 'link', 'not_empty' => true)
					),
					array(
						'type'        => 'dropdown',
						'heading'     => 'Link Target',
						'param_name'  => 'target',
						'admin_label' => true,
						'value'       => array(
							'Self'  => '_self',
							'Blank' => '_blank'
						),
						'save_always' => true,
						'dependency'  => array('element' => 'link', 'not_empty' => true)
					)
				)
			)
		) );

	}
	
	public function render($atts, $content = null) {
		$args = array(
            'icon_size' => '',
            'icon_color' => '',
            'title' => '',
            'title_color' => '',
            'title_size' => '',
            'link_item' => 'no',
            'title_hover_color' => '',
            'anchor_link' => '',
            'link' => '',
            'target' => '_self',
        );

        $args = array_merge($args, kloe_qodef_icon_collections()->getShortcodeParams());
		
        $params = shortcode_atts($args, $atts);
		
		//Extract params for use in method
		extract($params);
		$iconPackName = kloe_qodef_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$iconClasses = '';
		$linkClasses = 'qodef-icon-list-text ';

		//generate icon holder classes
		$iconClasses .= 'qodef-icon-list-item-icon ';
		$iconClasses .= $params['icon_pack'];
		$linkClasses .= $this->getLinkClass($params);

		
		$params['icon_classes'] = $iconClasses;
		$params['icon'] = $params[$iconPackName];		
		$params['icon_attributes']['style'] =  $this->getIconStyle($params);		
		$params['title_style'] =  $this->getTitleStyle($params);
		$params['link_class'] = $linkClasses;
		$params['text_data'] = $this->getTextHoverColor($params);

		//Get HTML from template
		$html = kloe_qodef_get_shortcode_module_template_part('templates/icon-list-item-template', 'icon-list-item', '', $params);
		return $html;
	}
	 /**
     * Generates icon styles
     *
     * @param $params
     *
     * @return array
     */
	private function getIconStyle($params){
		
		$iconStylesArray = array();
		if(!empty($params['icon_color'])) {
			$iconStylesArray[] = 'color:' . $params['icon_color'];
		}

		if (!empty($params['icon_size'])) {
			$iconStylesArray[] = 'font-size:' .kloe_qodef_filter_px( $params['icon_size']) . 'px';
		}
		
		return implode(';', $iconStylesArray);
	}
	 /**
     * Generates title styles
     *
     * @param $params
     *
     * @return array
     */
	private function getTitleStyle($params){
		$titleStylesArray = array();
		if(!empty($params['title_color'])) {
			$titleStylesArray[] = 'color:' . $params['title_color'];
		}

		if (!empty($params['title_size'])) {
			$titleStylesArray[] = 'font-size:' .kloe_qodef_filter_px( $params['title_size']) . 'px';
		}
		
		 return implode(';', $titleStylesArray);
	}

	private function getLinkClass($params) {
		$class = '';

		if($params['anchor_link'] != '' && $params['anchor_link'] == 'yes') {
			$class .= 'qodef-anchor';
		}

		return $class;
	}

	private function getTextHoverColor($params) {
		$textData = array();

		if($params['link_item'] == 'yes' && !empty($params['title_hover_color'])) {
			$textData['data-hover-color'] = $params['title_hover_color'];
		}

		return $textData;
	}

}