<?php
/**
 * WC_PensoPay_Install class
 *
 * @class 		WC_PensoPay_Install
 * @version		1.0.0
 * @package		Woocommerce_PensoPay/Classes
 * @category	Class
 * @author 		PensoPay
 */

class WC_PensoPay_Install
{
	/**
	 * Contains version numbers and the path to the update files.
	 */
	private static $updates = [
		'4.3' => 'updates/woocommerce-pensopay-update-4.3.php',
		'4.6' => 'updates/woocommerce-pensopay-update-4.6.php'
	];
	
	
	/**
	 * Updates the version. 
	 * 
	 * @param string $version = NULL - The version number to update to
	 */
	private static function update_db_version( $version = NULL )
	{
		delete_option( 'woocommerce_pensopay_version' );
		add_option( 'woocommerce_pensopay_version', $version === NULL ? WCPP_VERSION : $version );
	}
	
	
	/**
	 * Get the current DB version stored in the database.
	 * 
	 * @return string - the stored version number.
	 */
	public static function get_db_version() 
	{
		return get_option( 'woocommerce_pensopay_version', TRUE );
	}
	
	
	/**
	 * Checks if this is the first install.
	 * 
	 * @return bool
	 */
	public static function is_first_install() 
	{
		$settings = get_option( 'woocommerce_pensopay_settings', FALSE );
		return $settings === FALSE;
	}
	
	
	/**
	 * Runs on first install
	 */
	public static function install()
	{
		// Install...
	}
	
	
	/**
	 * Loops through the updates and executes them.
	 */
	public static function update() 
	{
        // Don't lock up other requests while processing
	    session_write_close();

        self::start_maintenance_mode();

		foreach ( self::$updates as $version => $updater ) {
			if ( self::is_update_required($version) ) {
				include( $updater );
				self::update_db_version( $version );
			}
		}
		
		self::update_db_version( WCPP_VERSION );

        self::stop_maintenance_mode();
	}

    /**
     * Checks if the current database version is outdated
     *
     * @param null $version
     * @return mixed
     */
	public static function is_update_required( $version = NULL )
    {
        $version = self::get_db_version();

        foreach( self::$updates as $update_version => $update_file ) {
            if (version_compare($version, $update_version, '<')) {
                return TRUE;
            }
        }

        return FALSE;
    }

    /**
     * Checks if in maintenance mode
     * @return bool
     */
    public static function is_in_maintenance_mode()
    {
        return get_option( 'woocommerce_pensopay_maintenance', FALSE );
    }

    /**
     * Enables maintenance mode
     */
    public static function start_maintenance_mode()
    {
        add_option('woocommerce_pensopay_maintenance', TRUE, '', 'yes');
    }

    /**
     * Disables maintenance mode
     */
    public static function stop_maintenance_mode()
    {
        delete_option('woocommerce_pensopay_maintenance');
    }

    /**
     * Shows an admin notice informing about required database migrations.
     */
    public static function show_update_warning()
    {
        if (self::is_update_required()) {
            if (!self::is_in_maintenance_mode()) {
                WC_PensoPay_Views::get_view('html-notice-update.php');
            } else {
                WC_PensoPay_Views::get_view('html-notice-upgrading.php');
            }
        }
    }

    /**
     * Asynchronous data upgrader acction
     */
    public static function ajax_run_upgrader()
    {
        $nonce = isset($_POST['nonce']) ? $_POST['nonce'] : NULL;

        if (!wp_verify_nonce($nonce, 'woocommerce-pensopay-run-upgrader-nonce') && !current_user_can('administrator'))
        {
            echo json_encode( [ 'status' => 'error', 'message' => __('You are not authorized to perform this action', 'woo-pensopay') ] );
            exit;
        }

        self::update();

        echo json_encode( [ 'status' => 'success' ] );

        exit;
    }

    /**
     * Creates a nonce
     * @return string - the nonce
     */
    public static function create_run_upgrader_nonce()
    {
        return wp_create_nonce("woocommerce-pensopay-run-upgrader-nonce");
    }
}