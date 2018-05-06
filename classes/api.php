<?php
/**
 * \PromPress\API
 * 
 * @package prompress
 */

namespace PromPress;

class API {

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
        add_action( 'rest_api_init', array( $this, 'register_route' ) );
    }

    /**
     * Register Route.
     * 
     * Sets up the main plugin features.
     * 
     * @return void
     */
    public function register_route() {
        register_rest_route( 'prompress/v1', 'metrics', array(
            'methods'  => 'GET',
            'callback' => array( $this, 'serve_metrics' ),
        ) );
    }
    
    /**
     * Serve the Mertrics API Request
     * 
     * Callback which handles the API request. Hacky implementation which pushes raw output and exits to avoid JSON encoding.
     * 
     * @return void
     */
    function serve_metrics( $request ) {
        
        header( 'Content-Type: text/plain' );
        echo '# HELP api_requests_total A counter for API requests.' . PHP_EOL;
        echo '# TYPE api_requests_total counter' . PHP_EOL;
        echo 'api_requests_total{job="highlighter-api"} 15118' . PHP_EOL;
        exit();

    }

}