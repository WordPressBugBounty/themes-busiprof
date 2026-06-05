<?php
/**
 * Wrapper for comments.php
 */
if ( function_exists( 'bus_fs' ) && bus_fs()->can_use_premium_code() ) {
    $pro_file = get_template_directory() . '/pro/comments.php';
    if ( file_exists( $pro_file ) ) {
        require $pro_file;
    } else {
        require get_template_directory() . '/free/comments.php';
    }
} else {
    require get_template_directory() . '/free/comments.php';
}