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
        <div class="date-text"><i class="far fa-calendar-alt"></i> <?php echo wp_date('l, d F Y'); ?></div>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-whatsapp"></i></a>
            <a href="#"><i class="fab fa-telegram-plane"></i></a>
        </div>
    </div>
</div>

<header class="main-header">
    <div class="container">
        <div class="logo-box">
            <i class="fas fa-tree logo-icon"></i>
            <div class="logo-text">
                <h1>شبكة حي الزيتون</h1>
                <span>المنصة الإعلامية الرسمية</span>
            </div>
        </div>
        <div class="header-buttons">
            <a href="#" class="btn-outline"><i class="fas fa-bullhorn"></i> تقديم مناشدة</a>
            <a href="#" class="btn-outline"><i class="fas fa-search"></i> الإبلاغ عن مفقود</a>
        </div>
    </div>
</header>

<nav class="navbar">
    <div class="container">
        <ul class="nav-links">
            <li><a href="<?php echo home_url(); ?>"><i class="fas fa-home"></i> الرئيسية</a></li>
            <li><a href="<?php echo get_post_type_archive_link('news'); ?>"><i class="far fa-newspaper"></i> أخبار الحي</a></li>
            <li><a href="<?php echo get_post_type_archive_link('events'); ?>"><i class="far fa-calendar-alt"></i> المناسبات</a></li>
            <li><a href="<?php echo get_post_type_archive_link('help'); ?>"><i class="fas fa-hands-helping"></i> المناشدات</a></li>
            <li><a href="<?php echo get_post_type_archive_link('person'); ?>"><i class="fas fa-user-tie"></i> شخصية الأسبوع</a></li>
        </ul>
        <a href="#" class="contact-btn"><i class="fas fa-phone-alt"></i> اتصل بنا</a>
    </div>
</nav>
