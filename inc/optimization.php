<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Оптимизация загрузки ресурсов
 */
function samara_optimize_resources() {
    // Отключаем эмодзи, если они не нужны
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );

    // Отключаем генерацию XML-RPC ссылки
    remove_action( 'wp_head', 'rsd_link' );
    
    // Отключаем вывод версии WordPress
    remove_action( 'wp_head', 'wp_generator' );
}
add_action( 'init', 'samara_optimize_resources' );

/**
 * Отключаем ленивую загрузку для featured images
 */
function samara_disable_lazy_load_for_featured_images() {
    add_filter('wp_img_tag_add_loading_attr', function($value, $image, $context) {
        if (strpos($image, 'wp-block-post-featured-image') !== false || 
            strpos($image, 'featured-image') !== false) {
            return false;
        }
        return $value;
    }, 10, 3);
}
add_action('wp', 'samara_disable_lazy_load_for_featured_images');