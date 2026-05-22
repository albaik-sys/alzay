<?php get_header(); ?>

<div class='container official-container'>
    
    <section class='official-hero'>
        <div class='hero-news-list'>
            <div class='official-heading'>
                <h2><i class="fas fa-newspaper"></i> أحدث الأخبــار</h2>
            </div>
            <div class='news-items-wrapper'>
                <?php
                $news_query = new WP_Query(array('post_type' => 'news', 'posts_per_page' => 4));
                if ($news_query->have_posts()) : while ($news_query->have_posts()) : $news_query->the_post();
                ?>
                <article class='news-list-item'>
                    <div class="news-list-img">
                        <?php if (has_post_thumbnail()) : the_post_thumbnail('thumbnail'); else : ?>
                            <img src='https://picsum.photos/100/100?random=<?php echo rand(1,100); ?>'>
                        <?php endif; ?>
                    </div>
                    <div class='news-list-content'>
                        <h4><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 10, '...'); ?></a></h4>
                        <span class="news-date"><i class="far fa-calendar-alt"></i> <?php echo get_the_date('d F Y'); ?></span>
                    </div>
                </article>
                <?php endwhile; wp_reset_postdata(); endif; ?>
            </div>
            <a href='<?php echo get_post_type_archive_link("news"); ?>' class='official-more-btn'>كافة الأخبار <i class='fas fa-arrow-left'></i></a>
        </div>

        <div class='hero-slider'>
            <?php
            $events_query = new WP_Query(array('post_type' => 'events', 'posts_per_page' => 1));
            if ($events_query->have_posts()) : while ($events_query->have_posts()) : $events_query->the_post();
                $slider_img = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : 'https://picsum.photos/1000/600';
            ?>
            <div class='slider-main' style="background: url('<?php echo $slider_img; ?>') center/cover;">
                <div class='slider-gradient'>
                    <span class="official-tag">تغطية خاصة</span>
                    <h2><?php the_title(); ?></h2>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 18, '...'); ?></p>
                    <a href='<?php the_permalink(); ?>' class='btn-gold'>التفاصيل الكاملة</a>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
    </section>

    <section class='official-services'>
        <a href='<?php echo get_post_type_archive_link("person"); ?>' class='service-box'>
            <i class='fas fa-id-badge'></i>
            <h3>شخصيات بارزة</h3>
            <p>سجل الشرف لأبناء الحي</p>
        </a>
        <a href='<?php echo get_post_type_archive_link("lost"); ?>' class='service-box'>
            <i class='fas fa-bullseye'></i>
            <h3>مركز المفقودات</h3>
            <p>البحث والإبلاغ عن المفقودات</p>
        </a>
        <a href='<?php echo get_post_type_archive_link("help"); ?>' class='service-box'>
            <i class='fas fa-hands-helping'></i>
            <h3>لجنة المساعدات</h3>
            <p>بوابة التكافل الاجتماعي</p>
        </a>
        <a href='#' class='service-box highlight-box' onclick="document.getElementById('appealModal').style.display='flex'; return false;">
            <i class='fas fa-envelope-open-text'></i>
            <h3>تقديم مناشدة</h3>
            <p>الديوان الإلكتروني لاستقبال الطلبات</p>
        </a>
    </section>

    <section class='official-middle-grid'>
        <div class='official-panel'>
            <div class='official-heading'>
                <h2><i class="fas fa-file-signature"></i> ديوان المناشدات</h2>
            </div>
            <div class='panel-content list-content'>
                <?php
                $help_query = new WP_Query(array('post_type' => 'help', 'posts_per_page' => 4));
                if ($help_query->have_posts()) : while ($help_query->have_posts()) : $help_query->the_post();
                ?>
                <div class='appeal-row'>
                    <span class="appeal-status">قيد المتابعة</span>
                    <a href="<?php the_permalink(); ?>" class="appeal-link"><?php echo wp_trim_words(get_the_title(), 8, '...'); ?></a>
                    <span class="appeal-date"><?php echo get_the_date('d/m/Y'); ?></span>
                </div>
                <?php endwhile; wp_reset_postdata(); endif; ?>
            </div>
        </div>

        <div class='official-panel'>
            <div class='official-heading'>
                <h2><i class="fas fa-chart-pie"></i> مركز استطلاعات الرأي</h2>
            </div>
            <div class='panel-content poll-content'>
                <h3 class="poll-question"><?php echo get_theme_mod("alzaytoon_poll_question", "الرجاء تحديد سؤال الاستطلاع من لوحة التحكم"); ?></h3>
                <form id="alzaytoonPollForm">
                    <?php for($i=1; $i<=3; $i++) { 
                        $opt = get_theme_mod("alzaytoon_poll_opt".$i, "الخيار ".$i);
                        if(!empty($opt)) :
                    ?>
                    <label class="poll-radio-wrap">
                        <input type="radio" name="poll_vote" value="<?php echo $i; ?>">
                        <span class="poll-lbl"><?php echo $opt; ?></span>
                        <div class="poll-progress"><div class="poll-fill" id="pollBar<?php echo $i; ?>"></div></div>
                        <span class="poll-val" id="pollPercent<?php echo $i; ?>"></span>
                    </label>
                    <?php endif; } ?>
                    <button type="button" class="btn-gold block-btn" onclick="submitOfficialPoll()">تسجيل الصوت</button>
                </form>
                <p id="pollMessage" style="display:none; color:#115c38; font-weight:700; margin-top:15px; text-align:center;">تم اعتماد التصويت، شكراً لك.</p>
            </div>
        </div>
    </section>

    <section class='official-random-grid'>
        <div class='official-heading center-heading'>
            <h2><i class="fas fa-book-reader"></i> مختارات من الشبكة</h2>
        </div>
        <div class='random-articles'>
            <?php
            // جلب مقالات عشوائية من أقسام مختلفة
            $random_query = new WP_Query(array('post_type' => array('news', 'events', 'person'), 'orderby' => 'rand', 'posts_per_page' => 4));
            if ($random_query->have_posts()) : while ($random_query->have_posts()) : $random_query->the_post();
            ?>
            <article class='random-card'>
                <a href="<?php the_permalink(); ?>" class="random-img">
                    <?php if (has_post_thumbnail()) : the_post_thumbnail('medium'); else : ?>
                        <img src='https://picsum.photos/300/200?random=<?php echo rand(1,999); ?>'>
                    <?php endif; ?>
                    <span class="random-cat"><?php echo get_post_type_object(get_post_type())->labels->singular_name; ?></span>
                </a>
                <div class='random-info'>
                    <h4><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 10, '...'); ?></a></h4>
                </div>
            </article>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
    </section>

</div>

<div id="appealModal" class="official-modal">
    <div class="modal-inner">
        <span class="close-modal" onclick="document.getElementById('appealModal').style.display='none'">&times;</span>
        <div class="modal-header">
            <h3><i class="fas fa-file-signature"></i> نموذج التقديم الإلكتروني</h3>
        </div>
        <form id="submitAppealForm" class="official-form">
            <input type="text" name="appeal_name" placeholder="الاسم الرباعي" class="gov-input">
            <input type="text" name="appeal_phone" placeholder="رقم الهاتف الأساسي *" required class="gov-input">
            <input type="text" name="appeal_title" placeholder="موضوع المناشدة *" required class="gov-input">
            <textarea name="appeal_content" placeholder="نص المناشدة بالتفصيل *" required class="gov-input" rows="4"></textarea>
            <input type="hidden" name="action" value="submit_appeal">
            <button type="submit" class="btn-gold block-btn" id="submitAppealBtn">إرسال الطلب للديوان</button>
            <div id="appealFormMsg" class="form-msg"></div>
        </form>
    </div>
</div>

<script>
function submitOfficialPoll() {
    const options = document.querySelectorAll('input[name="poll_vote"]');
    let selected = false;
    options.forEach(opt => { if(opt.checked) selected = true; });
    if(!selected) { alert('الرجاء تحديد خيار قبل الإرسال.'); return; }
    
    document.getElementById('pollBar1').style.width = '55%'; document.getElementById('pollPercent1').innerText = '55%';
    document.getElementById('pollBar2').style.width = '30%'; document.getElementById('pollPercent2').innerText = '30%';
    document.getElementById('pollBar3').style.width = '15%'; document.getElementById('pollPercent3').innerText = '15%';
    
    document.querySelector('.block-btn').style.display = 'none';
    document.getElementById('pollMessage').style.display = 'block';
}

const appealForm = document.getElementById('submitAppealForm');
if(appealForm) {
    appealForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = document.getElementById('submitAppealBtn');
        const msg = document.getElementById('appealFormMsg');
        btn.innerText = 'جاري معالجة الطلب...'; btn.disabled = true;
        fetch('<?php echo admin_url('admin-ajax.php'); ?>', { method: 'POST', body: new FormData(appealForm) })
        .then(res => res.json())
        .then(data => {
            msg.innerText = data.data.message;
            msg.style.color = data.success ? '#115c38' : '#d9534f';
            if(data.success) { appealForm.reset(); setTimeout(() => document.getElementById('appealModal').style.display='none', 3000); }
            btn.innerText = 'إرسال الطلب للديوان'; btn.disabled = false;
        });
    });
}
</script>

<?php get_footer(); ?>
