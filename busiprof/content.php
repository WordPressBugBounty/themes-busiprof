<?php
/**
 * Wrapper for content.php
 */
if ( function_exists( 'bus_fs' ) && bus_fs()->can_use_premium_code() ) {
    $pro_file = get_template_directory() . '/pro/content.php';
    if ( file_exists( $pro_file ) ) {
        require $pro_file;
    } else {
        require get_template_directory() . '/free/content.php';
    }
} else {
    require get_template_directory() . '/free/content.php';
}