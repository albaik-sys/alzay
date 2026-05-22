<?php get_header(); ?>

<div class='container homepage-container royal-layout'>
    
    <section class='hero-section'>
        <div class='news-box royal-box'>
            <div class='box-title'><i class="fas fa-bolt" style="color:var(--yellow); margin-left:8px;"></i> أحدث الأخبار</div>
            <div class='news-list'>
                <?php
                $news_query = new WP_Query(array('post_type' => 'news', 'posts_per_page' => 4));
                if ($news_query->have_posts()) : while ($news_query->have_posts()) : $news_query->the_post();
                ?>
                <div class='news-item'>
                    <?php if (has_post_thumbnail()) : the_post_thumbnail('thumbnail'); else : ?>
                        <img src='https://picsum.photos/100/70?random=<?php echo rand(1,100); ?>'>
                    <?php endif; ?>
                    <div class='news-info'>
                        <h4><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 8, '...'); ?></a></h4>
                        <small><i class="far fa-clock"></i> <?php echo get_the_date('d F Y'); ?></small>
                    </div>
                </div>
                <?php endwhile; wp_reset_postdata(); endif; ?>
            </div>
            <a href='<?php echo get_post_type_archive_link("news"); ?>' class='all-news-btn'>المزيد من الأخبار <i class='fas fa-arrow-left'></i></a>
        </div>

        <?php
        $events_query = new WP_Query(array('post_type' => 'events', 'posts_per_page' => 1));
        if ($events_query->have_posts()) : while ($events_query->have_posts()) : $events_query->the_post();
            $slider_img = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : 'https://picsum.photos/1000/500';
        ?>
        <div class='slider-box royal-shadow' style="background: url('<?php echo $slider_img; ?>') center/cover;">
            <div class='slider-overlay'>
                <span class="badge-featured"><i class="fas fa-star"></i> خبر مميز</span>
                <h2><?php the_title(); ?></h2>
                <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                <a href='<?php the_permalink(); ?>' class='btn-yellow royal-btn'>اقرأ التفاصيل</a>
            </div>
        </div>
        <?php endwhile; wp_reset_postdata(); endif; ?>
    </section>

    <section class='services-row'>
        <a href='<?php echo get_post_type_archive_link("person"); ?>' class='service-card royal-card'>
            <div class="icon-wrap" style="background: rgba(245, 185, 21, 0.15); color: #d4af37;"><i class='fas fa-user-tie'></i></div>
            <h3>شخصية الأسبوع</h3>
            <p>رموز ملهمة من أبناء الحي</p>
        </a>
        <a href='<?php echo get_post_type_archive_link("lost"); ?>' class='service-card royal-card'>
            <div class="icon-wrap" style="background: rgba(231, 76, 60, 0.15); color: #e74c3c;"><i class='fas fa-search'></i></div>
            <h3>مفقودات</h3>
            <p>للمساعدة في العثور على المفقودات</p>
        </a>
        <a href='<?php echo get_post_type_archive_link("help"); ?>' class='service-card royal-card'>
            <div class="icon-wrap" style="background: rgba(46, 204, 113, 0.15); color: #2ecc71;"><i class='fas fa-hand-holding-heart'></i></div>
            <h3>المساعدات</h3>
            <p>بوابة التكافل والدعم لأهل الحي</p>
        </a>
        <a href='#' class='service-card royal-card' onclick="document.getElementById('appealModal').style.display='flex'; return false;">
            <div class="icon-wrap" style="background: rgba(52, 152, 219, 0.15); color: #3498db;"><i class='fas fa-bullhorn'></i></div>
            <h3>أرسل مناشدة</h3>
            <p>اضغط هنا لتقديم مناشدة للإدارة</p>
        </a>
    </section>

    <section class='bottom-grid'>
        <div class='person-card royal-box'>
            <div class='box-title'><i class='fas fa-crown' style="color:var(--yellow); margin-left:8px;"></i> شخصية الأسبوع</div>
            <?php
            $person_query = new WP_Query(array('post_type' => 'person', 'posts_per_page' => 1));
            if ($person_query->have_posts()) : while ($person_query->have_posts()) : $person_query->the_post();
            ?>
            <div class='person-content'>
                <div class="img-frame">
                    <?php if (has_post_thumbnail()) : the_post_thumbnail('medium'); else : ?>
                        <img src='https://picsum.photos/150/150?person'>
                    <?php endif; ?>
                </div>
                <div class='person-info'>
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo wp_trim_words(get_the_content(), 15, '...'); ?></p>
                    <a href='<?php echo get_post_type_archive_link("person"); ?>' class='all-news-btn'>تصفح الشخصيات</a>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>

        <div class='appeals-box royal-box'>
            <div class='box-title' style='display:flex; justify-content:space-between; align-items:center;'>
                <span><i class="fas fa-hands-helping" style="color:var(--yellow); margin-left:8px;"></i> أحدث المناشدات</span>
                <button class="btn-yellow royal-btn-small" onclick="document.getElementById('appealModal').style.display='flex'">+ أضف مناشدة</button>
            </div>
            <?php
            $help_query = new WP_Query(array('post_type' => 'help', 'posts_per_page' => 4));
            if ($help_query->have_posts()) : while ($help_query->have_posts()) : $help_query->the_post();
            ?>
            <div class='appeal-item'>
                <span class='appeal-badge royal-badge'><i class="fas fa-exclamation-circle"></i> مناشدة</span>
                <div class='appeal-info'>
                    <span class='appeal-title'><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 7, '...'); ?></a></span>
                    <span class='appeal-time'><i class="far fa-clock"></i> <?php echo get_the_date(); ?></span>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>
            <a href='<?php echo get_post_type_archive_link("help"); ?>' class='all-news-btn'>عرض جميع المناشدات</a>
        </div>

        <div class='sidebar-widgets'>
            <div class='poll-widget royal-box'>
                <div class='box-title'><i class="fas fa-poll-h" style="color:var(--yellow); margin-left:8px;"></i> شارِك برأيك</div>
                <div class='poll-content'>
                    <h4><?php echo get_theme_mod("alzaytoon_poll_question", "ما رأيك في مستوى الخدمات؟"); ?></h4>
                    <form id="alzaytoonPollForm">
                        <?php for($i=1; $i<=3; $i++) { 
                            $opt = get_theme_mod("alzaytoon_poll_opt".$i, "خيار ".$i);
                            if(!empty($opt)) :
                        ?>
                        <label class="poll-option royal-radio">
                            <input type="radio" name="poll_vote" value="<?php echo $i; ?>">
                            <span class="poll-text"><?php echo $opt; ?></span>
                            <div class="poll-bar-bg"><div class="poll-bar-fill" id="pollBar<?php echo $i; ?>"></div></div>
                            <span class="poll-percent" id="pollPercent<?php echo $i; ?>"></span>
                        </label>
                        <?php endif; } ?>
                        <button type="button" class="btn-yellow royal-btn poll-submit-btn" onclick="submitPoll()">إرسال التصويت</button>
                    </form>
                    <p id="pollMessage" style="display:none; color:var(--green); font-size:14px; font-weight:700; text-align:center; margin-top:15px;">شكراً لمشاركتك!</p>
                </div>
            </div>
        </div>
    </section>
</div>

<div id="appealModal" class="royal-modal">
    <div class="modal-content">
        <span class="close-modal" onclick="document.getElementById('appealModal').style.display='none'">&times;</span>
        <h2><i class="fas fa-bullhorn" style="color:var(--green);"></i> تقديم مناشدة جديدة</h2>
        <p>املأ النموذج أدناه. سيتم مراجعة مناشدتك من قبل الإدارة قبل نشرها.</p>
        
        <form id="submitAppealForm" enctype="multipart/form-data">
            <div class="form-grid">
                <input type="text" name="appeal_name" placeholder="اسمك الكريم (اختياري)" class="royal-input">
                <input type="text" name="appeal_phone" placeholder="رقم الجوال للتواصل *" required class="royal-input">
            </div>
            <input type="text" name="appeal_title" placeholder="عنوان المناشدة *" required class="royal-input">
            <textarea name="appeal_content" placeholder="تفاصيل المناشدة بالكامل *" required class="royal-input" rows="4"></textarea>
            
            <div class="form-grid">
                <div>
                    <label>تاريخ البدء:</label>
                    <input type="date" name="appeal_start" class="royal-input">
                </div>
                <div>
                    <label>تاريخ الانتهاء:</label>
                    <input type="date" name="appeal_end" class="royal-input">
                </div>
            </div>
            
            <label class="file-upload-lbl">
                <i class="fas fa-cloud-upload-alt"></i> إرفاق صورة للمناشدة (اختياري)
                <input type="file" name="appeal_image" accept="image/*" style="display:none;">
            </label>
            
            <input type="hidden" name="action" value="submit_appeal">
            <button type="submit" class="btn-yellow royal-btn" style="width:100%; margin-top:20px;" id="submitAppealBtn">إرسال المناشدة للإدارة</button>
            <div id="appealFormMsg" style="margin-top:15px; text-align:center; font-weight:bold;"></div>
        </form>
    </div>
</div>

<?php get_footer(); ?>
