<?php

class MNB_Shortcodes {
    /**
     * The single instance of the class.
     *
     * @var MNB_Shortcodes
     */
    protected static $_instance = null;

    /**
     * Main MNB_Shortcodes Instance.
     *
     * @return MNB_Shortcodes - Main instance.
     */
    public static function instance()
    {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * MNB_Shortcodes Constructor.
     */
    private function __construct()
    {
        add_action('init', array($this, 'add_shortcodes'));
    }

    /**
     * Add shortcodes.
     */
    public function add_shortcodes()
    {
        add_shortcode('mnb_get_book_shortcode', array ($this, 'get_book_shortcode'));
        add_shortcode('mnb_order_details', array ($this, 'order_details'));
    }

    /**
     * Add Get Free book Shortcode
     */
    public function get_book_shortcode($args)
    {
        return $this->render_html(MNB_THEME_PATH . '/views/shortcode-get-book.php', $args);
    }

    /**
     * Add Get Free book Shortcode
     */
    public function order_details($args)
    {
        return $this->render_html(MNB_THEME_PATH . '/views/shortcode-order-details.php', $args);
    }

    /**
     * Render HTML from buffer
     */
    public function render_html($pagepath, $data = array()) {
        @extract ($data);
        ob_start();
        include ($pagepath);
        return ob_get_clean();
    }

}
/**
 * Main instance of MNB_Shortcodes.
 * @return MNB_Shortcodes
 */
function MNB_Shortcodes() {
    return MNB_Shortcodes::instance();
}

// Global for backwards compatibility.
$GLOBALS['mnb_shortcodes'] = MNB_Shortcodes();