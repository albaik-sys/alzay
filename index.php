<?php get_header(); ?>

<div class='container homepage-container'>
    
    <section class='hero-section'>
        
        <div class='news-box'>
            <div class='box-title'>أحدث الأخبار</div>
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
                        <small><?php echo get_the_date('d F Y'); ?></small>
                    </div>
                </div>
                <?php endwhile; wp_reset_postdata(); endif; ?>
            </div>
            <a href='<?php echo get_post_type_archive_link("news"); ?>' class='all-news-btn'>عرض جميع الأخبار <i class='fas fa-chevron-left'></i></a>
        </div>

        <?php
        $events_query = new WP_Query(array('post_type' => 'events', 'posts_per_page' => 1));
        if ($events_query->have_posts()) : while ($events_query->have_posts()) : $events_query->the_post();
            $slider_img = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : 'https://picsum.photos/1000/500';
        ?>
        <div class='slider-box' style="background: url('<?php echo $slider_img; ?>') center/cover;">
            <div class='slider-overlay'>
                <span class="badge-featured">خبر مميز</span>
                <h2><?php the_title(); ?></h2>
                <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                <a href='<?php the_permalink(); ?>' class='btn-yellow'>اقرأ المزيد</a>
            </div>
        </div>
        <?php endwhile; wp_reset_postdata(); else: ?>
        <div class='slider-box' style="background: url('https://picsum.photos/1000/500') center/cover;">
            <div class='slider-overlay'>
                <span class="badge-featured">خبر مميز</span>
                <h2>مرحباً بك في شبكة حي الزيتون</h2>
                <p>قم بإضافة مناسبات وأخبار لتظهر هنا مباشرة.</p>
            </div>
        </div>
        <?php endif; ?>
    </section>

    <section class='services-row'>
        <a href='<?php echo get_post_type_archive_link("person"); ?>' class='service-card'>
            <i class='fas fa-user-tie'></i>
            <h3>شخصية الأسبوع</h3>
            <p>نسلط الضوء على شخصية ملهمة من أبناء الحي</p>
        </a>
        <a href='<?php echo get_post_type_archive_link("lost"); ?>' class='service-card'>
            <i class='fas fa-search'></i>
            <h3>مفقودات</h3>
            <p>نشر المفقودات للمساعدة في العثور على أصحابها</p>
        </a>
        <a href='<?php echo get_post_type_archive_link("help"); ?>' class='service-card'>
            <i class='fas fa-hand-holding-heart'></i>
            <h3>المساعدات</h3>
            <p>أخبار وروابط المساعدات المتاحة لأهل الحي</p>
        </a>
        <a href='#' class='service-card'>
            <i class='fas fa-bullhorn'></i>
            <h3>مناشدات أهل الحي</h3>
            <p>نشر مناشدات وطلبات أهل الحي ومتابعتها</p>
        </a>
    </section>

    <section class='bottom-grid'>
        
        <div class='person-card'>
            <div class='box-title'>شخصية الأسبوع <i class='fas fa-star'></i></div>
            <?php
            $person_query = new WP_Query(array('post_type' => 'person', 'posts_per_page' => 1));
            if ($person_query->have_posts()) : while ($person_query->have_posts()) : $person_query->the_post();
            ?>
            <div class='person-content'>
                <?php if (has_post_thumbnail()) : the_post_thumbnail('medium'); else : ?>
                    <img src='https://picsum.photos/150/150?person' alt='شخصية'>
                <?php endif; ?>
                <div class='person-info'>
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo wp_trim_words(get_the_content(), 20, '...'); ?></p>
                    <a href='<?php the_permalink(); ?>' class='btn-yellow'>اقرأ القصة الكاملة</a>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>

        <div class='appeals-box'>
            <div class='box-title' style='background: var(--green);'>أحدث المناشدات</div>
            <?php
            $help_query = new WP_Query(array('post_type' => 'help', 'posts_per_page' => 4));
            if ($help_query->have_posts()) : while ($help_query->have_posts()) : $help_query->the_post();
            ?>
            <div class='appeal-item'>
                <span class='appeal-badge'>مناشدة</span>
                <div class='appeal-info'>
                    <span class='appeal-title'><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 7, '...'); ?></a></span>
                    <span class='appeal-time'><?php echo get_the_date(); ?></span>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>
            <a href='<?php echo get_post_type_archive_link("help"); ?>' class='all-news-btn'>عرض جميع المناشدات</a>
        </div>

        <div class='sidebar-widgets'>
            
            <div class='poll-widget'>
                <div class='box-title' style='background: var(--green);'>شارِك برأيك <i class="fas fa-poll"></i></div>
                <div class='poll-content'>
                    <h4><?php echo get_theme_mod("alzaytoon_poll_question", "ما رأيك في مستوى الخدمات المقدمة في حي الزيتون مؤخراً؟"); ?></h4>
                    <form id="alzaytoonPollForm">
                        <?php for($i=1; $i<=3; $i++) { 
                            $opt = get_theme_mod("alzaytoon_poll_opt".$i, "خيار ".$i);
                            if(!empty($opt)) :
                        ?>
                        <label class="poll-option">
                            <input type="radio" name="poll_vote" value="<?php echo $i; ?>">
                            <span class="poll-text"><?php echo $opt; ?></span>
                            <div class="poll-bar-bg"><div class="poll-bar-fill" id="pollBar<?php echo $i; ?>"></div></div>
                            <span class="poll-percent" id="pollPercent<?php echo $i; ?>"></span>
                        </label>
                        <?php endif; } ?>
                        <button type="button" class="btn-yellow poll-submit-btn" onclick="submitPoll()">تصويت</button>
                    </form>
                    <p id="pollMessage" style="display:none; color:var(--green); font-size:13px; font-weight:700; margin-top:10px; text-align:center;">شكراً لمشاركتك!</p>
                </div>
            </div>

            <div class='links-box' style='margin-top:20px;'>
                <div class='box-title' style='background: var(--green);'>روابط سريعة</div>
                <ul class='links-list'>
                    <li><a href='#'>مساعدات غذائية <i class='fas fa-link'></i></a></li>
                    <li><a href='#'>مساعدات طبية <i class='fas fa-link'></i></a></li>
                    <li><a href='#'>جهات خيرية <i class='fas fa-link'></i></a></li>
                </ul>
            </div>
            
        </div>

    </section>

</div>

<script>
function submitPoll() {
    const options = document.querySelectorAll('input[name="poll_vote"]');
    let selected = false;
    options.forEach(opt => { if(opt.checked) selected = true; });
    
    if(!selected) { alert('الرجاء اختيار إجابة أولاً!'); return; }
    
    // إنشاء نسب مئوية وهمية للعرض (يمكن ربطها بقاعدة بيانات لاحقاً)
    document.getElementById('pollBar1').style.width = '65%'; document.getElementById('pollPercent1').innerText = '65%';
    document.getElementById('pollBar2').style.width = '20%'; document.getElementById('pollPercent2').innerText = '20%';
    document.getElementById('pollBar3').style.width = '15%'; document.getElementById('pollPercent3').innerText = '15%';
    
    document.querySelector('.poll-submit-btn').style.display = 'none';
    document.getElementById('pollMessage').style.display = 'block';
}
</script>

<?php get_footer(); ?>
