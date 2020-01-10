<?php

class WC_PensoPay_Bitcoin extends WC_PensoPay_Instance {

    public $main_settings = NULL;

    public function __construct() {
        parent::__construct();

        // Get gateway variables
        $this->id = 'bitcoin';

        $this->method_title = 'PensoPay - Bitcoin';

        $this->setup();

        $this->title = $this->s('title');
        $this->description = $this->s('description');

        add_filter( 'woocommerce_pensopay_cardtypelock_bitcoin', [ $this, 'filter_cardtypelock' ] );
    }


    /**
     * init_form_fields function.
     *
     * Initiates the plugin settings form fields
     *
     * @access public
     * @return array
     */
    public function init_form_fields()
    {
        $this->form_fields = [
            'enabled' => [
                'title' => __( 'Enable', 'woo-pensopay' ),
                'type' => 'checkbox',
                'label' => __( 'Enable Bitcoin payment', 'woo-pensopay' ),
                'default' => 'no'
            ],
            '_Shop_setup' => [
                'type' => 'title',
                'title' => __( 'Shop setup', 'woo-pensopay' ),
            ],
            'title' => [
                'title' => __( 'Title', 'woo-pensopay' ),
                'type' => 'text',
                'description' => __( 'This controls the title which the user sees during checkout.', 'woo-pensopay' ),
                'default' => __('Bitcoin through Coinify', 'woo-pensopay')
            ],
            'description' => [
                'title' => __( 'Customer Message', 'woo-pensopay' ),
                'type' => 'textarea',
                'description' => __( 'This controls the description which the user sees during checkout.', 'woo-pensopay' ),
                'default' => __('Pay with Bitcoin', 'woo-pensopay')
            ],
        ];
    }


    /**
     * filter_cardtypelock function.
     *
     * Sets the cardtypelock
     *
     * @access public
     * @return string
     */
    public function filter_cardtypelock( )
    {
        return 'bitcoin';
    }
}
