<?php
function alzaytoon_theme_scripts() {
    wp_enqueue_style( 'alzaytoon-fonts', 'https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap', array(), null );
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', array(), '6.5.2' );
    wp_enqueue_style( 'alzaytoon-style', get_stylesheet_uri(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'alzaytoon_theme_scripts' );

function alzaytoon_theme_setup() {
    add_theme_support( 'post-thumbnails' );
    register_nav_menus( array(
        'primary' => __( 'القائمة الرئيسية', 'al-zaytoon' ),
    ) );
}
add_action( 'after_setup_theme', 'alzaytoon_theme_setup' );
