<?php

/**
 * Busiprof Theme Functions
 *
 * @package Busiprof
 */
// Define template directory constants early
if ( !defined( 'BUSI_TEMPLATE_DIR' ) ) {
    define( 'BUSI_TEMPLATE_DIR', get_template_directory() );
}
if ( !defined( 'BUSI_TEMPLATE_DIR_URI' ) ) {
    define( 'BUSI_TEMPLATE_DIR_URI', get_template_directory_uri() );
}
if ( !class_exists( 'Busiprof_Freemius_Mock' ) ) {
    class Busiprof_Freemius_Mock {
        public function can_use_premium_code() {
            return false;
        }

        public function is_premium() {
            return false;
        }

        public function is_plan( $plan ) {
            return false;
        }

        public function is_free_plan() {
            return true;
        }

    }

}
if ( !function_exists( 'bus_fs' ) ) {
    // Create a helper function for easy SDK access.
    function bus_fs() {
        global $bus_fs;
        if ( !isset( $bus_fs ) ) {
            $busiprof_theme = wp_get_theme();
            $allowed_themes = array(
                'Busiprof',
                'Busiprof child',
                'Busiprof Child',
                'Busiprof Pro',
                'Busiprof Pro child',
                'Busiprof Pro Child',
                'BusiProf Pro',
                'BusiProf Pro child',
                'BusiProf Pro Child'
            );
            if ( in_array( $busiprof_theme->get( 'Name' ), $allowed_themes ) ) {
                // Include Freemius SDK.
                if ( file_exists( dirname( __FILE__ ) . '/freemius/start.php' ) ) {
                    require_once dirname( __FILE__ ) . '/freemius/start.php';
                } elseif ( defined( 'WC__PLUGIN_DIR' ) && file_exists( WC__PLUGIN_DIR . 'freemius/start.php' ) ) {
                    require_once WC__PLUGIN_DIR . 'freemius/start.php';
                }
                if ( function_exists( 'fs_dynamic_init' ) ) {
                    $bus_fs = fs_dynamic_init( array(
                        'id'               => '11279',
                        'slug'             => 'busiprof',
                        'premium_slug'     => 'busiprof-pro',
                        'type'             => 'theme',
                        'public_key'       => 'pk_5ea01e78f217552052e9a011d91c1',
                        'is_premium'       => false,
                        'premium_suffix'   => 'Pro',
                        'has_addons'       => false,
                        'has_paid_plans'   => true,
                        'menu'             => array(
                            'slug'    => 'busiprof-welcome',
                            'account' => true,
                            'contact' => false,
                            'support' => true,
                        ),
                        'navigation'       => 'menu',
                        'is_org_compliant' => true,
                        'is_live'          => true,
                    ) );
                }
            }
        }
        if ( !isset( $bus_fs ) || !is_object( $bus_fs ) ) {
            $bus_fs = new Busiprof_Freemius_Mock();
        }
        return $bus_fs;
    }

    // Init Freemius.
    bus_fs();
    // Signal that SDK was initiated.
    do_action( 'bus_fs_loaded' );
}
// Load Pro or Free functions based on Freemius license
if ( bus_fs()->can_use_premium_code() ) {
    require get_template_directory() . '/pro/functions.php';
} else {
    require get_template_directory() . '/free/functions.php';
}