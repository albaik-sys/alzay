<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="rtl">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="topbar">
    <div class="container">
        <div class="date-box"><i class="far fa-calendar-alt"></i> <?php echo wp_date('l, d F Y'); ?></div>
        <div class="topbar-middle">المنصة الرسمية والديوان الإلكتروني لأهالي حي الزيتون</div>
        <div class="topbar-social">
            <a href="<?php echo esc_url(get_theme_mod('alzaytoon_facebook', '#')); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://wa.me/<?php echo esc_attr(get_theme_mod('alzaytoon_whatsapp', '')); ?>" target="_blank"><i class="fab fa-whatsapp"></i></a>
            <a href="<?php echo esc_url(get_theme_mod('alzaytoon_telegram', '#')); ?>" target="_blank"><i class="fab fa-telegram-plane"></i></a>
        </div>
    </div>
</div>

<header class="main-header">
    <div class="container">
        <div class="header-logo-area">
            <i class="fas fa-tree logo-symbol"></i>
            <div class="logo-title">
                <h1>شبكة حي الزيتون</h1>
                <span>الإعلاميــة والخدميــة</span>
            </div>
        </div>
        <div class="header-action-buttons-royal">
            <button class="gov-btn-royal bg-emerald" onclick="openGovModal('help')">
                <span class="icon-holder-gov"><i class="fas fa-bullhorn"></i></span>
                <div class="btn-gov-text">
                    <strong>تقديم مناشدة</strong>
                    <small>الديوان الإلكتروني للطلب</small>
                </div>
            </button>
            <button class="gov-btn-royal bg-amber" onclick="openGovModal('lost')">
                <span class="icon-holder-gov"><i class="fas fa-search-plus"></i></span>
                <div class="btn-gov-text">
                    <strong>الإبلاغ عن مفقود</strong>
                    <small>بوابة المفقودات الذكية</small>
                </div>
            </button>
        </div>
    </div>
</header>

<nav class="navbar-wrap">
    <div class="container">
        <button class="mobile-menu-btn" id="mobileToggle"><i class="fas fa-bars"></i> قائمة الشبكة الرسمية</button>
        <div class="nav-menu-container">
            <ul class="nav-ul" id="navUl">
                <li class="close-mobile-li"><a href="javascript:void(0)" id="mobileCloseMenu"><i class="fas fa-times"></i> إغلاق القائمة</a></li>
                <li><a href="<?php echo home_url(); ?>"><i class="fas fa-home"></i> الرئيسية</a></li>
                <li><a href="<?php echo get_post_type_archive_link('news'); ?>"><i class="far fa-newspaper"></i> أخبار الحي</a></li>
                <li><a href="<?php echo get_post_type_archive_link('events'); ?>"><i class="far fa-calendar-alt"></i> المناسبات والفعاليات</a></li>
                <li><a href="<?php echo get_post_type_archive_link('help'); ?>"><i class="fas fa-hand-holding-heart"></i> المناشدات والدعم</a></li>
                <li><a href="<?php echo get_post_type_archive_link('person'); ?>"><i class="fas fa-user-tie"></i> شخصية الأسبوع</a></li>
            </ul>
        </div>
        <a href="tel:<?php echo esc_attr(get_theme_mod('alzaytoon_phone', '')); ?>" class="nav-contact-link"><i class="fas fa-phone-alt"></i> اتصل بنا</a>
    </div>
</nav>

<div class="gov-news-ticker-strip">
    <div class="container ticker-flex-container">
        <div class="ticker-badge-title">
            <i class="fas fa-bullhorn"></i> <?php echo esc_html(get_theme_mod('alzaytoon_ticker_title', 'تنويه رسمي عاجل')); ?>
        </div>
        <div class="ticker-text-window">
            <span id="typingTickerElement" class="typing-text-data"></span>
            <span class="typing-cursor">|</span>
        </div>
    </div>
</div>
