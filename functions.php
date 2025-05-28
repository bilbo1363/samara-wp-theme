<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Определяем константы
define( 'SAMARA_VERSION', '1.0.0' );

/**
 * Настройка темы
 */
function samara_setup() {
    // Добавляем поддержку блоков
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'custom-units' );

    // Добавляем поддержку изображений
    add_theme_support( 'custom-logo' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'featured-images' );
    
    // Добавляем поддержку блока featured image
    add_theme_support( 'core-block-patterns' );
    add_theme_support( 'post-thumbnails' );
    
    // Регистрируем размеры изображений
    add_image_size( 'samara-featured', 1200, 600, true );
    add_image_size( 'samara-large', 800, 400, true );
    add_image_size( 'samara-medium', 600, 300, true );
}
add_action( 'after_setup_theme', 'samara_setup' );