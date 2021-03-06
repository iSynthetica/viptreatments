<?php

    $header_meta_box = kloe_qodef_add_meta_box(
        array(
            'scope' => array('page', 'portfolio-item', 'post'),
            'title' => 'Header',
            'name' => 'header_meta'
        )
    );


    kloe_qodef_add_meta_box_field(
        array(
            'name' => 'qodef_header_type_meta',
            'type' => 'select',
            'default_value' => '',
            'label' => 'Choose Header Type',
            'description' => 'Select the type of header you would like to use',
            'parent' => $header_meta_box,
            'options' => array(
                '' => '',
                'header-standard' => 'Header Standard',
                'header-vertical' => 'Header Vertical'
            )
        )
    );


    kloe_qodef_add_meta_box_field(
        array(
            'name' => 'qodef_header_style_meta',
            'type' => 'select',
            'default_value' => '',
            'label' => 'Header Skin',
            'description' => 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style',
            'parent' => $header_meta_box,
            'options' => array(
                '' => '',
                'light-header' => 'Light',
                'dark-header' => 'Dark'
            )
        )
    );

    kloe_qodef_add_meta_box_field(
        array(
            'parent' => $header_meta_box,
            'type' => 'select',
            'name' => 'qodef_enable_header_style_on_scroll_meta',
            'default_value' => '',
            'label' => 'Enable Header Style on Scroll',
            'description' => 'Enabling this option, header will change style depending on row settings for dark/light style',
            'options' => array(
                '' => '',
                'no' => 'No',
                'yes' => 'Yes'
            )
        )
    );

    kloe_qodef_add_meta_box_field(
        array(
            'name' => 'qodef_menu_area_background_color_header_standard_meta',
            'type' => 'color',
            'label' => 'Background Color for Standard Header Type',
            'description' => 'Choose a background color for standard header type',
            'parent' => $header_meta_box
        )
    );

    kloe_qodef_add_meta_box_field(
        array(
            'name' => 'qodef_menu_area_background_transparency_header_standard_meta',
            'type' => 'text',
            'label' => 'Transparency for Standard Header Type',
            'description' => 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque) for standard header type',
            'parent' => $header_meta_box,
            'args' => array(
                'col_width' => 2
            )
        )
    );


    kloe_qodef_add_meta_box_field(array(
        'name'        => 'qodef_vertical_header_background_color_meta',
        'type'        => 'color',
        'label'       => 'Background Color for Vertical Header Type',
        'description' => 'Set background color for vertical menu',
        'parent'      => $header_meta_box
    ));

    kloe_qodef_add_meta_box_field(
        array(
            'name'          => 'qodef_vertical_header_background_image_meta',
            'type'          => 'image',
            'default_value' => '',
            'label'         => 'Background Image for Vertical Header Type',
            'description'   => 'Set background image for vertical menu',
            'parent'        => $header_meta_box
        )
    );

    kloe_qodef_add_meta_box_field(
        array(
            'name' => 'qodef_disable_vertical_header_background_image_meta',
            'type' => 'yesno',
            'default_value' => 'no',
            'label' => 'Disable Background Image for Vertical Header Type',
            'description' => 'Enabling this option will hide background image in Vertical Menu',
            'parent' => $header_meta_box
        )
    );


    if(kloe_qodef_options() -> getOptionValue('header_type') != 'header-vertical') {
        kloe_qodef_add_meta_box_field(
            array(
                'name'            => 'qodef_scroll_amount_for_sticky_meta',
                'type'            => 'text',
                'label'           => 'Scroll amount for sticky header appearance',
                'description'     => 'Define scroll amount for sticky header appearance',
                'parent'          => $header_meta_box,
                'args'            => array(
                    'col_width' => 2,
                    'suffix'    => 'px'
                ),
                'hidden_property' => 'qodef_header_behaviour',
                'hidden_values'   => array("sticky-header-on-scroll-up", "fixed-on-scroll")
            )
        );
    }


