<?php get_header(); ?>

<div class="container main-front-content-wrap" style="margin-top: 40px; margin-bottom: 60px;">

    <section class="gov-home-section" style="margin-bottom: 55px;">
        <div class="block-header-gov" style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
            <h2><i class="fas fa-hand-holding-heart"></i> ديوان ومتابعة المناشدات الحالية</h2>
            <a href="<?php echo get_post_type_archive_link('help'); ?>" class="gov-view-all-link">عرض كافة المناشدات <i class="fas fa-angle-left"></i></a>
        </div>

        <div class="random-articles-grid">
            <?php 
            $help_query = new WP_Query(array(
                'post_type' => 'help',
                'posts_per_page' => 6,
                'post_status' => 'publish'
            ));
            if($help_query->have_posts()) : while($help_query->have_posts()) : $help_query->the_post(); 
                $p_id = get_the_ID();
                $card_sender = get_post_meta($p_id, '_gov_sender_name', true);
                $card_phone = get_post_meta($p_id, '_gov_phone_address', true);
                $badge_status = get_post_meta($p_id, '_appeal_badge_status', true);
            ?>
            <article class="random-article-card gov-archive-card">
                <a href="<?php the_permalink(); ?>" class="random-card-img-wrap">
                    <?php if(has_post_thumbnail()) { the_post_thumbnail('medium_large'); } else { echo "<img src='https://picsum.photos/400/260?random=".$p_id."'>"; } ?>
                    <?php if(!empty($badge_status)) : ?>
                        <span class="gov-badge-status-key badge-<?php echo esc_attr($badge_status); ?>">
                            <?php 
                            if($badge_status == 'urgent') echo '🚨 عاجلة';
                            elseif($badge_status == 'necessary') echo '⚠️ ضرورية';
                            elseif($badge_status == 'following') echo '🔄 قيد المتابعة';
                            else echo '✨ جديد';
                            ?>
                        </span>
                    <?php endif; ?>
                </a>
                <div class="random-card-text" style="padding: 20px;">
                    <h3 class="gov-archive-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    
                    <?php if(!empty($card_sender)) : ?>
                        <div class="gov-card-author-strip">
                            <i class="fas fa-user-tie"></i> <strong>مقدم المناشدة:</strong> <span><?php echo esc_html($card_sender); ?></span>
                        </div>
                    <?php endif; ?>

                    <div class="gov-archive-excerpt-6lines">
                        <?php echo wp_trim_words(strip_tags(get_the_content()), 35, '...'); ?>
                    </div>

                    <?php if(!empty($card_phone)) : ?>
                        <div class="gov-card-phone-row">
                            <i class="fas fa-phone-alt"></i> <span><?php echo esc_html($card_phone); ?></span>
                        </div>
                    <?php endif; ?>

                    <div class="random-card-footer-meta gov-archive-footer">
                        <span class="gov-day-badge"><i class="far fa-calendar-check"></i> <?php echo get_the_date('l, d F Y'); ?></span>
                        <span><i class="far fa-eye"></i> <?php echo alzaytoon_get_post_views($p_id); ?> قراءة</span>
                    </div>
                </div>
            </article>
            <?php endwhile; wp_reset_postdata(); else: ?>
                <p style="grid-column:1/-1; text-align:center; padding:40px; background:#fff; border-radius:8px;">لا توجد مناشدات حية منشورة حالياً.</p>
            <?php endif; ?>
        </div>
    </section>


    <section class="gov-home-section">
        <div class="block-header-gov" style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
            <h2><i class="fas fa-search"></i> بوابة الاستعلام عن المفقودات الحالية</h2>
            <a href="<?php echo get_post_type_archive_link('lost'); ?>" class="gov-view-all-link">عرض كافة المفقودات <i class="fas fa-angle-left"></i></a>
        </div>

        <div class="random-articles-grid">
            <?php 
            $lost_query = new WP_Query(array(
                'post_type' => 'lost',
                'posts_per_page' => 3, // عرض 3 مفقودات مميزة لتناسق الصفحة رئيسية
                'post_status' => 'publish'
            ));
            if($lost_query->have_posts()) : while($lost_query->have_posts()) : $lost_query->the_post(); 
                $p_id = get_the_ID();
                $card_sender = get_post_meta($p_id, '_gov_sender_name', true);
                $card_phone = get_post_meta($p_id, '_gov_phone_address', true);
                $badge_status = get_post_meta($p_id, '_appeal_badge_status', true);
            ?>
            <article class="random-article-card gov-archive-card">
                <a href="<?php the_permalink(); ?>" class="random-card-img-wrap">
                    <?php if(has_post_thumbnail()) { the_post_thumbnail('medium_large'); } else { echo "<img src='https://picsum.photos/400/260?random=".$p_id."'>"; } ?>
                    <?php if(!empty($badge_status)) : ?>
                        <span class="gov-badge-status-key badge-<?php echo esc_attr($badge_status); ?>">
                            <?php 
                            if($badge_status == 'urgent') echo '🚨 بلاغ عاجل';
                            else echo '🔍 مفقود';
                            ?>
                        </span>
                    <?php endif; ?>
                </a>
                <div class="random-card-text" style="padding: 20px;">
                    <h3 class="gov-archive-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    
                    <?php if(!empty($card_sender)) : ?>
                        <div class="gov-card-author-strip" style="background: rgba(17, 92, 56, 0.04); border-right-color: var(--primary);">
                            <i class="fas fa-user-circle"></i> <strong>صاحب البلاغ:</strong> <span><?php echo esc_html($card_sender); ?></span>
                        </div>
                    <?php endif; ?>

                    <div class="gov-archive-excerpt-6lines">
                        <?php echo wp_trim_words(strip_tags(get_the_content()), 35, '...'); ?>
                    </div>

                    <?php if(!empty($card_phone)) : ?>
                        <div class="gov-card-phone-row">
                            <i class="fas fa-phone-alt"></i> <span><?php echo esc_html($card_phone); ?></span>
                        </div>
                    <?php endif; ?>

                    <div class="random-card-footer-meta gov-archive-footer">
                        <span class="gov-day-badge"><i class="far fa-calendar-check"></i> <?php echo get_the_date('l, d F Y'); ?></span>
                        <span><i class="far fa-eye"></i> <?php echo alzaytoon_get_post_views($p_id); ?> قراءة</span>
                    </div>
                </div>
            </article>
            <?php endwhile; wp_reset_postdata(); else: ?>
                <p style="grid-column:1/-1; text-align:center; padding:40px; background:#fff; border-radius:8px;">لا توجد بلاغات مفقودات منشورة حالياً.</p>
            <?php endif; ?>
        </div>
    </section>

</div>

<?php get_footer(); ?>
