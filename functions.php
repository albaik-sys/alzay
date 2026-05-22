<?php
/**
 * Al-Zaytoon Official Theme Functions
 */

// ربط المكتبات وملف التنسيقات الرئيسي مع كاسر الكاش
function alzaytoon_royal_scripts() {
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', array(), '6.5.2' );
    wp_enqueue_style( 'alzaytoon-royal-style', get_stylesheet_uri(), array(), time() ); 
}
add_action( 'wp_enqueue_scripts', 'alzaytoon_royal_scripts' );

// إعدادات دعم الثيم والقوائم
function alzaytoon_royal_setup() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    register_nav_menus( array( 'primary' => 'القائمة الرئيسية' ) );
}
add_action( 'after_setup_theme', 'alzaytoon_royal_setup' );

// تسجيل الأقسام المخصصة (Custom Post Types)
function alzaytoon_royal_cpts() {
    $cpts = array(
        'news'   => array('name' => 'الأخبار', 'singular' => 'خبر', 'icon' => 'dashicons-megaphone'),
        'events' => array('name' => 'المناسبات', 'singular' => 'مناسبة', 'icon' => 'dashicons-calendar-alt'),
        'help'   => array('name' => 'المناشدات والمساعدات', 'singular' => 'مناشدة', 'icon' => 'dashicons-heart'),
        'lost'   => array('name' => 'المفقودات', 'singular' => 'مفقود', 'icon' => 'dashicons-search'),
        'person' => array('name' => 'شخصية الأسبوع', 'singular' => 'شخصية', 'icon' => 'dashicons-admin-users'),
    );
    foreach ($cpts as $key => $value) {
        register_post_type( $key, array(
            'labels' => array(
                'name' => $value['name'], 
                'singular_name' => $value['singular'], 
                'menu_name' => $value['name'],
                'add_new' => 'إضافة جديد',
                'add_new_item' => 'إضافة ' . $value['singular'] . ' جديد'
            ),
            'public' => true, 
            'has_archive' => true, 
            'menu_icon' => $value['icon'],
            'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ), 
            'show_in_rest' => true,
        ));
    }
}
add_action( 'init', 'alzaytoon_royal_cpts' );

// إدارة لوحة التحكم (Customizer) للتصويت والسوشيال ميديا
function alzaytoon_royal_customizer( $wp_customize ) {
    $wp_customize->add_section( 'alzaytoon_social_section', array( 'title' => 'إعدادات شبكة الزيتون (التواصل)', 'priority' => 30 ) );
    $fields = array('facebook' => 'رابط الفيسبوك', 'whatsapp' => 'رقم الواتساب', 'telegram' => 'رابط التيليجرام', 'phone' => 'رقم الهاتف للاتصال');
    foreach($fields as $key => $label) {
        $wp_customize->add_setting( 'alzaytoon_'.$key, array('default' => '') );
        $wp_customize->add_control( 'alzaytoon_'.$key, array('label' => $label, 'section' => 'alzaytoon_social_section', 'type' => 'text') );
    }

    $wp_customize->add_section( 'alzaytoon_poll_section', array( 'title' => 'إعدادات استطلاعات الرأي والقرار', 'priority' => 31 ) );
    $wp_customize->add_setting( 'alzaytoon_poll_question', array('default' => 'ما رأيك في مستوى الخدمات المقدمة في حي الزيتون مؤخراً؟') );
    $wp_customize->add_control( 'alzaytoon_poll_question', array('label' => 'سؤال الاستطلاع الحالي:', 'section' => 'alzaytoon_poll_section', 'type' => 'text') );
    for($i=1; $i<=3; $i++) {
        $wp_customize->add_setting( 'alzaytoon_poll_opt'.$i, array('default' => 'خيار ' . $i) );
        $wp_customize->add_control( 'alzaytoon_poll_opt'.$i, array('label' => 'خيار الإجابة رقم ' . $i . ':', 'section' => 'alzaytoon_poll_section', 'type' => 'text') );
    }
}
add_action( 'customize_register', 'alzaytoon_royal_customizer' );

// نظام المشاهدات ووقت القراءة
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
    return ($count == '') ? "0" : $count;
}
function alzaytoon_reading_time() {
    $content = get_post_field( 'post_content', get_the_ID() );
    $word_count = str_word_count( strip_tags( $content ) );
    $readingtime = ceil($word_count / 200);
    return ($readingtime <= 1) ? "دقيقة واحدة" : $readingtime . " دقائق";
}

// عرض الصناديق في لوحة التحكم لمراجعة ومعاينة تفاصيل الإرسال
function alzaytoon_register_gov_boxes() {
    add_meta_box( 'gov_meta_details', 'تفاصيل الاستمارة الإلكترونية المحفوظة', 'alzaytoon_gov_meta_html', array('help', 'lost'), 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'alzaytoon_register_gov_boxes' );

function alzaytoon_gov_meta_html($post) {
    $phone = get_post_meta($post->ID, '_gov_phone_address', true);
    $sender = get_post_meta($post->ID, '_gov_sender_name', true);
    $end_date = get_post_meta($post->ID, '_gov_end_date', true);
    ?>
    <div style="padding:12px; font-size:14px; line-height: 1.6;">
        <p><strong>اسم مقدم الطلب:</strong> <?php echo esc_html($sender); ?></p>
        <p><strong>رقم الجوال / العنوان:</strong> <?php echo esc_html($phone); ?></p>
        <p><strong>تاريخ انتهاء النشر والاهتمام:</strong> <?php echo esc_html($end_date); ?></p>
    </div>
    <?php
}

// معالج الأجاكس المتطور لاستقبال وحفظ المفقودات والمناشدات مع التحقق الرياضي العشوائي الآمن
function alzaytoon_submit_gov_form_ajax() {
    // 1. التحقق من الكابتشا العشوائية
    $user_captcha = isset($_POST['captcha_input']) ? intval($_POST['captcha_input']) : 0;
    $correct_captcha = isset($_POST['captcha_correct']) ? intval($_POST['captcha_correct']) : -1;

    if ($user_captcha !== $correct_captcha) {
        wp_send_json_error(array('message' => 'رمز التحقق العشوائي (الكابتشا) غير صحيح، يرجى المحاولة مرة أخرى.'));
    }

    $form_type = sanitize_text_field($_POST['form_type']); // إما help أو lost
    $title_prefix = ($form_type == 'lost') ? 'بلاغ مفقود: ' : 'مناشدة عاجلة: ';

    // 2. إدخال المقال بالداتابيز في حالة الانتظار والمراجعة (Pending)
    $post_id = wp_insert_post(array(
        'post_title'   => $title_prefix . sanitize_text_field($_POST['appeal_title']),
        'post_content' => sanitize_textarea_field($_POST['appeal_content']),
        'post_status'  => 'pending', 
        'post_type'    => $form_type,
    ));

    if($post_id) {
        update_post_meta($post_id, '_gov_sender_name', sanitize_text_field($_POST['appeal_name']));
        update_post_meta($post_id, '_gov_phone_address', sanitize_text_field($_POST['appeal_phone']));
        update_post_meta($post_id, '_gov_end_date', sanitize_text_field($_POST['appeal_end']));
        
        // رفع وتعيين الصورة المرفقة إن وجدت
        if (!empty($_FILES['appeal_image']['name'])) {
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');
            $attach_id = media_handle_upload('appeal_image', $post_id);
            if (!is_wp_error($attach_id)) { set_post_thumbnail($post_id, $attach_id); }
        }
        wp_send_json_success(array('message' => 'تم استلام المعاملة بنجاح وحفظها برقم إشاري بروتوكولي في لوحة القيادة وهي قيد المراجعة والتدقيق الآن.'));
    } else {
        wp_send_json_error(array('message' => 'عذراً، فشل في حفظ البيانات بنظام الجدار الحمايتي.'));
    }
}
add_action('wp_ajax_submit_gov_form', 'alzaytoon_submit_gov_form_ajax');
add_action('wp_ajax_nopriv_submit_gov_form', 'alzaytoon_submit_gov_form_ajax');
