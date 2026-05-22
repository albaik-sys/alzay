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

/* =========================================================
   نظام المناشدات التفاعلي (استقبال + حقول مخصصة)
========================================================= */

// 1. إضافة الحقول المخصصة (رقم الجوال، التواريخ) لصفحة تعديل المناشدة في الإدارة
function alzaytoon_help_meta_boxes() {
    add_meta_box( 'help_details', 'تفاصيل المناشدة (من الزوار)', 'alzaytoon_help_meta_box_html', 'help', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'alzaytoon_help_meta_boxes' );

function alzaytoon_help_meta_box_html( $post ) {
    $phone = get_post_meta( $post->ID, '_help_phone', true );
    $start_date = get_post_meta( $post->ID, '_help_start', true );
    $end_date = get_post_meta( $post->ID, '_help_end', true );
    $sender_name = get_post_meta( $post->ID, '_help_sender', true );
    ?>
    <div style="padding: 10px;">
        <p><label><strong>اسم المرسل:</strong></label><br><input type="text" style="width:100%" value="<?php echo esc_attr($sender_name); ?>" readonly></p>
        <p><label><strong>رقم الجوال:</strong></label><br><input type="text" style="width:100%" value="<?php echo esc_attr($phone); ?>" readonly></p>
        <p><label><strong>تاريخ البداية:</strong></label><br><input type="date" value="<?php echo esc_attr($start_date); ?>" readonly></p>
        <p><label><strong>تاريخ الانتهاء:</strong></label><br><input type="date" value="<?php echo esc_attr($end_date); ?>" readonly></p>
    </div>
    <?php
}

// 2. معالجة طلب إرسال المناشدة من الزوار (AJAX)
add_action('wp_ajax_submit_appeal', 'alzaytoon_handle_submit_appeal');
add_action('wp_ajax_nopriv_submit_appeal', 'alzaytoon_handle_submit_appeal');

function alzaytoon_handle_submit_appeal() {
    if ( !isset($_POST['appeal_title']) || empty($_POST['appeal_title']) ) {
        wp_send_json_error(array('message' => 'يرجى إدخال عنوان المناشدة.'));
    }

    // إنشاء المقال بحالة "بانتظار المراجعة" (Pending)
    $post_data = array(
        'post_title'   => sanitize_text_field($_POST['appeal_title']),
        'post_content' => sanitize_textarea_field($_POST['appeal_content']),
        'post_status'  => 'pending', // لن يظهر بالموقع حتى توافق عليه
        'post_type'    => 'help',
    );
    $post_id = wp_insert_post($post_data);

    if ($post_id) {
        // حفظ البيانات الإضافية
        update_post_meta($post_id, '_help_sender', sanitize_text_field($_POST['appeal_name']));
        update_post_meta($post_id, '_help_phone', sanitize_text_field($_POST['appeal_phone']));
        update_post_meta($post_id, '_help_start', sanitize_text_field($_POST['appeal_start']));
        update_post_meta($post_id, '_help_end', sanitize_text_field($_POST['appeal_end']));

        // معالجة الصورة المرفقة
        if (!empty($_FILES['appeal_image']['name'])) {
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');
            $attachment_id = media_handle_upload('appeal_image', $post_id);
            if (!is_wp_error($attachment_id)) {
                set_post_thumbnail($post_id, $attachment_id);
            }
        }
        wp_send_json_success(array('message' => 'تم إرسال مناشدتك بنجاح! سيتم مراجعتها من قبل الإدارة قريباً.'));
    } else {
        wp_send_json_error(array('message' => 'حدث خطأ أثناء الإرسال. حاول مرة أخرى.'));
    }
}
