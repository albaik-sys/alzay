<?php get_header(); ?>

<div class="container main-content-wrap">
    
    <section class="royal-hero-section">
        <div class="hero-sidebar-news">
            <div class="block-header-gov"><i class="fas fa-bolt"></i> عاجل وأحدث الأخبار</div>
            <div class="sidebar-news-list">
                <?php
                $news = new WP_Query(array('post_type' => 'news', 'posts_per_page' => 4));
                if($news->have_posts()) : while($news->have_posts()) : $news->the_post();
                ?>
                <div class="sidebar-news-card">
                    <div class="card-thumb">
                        <?php if(has_post_thumbnail()) { the_post_thumbnail('thumbnail'); } else { echo "<img src='https://picsum.photos/90/65?random=".rand(1,500)."'>"; } ?>
                    </div>
                    <div class="card-details">
                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <small><i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?></small>
                    </div>
                </div>
                <?php endwhile; endif; wp_reset_postdata(); ?>
            </div>
            <a href="<?php echo get_post_type_archive_link('news'); ?>" class="view-all-gov-btn">غرفة الأخبار كاملة &laquo;</a>
        </div>

        <div class="hero-slider-showcase">
            <?php
            $events = new WP_Query(array('post_type' => 'events', 'posts_per_page' => 1));
            if($events->have_posts()) : while($events->have_posts()) : $events->the_post();
            $slider_background = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : 'https://picsum.photos/1000/500';
            ?>
            <div class="slider-panel-img" style="background: url('<?php echo $slider_background; ?>') center/cover;">
                <div class="slider-panel-gradient">
                    <span class="badge-gold-royal"><i class="fas fa-star"></i> التغطية الكبرى</span>
                    <h2><?php the_title(); ?></h2>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 22); ?></p>
                    <a href="<?php the_permalink(); ?>" class="btn-royal-gold">تصفح التقارير الرسمية</a>
                </div>
            </div>
            <?php endwhile; else: ?>
            <div class="slider-panel-img" style="background: url('https://picsum.photos/1000/500') center/cover;">
                <div class="slider-panel-gradient">
                    <span class="badge-gold-royal"><i class="fas fa-star"></i> المنصة الرسمية</span>
                    <h2>مرحباً بكم في الموقع الإلكتروني لشبكة حي الزيتون</h2>
                    <p>يرجى إضافة مقالات ومناسبات في لوحة القيادة لتظهر هنا بصورة تلقائية ديناميكية ممتازة.</p>
                </div>
            </div>
            <?php endif; wp_reset_postdata(); ?>
        </div>
    </section>

    <section class="four-royal-portals">
        <a href="<?php echo get_post_type_archive_link('person'); ?>" class="portal-box color-1">
            <div class="portal-icon-circle"><i class="fas fa-award"></i></div>
            <h3>شخصيات بارزة</h3>
            <p>سجل الشرف والرموز والعلماء والملهمين في الحي</p>
        </a>
        <a href="<?php echo get_post_type_archive_link('lost'); ?>" class="portal-box color-2">
            <div class="portal-icon-circle"><i class="fas fa-search-location"></i></div>
            <h3>بوابة المفقودات</h3>
            <p>النظام الذكي للإبلاغ والمساعدة في إيجاد المفقودات</p>
        </a>
        <a href="<?php echo get_post_type_archive_link('help'); ?>" class="portal-box color-3">
            <div class="portal-icon-circle"><i class="fas fa-hand-holding-heart"></i></div>
            <h3>لجنة المساعدات</h3>
            <p>بوابة التكافل والدعم المجتمعي الشامل لأهلنا</p>
        </a>
        <button class="portal-box color-4" onclick="openAppealModal()" style="width:100%; text-align:right; border:none; cursor:pointer;">
            <div class="portal-icon-circle"><i class="fas fa-mail-bulk"></i></div>
            <h3>تقديم مناشدة</h3>
            <p>الديوان الإلكتروني العام لاستقبال وتوجيه الطلبات والشكاوى</p>
        </button>
    </section>

    <section class="middle-layout-grid">
        <div class="royal-content-panel">
            <div class="panel-header-gov"><i class="fas fa-file-invoice"></i> ديوان ومتابعة المناشدات الحالية</div>
            <div class="panel-inner-body">
                <?php
                $help_list = new WP_Query(array('post_type' => 'help', 'posts_per_page' => 4));
                if($help_list->have_posts()) : while($help_list->have_posts()) : $help_list->the_post();
                ?>
                <div class="appeal-official-row">
                    <span class="appeal-gov-tag">قيد المتابعة</span>
                    <a href="<?php the_permalink(); ?>" class="appeal-title-link"><?php the_title(); ?></a>
                    <span class="appeal-row-date"><i class="far fa-calendar"></i> <?php echo get_the_date('d/m/Y'); ?></span>
                </div>
                <?php endwhile; else: ?>
                    <p class="empty-panel-msg">لا توجد مناشدات منشورة ومعتمدة حالياً في الديوان العام.</p>
                <?php endif; wp_reset_postdata(); ?>
            </div>
        </div>

        <div class="royal-content-panel">
            <div class="panel-header-gov"><i class="fas fa-poll-h"></i> مركز استطلاعات الرأي واتخاذ القرار</div>
            <div class="panel-inner-body poll-wrapper-box">
                <h3 class="poll-question-title"><?php echo get_theme_mod('alzaytoon_poll_question', 'ما تقييمك لمستوى الخدمات والبنية التحتية في حي الزيتون مؤخراً؟'); ?></h3>
                <form id="royalPollForm">
                    <?php for($i=1; $i<=3; $i++) {
                        $opt_text = get_theme_mod('alzaytoon_poll_opt'.$i, 'الخيار ' . $i);
                        if(!empty($opt_text)) :
                    ?>
                    <label class="poll-label-radio">
                        <input type="radio" name="poll_vote_radio" value="<?php echo $i; ?>">
                        <span class="radio-custom-txt"><?php echo $opt_text; ?></span>
                        <div class="poll-track-bg"><div class="poll-fill-progress" id="barFill<?php echo $i; ?>"></div></div>
                        <span class="poll-percentage-num" id="percentTxt<?php echo $i; ?>"></span>
                    </label>
                    <?php endif; } ?>
                    <button type="button" class="btn-royal-gold full-width-btn" onclick="triggerRoyalPollSubmit()">اعتماد الصوت وإرسال</button>
                </form>
                <p id="pollAckMsg" class="poll-success-ack">تم تسجيل تصويتك الرسمي في خوادم الشبكة بنجاح، شكراً لمشاركتك.</p>
            </div>
        </div>
    </section>

    <section class="random-articles-section">
        <div class="block-header-gov center-aligned-header"><i class="fas fa-layer-group"></i> منوعات ومختارات من شبكة الزيتون</div>
        <div class="random-articles-grid">
            <?php
            $random_articles = new WP_Query(array('post_type' => array('news', 'events', 'person'), 'orderby' => 'rand', 'posts_per_page' => 4));
            if($random_articles->have_posts()) : while($random_articles->have_posts()) : $random_articles->the_post();
            ?>
            <article class="random-article-card">
                <a href="<?php the_permalink(); ?>" class="random-card-img-wrap">
                    <?php if(has_post_thumbnail()) { the_post_thumbnail('medium_large'); } else { echo "<img src='https://picsum.photos/400/260?random=".rand(1,999)."'>"; } ?>
                    <span class="random-type-badge"><?php echo get_post_type_object(get_post_type())->labels->singular_name; ?></span>
                </a>
                <div class="random-card-text">
                    <h3><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 10, '...'); ?></a></h3>
                    <div class="random-card-footer-meta">
                        <span><i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
                        <span><i class="far fa-eye"></i> <?php echo alzaytoon_get_post_views(get_the_ID()); ?> قراءة</span>
                    </div>
                </div>
            </article>
            <?php endwhile; else: ?>
                <p style="grid-column:1/-1; text-align:center; color:#666; padding:40px;">يرجى تزويد قاعدة البيانات بالمقالات لتفعيل نظام الترشيح العشوائي والمختارات الفخم.</p>
            <?php endif; wp_reset_postdata(); ?>
        </div>
    </section>

</div>

<div id="appealGovModal" class="gov-modal-overlay">
    <div class="gov-modal-container">
        <span class="gov-modal-close-icon" onclick="closeAppealModal()">&times;</span>
        <div class="gov-modal-title-header">
            <h3><i class="fas fa-file-signature"></i> بوابة الديوان الإلكتروني لاستقبال طلبات المواطنين</h3>
        </div>
        <form id="govAppealForm" class="gov-form-wrapper" enctype="multipart/form-data">
            <div class="gov-form-row-grid">
                <div class="form-group-box">
                    <label>الاسم الكامل رباعي:</label>
                    <input type="text" name="appeal_name" placeholder="أدخل اسمك الكامل" class="gov-form-input">
                </div>
                <div class="form-group-box">
                    <label>رقم هاتف التواصل والتحقق *:</label>
                    <input type="text" name="appeal_phone" placeholder="مثال: 059XXXXXXX" required class="gov-form-input">
                </div>
            </div>
            
            <div class="form-group-box">
                <label>موضوع المناشدة الرئيسي *:</label>
                <input type="text" name="appeal_title" placeholder="اكتب عنواناً واضحاً للمناشدة والطلب" required class="gov-form-input">
            </div>

            <div class="form-group-box">
                <label>شرح تفصيلي للطلب والمناشدة *:</label>
                <textarea name="appeal_content" placeholder="اكتب تفاصيل المناشدة والظروف والطلبات هنا بالتفصيل المكتمل..." required class="gov-form-input" rows="4"></textarea>
            </div>

            <div class="gov-form-row-grid">
                <div class="form-group-box">
                    <label>تاريخ بدء النشر المطلوب:</label>
                    <input type="date" name="appeal_start" class="gov-form-input">
                </div>
                <div class="form-group-box">
                    <label>تاريخ انتهاء النشر التلقائي:</label>
                    <input type="date" name="appeal_end" class="gov-form-input">
                </div>
            </div>

            <div class="form-group-box">
                <label>إرفاق وثائق، تقارير أو صور داعمة (اختياري):</label>
                <label class="custom-gov-file-uploader">
                    <i class="fas fa-upload"></i> تحميل الملفات أو الصور الداعمة للمناشدة
                    <input type="file" name="appeal_image" accept="image/*" style="display:none;">
                </label>
            </div>

            <input type="hidden" name="action" value="submit_appeal">
            <button type="submit" class="btn-royal-gold full-width-btn" id="govAppealSubmitBtn" style="margin-top:20px; font-size:16px;">إرسال المعاملة بشكل رسمي للديوان</button>
            <div id="govAppealStatusMsg" class="gov-ajax-response-message"></div>
        </form>
    </div>
</div>
