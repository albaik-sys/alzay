<?php get_header(); ?>

<div class="container home-layout official-container royal-layout">
    
    <section class="royal-hero-section" style="margin-bottom: 40px;">
        <div class="hero-sidebar-news royal-box">
            <div class="block-header-gov"><i class="fas fa-bolt" style="color:var(--gold); margin-left:8px;"></i> أحدث الأخبــار</div>
            <div class="sidebar-news-list">
                <?php
                $news_query = new WP_Query(array('post_type' => 'news', 'posts_per_page' => 4, 'post_status' => 'publish'));
                if ($news_query->have_posts()) : while ($news_query->have_posts()) : $news_query->the_post();
                ?>
                <div class="sidebar-news-card">
                    <div class="card-thumb">
                        <?php if (has_post_thumbnail()) : the_post_thumbnail('thumbnail'); else : ?>
                            <img src="https://picsum.photos/90/65?random=<?php echo get_the_ID(); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="card-details">
                        <h4><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 8, '...'); ?></a></h4>
                        <small><i class="far fa-clock"></i> <?php echo get_the_date('d F Y'); ?></small>
                    </div>
                </div>
                <?php endwhile; wp_reset_postdata(); endif; ?>
            </div>
            <a href="<?php echo get_post_type_archive_link('news'); ?>" class="view-all-gov-btn">غرفة الأخبار كاملة &laquo;</a>
        </div>

        <div class="hero-slider-showcase royal-shadow">
            <?php
            $events_query = new WP_Query(array('post_type' => 'events', 'posts_per_page' => 1, 'post_status' => 'publish'));
            if ($events_query->have_posts()) : while ($events_query->have_posts()) : $events_query->the_post();
                $slider_img = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : 'https://picsum.photos/1000/500';
            ?>
            <div class="slider-panel-img" style="background: url('<?php echo $slider_img; ?>') center/cover;">
                <div class="slider-panel-gradient">
                    <span class="badge-gold-royal"><i class="fas fa-star"></i> خبر مميز وتغطية خاصة</span>
                    <h2><?php the_title(); ?></h2>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                    <a href="<?php the_permalink(); ?>" class="btn-royal-gold">اقرأ التفاصيل الرسمية</a>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
    </section>

    <section class="four-royal-portals" style="margin-bottom: 40px;">
        <a href="<?php echo get_post_type_archive_link('person'); ?>" class="portal-box color-1 royal-card">
            <div class="portal-icon-circle" style="background: rgba(214, 175, 55, 0.15); color: #d4af37;"><i class="fas fa-award"></i></div>
            <h3>شخصية الأسبوع</h3>
            <p>رموز ملهمة ونماذج مشرفة من أبناء الحي</p>
        </a>
        <a href="javascript:void(0)" onclick="openGovModal('lost')" class="portal-box color-2 royal-card">
            <div class="portal-icon-circle" style="background: rgba(231, 76, 60, 0.15); color: #e74c3c;"><i class="fas fa-search-location"></i></div>
            <h3>بوابة المفقودات</h3>
            <p>النظام المركزي للإبلاغ والعثور على المفقودات</p>
        </a>
        <a href="<?php echo get_post_type_archive_link('help'); ?>" class="portal-box color-3 royal-card">
            <div class="portal-icon-circle" style="background: rgba(46, 204, 113, 0.15); color: #2ecc71;"><i class="fas fa-hand-holding-heart"></i></div>
            <h3>المساعدات والدعم</h3>
            <p>بوابة التكافل والدعم الاجتماعي الشامل لأهلنا</p>
        </a>
        <button class="portal-box color-4 royal-card" onclick="openGovModal('help')" style="width:100%; text-align:right; border:none; cursor:pointer;">
            <div class="portal-icon-circle" style="background: rgba(255,255,255,0.2); color: #fff;"><i class="fas fa-bullhorn"></i></div>
            <h3>أرسل مناشدة</h3>
            <p>الديوان الإلكتروني العام لاستقبال طلبات المواطنين</p>
        </button>
    </section>

    <div class="middle-layout-grid" style="margin-bottom: 40px;">
        
        <div class="royal-content-panel royal-box">
            <div class="panel-header-gov">
                <span><i class="fas fa-file-invoice" style="color:var(--gold); margin-left:8px;"></i> ديوان ومتابعة المناشدات الحالية</span>
                <button class="btn-yellow royal-btn-small" onclick="openGovModal('help')" style="background:var(--gold); color:#fff; border:none; padding:5px 12px; cursor:pointer;">+ أضف مناشدة</button>
            </div>
            <div class="panel-inner-body" style="padding:0;">
                <?php
                $help_query = new WP_Query(array('post_type' => 'help', 'posts_per_page' => 6, 'post_status' => 'publish'));
                if ($help_query->have_posts()) : while ($help_query->have_posts()) : $help_query->the_post();
                    $badge = get_post_meta(get_the_ID(), '_appeal_badge_status', true);
                    $badge_class = 'badge-new'; $badge_txt = 'جديد'; $badge_ico = 'fas fa-star';
                    if($badge == 'urgent') { $badge_class = 'badge-urgent'; $badge_txt = 'عاجلة'; $badge_ico = 'fas fa-exclamation-triangle'; }
                    elseif($badge == 'necessary') { $badge_class = 'badge-necessary'; $badge_txt = 'ضرورية'; $badge_ico = 'fas fa-exclamation-circle'; }
                    elseif($badge == 'following') { $badge_class = 'badge-following'; $badge_txt = 'قيد المتابعة'; $badge_ico = 'fas fa-sync'; }
                ?>
                <div class="appeal-official-row" style="padding: 15px 20px; border-bottom: 1px solid #f0f0f0;">
                    <span class="appeal-gov-tag <?php echo $badge_class; ?>"><i class="<?php echo $badge_ico; ?>"></i> <?php echo $badge_txt; ?></span>
                    <a href="<?php the_permalink(); ?>" class="appeal-title-link" style="font-weight:700; font-size:14.5px;"><?php the_title(); ?></a>
                    <span class="appeal-row-date" style="color:#888; font-size:12px;"><i class="far fa-calendar-alt"></i> <?php echo get_the_date('d/m/Y'); ?></span>
                </div>
                <?php endwhile; wp_reset_postdata(); endif; ?>
            </div>
            <a href="<?php echo get_post_type_archive_link('help'); ?>" class="view-all-gov-btn" style="text-align:center; display:block; padding:12px; background:#fafafa; font-weight:700;">تصفح كافة المناشدات المعتمدة &laquo;</a>
        </div>

        <div class="sidebar-widgets-wrap" style="display:flex; flex-direction:column; gap:25px;">
            
            <div class="royal-content-panel royal-box">
                <div class="panel-header-gov"><i class="fas fa-poll-h" style="color:var(--gold); margin-left:8px;"></i> مركز استطلاعات الرأي</div>
                <div class="panel-inner-body poll-wrapper-box" style="padding:20px;">
                    <h3 class="poll-question-title" style="font-size:14.5px; margin-bottom:15px; font-weight:700; line-height:1.5; text-align:center;"><?php echo get_theme_mod('poll_q', 'ما رأيك في مستوى الخدمات والبنية التحتية في حي الزيتون مؤخراً؟'); ?></h3>
                    <form id="royalPollForm">
                        <label class="poll-label-radio" style="display:block; margin-bottom:12px; position:relative; padding-right:20px;">
                            <input type="radio" name="poll_vote_radio" value="1" style="position:absolute; right:0; top:4px;">
                            <span class="radio-custom-txt" style="font-size:13.5px; font-weight:700;">ممتاز ومستقر جداً</span>
                            <div class="poll-track-bg" style="width:100%; height:6px; background:#eee; margin-top:5px; border-radius:3px; overflow:hidden;"><div class="poll-fill-progress" id="barFill1" style="height:100%; background:var(--primary); width:0%;"></div></div>
                            <span class="poll-percentage-num" id="percentTxt1" style="position:absolute; left:0; top:0; font-size:11px; font-weight:900;"></span>
                        </label>
                        <label class="poll-label-radio" style="display:block; margin-bottom:12px; position:relative; padding-right:20px;">
                            <input type="radio" name="poll_vote_radio" value="2" style="position:absolute; right:0; top:4px;">
                            <span class="radio-custom-txt" style="font-size:13.5px; font-weight:700;">متوسط وبحاجة لتحسين</span>
                            <div class="poll-track-bg" style="width:100%; height:6px; background:#eee; margin-top:5px; border-radius:3px; overflow:hidden;"><div class="poll-fill-progress" id="barFill2" style="height:100%; background:var(--primary); width:0%;"></div></div>
                            <span class="poll-percentage-num" id="percentTxt2" style="position:absolute; left:0; top:0; font-size:11px; font-weight:900;"></span>
                        </label>
                        <button type="button" class="btn-royal-gold full-width-btn" onclick="triggerRoyalPollSubmit()" style="width:100%; padding:10px; border:none; background:var(--gold); color:#fff; font-weight:bold; cursor:pointer; margin-top:10px; border-radius:4px;">اعتماد تصويتي الرسمي</button>
                    </form>
                    <p id="pollAckMsg" class="poll-success-ack" style="display:none; text-align:center; color:var(--primary); font-weight:bold; font-size:13px; margin-top:10px;">تم اعتماد الصوت، شكراً لك.</p>
                </div>
            </div>

            <div class="royal-content-panel royal-box">
                <div class="panel-header-gov"><i class="fas fa-search" style="color:var(--gold); margin-left:8px;"></i> بوابة المفقودات الحالية</div>
                <div class="panel-inner-body" style="padding:0;">
                    <?php
                    $lost_query = new WP_Query(array('post_type' => 'lost', 'posts_per_page' => 3, 'post_status' => 'publish'));
                    if ($lost_query->have_posts()) : while ($lost_query->have_posts()) : $lost_query->the_post();
                    ?>
                    <a href="<?php the_permalink(); ?>" style="display:flex; justify-content:space-between; align-items:center; padding:15px 20px; border-bottom:1px solid #eee; transition:0.3s;" onmouseover="this.style.background='#fafafa'" onmouseout="this.style.background='#fff'">
                        <span style="font-size:13.5px; font-weight:700; color:var(--dark);"><i class="fas fa-question-circle" style="color:var(--gold); margin-left:6px;"></i> <?php the_title(); ?></span>
                        <span style="font-size:11px; color:#888; white-space:nowrap;"><i class="far fa-clock"></i> <?php echo get_the_date('d/m'); ?></span>
                    </a>
                    <?php endwhile; wp_reset_postdata(); endif; ?>
                </div>
                <a href="<?php echo get_post_type_archive_link('lost'); ?>" class="view-all-gov-btn" style="text-align:center; display:block; padding:12px; background:#fafafa; font-weight:700;">مركز المفقودات كامل &laquo;</a>
            </div>

        </div>
    </div>

    <section class="random-articles-section" style="margin-top:40px;">
        <div class="block-header-gov center-aligned-header"><i class="fas fa-layer-group"></i> منوعات ومختارات من شبكة الزيتون</div>
        <div class="random-articles-grid" style="margin-top:20px;">
            <?php
            $random_articles = new WP_Query(array('post_type' => array('news', 'events', 'person'), 'orderby' => 'rand', 'posts_per_page' => 4, 'post_status' => 'publish'));
            if($random_articles->have_posts()) : while($random_articles->have_posts()) : $random_articles->the_post();
            ?>
            <article class="random-article-card gov-archive-card">
                <a href="<?php the_permalink(); ?>" class="random-card-img-wrap">
                    <?php if(has_post_thumbnail()) { the_post_thumbnail('medium_large'); } else { echo "<img src='https://picsum.photos/400/260?random=".get_the_ID()."'>"; } ?>
                    <span class="random-type-badge"><?php echo get_post_type_object(get_post_type())->labels->singular_name; ?></span>
                </a>
                <div class="random-card-text" style="padding:15px;">
                    <h3 style="font-size:14px; font-weight:800; line-height:1.5; margin-bottom:10px;"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 9, '...'); ?></a></h3>
                    <div class="random-card-footer-meta">
                        <span><i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
                        <span><i class="far fa-eye"></i> <?php echo alzaytoon_get_post_views(get_the_ID()); ?> قراءة</span>
                    </div>
                </div>
            </article>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
    </section>

</div>

<?php get_footer(); ?>
