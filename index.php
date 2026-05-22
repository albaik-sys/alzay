<?php get_header(); ?>

<div class="container home-layout">
    <div class="section-title"><i class="fas fa-bolt"></i> التغطية الشاملة</div>
    
    <div class="hero-grid">
        <div class="hero-news">
            <div class="hero-news-header">آخر الأخبار</div>
            <?php
            $news = new WP_Query(array('post_type' => 'news', 'posts_per_page' => 4));
            if($news->have_posts()) : while($news->have_posts()) : $news->the_post();
            ?>
            <div class="hero-news-item">
                <?php if(has_post_thumbnail()) { the_post_thumbnail('thumbnail'); } else { echo "<img src='https://picsum.photos/100/100?random=".rand(1,99)."'>"; } ?>
                <div class="hero-news-content">
                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <small><i class="far fa-clock"></i> <?php echo get_the_date(); ?></small>
                </div>
            </div>
            <?php endwhile; endif; wp_reset_postdata(); ?>
            <a href="<?php echo get_post_type_archive_link('news'); ?>" class="hero-news-more">جميع الأخبار &laquo;</a>
        </div>

        <div class="hero-slider">
            <?php
            $events = new WP_Query(array('post_type' => 'events', 'posts_per_page' => 1));
            if($events->have_posts()) : while($events->have_posts()) : $events->the_post();
            $img = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(),'full') : 'https://picsum.photos/1000/500';
            ?>
            <div style="background: url('<?php echo $img; ?>') center/cover; height:100%;">
                <div class="hero-slider-overlay">
                    <span class="badge">تغطية خاصة</span>
                    <h2><?php the_title(); ?></h2>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                </div>
            </div>
            <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
    </div>

    <div class="services-grid">
        <a href="<?php echo get_post_type_archive_link('person'); ?>" class="service-box">
            <i class="fas fa-id-card service-icon"></i>
            <h3>شخصيات بارزة</h3><p>سجل الشرف لأبناء الحي</p>
        </a>
        <a href="<?php echo get_post_type_archive_link('help'); ?>" class="service-box">
            <i class="fas fa-hand-holding-heart service-icon"></i>
            <h3>المساعدات</h3><p>بوابة التكافل والدعم</p>
        </a>
        <a href="<?php echo get_post_type_archive_link('lost'); ?>" class="service-box">
            <i class="fas fa-search service-icon"></i>
            <h3>مفقودات</h3><p>الإبلاغ والعثور على المفقودات</p>
        </a>
        <a href="#" class="service-box" style="background:var(--primary); color:#fff; border-color:var(--primary);">
            <i class="fas fa-envelope-open-text service-icon" style="color:var(--gold);"></i>
            <h3 style="color:#fff;">أرسل مناشدة</h3><p style="color:#ddd;">الديوان الإلكتروني للطلبات</p>
        </a>
    </div>

    <div class="bottom-grid">
        <div class="widget-box">
            <div class="widget-header"><span>شخصية الأسبوع</span><i class="fas fa-star" style="color:var(--gold);"></i></div>
            <div class="widget-content" style="text-align:center;">
                <?php
                $person = new WP_Query(array('post_type' => 'person', 'posts_per_page' => 1));
                if($person->have_posts()) : while($person->have_posts()) : $person->the_post();
                if(has_post_thumbnail()) { the_post_thumbnail('medium', array('style'=>'width:120px;height:120px;border-radius:50%;margin:0 auto 15px;')); }
                ?>
                <h3 style="color:var(--primary); font-weight:800; margin-bottom:10px;"><?php the_title(); ?></h3>
                <p style="font-size:14px; color:#555;"><?php echo wp_trim_words(get_the_content(), 15); ?></p>
                <?php endwhile; endif; wp_reset_postdata(); ?>
            </div>
        </div>

        <div class="widget-box">
            <div class="widget-header"><span>أحدث المناشدات</span><i class="fas fa-file-signature" style="color:var(--gold);"></i></div>
            <div class="widget-content" style="padding:0;">
                <?php
                $help = new WP_Query(array('post_type' => 'help', 'posts_per_page' => 4));
                if($help->have_posts()) : while($help->have_posts()) : $help->the_post();
                ?>
                <a href="<?php the_permalink(); ?>" style="display:block; padding:15px; border-bottom:1px solid #eee; font-size:14px; font-weight:700; color:var(--dark);">
                    <i class="fas fa-exclamation-circle" style="color:#e74c3c; margin-left:5px;"></i> <?php the_title(); ?>
                </a>
                <?php endwhile; endif; wp_reset_postdata(); ?>
            </div>
        </div>

        <div class="widget-box">
            <div class="widget-header"><span>استطلاع رأي</span><i class="fas fa-poll" style="color:var(--gold);"></i></div>
            <div class="widget-content">
                <h4 style="color:var(--primary); font-weight:800; margin-bottom:15px;"><?php echo get_theme_mod('poll_q', 'ما رأيك في الخدمات؟'); ?></h4>
                <p style="color:#666; font-size:13px; text-align:center;">نظام التصويت مفعل من لوحة التحكم</p>
                <button style="width:100%; padding:10px; background:var(--gold); border:none; color:#fff; font-weight:bold; border-radius:4px; margin-top:20px;">تصويت</button>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
