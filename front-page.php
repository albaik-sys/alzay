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
            <p>الديوان الإلكتروني العام استقبال طلبات المواطنين</p>
        </button>
    </section>

    <div class="gov-two-column-master-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px; margin-bottom: 40px; align-items: start;">
        
        <div class="royal-content-panel royal-box">
            <div class="panel-header-gov">
                <span><i class="fas fa-file-invoice" style="color:var(--gold); margin-left:8px;"></i> ديوان ومتابعة المناشدات الحالية</span>
                <button class="btn-yellow" onclick="openGovModal('help')" style="background:var(--gold); color:#fff; border:none; padding:5px 12px; cursor:pointer; font-weight:bold; font-size:12px; border-radius:3px;">+ أضف مناشدة</button>
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
                <div class="compact-gov-list-row">
                    <div class="compact-right-side">
                        <span class="appeal-gov-tag <?php echo $badge_class; ?>"><i class="<?php echo $badge_ico; ?>"></i> <?php echo $badge_txt; ?></span>
                        <a href="<?php the_permalink(); ?>" class="compact-row-title-link"><?php the_title(); ?></a>
                    </div>
                    <span class="compact-row-date-stamp"><i class="far fa-calendar-alt"></i> <?php echo get_the_date('d/m/Y'); ?></span>
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
                        <label class="poll-label-radio" style="display:block; margin-bottom:12px; position:relative; padding-right:20px; cursor:pointer;">
                            <input type="radio" name="poll_vote_radio" value="1" style="position:absolute; right:0; top:4px;">
                            <span class="radio-custom-txt" style="font-size:13.5px; font-weight:700;">ممتاز ومستقر جداً</span>
                            <div class="poll-track-bg" style="width:100%; height:6px; background:#eee; margin-top:5px; border-radius:3px; overflow:hidden;"><div class="poll-fill-progress" id="barFill1" style="height:100%; background:var(--primary); width:0%;"></div></div>
                            <span class="poll-percentage-num" id="percentTxt1" style="position:absolute; left:0; top:0; font-size:11px; font-weight:900;"></span>
                        </label>
                        <label class="poll-label-radio" style="display:block; margin-bottom:12px; position:relative; padding-right:20px; cursor:pointer;">
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

            <div class="royal-content-panel royal-box" style="border:1px solid var(--gold);">
                <div class="panel-header-gov" style="background:var(--primary); color:#fff; font-weight:800;"><i class="fas fa-star" style="color:var(--gold); margin-left:8px;"></i> شخصية الأسبوع البارزة</div>
                <div class="widget-content" style="padding:20px 15px; text-align:center; background:#fff;">
                    <?php
                    $person_query = new WP_Query(array('post_type' => 'person', 'posts_per_page' => 1, 'post_status' => 'publish'));
                    if ($person_query->have_posts()) : while ($person_query->have_posts()) : $person_query->the_post();
                    if (has_post_thumbnail()) { the_post_thumbnail('medium', array('style'=>'width:90px;height:90px;border-radius:50%;margin:0 auto 12px;border:3px solid var(--gold);object-fit:cover;display:block;')); }
                    ?>
                    <h3 style="color:var(--primary); font-weight:800; font-size:15px; margin-bottom:6px;"><?php the_title(); ?></h3>
                    <p style="font-size:12.5px; color:#555; line-height:1.5; margin-bottom:12px; text-align:justify;"><?php echo wp_trim_words(get_the_content(), 14, '...'); ?></p>
                    <a href="<?php the_permalink(); ?>" class="view-all-gov-btn" style="padding:5px 12px; font-size:12px; display:inline-block; font-weight:700; background:#f9fafb; border:1px solid #eee; border-radius:4px;">السيرة الكاملة &laquo;</a>
                    <?php endwhile; wp_reset_postdata(); endif; ?>
                </div>
            </div>

            <div class="royal-content-panel royal-box" style="border-top:3px solid #e74c3c;">
                <div class="panel-header-gov" style="background:#fff; color:#e74c3c; font-weight:800;"><i class="fas fa-phone-volume"></i> دليل هاتف الطوارئ والخدمات للحي</div>
                <div class="panel-inner-body" style="padding:0;">
                    <div class="emergency-item-row" style="display:flex; justify-content:space-between; align-items:center; padding:10px 15px; border-bottom:1px solid #f9f9f9;">
                        <span style="font-size:13px; font-weight:700; color:#333;"><i class="fas fa-ambulance" style="color:#e74c3c; margin-left:6px;"></i> الإسعاف والطوارئ</span>
                        <a href="tel:101" style="font-family:sans-serif !important; font-size:13px; font-weight:900; color:#e74c3c; background:rgba(231,76,60,0.08); padding:2px 8px; border-radius:3px;">101</a>
                    </div>
                    <div class="emergency-item-row" style="display:flex; justify-content:space-between; align-items:center; padding:10px 15px; border-bottom:1px solid #f9f9f9;">
                        <span style="font-size:13px; font-weight:700; color:#333;"><i class="fas fa-fire-extinguisher" style="color:#e67e22; margin-left:6px;"></i> الدفاع المدني</span>
                        <a href="tel:102" style="font-family:sans-serif !important; font-size:13px; font-weight:900; color:#e67e22; background:rgba(230,126,34,0.08); padding:2px 8px; border-radius:3px;">102</a>
                    </div>
                    <div class="emergency-item-row" style="display:flex; justify-content:space-between; align-items:center; padding:10px 15px; border-bottom:1px solid #f9f9f9;">
                        <span style="font-size:13px; font-weight:700; color:#333;"><i class="fas fa-shield-alt" style="color:#2980b9; margin-left:6px;"></i> الشرطة والنجدة</span>
                        <a href="tel:100" style="font-family:sans-serif !important; font-size:13px; font-weight:900; color:#2980b9; background:rgba(41,128,185,0.08); padding:2px 8px; border-radius:3px;">100</a>
                    </div>
                    <div class="emergency-item-row" style="display:flex; justify-content:space-between; align-items:center; padding:10px 15px;">
                        <span style="font-size:13px; font-weight:700; color:#333;"><i class="fas fa-faucet" style="color:#27ae60; margin-left:6px;"></i> طوارئ المياه والبلدية</span>
                        <a href="tel:115" style="font-family:sans-serif !important; font-size:13px; font-weight:900; color:#27ae60; background:rgba(39,174,96,0.08); padding:2px 8px; border-radius:3px;">115</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <section class="gov-home-section" style="margin-bottom: 45px;">
        <div class="block-header-gov" style="margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center;">
            <h2><i class="fas fa-search"></i> بوابة الاستعلام عن المفقودات الحالية (طلبات وعروض)</h2>
            <a href="<?php echo get_post_type_archive_link('lost'); ?>" class="gov-view-all-link" style="font-size:13px; font-weight:700; text-decoration:none; background:rgba(17,92,56,0.06); padding:5px 12px; border-radius:3px; color:var(--primary);">مركز المفقودات كامل &laquo;</a>
        </div>

        <div class="lost-articles-list-vertical-wrapper" style="display: flex; flex-direction: column; gap: 15px;">
            <?php 
            $lost_query = new WP_Query(array('post_type' => 'lost', 'posts_per_page' => 4, 'post_status' => 'publish'));
            if($lost_query->have_posts()) : while($lost_query->have_posts()) : $lost_query->the_post(); 
                $p_id = get_the_ID();
                $card_sender = get_post_meta($p_id, '_gov_sender_name', true);
                $card_phone = get_post_meta($p_id, '_gov_phone_address', true);
            ?>
            <div class="lost-list-row-item-box" style="display: flex; align-items: center; justify-content: space-between; background: #fff; border: 1px solid #e2e8f0; border-right: 4px solid var(--gold); padding: 15px 20px; border-radius: 4px; gap: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.01);">
                <div style="display: flex; flex-direction: column; gap: 6px; flex: 1;">
                    <h3 style="font-size: 15.5px; font-weight: 800; margin: 0;"><a href="<?php the_permalink(); ?>" style="color:#1a1a1a; text-decoration:none;"><?php the_title(); ?></a></h3>
                    <div style="display: flex; align-items: center; flex-wrap: wrap; gap: 15px; font-size: 12.5px; color: #666;">
                        <?php if(!empty($card_sender)) : ?>
                            <span><i class="fas fa-user-circle" style="color:var(--primary);"></i> <strong>المعلن:</strong> <?php echo esc_html($card_sender); ?></span>
                        <?php endif; ?>
                        <?php if(!empty($card_phone)) : ?>
                            <span style="color:var(--primary); font-weight:700;"><i class="fas fa-phone-alt"></i> <?php echo esc_html($card_phone); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <span style="font-size: 12px; color: #999; white-space: nowrap;"><i class="far fa-calendar-check"></i> اليوم: <?php echo get_the_date('l, d/m'); ?></span>
            </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
    </section>

    <section class="home-bottom-adv-banner" style="background: linear-gradient(135deg, #115c38 0%, #0b3d25 100%); border: 2px solid var(--gold); border-radius: 6px; padding: 30px; text-align: center; color: #fff; margin: 40px 0; position: relative; overflow: hidden;">
        <h3 style="font-size: 20px; font-weight: 900; color: var(--gold); margin-bottom: 8px;">مساحة إعلانية مخصصة لشركات ومحلات حي الزيتون</h3>
        <p style="font-size: 14px; color: #e2e8f0; max-width: 600px; margin: 0 auto;">لرعاية وتطوير الأنشطة الخيرية والخدمية داخل الحي، يرجى التواصل مع إدارة الشبكة عبر بوابة اتصل بنا الرسمية أو عبر رقم الواتساب المعتمد.</p>
    </section>

    <section class="custom-categories-master-section" style="margin: 40px 0 60px 0;">
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 25px;">
            
            <div class="royal-content-panel royal-box">
                <div class="panel-header-gov" style="background:#1e7e4e; color:#fff; border-bottom-color:var(--gold);"><i class="fas fa-laptop-code"></i> نبض التكنولوجيا والرقميات بالحي</div>
                <div class="panel-inner-body" style="padding:10px 0;">
                    <?php
                    $tech_query = new WP_Query(array('post_type' => 'news', 'posts_per_page' => 3, 'post_status' => 'publish'));
                    if ($tech_query->have_posts()) : while ($tech_query->have_posts()) : $tech_query->the_post();
                    ?>
                    <div class="compact-news-row-item">
                        <span class="compact-tech-dot"></span>
                        <a href="<?php the_permalink(); ?>" class="compact-news-link-txt"><?php the_title(); ?></a>
                        <span class="compact-news-time-badge"><?php echo get_the_date('d/m'); ?></span>
                    </div>
                    <?php endwhile; wp_reset_postdata(); endif; ?>
                </div>
            </div>

            <div class="royal-content-panel royal-box">
                <div class="panel-header-gov" style="background:#1e7e4e; color:#fff; border-bottom-color:var(--gold);"><i class="fas fa-feather-alt"></i> شؤون محلية وتقارير ومقالات مصورة</div>
                <div class="panel-inner-body" style="padding:10px 0;">
                    <?php
                    $local_query = new WP_Query(array('post_type' => 'events', 'posts_per_page' => 3, 'post_status' => 'publish'));
                    if ($local_query->have_posts()) : while ($local_query->have_posts()) : $local_query->the_post();
                    ?>
                    <div class="compact-news-row-item">
                        <span class="compact-tech-dot" style="background:var(--gold);"></span>
                        <a href="<?php the_permalink(); ?>" class="compact-news-link-txt"><?php the_title(); ?></a>
                        <span class="compact-news-time-badge"><?php echo get_the_date('d/m'); ?></span>
                    </div>
                    <?php endwhile; wp_reset_postdata(); endif; ?>
                </div>
            </div>

        </div>
    </section>

</div>

<?php get_footer(); ?>
