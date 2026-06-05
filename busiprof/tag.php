<?php
/**
 * Wrapper for tag.php
 */
if ( function_exists( 'bus_fs' ) && bus_fs()->can_use_premium_code() ) {
    $pro_file = get_template_directory() . '/pro/tag.php';
    if ( file_exists( $pro_file ) ) {
        require $pro_file;
    } else {
        require get_template_directory() . '/free/tag.php';
    }
} else {
    require get_template_directory() . '/free/tag.php';
}