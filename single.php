<?php get_header(); ?>

<div class="container single-post-main-container">
    <?php while(have_posts()) : the_post(); alzaytoon_set_post_views(get_the_ID()); ?>
    
    <header class="post-header-gov-style">
        <div class="post-breadcrumbs-gov">
            <a href="<?php echo home_url(); ?>">الرئيسية</a> / <span><?php echo get_post_type_object(get_post_type())->labels->name; ?></span>
        </div>
        <h1 class="post-main-headline"><?php the_title(); ?></h1>
        
        <div class="post-meta-details-strip">
            <div class="meta-publish-datetime">
                نشر في: <?php echo get_the_date('d F Y'); ?> | الساعة: <?php echo get_the_time('h:i A'); ?>
            </div>
            <div class="meta-reading-views-stats">
                <span><i class="far fa-clock"></i> مدة القراءة: <?php echo alzaytoon_reading_time(); ?></span>
                <span class="views-count-alert-badge"><i class="far fa-eye"></i> شوهد: <?php echo alzaytoon_get_post_views(get_the_ID()); ?> مرة</span>
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

            <?php if(in_array(get_post_type(), array('help', 'lost'))) : ?>
                <div class="magical-details-block">
                    <div class="magical-details-header">
                        <i class="fas fa-clipboard-list"></i> التفاصيل والبيانات الإضافية للمعامـلة
                    </div>
                    <div class="magical-details-body">
                        <p class="magical-text-desc">
                            <?php 
                            // جلب المقتطف أو نص الشرح الإضافي بطريقة منسقة
                            if(has_excerpt()) {
                                the_excerpt();
                            } else {
                                echo 'مرفق أعلاه كافة بيانات الاتصال المعتمدة لـ ' . get_post_type_object(get_post_type())->labels->singular_name . ' المنشورة رسمياً عبر ديوان شبكة حي الزيتون للإعلام والخدمات العامة. يرجى من الأهالي الكرام أخذ العلم والتعاون المباشر.';
                            }
                            ?>
                        </p>
                        <div class="magical-footer-stamp">
                            <span class="stamp-item"><i class="fas fa-shield-alt"></i> معاملة معتمدة</span>
                            <span class="stamp-item"><i class="fas fa-check-circle"></i> تم التدقيق الإلكتروني</span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

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
</div>

<?php get_footer(); ?>
