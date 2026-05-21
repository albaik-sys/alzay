<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="rtl">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class='topbar'>
    <div class='container'>
        <div class='date'><i class='far fa-calendar-alt'></i> <?php echo wp_date('l d F Y'); ?></div>
        <div class='topbar-text'>من قلب حي الزيتون... نكتب لأجل أهلنا</div>
        <div class='social'>
            <a href='#'><i class='fab fa-facebook-f'></i></a>
            <a href='#'><i class='fab fa-instagram'></i></a>
            <a href='#'><i class='fab fa-telegram'></i></a>
            <a href='#'><i class='fab fa-youtube'></i></a>
        </div>
    </div>
</div>

<header class='main-header'>
    <div class='container'>
        <div class='logo-area'>
            <div class='logo-text'>
                <h1>شبكة حي الزيتون</h1>
                <span>الإعلامية</span>
            </div>
            <i class='fas fa-tree logo-icon'></i>
        </div>
        <div class='header-actions'>
            <a href='#' class='action-box'><i class='fas fa-bullhorn'></i><span>مناشدات</span></a>
            <a href='<?php echo get_post_type_archive_link("help"); ?>' class='action-box'><i class='fas fa-hand-holding-heart'></i><span>مساعدات</span></a>
            <a href='<?php echo get_post_type_archive_link("lost"); ?>' class='action-box'><i class='fas fa-search'></i><span>مفقودات</span></a>
        </div>
    </div>
</header>

<nav class='navbar-wrap'>
    <div class='container'>
        <button class='mobile-menu-toggle' id='menuToggle'><i class='fas fa-bars'></i></button>

        <div class='navbar'>
            <ul id='mobileMenu'>
                <li class='close-menu-li'><a href='javascript:void(0)' id='closeMenu'><i class='fas fa-times'></i> إغلاق القائمة</a></li>
                <li class='active'><a href='<?php echo home_url(); ?>'><i class='fas fa-home'></i> الرئيسية</a></li>
                <li><a href='<?php echo get_post_type_archive_link("news"); ?>'><i class='far fa-newspaper'></i> أخبار الحي</a></li>
                <li><a href='<?php echo get_post_type_archive_link("events"); ?>'><i class='far fa-calendar-alt'></i> المناسبات</a></li>
                <li><a href='<?php echo get_post_type_archive_link("help"); ?>'><i class='fas fa-hand-holding-heart'></i> المساعدات</a></li>
                <li><a href='#'><i class='fas fa-bullhorn'></i> مناشدات أهل الحي</a></li>
                <li><a href='<?php echo get_post_type_archive_link("lost"); ?>'><i class='fas fa-search'></i> مفقودات</a></li>
                <li><a href='<?php echo get_post_type_archive_link("person"); ?>'><i class='fas fa-user-tie'></i> شخصية الأسبوع</a></li>
                <li><a href='#'><i class='fas fa-info-circle'></i> من نحن</a></li>
            </ul>
        </div>
        <a href='#' class='contact-btn'><i class='fas fa-phone-alt'></i> اتصل بنا</a>
    </div>
</nav>
