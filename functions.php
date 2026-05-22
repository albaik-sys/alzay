<?php
// 1. ربط الملفات والأيقونات
function alzaytoon_theme_scripts() {
    wp_enqueue_style( 'font-awesome-official', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', array(), '6.5.2' );
    wp_enqueue_style( 'alzaytoon-style', get_stylesheet_uri(), array(), time() ); 
}
add_action( 'wp_enqueue_scripts', 'alzaytoon_theme_scripts' );

function alzaytoon_theme_setup() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    register_nav_menus( array('primary' => 'القائمة الرئيسية') );
}
add_action( 'after_setup_theme', 'alzaytoon_theme_setup' );

// 2. تسجيل الأقسام المخصصة
function alzaytoon_register_custom_post_types() {
    $cpts = array(
        'news'   => array('name' => 'الأخبار', 'singular' => 'خبر', 'icon' => 'dashicons-megaphone'),
        'events' => array('name' => 'المناسبات', 'singular' => 'مناسبة', 'icon' => 'dashicons-calendar-alt'),
        'help'   => array('name' => 'المناشدات', 'singular' => 'مناشدة', 'icon' => 'dashicons-heart'),
        'lost'   => array('name' => 'المفقودات', 'singular' => 'بند مفقود', 'icon' => 'dashicons-search'),
        'person' => array('name' => 'شخصيات', 'singular' => 'شخصية', 'icon' => 'dashicons-admin-users'),
    );
    foreach ($cpts as $key => $value) {
        register_post_type( $key, array(
            'labels' => array('name' => $value['name'], 'singular_name' => $value['singular'], 'menu_name' => $value['name']),
            'public' => true, 'has_archive' => true, 'menu_icon' => $value['icon'],
            'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ), 'show_in_rest' => true,
        ));
    }
}
add_action( 'init', 'alzaytoon_register_custom_post_types' );

// 3. لوحة التحكم المخصصة (السوشيال ميديا + التصويت)
function alzaytoon_customize_register( $wp_customize ) {
    // السوشيال ميديا
    $wp_customize->add_section( 'alzaytoon_social', array('title' => 'إعدادات التواصل', 'priority' => 30) );
    $socials = array('facebook' => 'فيسبوك', 'instagram' => 'انستجرام', 'telegram' => 'تيليجرام', 'youtube' => 'يوتيوب', 'whatsapp' => 'واتساب', 'phone' => 'الهاتف');
    foreach($socials as $key => $label) {
        $wp_customize->add_setting( 'alzaytoon_'.$key, array('default' => '') );
        $wp_customize->add_control( 'alzaytoon_'.$key, array('label' => $label, 'section' => 'alzaytoon_social', 'type' => 'text') );
    }
    
    // التصويت
    $wp_customize->add_section( 'alzaytoon_poll_section', array('title' => 'نظام التصويت (الرئيسية)', 'priority' => 31) );
    $wp_customize->add_setting( 'alzaytoon_poll_question', array('default' => 'ما تقييمك لمستوى الخدمات مؤخراً؟') );
    $wp_customize->add_control( 'alzaytoon_poll_question', array('label' => 'سؤال التصويت:', 'section' => 'alzaytoon_poll_section', 'type' => 'text') );
    for($i=1; $i<=3; $i++) {
        $wp_customize->add_setting( 'alzaytoon_poll_opt'.$i, array('default' => 'الخيار '.$i) );
        $wp_customize->add_control( 'alzaytoon_poll_opt'.$i, array('label' => 'خيار '.$i.':', 'section' => 'alzaytoon_poll_section', 'type' => 'text') );
    }
}
add_action( 'customize_register', 'alzaytoon_customize_register' );

// 4. نظام المشاهدات ووقت القراءة
function alzaytoon_set_post_views($postID) {
    $count = get_post_meta($postID, 'post_views_count', true);
    $count = ($count == '') ? '1' : $count + 1;
    update_post_meta($postID, 'post_views_count', $count);
}
function alzaytoon_get_post_views($postID){
    $count = get_post_meta($postID, 'post_views_count', true);
    return ($count == '') ? "0" : $count;
}
function alzaytoon_reading_time() {
    $content = get_post_field( 'post_content', get_the_ID() );
    return ceil(str_word_count( strip_tags( $content ) ) / 200) . " دقائق";
}

// 5. نظام استقبال المناشدات (AJAX)
function alzaytoon_handle_submit_appeal() {
    $post_id = wp_insert_post(array(
        'post_title' => sanitize_text_field($_POST['appeal_title']),
        'post_content' => sanitize_textarea_field($_POST['appeal_content']),
        'post_status' => 'pending', 'post_type' => 'help'
    ));
    if ($post_id) {
        update_post_meta($post_id, '_help_sender', sanitize_text_field($_POST['appeal_name']));
        update_post_meta($post_id, '_help_phone', sanitize_text_field($_POST['appeal_phone']));
        wp_send_json_success(array('message' => 'تم استلام مناشدتك الرسمية بنجاح.'));
    } else {
        wp_send_json_error(array('message' => 'خطأ في النظام.'));
    }
}
add_action('wp_ajax_submit_appeal', 'alzaytoon_handle_submit_appeal');
add_action('wp_ajax_nopriv_submit_appeal', 'alzaytoon_handle_submit_appeal');
