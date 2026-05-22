<?php
/**
 * Al-Zaytoon Official Theme Functions - Master Version
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

// إدارة لوحة التحكم (Customizer) للتصويت والسوشيال ميديا والشريط الإخباري
function alzaytoon_royal_customizer( $wp_customize ) {
    // السوشيال ميديا
    $wp_customize->add_section( 'alzaytoon_social_section', array( 'title' => 'إعدادات شبكة الزيتون (التواصل)', 'priority' => 30 ) );
    $fields = array('facebook' => 'رابط الفيسبوك', 'whatsapp' => 'رقم الواتساب', 'telegram' => 'رابط التيليجرام', 'phone' => 'رقم الهاتف للاتصال');
    foreach($fields as $key => $label) {
        $wp_customize->add_setting( 'alzaytoon_'.$key, array('default' => '') );
        $wp_customize->add_control( 'alzaytoon_'.$key, array('label' => $label, 'section' => 'alzaytoon_social_section', 'type' => 'text') );
    }

    // نظام الشريط الإخباري الذكي (آلة الكتابة)
    $wp_customize->add_section( 'alzaytoon_ticker_section', array( 'title' => 'إعدادات الشريط الإخباري العاجل', 'priority' => 32 ) );
    $wp_customize->add_setting( 'alzaytoon_ticker_title', array('default' => 'تنويه رسمي عاجل') );
    $wp_customize->add_control( 'alzaytoon_ticker_title', array('label' => 'عنوان الشريط الأحمر:', 'section' => 'alzaytoon_ticker_section', 'type' => 'text') );
    $wp_customize->add_setting( 'alzaytoon_ticker_text', array('default' => 'باقي 5 أيام على الإطلاق الرسمي للمنصة الإلكترونية الموحدة لحي الزيتون... شاركنا الآن برأيك وبلاغاتك.') );
    $wp_customize->add_control( 'alzaytoon_ticker_text', array('label' => 'نص آلة الكتابة المتحرك:', 'section' => 'alzaytoon_ticker_section', 'type' => 'textarea') );

    // نظام التصويت المطور
    $wp_customize->add_section( 'alzaytoon_poll_section', array( 'title' => 'إعدادات استطلاعات الرأي والقرار', 'priority' => 31 ) );
    $wp_customize->add_setting( 'alzaytoon_poll_question', array('default' => 'ما رأيك في مستوى الخدمات المقدمة في حي الزيتون مؤخراً؟') );
    $wp_customize->add_control( 'alzaytoon_poll_question', array('label' => 'سؤال الاستطلاع الحالي:', 'section' => 'alzaytoon_poll_section', 'type' => 'text') );
    for($i=1; $i<=3; $i++) {
        $wp_customize->add_setting( 'alzaytoon_poll_opt'.$i, array('default' => 'خيار ' . $i) );
        $wp_customize->add_control( 'alzaytoon_poll_opt'.$i, array('label' => 'خيار الإجابة رقم ' . $i . ':', 'section' => 'alzaytoon_poll_section', 'type' => 'text') );
    }
}
add_action( 'customize_register', 'alzaytoon_royal_customizer' );

// نظام عداد المشاهدات
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
    return ceil($word_count / 200) . " دقائق";
}

// إضافة صناديق التحكم (Meta Boxes) للمناشدات والمفقودات في لوحة الإدارة
function alzaytoon_register_gov_boxes() {
    add_meta_box( 'gov_meta_details', 'تفاصيل الاستمارة الإلكترونية المحفوظة', 'alzaytoon_gov_meta_html', array('help', 'lost'), 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'alzaytoon_register_gov_boxes' );

function alzaytoon_gov_meta_html($post) {
    $phone = get_post_meta($post->ID, '_gov_phone_address', true);
    $sender = get_post_meta($post->ID, '_gov_sender_name', true);
    $end_date = get_post_meta($post->ID, '_gov_end_date', true);
    $badge_status = get_post_meta($post->ID, '_appeal_badge_status', true);
    ?>
    <div style="padding:12px; font-size:14px; line-height: 1.6;">
        <p><strong>اسم مقدم الطلب / العضو:</strong> <input type="text" name="gov_sender_name" style="width:100%; height:30px;" value="<?php echo esc_attr($sender); ?>"></p>
        <p><strong>رقم الجوال / العنوان للتواصل الاتصالي:</strong> <input type="text" name="gov_phone_address" style="width:100%; height:30px;" value="<?php echo esc_attr($phone); ?>"></p>
        <p><strong>تاريخ انتهاء الفعالية والاهتمام:</strong> <input type="date" name="gov_end_date" style="width:100%; height:30px;" value="<?php echo esc_attr($end_date); ?>"></p>
        
        <p><strong>مسميات جاهزة لاختيار نوع المقال وعرضه ديناميكياً:</strong><br>
        <select name="appeal_badge_status" style="width:100%; height:35px; margin-top:5px; font-weight:bold;">
            <option value="urgent" <?php selected($badge_status, 'urgent'); ?>>🚨 عاجلة</option>
            <option value="necessary" <?php selected($badge_status, 'necessary'); ?>>⚠️ ضرورية</option>
            <option value="following" <?php selected($badge_status, 'following'); ?>>🔄 قيد المتابعة</option>
            <option value="new" <?php selected($badge_status, 'new'); ?>>✨ جديد</option>
        </select></p>
    </div>
    <?php
}

function alzaytoon_save_gov_meta($post_id) {
    if (array_key_exists('appeal_badge_status', $_POST)) { update_post_meta($post_id, '_appeal_badge_status', sanitize_text_field($_POST['appeal_badge_status'])); }
    if (array_key_exists('gov_sender_name', $_POST)) { update_post_meta($post_id, '_gov_sender_name', sanitize_text_field($_POST['gov_sender_name'])); }
    if (array_key_exists('gov_phone_address', $_POST)) { update_post_meta($post_id, '_gov_phone_address', sanitize_text_field($_POST['gov_phone_address'])); }
    if (array_key_exists('gov_end_date', $_POST)) { update_post_meta($post_id, '_gov_end_date', sanitize_text_field($_POST['gov_end_date'])); }
}
add_action('save_post', 'alzaytoon_save_gov_meta');

// دمج حقل معلومات الاتصال تلقائياً في أول المقال لكل من قسم المناشدات والمفقودات
function alzaytoon_prepend_contact_box_to_content($content) {
    if (is_singular(array('help', 'lost'))) {
        $post_id = get_the_ID();
        $sender = get_post_meta($post_id, '_gov_sender_name', true);
        $phone = get_post_meta($post_id, '_gov_phone_address', true);
        $end_date = get_post_meta($post_id, '_gov_end_date', true);
        
        $type_label = (get_post_type($post_id) == 'lost') ? 'صاحب البلاغ' : 'مقدم المناشدة';
        $icon_label = (get_post_type($post_id) == 'lost') ? 'fa-search' : 'fa-bullhorn';

        if(!empty($phone) || !empty($sender)) {
            $contact_html = '
            <div class="royal-contact-info-card">
                <div class="contact-card-title"><i class="fas ' . $icon_label . '"></i> البيانات الرسمية ومعلومات الاتصال الموثقة</div>
                <div class="contact-card-grid">
                    ' . (!empty($sender) ? '<div class="contact-meta-item"><strong><i class="fas fa-user"></i> اسم ' . $type_label . ':</strong> ' . esc_html($sender) . '</div>' : '') . '
                    ' . (!empty($phone) ? '<div class="contact-meta-item"><strong><i class="fas fa-address-book"></i> الجوال / العنوان:</strong> <span class="gov-highlight-phone">' . esc_html($phone) . '</span></div>' : '') . '
                    ' . (!empty($end_date) ? '<div class="contact-meta-item"><strong><i class="far fa-calendar-check"></i> تاريخ انتهاء النشر:</strong> ' . esc_html($end_date) . '</div>' : '') . '
                </div>
            </div>';
            $content = $contact_html . $content;
        }
    }
    return $content;
}
add_filter('the_content', 'alzaytoon_prepend_contact_box_to_content');

// معالج الأجاكس لحفظ المقالات بانتظار المراجعة
function alzaytoon_submit_gov_form_ajax() {
    $user_captcha = isset($_POST['captcha_input']) ? intval($_POST['captcha_input']) : 0;
    $correct_captcha = isset($_POST['captcha_correct']) ? intval($_POST['captcha_correct']) : -1;
    if ($user_captcha !== $correct_captcha) { wp_send_json_error(array('message' => 'رمز التحقق العشوائي غير صحيح، حاول مرة أخرى.')); }

    $form_type = sanitize_text_field($_POST['form_type']);
    $post_id = wp_insert_post(array(
        'post_title'   => sanitize_text_field($_POST['appeal_title']),
        'post_content' => sanitize_textarea_field($_POST['appeal_content']),
        'post_status'  => 'pending', 
        'post_type'    => $form_type,
    ));
    if($post_id) {
        update_post_meta($post_id, '_gov_sender_name', sanitize_text_field($_POST['appeal_name']));
        update_post_meta($post_id, '_gov_phone_address', sanitize_text_field($_POST['appeal_phone']));
        update_post_meta($post_id, '_gov_end_date', sanitize_text_field($_POST['appeal_end']));
        update_post_meta($post_id, '_appeal_badge_status', 'new');
        if (!empty($_FILES['appeal_image']['name'])) {
            require_once(ABSPATH . 'wp-admin/includes/image.php'); require_once(ABSPATH . 'wp-admin/includes/file.php'); require_once(ABSPATH . 'wp-admin/includes/media.php');
            $attach_id = media_handle_upload('appeal_image', $post_id);
            if (!is_wp_error($attach_id)) { set_post_thumbnail($post_id, $attach_id); }
        }
        wp_send_json_success(array('message' => 'تم استلام المعاملة بنجاح، وهي بانتظار مراجعة وقبول الإدارة.'));
    } else { wp_send_json_error(array('message' => 'فشل في حفظ البيانات.')); }
}
add_action('wp_ajax_submit_gov_form', 'alzaytoon_submit_gov_form_ajax');
add_action('wp_ajax_nopriv_submit_gov_form', 'alzaytoon_submit_gov_form_ajax');
