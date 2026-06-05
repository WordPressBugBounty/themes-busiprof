<?php
/**
 * Wrapper for author.php
 */
if ( function_exists( 'bus_fs' ) && bus_fs()->can_use_premium_code() ) {
    $pro_file = get_template_directory() . '/pro/author.php';
    if ( file_exists( $pro_file ) ) {
        require $pro_file;
    } else {
        require get_template_directory() . '/free/author.php';
    }
} else {
    require get_template_directory() . '/free/author.php';
}