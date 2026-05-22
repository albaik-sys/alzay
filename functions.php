<?php
function alzaytoon_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    register_nav_menus(array('primary' => 'القائمة الرئيسية'));
}
add_action('after_setup_theme', 'alzaytoon_setup');

function alzaytoon_scripts() {
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0');
    wp_enqueue_style('style', get_stylesheet_uri(), array(), time());
}
add_action('wp_enqueue_scripts', 'alzaytoon_scripts');

function alzaytoon_cpt() {
    $cpts = array(
        'news'   => array('الأخبار', 'خبر', 'dashicons-megaphone'),
        'events' => array('المناسبات', 'مناسبة', 'dashicons-calendar-alt'),
        'help'   => array('المناشدات', 'مناشدة', 'dashicons-heart'),
        'lost'   => array('المفقودات', 'مفقود', 'dashicons-search'),
        'person' => array('شخصيات', 'شخصية', 'dashicons-admin-users')
    );
    foreach ($cpts as $key => $val) {
        register_post_type($key, array(
            'labels' => array('name' => $val[0], 'singular_name' => $val[1]),
            'public' => true, 'has_archive' => true, 'menu_icon' => $val[2],
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
        ));
    }
}
add_action('init', 'alzaytoon_cpt');

// إعدادات لوحة التحكم
function alzaytoon_customizer($wp_customize) {
    $wp_customize->add_section('alzaytoon_poll', array('title' => 'نظام التصويت', 'priority' => 30));
    $wp_customize->add_setting('poll_q', array('default' => 'ما رأيك في الخدمات؟'));
    $wp_customize->add_control('poll_q', array('label' => 'السؤال', 'section' => 'alzaytoon_poll', 'type' => 'text'));
}
add_action('customize_register', 'alzaytoon_customizer');
