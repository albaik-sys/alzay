<?php
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

function alzaytoon_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'alzaytoon_social', array('title' => 'إعدادات شبكة حي الزيتون', 'priority' => 30) );
    $socials = array('facebook' => 'فيسبوك', 'instagram' => 'انستجرام', 'telegram' => 'تيليجرام', 'youtube' => 'يوتيوب', 'whatsapp' => 'واتساب', 'phone' => 'الهاتف');
    foreach($socials as $key => $label) {
        $wp_customize->add_setting( 'alzaytoon_'.$key, array('default' => '') );
        $wp_customize->add_control( 'alzaytoon_'.$key, array('label' => $label, 'section' => 'alzaytoon_social', 'type' => 'text') );
    }
}
add_action( 'customize_register', 'alzaytoon_customize_register' );

function alzaytoon_set_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count == ''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '1');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
function alzaytoon_get_post_views($postID){
    $count = get_post_meta($postID, 'post_views_count', true);
    return ($count == '') ? "0" : $count;
}

function alzaytoon_reading_time() {
    $content = get_post_field( 'post_content', get_the_ID() );
    $word_count = str_word_count( strip_tags( $content ) );
    $readingtime = ceil($word_count / 200);
    if ($readingtime <= 1) { return "دقيقة واحدة"; } 
    elseif ($readingtime == 2) { return "دقيقتان"; } 
    else { return $readingtime . " دقائق"; }
}

// 🟢 إعدادات نظام التصويت في لوحة التخصيص 🟢
function alzaytoon_poll_customizer( $wp_customize ) {
    $wp_customize->add_section( 'alzaytoon_poll_section', array(
        'title'    => __( 'إعدادات التصويت (الرئيسية)', 'alzaytoon' ),
        'priority' => 31,
    ));
    
    // سؤال التصويت
    $wp_customize->add_setting( 'alzaytoon_poll_question', array('default' => 'ما رأيك في مستوى الخدمات المقدمة في حي الزيتون مؤخراً؟') );
    $wp_customize->add_control( 'alzaytoon_poll_question', array('label' => 'سؤال التصويت:', 'section' => 'alzaytoon_poll_section', 'type' => 'text') );

    // الخيارات
    for($i=1; $i<=3; $i++) {
        $wp_customize->add_setting( 'alzaytoon_poll_opt'.$i, array('default' => 'خيار '.$i) );
        $wp_customize->add_control( 'alzaytoon_poll_opt'.$i, array('label' => 'الخيار رقم '.$i.':', 'section' => 'alzaytoon_poll_section', 'type' => 'text') );
    }
}
add_action( 'customize_register', 'alzaytoon_poll_customizer' );
