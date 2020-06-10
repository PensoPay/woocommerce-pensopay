<?php

/**
 * WC_PensoPay_Settings class
 *
 * @class 		WC_PensoPay_Settings
 * @version		1.0.0
 * @package		Woocommerce_PensoPay/Classes
 * @category	Class
 * @author 		PensoPay
 */
class WC_PensoPay_Settings {

	/**
	 * get_fields function.
	 *
	 * Returns an array of available admin settings fields
	 *
	 * @access public static
	 * @return array
	 */
	public static function get_fields() {
		$fields =
			[
				'enabled' => [
					'title'   => __( 'Enable', 'woo-pensopay' ),
					'type'    => 'checkbox',
					'label'   => __( 'Enable PensoPay Payment', 'woo-pensopay' ),
					'default' => 'yes'
				],

				'_Account_setup'                     => [
					'type'  => 'title',
					'title' => __( 'API - Integration', 'woo-pensopay' ),
				],
				'pensopay_apikey'                    => [
					'title'       => __( 'Api User key', 'woo-pensopay' ) . self::get_required_symbol(),
					'type'        => 'text',
					'description' => __( 'Your API User\'s key. Create a separate API user in the "Users" tab inside the PensoPay manager.', 'woo-pensopay' ),
					'desc_tip'    => true,
				],
				'pensopay_privatekey'                => [
					'title'       => __( 'Private key', 'woo-pensopay' ) . self::get_required_symbol(),
					'type'        => 'text',
					'description' => __( 'Your agreement private key. Found in the "Integration" tab inside the PensoPay manager.', 'woo-pensopay' ),
					'desc_tip'    => true,
				],
				'_Autocapture'                       => [
					'type'  => 'title',
					'title' => __( 'Autocapture settings', 'woo-pensopay' )
				],
				'pensopay_autocapture'               => [
					'title'       => __( 'Physical products (default)', 'woo-pensopay' ),
					'type'        => 'checkbox',
					'label'       => __( 'Enable', 'woo-pensopay' ),
					'description' => __( 'Automatically capture payments on physical products.', 'woo-pensopay' ),
					'default'     => 'no',
					'desc_tip'    => false,
				],
				'pensopay_autocapture_virtual'       => [
					'title'       => __( 'Virtual products', 'woo-pensopay' ),
					'type'        => 'checkbox',
					'label'       => __( 'Enable', 'woo-pensopay' ),
					'description' => __( 'Automatically capture payments on virtual products. If the order contains both physical and virtual products, this setting will be overwritten by the default setting above.', 'woo-pensopay' ),
					'default'     => 'no',
					'desc_tip'    => false,
				],
				'_Currency_settings'                 => [
					'type'  => 'title',
					'title' => __( 'Currency settings', 'woo-pensopay' )
				],
				'pensopay_currency'                  => [
					'title'       => __( 'Fixed Currency', 'woo-pensopay' ),
					'description' => __( 'Choose a fixed currency. Please make sure to use the same currency as in your WooCommerce currency settings.', 'woo-pensopay' ),
					'desc_tip'    => true,
					'type'        => 'select',
					'options'     => [
						'DKK' => 'DKK',
						'EUR' => 'EUR',
						'GBP' => 'GBP',
						'NOK' => 'NOK',
						'SEK' => 'SEK',
						'USD' => 'USD'
					]
				],
				'pensopay_currency_auto'             => [
					'title'       => __( 'Auto Currency', 'woo-pensopay' ),
					'type'        => 'checkbox',
					'label'       => __( 'Enable', 'woo-pensopay' ),
					'description' => __( 'Automatically checks out with the order currency. This setting overwrites the "Fixed Currency" setting.', 'woo-pensopay' ),
					'default'     => 'no',
					'desc_tip'    => true,
				],
				'_Embedded_payments'                 => [
					'type'  => 'title',
					'title' => __( 'Embedded payments', 'woo-pensopay' )
				],
				'pensopay_embedded_payments_enabled' => [
					'title'           => __( 'Enable', 'woo-pensopay' ),
					'type'            => 'checkbox',
					'description'     => __( 'Allows the customer to pay safely directly on your website without redirecting the customer to the PensoPay payment window. <b>Works with Clearhaus only!</b>', 'woo-pensopay' ),
					'default'         => 'no',
					'desc_tip'        => false,
					'checkboxgroup'   => 'start',
					'shop_if_checked' => 'option'
				],
				'pensopay_embedded_autojump'         => [
					'title'           => __( 'Autojump', 'woo-pensopay' ),
					'label'           => __( 'Enable', 'woo-pensopay' ),
					'type'            => 'checkbox',
					'description'     => __( 'Automatically jump to the next field when the customer types in card information.', 'woo-pensopay' ),
					'default'         => 'no',
					'desc_tip'        => false,
					'show_if_checked' => 'option',
					'checkboxgroup'   => 'end'
				],
				'_Extra_gateway_settings'            => [
					'type'  => 'title',
					'title' => __( 'Extra gateway settings', 'woo-pensopay' )
				],
				'pensopay_language'                  => [
					'title'       => __( 'Language', 'woo-pensopay' ),
					'description' => __( 'Payment Window Language', 'woo-pensopay' ),
					'desc_tip'    => true,
					'type'        => 'select',
					'options'     => [
						'da'        => 'Danish',
						'de'        => 'German',
						'en'        => 'English',
						'fr'        => 'French',
						'it'        => 'Italian',
						'es'        => 'Spanish',
						'no'        => 'Norwegian',
						'nl'        => 'Dutch',
						'pl'        => 'Polish',
						'se'        => 'Swedish'
					]
				],
				'pensopay_currency'                  => [
					'title'       => __( 'Currency', 'woo-pensopay' ),
					'description' => __( 'Choose your currency. Please make sure to use the same currency as in your WooCommerce currency settings.', 'woo-pensopay' ),
					'desc_tip'    => true,
					'type'        => 'select',
					'options'     => [
						'DKK' => 'DKK',
						'EUR' => 'EUR',
						'GBP' => 'GBP',
						'NOK' => 'NOK',
						'SEK' => 'SEK',
						'USD' => 'USD'
					]
				],
				'pensopay_cardtypelock'              => [
					'title'       => __( 'Payment methods', 'woo-pensopay' ),
					'type'        => 'text',
					'description' => __( 'Default: creditcard. Type in the cards you wish to accept (comma separated). See the valid payment types here: <b>http://tech.quickpay.net/appendixes/payment-methods/</b>', 'woo-pensopay' ),
					'default'     => 'creditcard',
				],
				'pensopay_branding_id'               => [
					'title'       => __( 'Branding ID', 'woo-pensopay' ),
					'type'        => 'text',
					'description' => __( 'Leave empty if you have no custom branding options', 'woo-pensopay' ),
					'default'     => '',
					'desc_tip'    => true,
				],
				'pensopay_sendaddresses'             => [
					'title'       => __( 'Send customer info to payment gateway', 'woo-pensopay' ),
					'type'        => 'checkbox',
					'label'       => __( 'Enable', 'woo-pensopay' ),
					'description' => __( 'If enabled, invoice & shipping address info is sent to payment gateway.', 'woo-pensopay' ),
					'default'     => 'yes',
					'desc_tip'    => true,
				],
				'pensopay_iframe'           => [
					'title'       => __( 'Enable IFrame', 'woo-pensopay' ),
					'type'        => 'checkbox',
					'label'       => __( 'Enable', 'woo-pensopay' ),
					'description' => __( 'If enabled, payments are made in the shop using an iframe instead of a redirect to pensopay.', 'woo-pensopay' ),
					'default'     => 'no',
					'desc_tip'    => true,
				],
				'pensopay_autofee' => [
					'title'       => __( 'Enable autofee', 'woo-pensopay' ),
					'type'        => 'checkbox',
					'label'       => __( 'Enable', 'woo-pensopay' ),
					'description' => __( 'If enabled, the fee charged by the acquirer will be calculated and added to the transaction amount.', 'woo-pensopay' ),
					'default'     => 'no',
					'desc_tip'    => true,
				],
				'pensopay_captureoncomplete'         => [
					'title'       => __( 'Capture on complete', 'woo-pensopay' ),
					'type'        => 'checkbox',
					'label'       => __( 'Enable', 'woo-pensopay' ),
					'description' => __( 'When enabled pensopay payments will automatically be captured when order state is set to "Complete".', 'woo-pensopay' ),
					'default'     => 'no',
					'desc_tip'    => true,
				],
				'pensopay_text_on_statement'         => [
					'title'             => __( 'Text on statement', 'woo-pensopay' ),
					'type'              => 'text',
					'description'       => __( 'Text that will be placed on cardholder’s bank statement (MAX 22 ASCII characters and only supported by Clearhaus currently).', 'woo-pensopay' ),
					'default'           => '',
					'desc_tip'          => true,
					'custom_attributes' => [
						'maxlength' => 22,
					],
				],


				'_Shop_setup'                           => [
					'type'  => 'title',
					'title' => __( 'Shop setup', 'woo-pensopay' ),
				],
				'title'                                 => [
					'title'       => __( 'Title', 'woo-pensopay' ),
					'type'        => 'text',
					'description' => __( 'This controls the title which the user sees during checkout.', 'woo-pensopay' ),
					'default'     => __( 'PensoPay', 'woo-pensopay' ),
					'desc_tip'    => true,
				],
				'description'                           => [
					'title'       => __( 'Customer Message', 'woo-pensopay' ),
					'type'        => 'textarea',
					'description' => __( 'This controls the description which the user sees during checkout.', 'woo-pensopay' ),
					'default'     => __( 'Pay via PensoPay. Allows you to pay with your credit card via PensoPay.', 'woo-pensopay' ),
					'desc_tip'    => true,
				],
				'checkout_button_text'                  => [
					'title'       => __( 'Order button text', 'woo-pensopay' ),
					'type'        => 'text',
					'description' => __( 'Text shown on the submit button when choosing payment method.', 'woo-pensopay' ),
					'default'     => __( 'Go to payment', 'woo-pensopay' ),
					'desc_tip'    => true,
				],
				'instructions'                          => [
					'title'       => __( 'Email instructions', 'woo-pensopay' ),
					'type'        => 'textarea',
					'description' => __( 'Instructions that will be added to emails.', 'woo-pensopay' ),
					'default'     => '',
					'desc_tip'    => true,
				],
				'pensopay_icons'                        => [
					'title'             => __( 'Credit card icons', 'woo-pensopay' ),
					'type'              => 'multiselect',
					'description'       => __( 'Choose the card icons you wish to show next to the PensoPay payment option in your shop.', 'woo-pensopay' ),
					'desc_tip'          => true,
					'class'             => 'wc-enhanced-select',
					'css'               => 'width: 450px;',
					'custom_attributes' => [
						'data-placeholder' => __( 'Select icons', 'woo-pensopay' )
					],
					'default'           => '',
					'options'           => self::get_card_icons(),
				],
				'pensopay_icons_maxheight'              => [
					'title'       => __( 'Credit card icons maximum height', 'woo-pensopay' ),
					'type'        => 'number',
					'description' => __( 'Set the maximum pixel height of the credit card icons shown on the frontend.', 'woo-pensopay' ),
					'default'     => 20,
					'desc_tip'    => true,
				],
				'Google Analytics'                      => [
					'type'  => 'title',
					'title' => __( 'Google Analytics', 'woo-pensopay' ),
				],
				'pensopay_google_analytics_tracking_id' => [
					'title'       => __( 'Tracking ID', 'woo-pensopay' ),
					'type'        => 'text',
					'description' => __( 'Your Google Analytics tracking ID. I.E: UA-XXXXXXXXX-X', 'woo-pensopay' ),
					'default'     => '',
					'desc_tip'    => true,
				],
				'ShopAdminSetup'                        => [
					'type'  => 'title',
					'title' => __( 'Shop Admin Setup', 'woo-pensopay' ),
				],

				'pensopay_orders_transaction_info' => [
					'title'       => __( 'Fetch Transaction Info', 'woo-pensopay' ),
					'type'        => 'checkbox',
					'label'       => __( 'Enable', 'woo-pensopay' ),
					'description' => __( 'Show transaction information in the order overview.', 'woo-pensopay' ),
					'default'     => 'yes',
					'desc_tip'    => false,
				],

				'CustomVariables'           => [
					'type'  => 'title',
					'title' => __( 'Custom Variables', 'woo-pensopay' ),
				],
				'pensopay_custom_variables' => [
					'title'             => __( 'Select Information', 'woo-pensopay' ),
					'type'              => 'multiselect',
					'class'             => 'wc-enhanced-select',
					'css'               => 'width: 450px;',
					'default'           => '',
					'description'       => __( 'Selected options will store the specific data on your transaction inside your PensoPay Manager.', 'woo-pensopay' ),
					'options'           => self::custom_variable_options(),
					'desc_tip'          => true,
					'custom_attributes' => [
						'data-placeholder' => __( 'Select order data', 'woo-pensopay' )
					]
				],
			];

		if ( WC_PensoPay_Subscription::plugin_is_active() ) {
			$fields['woocommerce-subscriptions'] = [
				'type'  => 'title',
				'title' => 'Subscriptions'
			];

			$fields['subscription_autocomplete_renewal_orders'] = [
				'title'       => __( 'Complete renewal orders', 'woo-pensopay' ),
				'type'        => 'checkbox',
				'label'       => __( 'Enable', 'woo-pensopay' ),
				'description' => __( 'Automatically mark a renewal order as complete on successful recurring payments.', 'woo-pensopay' ),
				'default'     => 'no',
				'desc_tip'    => true,
			];
		}

		return $fields;
	}

	/**
	 * @return array
	 */
	public static function get_card_icons() {
		return [
			'apple-pay'             => 'Apple Pay',
			'dankort'               => 'Dankort',
			'visa'                  => 'Visa',
			'visaelectron'          => 'Visa Electron',
			'visa-verified'         => 'Verified by Visa',
			'mastercard'            => 'Mastercard',
			'mastercard-securecode' => 'Mastercard SecureCode',
			'mastercard-idcheck'    => 'Mastercard ID Check',
			'maestro'               => 'Maestro',
			'jcb'                   => 'JCB',
			'americanexpress'       => 'American Express',
			'diners'                => 'Diner\'s Club',
			'discovercard'          => 'Discover Card',
			'viabill'               => 'ViaBill',
			'paypal'                => 'Paypal',
			'danskebank'            => 'Danske Bank',
			'nordea'                => 'Nordea',
			'mobilepay'             => 'MobilePay',
			'forbrugsforeningen'    => 'Forbrugsforeningen',
			'ideal'                 => 'iDEAL',
			'unionpay'              => 'UnionPay',
			'sofort'                => 'Sofort',
			'cirrus'                => 'Cirrus',
			'klarna'                => 'Klarna',
			'bankaxess'             => 'BankAxess',
			'vipps'                 => 'Vipps',
			'swish'                 => 'Swish',
			'bitcoin'               => 'Bitcoin',
			'trustly'               => 'Trustly',
			'paysafecard'           => 'Paysafe Card',
		];
	}


	/**
	 * custom_variable_options function.
	 *
	 * Provides a list of custom variable options used in the settings
	 *
	 * @access private
	 * @return array
	 */
	private static function custom_variable_options() {
		$options = [
			'billing_all_data'  => __( 'Billing: Complete Customer Details', 'woo-pensopay' ),
			'browser_useragent' => __( 'Browser: User Agent', 'woo-pensopay' ),
			'customer_email'    => __( 'Customer: Email Address', 'woo-pensopay' ),
			'customer_phone'    => __( 'Customer: Phone Number', 'woo-pensopay' ),
			'shipping_all_data' => __( 'Shipping: Complete Customer Details', 'woo-pensopay' ),
			'shipping_method'   => __( 'Shipping: Shipping Method', 'woo-pensopay' ),
		];

		asort( $options );

		return $options;
	}

	/**
	 * Clears the log file.
	 *
	 * @return void
	 */
	public static function clear_logs_section() {
		printf( '<h3 class="wc-settings-sub-title">%s</h3>', __( 'Debug', 'woo-pensopay' ) );
		printf( '<a id="wcpp_wiki" class="button button-primary" href="%s" target="_blank">%s</a>', self::get_wiki_link(), __( 'Got problems? Check out the Wiki.', 'woo-pensopay' ) );
		printf( '<a id="wcpp_logs" class="button" href="%s">%s</a>', WC_PP()->log->get_admin_link(), __( 'View debug logs', 'woo-pensopay' ) );
		printf( '<button id="wcpp_logs_clear" class="button">%s</button>', __( 'Empty debug logs', 'woo-pensopay' ) );
		printf( '<br/>' );
		printf( '<h3 class="wc-settings-sub-title">%s</h3>', __( 'Enable', 'woo-pensopay' ) );
	}

	/**
	 * Returns the link to the gateway settings page.
	 *
	 * @return mixed
	 */
	public static function get_settings_page_url() {
		return admin_url( 'admin.php?page=wc-settings&tab=checkout&section=wc_pensopay' );
	}

	/**
	 * Shows an admin notice if the setup is not complete.
	 *
	 * @return void
	 */
	public static function show_admin_setup_notices() {
		$error_fields = [];

		$mandatory_fields = [
			'pensopay_privatekey' => __( 'Private key', 'woo-pensopay' ),
			'pensopay_apikey'     => __( 'Api User key', 'woo-pensopay' )
		];

		foreach ( $mandatory_fields as $mandatory_field_setting => $mandatory_field_label ) {
			if ( self::has_empty_mandatory_post_fields( $mandatory_field_setting ) ) {
				$error_fields[] = $mandatory_field_label;
			}
		}

		if ( ! empty( $error_fields ) ) {
			$message = sprintf( '<h2>%s</h2>', __( "WooCommerce PensoPay", 'woo-pensopay' ) );
			$message .= sprintf( '<p>%s</p>', sprintf( __( 'You have missing or incorrect settings. Go to the <a href="%s">settings page</a>.', 'woo-pensopay' ), self::get_settings_page_url() ) );
			$message .= '<ul>';
			foreach ( $error_fields as $error_field ) {
				$message .= "<li>" . sprintf( __( '<strong>%s</strong> is mandatory.', 'woo-pensopay' ), $error_field ) . "</li>";
			}
			$message .= '</ul>';

			printf( '<div class="%s">%s</div>', 'notice notice-error', $message );
		}

	}

	/**
	 * @return string
	 */
	public static function get_wiki_link() {
		return 'https://pensopay.zendesk.com/hc/da';
	}

	/**
	 * Logic wrapper to check if some of the mandatory fields are empty on post request.
	 *
	 * @return bool
	 */
	private static function has_empty_mandatory_post_fields( $settings_field ) {
		$post_key    = 'woocommerce_pensopay_' . $settings_field;
		$setting_key = WC_PP()->s( $settings_field );

		return empty( $_POST[ $post_key ] ) && empty( $setting_key );

	}

	/**
	 * @return string
	 */
	private static function get_required_symbol() {
		return '<span style="color: red;">*</span>';
	}
}


?>