<?php

class Kloe_Vendors
{
    /**
     * The single instance of the class.
     *
     * @var Kloe_Vendors
     */
    protected static $_instance = null;

    /**
     * Main Kloe_Vendors Instance.
     *
     * @return MNB_Shortcodes - Main instance.
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Kloe_Vendors Constructor.
     */
    private function __construct()
    {
        //add_action('init', array($this, 'add_shortcodes'));
        add_action('widgets_init', array($this, 'register_vendor_sidebar'));

        add_filter('wcpv_sold_by_text', array($this, 'sold_by_text'));
        add_filter( 'template_include', array($this, 'template_loader'));
        add_filter('kloe_qodef_title_text', array($this, 'vendor_title_text'));
        add_filter('kloe_qodef_title_area_height_params', array($this, 'title_area_height_params'));
    }

    /**
     * Change sold by text for vendor
     * @param $content
     * @return string
     */
    public function sold_by_text($content) {
        $content = esc_html__( 'Specialist name:', 'kloe' );
        return $content;
    }

    /**
     * Change template for Vendor page
     * @param $template
     * @return string
     */
    public function template_loader($template)
    {
        if (is_product_taxonomy()) {
            $term   = get_queried_object();

            //var_dump($term);

            if ( is_tax('wcpv_product_vendors') ) {
                $file = 'taxonomy-' . $term->taxonomy . '.php';

                $find[] = $file;

                if ( $file ) {
                    $template       = locate_template( array_unique( $find ) );
                }
            }
        }

        return $template;
    }

    /**
     * Change title text for vendor page
     * @param $title
     * @return mixed
     */
    function vendor_title_text($title)
    {
        if (is_product_taxonomy()) {
            $term = get_queried_object();

            if ( is_tax('wcpv_product_vendors') ) {
                $title = $term->name;
            }
        }
        return $title;
    }

    /**
     * Change title area parameters
     * @param $parameters
     * @return mixed
     */
    public function title_area_height_params($parameters)
    {
        if (is_product_taxonomy()) {
            $term = get_queried_object();
    
            if ( is_tax('wcpv_product_vendors') ) {
                $parameters['enable_breadcrumbs'] = false;
            }
        }
        return $parameters;
    }

    public function register_vendor_sidebar()
    {
        register_sidebar(array(
            'name' => 'Vendor Sidebar',
            'id' => 'vendor_sidebar',
            'description' => 'Sidebar for using on vendor page',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4>',
            'after_title' => '</h4>'
        ));
    }
}

/**
 * Main instance of MNB_Shortcodes.
 * @return MNB_Shortcodes
 */
function Kloe_Vendors() {
    return Kloe_Vendors::instance();
}

// Global for backwards compatibility.
$GLOBALS['kloe_vendors'] = Kloe_Vendors();