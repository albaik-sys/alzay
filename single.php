<?php get_header(); ?>

<div class="container single-post-main-container">
    <?php while(have_posts()) : the_post(); 
        // تفعيل عداد المشاهدات بأمان
        if (function_exists('alzaytoon_set_post_views')) {
            alzaytoon_set_post_views(get_the_ID());
        }
        
        $p_id = get_the_ID();
        $p_type = get_post_type($p_id);
    ?>
    
    <header class="post-header-gov-style">
        <div class="post-breadcrumbs-gov">
            <a href="<?php echo home_url(); ?>">الرئيسية</a> / 
            <span><?php echo get_post_type_object($p_type)->labels->name; ?></span>
        </div>
        <h1 class="post-main-headline"><?php the_title(); ?></h1>
        
        <div class="post-meta-details-strip">
            <div class="meta-publish-datetime">
                نشر في: <?php echo get_the_date('d F Y'); ?> | الساعة: <?php echo get_the_time('h:i A'); ?>
            </div>
            <div class="meta-reading-views-stats">
                <span><i class="far fa-clock"></i> مدة القراءة: <?php echo function_exists('alzaytoon_reading_time') ? alzaytoon_reading_time() : 'دقيقتين'; ?></span>
                <span class="views-count-alert-badge"><i class="far fa-eye"></i> شوهد: <?php echo function_exists('alzaytoon_get_post_views') ? alzaytoon_get_post_views($p_id) : '0'; ?> مرة</span>
            </div>
        </div>
    </header>

    <div class="post-layout-columns-grid">
        <article class="post-main-content-column">
            <?php if(has_post_thumbnail()) : ?>
            <div class="post-featured-photo-frame">
                <?php the_post_thumbnail('large'); ?>
            </div>
            <?php endif; ?>

            <div class="post-body-typography-content">
                <?php the_content(); ?>
            </div>

            <?php 
            if ( in_array($p_type, array('help', 'lost')) ) : 
                $has_excerpt = has_excerpt($p_id);
                if ( $has_excerpt || !empty(get_post_meta($p_id, '_gov_phone_address', true)) ) :
            ?>
                <div class="magical-details-block">
                    <div class="magical-details-header">
                        <i class="fas fa-clipboard-list"></i> التفاصيل والبيانات الإضافية للمعامـلة الرسميـة
                    </div>
                    <div class="magical-details-body">
                        <p class="magical-text-desc">
                            <?php 
                            if( $has_excerpt ) {
                                the_excerpt();
                            } else {
                                echo 'مرفق في مطلع البيان كافة معلومات الاتصال الجوالية والعنوانية الموثقة التابعة لـ ' . get_post_type_object($p_type)->labels->singular_name . ' المنشورة عبر الديوان العام لشبكة حي الزيتون للاستعلام والخدمات. يرجى المتابعة والاهتمام.';
                            }
                            ?>
                        </p>
                        <div class="magical-footer-stamp">
                            <span class="stamp-item"><i class="fas fa-shield-alt"></i> معاملة معتمدة للعامة</span>
                            <span class="stamp-item"><i class="fas fa-check-circle"></i> مدققة إلكترونياً</span>
                        </div>
                    </div>
                </div>
            <?php 
                endif; 
            endif; 
            ?>

            <div class="post-share-footer-block">
                <h3><i class="fas fa-share-alt"></i> مشاركة المقال عبر شبكات التواصل الاجتماعي:</h3>
                <div class="share-links-btn-grid">
                    <a href="https://api.whatsapp.com/send?text=<?php echo urlencode(get_the_title() . ' - ' . get_permalink()); ?>" target="_blank" class="share-btn-item whatsapp-btn-color"><i class="fab fa-whatsapp"></i> واتســاب</a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-btn-item facebook-btn-color"><i class="fab fa-facebook-f"></i> فيسبــوك</a>
                    <a href="https://t.me/share/url?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share-btn-item telegram-btn-color"><i class="fab fa-telegram-plane"></i> تيليجــرام</a>
                </div>
            </div>
        </article>

        <aside class="post-sidebar-share-column">
            <div class="sticky-sidebar-share-holder">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="floating-btn-ico f-fb" title="مشاركة عبر فيسبوك"><i class="fab fa-facebook-f"></i></a>
                <a href="https://api.whatsapp.com/send?text=<?php echo urlencode(get_the_title() . ' - ' . get_permalink()); ?>" target="_blank" class="floating-btn-ico f-wa" title="مشاركة عبر واتساب"><i class="fab fa-whatsapp"></i></a>
                <a href="https://t.me/share/url?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="floating-btn-ico f-tg" title="مشاركة عبر تيليجرام"><i class="fab fa-telegram-plane"></i></a>
                <a href="javascript:window.print()" class="floating-btn-ico f-print" title="طباعة المقال رسمياً"><i class="fas fa-print"></i></a>
            </div>
        </aside>
    </div>

    <?php endwhile; ?>
</div>

<?php get_footer(); ?>
