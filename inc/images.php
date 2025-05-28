<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Добавляем поддержку WebP
 */
function samara_webp_upload_mimes( $existing_mimes ) {
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter( 'mime_types', 'samara_webp_upload_mimes' );

/**
 * Добавляем поддержку picture для изображений
 */
function samara_add_picture_support( $content ) {
    if ( is_admin() || empty( $content ) ) {
        return $content;
    }
    
    // Заменяем img на picture с поддержкой WebP
    $content = preg_replace_callback( 
        '/<img([^>]+?)src=[\'"]?([^\'"]\s>]+)[\'"]?([^>]*)>/i',
        function( $matches ) {
            $img_attrs = $matches[1] . $matches[3];
            $src = $matches[2];
            
            // Получаем WebP версию
            $webp_src = preg_replace( '/\.(jpe?g|png)$/i', '.webp', $src );
            
            // Формируем picture
            $picture = '<picture>';
            $picture .= '<source srcset="' . esc_attr( $webp_src ) . '" type="image/webp">';
            $picture .= '<img src="' . esc_attr( $src ) . '"' . $img_attrs . '>';
            $picture .= '</picture>';
            
            return $picture;
        },
        $content
    );
    
    return $content;
}
add_filter( 'the_content', 'samara_add_picture_support' );