<?php
/**
 * Main Class for the Plugin
 *
 * This file can use syntax from the required level of PHP or later.
 * 
 * @package prompress
 */

namespace PromPress;

class Main {

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct() {
        $this->init();
    }

    /**
     * Initiation.
     *
     * Sets up the main plugin features.
     *
     * @return void
     */
    public function init() {
        add_action( 'plugins_loaded', array( $this, 'load_i18n' ) );
        //add_action( 'plugins_loaded', array( '\PromPress\Api', 'init' ) );
        new \PromPress\Api;
    }

    /**
     * Load translations.
     *
     * Loads the textdomain needed to get translations.
     *
     * @return void
     */
    public function load_i18n() {
        load_plugin_textdomain( 'pp', false, PP_PATH . '/languages' );
    }

}