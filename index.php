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
        <button class="portal-box color-2" onclick="openGovModal('lost')" style="width:100%; text-align:right; border:none; cursor:pointer;">
            <div class="portal-icon-circle"><i class="fas fa-search-location"></i></div>
            <h3>بوابة المفقودات</h3>
            <p>النظام الذكي للإبلاغ والمساعدة في إيجاد المفقودات</p>
        </button>
        <a href="<?php echo get_post_type_archive_link('help'); ?>" class="portal-box color-3">
            <div class="portal-icon-circle"><i class="fas fa-hand-holding-heart"></i></div>
            <h3>لجنة المساعدات</h3>
            <p>بوابة التكافل والدعم المجتمعي الشامل لأهلنا</p>
        </a>
        <button class="portal-box color-4" onclick="openGovModal('help')" style="width:100%; text-align:right; border:none; cursor:pointer;">
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
                    $badge = get_post_meta(get_the_ID(), '_appeal_badge_status', true);
                    $badge_class = 'badge-new'; $badge_txt = 'جديد'; $badge_ico = 'fas fa-star';
                    if($badge == 'urgent') { $badge_class = 'badge-urgent'; $badge_txt = 'عاجلة'; $badge_ico = 'fas fa-exclamation-triangle'; }
                    elseif($badge == 'necessary') { $badge_class = 'badge-necessary'; $badge_txt = 'ضرورية'; $badge_ico = 'fas fa-exclamation-circle'; }
                    elseif($badge == 'following') { $badge_class = 'badge-following'; $badge_txt = 'قيد المتابعة'; $badge_ico = 'fas fa-sync'; }
                ?>
                <div class="appeal-official-row">
                    <span class="appeal-gov-tag <?php echo $badge_class; ?>"><i class="<?php echo $badge_ico; ?>"></i> <?php echo $badge_txt; ?></span>
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
        <div class="block-header-gov center-aligned-header"><i class="fas fa-layer-group"></i> منوعات ومختارات شاملة من كافة أقسام المنصة</div>
        <div class="random-articles-grid">
            <?php
            $random_articles = new WP_Query(array('post_type' => array('news', 'events', 'help', 'lost', 'person'), 'orderby' => 'rand', 'posts_per_page' => 4));
            if($random_articles->have_posts()) : while($random_articles->have_posts()) : $random_articles->the_post();
                $c_id = get_the_ID(); $c_type = get_post_type($c_id);
                $c_sender = get_post_meta($c_id, '_gov_sender_name', true);
                $c_phone = get_post_meta($c_id, '_gov_phone_address', true);
            ?>
            <article class="random-article-card">
                <a href="<?php the_permalink(); ?>" class="random-card-img-wrap">
                    <?php if(has_post_thumbnail()) { the_post_thumbnail('medium_large'); } else { echo "<img src='https://picsum.photos/400/260?random=".rand(1,999)."'>"; } ?>
                    <span class="random-type-badge"><?php echo get_post_type_object($c_type)->labels->singular_name; ?></span>
                </a>
                <div class="random-card-text">
                    <h3><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 9, '...'); ?></a></h3>
                    <?php if(in_array($c_type, array('help', 'lost')) && (!empty($c_sender) || !empty($c_phone))) : ?>
                        <div class="grid-gov-info-badge">
                            <?php if(!empty($c_phone)) : ?>
                                <span><i class="fas fa-phone-alt"></i> <?php echo esc_html($c_phone); ?></span>
                            <?php elseif(!empty($c_sender)) : ?>
                                <span><i class="fas fa-user"></i> <?php echo esc_html($c_sender); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="random-card-footer-meta">
                        <span><i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
                        <span><i class="far fa-eye"></i> <?php echo alzaytoon_get_post_views($c_id); ?> قراءة</span>
                    </div>
                </div>
            </article>
            <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
    </section>

    <section class="gov-categorized-rows-section">
        <div class="gov-double-column-rows">
            
            <div class="gov-row-block">
                <div class="block-header-gov"><i class="far fa-newspaper"></i> منوعات أخبار حي الزيتون</div>
                <div class="gov-row-list-items">
                    <?php
                    $block_news = new WP_Query(array('post_type' => 'news', 'posts_per_page' => 3));
                    if($block_news->have_posts()) : while($block_news->have_posts()) : $block_news->the_post();
                    ?>
                    <div class="gov-row-horizontal-card">
                        <div class="horizontal-card-img">
                            <?php if(has_post_thumbnail()) { the_post_thumbnail('thumbnail'); } else { echo "<img src='https://picsum.photos/120/90?random=".rand(1,99)."'>"; } ?>
                        </div>
                        <div class="horizontal-card-info">
                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <small><i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?></small>
                        </div>
                    </div>
                    <?php endwhile; endif; wp_reset_postdata(); ?>
                </div>
            </div>

            <div class="gov-row-block">
                <div class="block-header-gov"><i class="far fa-calendar-alt"></i> مناسبات وفعاليات المجتمع</div>
                <div class="gov-row-list-items">
                    <?php
                    $block_events = new WP_Query(array('post_type' => 'events', 'posts_per_page' => 3));
                    if($block_events->have_posts()) : while($block_events->have_posts()) : $block_events->the_post();
                    ?>
                    <div class="gov-row-horizontal-card">
                        <div class="horizontal-card-img">
                            <?php if(has_post_thumbnail()) { the_post_thumbnail('thumbnail'); } else { echo "<img src='https://picsum.photos/120/90?random=".rand(1,99)."'>"; } ?>
                        </div>
                        <div class="horizontal-card-info">
                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <small><i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?></small>
                        </div>
                    </div>
                    <?php endwhile; endif; wp_reset_postdata(); ?>
                </div>
            </div>

        </div>
    </section>

</div>

<?php get_footer(); ?>
    <section class="home-dual-news-tables">
        <div class="news-table-block">
            <div class="news-table-header">
                <span><i class="fas fa-bullhorn"></i> التعميمات والبلاغات الرسمية</span>
                <span class="table-badge">الديوان العام</span>
            </div>
            <div class="news-table-rows">
                <?php
                // استعلام لجلب آخر 3 تدوينات من تصنيف معين أو من المفقودات/المناشدات
                $table_query1 = new WP_Query(array('post_type' => array('news', 'help'), 'posts_per_page' => 3, 'post_status' => 'publish'));
                if($table_query1->have_posts()) : while($table_query1->have_posts()) : $table_query1->the_post();
                ?>
                <div class="news-table-row-item">
                    <a href="<?php the_permalink(); ?>" class="table-row-title"><?php the_title(); ?></a>
                    <span class="table-row-date"><i class="far fa-clock"></i> <?php echo get_the_date('d M'); ?></span>
                </div>
                <?php endwhile; else: ?>
                <div class="news-table-row-item"><span class="table-row-title">لا توجد بلاغات رسمية منشورة حالياً.</span></div>
                <?php endif; wp_reset_postdata(); ?>
            </div>
        </div>

        <div class="news-table-block">
            <div class="news-table-header">
                <span><i class="far fa-calendar-check"></i> أجندة الفعاليات والأنشطة القادمة</span>
                <span class="table-badge">اللجنة المجتمعية</span>
            </div>
            <div class="news-table-rows">
                <?php
                $table_query2 = new WP_Query(array('post_type' => 'events', 'posts_per_page' => 3, 'post_status' => 'publish'));
                if($table_query2->have_posts()) : while($table_query2->have_posts()) : $table_query2->the_post();
                ?>
                <div class="news-table-row-item">
                    <a href="<?php the_permalink(); ?>" class="table-row-title"><?php the_title(); ?></a>
                    <span class="table-row-date"><i class="far fa-calendar-alt"></i> <?php echo get_the_date('d M'); ?></span>
                </div>
                <?php endwhile; else: ?>
                <div class="news-table-row-item"><span class="table-row-title">لا توجد فعاليات مجدولة حالياً.</span></div>
                <?php endif; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>

    <section class="home-bottom-adv-banner">
        <h3 class="adv-banner-title">مساحة إعلانية مخصصة لشركات ومحلات حي الزيتون</h3>
        <p class="adv-banner-desc">لرعاية وتطوير الأنشطة الخيرية والخدمية داخل الحي، يرجى التواصل مع إدارة الشبكة عبر بوابة اتصل بنا الرسمية أو عبر رقم الواتساب المعتمد.</p>
    </section>

