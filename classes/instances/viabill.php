<?php

class WC_PensoPay_ViaBill extends WC_PensoPay_Instance {
    
    public $main_settings = NULL;
    
    public function __construct() {
        parent::__construct();
        
        // Get gateway variables
        $this->id = 'viabill';
        
        $this->method_title = 'PensoPay - ViaBill';
        
        $this->setup();
        
        $this->title = $this->s('title');
        $this->description = $this->s('description');
        
        add_filter( 'woocommerce_pensopay_cardtypelock_viabill', array( $this, 'filter_cardtypelock' ) );

	    add_filter('woocommerce_get_price_html', array( $this, 'viabill_price_html' ), 10, 2);
	    add_filter('woocommerce_cart_totals_order_total_html', array( $this, 'viabill_price_html_cart' ), 10, 1);
	    add_filter('woocommerce_gateway_method_description', array( $this, 'viabill_payment_method' ), 10, 2);
	    add_action('woocommerce_checkout_order_review', array( $this, 'viabill_checkout_order_review'), 10, 0);
    }

	public function viabill_header()
	{
	    ?>
        <script type="text/javascript">
            var o;

            var viabillInit = function() {
                o =document.createElement('script');
                o.type='text/javascript';
                o.async=true;
                o.id = 'viabillscript';
                o.src='https://pricetag.viabill.com/script/<?= $this->settings['id']; ?>';
                var s=document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(o,s);
            };

            var viabillReset = function() {
                document.getElementById('viabillscript').remove();
                vb = null;
                pricetag = null;
                viabillInit();
            };

            jQuery(document).ready(function() {
                viabillInit();
                jQuery('body').on('updated_checkout', viabillReset);
            });
        </script>
        <?php
	}

	/**
	 * payment_fields function.
	 *
	 * Prints out the description of the gateway. Also adds two checkboxes for viaBill/creditcard for customers to choose how to pay.
	 *
	 * @access public
	 * @return void
	 */
	public function payment_fields() {
		echo wpautop( wptexturize( $this->description ) ) . $this->getViabillPriceHtml('basket', WC()->cart->get_total('nodisplay'));
	}

	public function viabill_payment_method($description, $instance)
	{
		return $description;
	}

	public function getViabillPriceHtml($type, $price)
	{
		return sprintf('<div class="viabill-pricetag" data-view="%s" data-price="%s"></div>', $type, $price);
	}

    /**
     * Display pricetag in cart
     *
     * @param $value
     * @return string
     */
	public function viabill_price_html_cart($value)
	{
		if (is_cart() && $this->settings['show_pricetag_in_cart'] === 'yes') {
			return $value . $this->getViabillPriceHtml('basket', WC()->cart->get_total('nodisplay'));
		} else {
			return $value;
		}
	}

	public function viabill_price_html($price, $product)
	{
	    if ((is_front_page() || is_shop()) && $this->settings['show_pricetag_on_frontpage'] !== 'yes') {
	        return;
        }

	    if (is_product() && $this->settings['show_pricetag_on_product_page'] !== 'yes') {
	        return;
        }

	    if (is_product_category() && $this->settings['show_pricetag_on_category_page'] !== 'yes') {
	        return;
        }

		return $price . $this->getViabillPriceHtml(is_product() ? 'product' : 'list', $product->get_price());
	}

    /**
     * Show pricetag in checkout
     */
	public function viabill_checkout_order_review()
    {
        if ($this->settings['show_pricetag_in_checkout'] === 'yes') {
            echo $this->getViabillPriceHtml('basket', WC()->cart->get_total('nodisplay'));
        }
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
        $this->form_fields = array(
            'enabled' => array(
                'title' => __( 'Enable', 'woo-pensopay' ),
                'type' => 'checkbox', 
                'label' => __( 'Enable ViaBill payment', 'woo-pensopay' ),
                'default' => 'no'
            ), 
            '_Shop_setup' => array(
                'type' => 'title',
                'title' => __( 'Shop setup', 'woo-pensopay' ),
            ),
                'title' => array(
                    'title' => __( 'Title', 'woo-pensopay' ),
                    'type' => 'text', 
                    'description' => __( 'This controls the title which the user sees during checkout.', 'woo-pensopay' ),
                    'default' => __('ViaBill', 'woo-pensopay')
                ),
                'description' => array(
                    'title' => __( 'Customer Message', 'woo-pensopay' ),
                    'type' => 'textarea', 
                    'description' => __( 'This controls the description which the user sees during checkout.', 'woo-pensopay' ),
                    'default' => __('Pay with ViaBill', 'woo-pensopay')
                ),
            '_Pricetag' => array(
                'type' => 'title',
                'title' => __('Pricetag settings', 'woo-pensopay' )
            ),
                'id' => array(
                    'title' => __( 'Viabill ID', 'woo-pensopay' ),
                    'type' => 'text'
                ),
                'show_pricetag_on_frontpage' => array(
                    'title' => __( 'Show pricetag on frontpage', 'woo-pensopay' ),
                    'type' => 'checkbox',
                    'label' => __( 'Enable ViaBill pricetag on frontpage', 'woo-pensopay' ),
                    'default' => 'no'
                ),
                'show_pricetag_on_product_page' => array(
                    'title' => __( 'Show pricetag on product page', 'woo-pensopay' ),
                    'type' => 'checkbox',
                    'label' => __( 'Enable ViaBill pricetag on product page', 'woo-pensopay' ),
                    'default' => 'no'
                ),
                'show_pricetag_on_category_page' => array(
                    'title' => __( 'Show pricetag on category page', 'woo-pensopay' ),
                    'type' => 'checkbox',
                    'label' => __( 'Enable ViaBill pricetag on category page', 'woo-pensopay' ),
                    'default' => 'no'
                ),
                'show_pricetag_in_cart' => array(
                    'title' => __( 'Show pricetag in cart', 'woo-pensopay' ),
                    'type' => 'checkbox',
                    'label' => __( 'Enable ViaBill pricetag in cart', 'woo-pensopay' ),
                    'default' => 'no'
                ),
                'show_pricetag_in_checkout' => array(
                    'title' => __( 'Show pricetag in checkout', 'woo-pensopay' ),
                    'type' => 'checkbox',
                    'label' => __( 'Enable ViaBill pricetag in checkout', 'woo-pensopay' ),
                    'default' => 'no'
                ),
        );
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
        return 'viabill';
    }
}
