<?php
// ربط التنسيقات والأيقونات
function alzaytoon_theme_scripts() {
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', array(), '6.5.2' );
    wp_enqueue_style( 'alzaytoon-style', get_stylesheet_uri(), array(), time() ); 
}
add_action( 'wp_enqueue_scripts', 'alzaytoon_theme_scripts' );

function alzaytoon_theme_setup() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    register_nav_menus( array('primary' => __( 'القائمة الرئيسية', 'al-zaytoon' )) );
}
add_action( 'after_setup_theme', 'alzaytoon_theme_setup' );

// تسجيل الأقسام المخصصة
function alzaytoon_register_custom_post_types() {
    $cpts = array(
        'news'   => array('name' => 'الأخبار', 'singular' => 'خبر', 'icon' => 'dashicons-megaphone'),
        'events' => array('name' => 'المناسبات', 'singular' => 'مناسبة', 'icon' => 'dashicons-calendar-alt'),
        'help'   => array('name' => 'المساعدات والمناشدات', 'singular' => 'مناشدة', 'icon' => 'dashicons-heart'),
        'lost'   => array('name' => 'المفقودات', 'singular' => 'بند مفقود', 'icon' => 'dashicons-search'),
        'person' => array('name' => 'شخصية الأسبوع', 'singular' => 'شخصية', 'icon' => 'dashicons-admin-users'),
    );
    foreach ($cpts as $key => $value) {
        $args = array(
            'labels' => array('name' => $value['name'], 'singular_name' => $value['singular'], 'menu_name' => $value['name']),
            'public' => true, 'has_archive' => true, 'menu_icon' => $value['icon'],
            'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ), 'show_in_rest' => true,
        );
        register_post_type( $key, $args );
    }
}
add_action( 'init', 'alzaytoon_register_custom_post_types' );

// 🟢 الميزة 1: لوحة تحكم مخصصة لتغيير روابط السوشيال ميديا 🟢
function alzaytoon_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'alzaytoon_social', array(
        'title'    => __( 'إعدادات شبكة حي الزيتون (السوشيال ميديا)', 'alzaytoon' ),
        'priority' => 30,
    ));
    $socials = array(
        'facebook'  => 'رابط صفحة فيسبوك',
        'instagram' => 'رابط انستجرام',
        'telegram'  => 'رابط قناة تيليجرام',
        'youtube'   => 'رابط قناة يوتيوب',
        'whatsapp'  => 'رقم الواتساب (مثال: 970591234567)',
        'phone'     => 'رقم الهاتف للاتصال المباشر'
    );
    foreach($socials as $key => $label) {
        $wp_customize->add_setting( 'alzaytoon_'.$key, array('default' => '') );
        $wp_customize->add_control( 'alzaytoon_'.$key, array(
            'label'   => $label,
            'section' => 'alzaytoon_social',
            'type'    => 'text',
        ));
    }
}
add_action( 'customize_register', 'alzaytoon_customize_register' );

// 🟢 الميزة 2: برمجة عداد المشاهدات الذكي 🟢
function alzaytoon_set_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count == ''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
function alzaytoon_get_post_views($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count == ''){ return "0"; }
    return $count;
}
?>