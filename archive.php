<?php get_header(); ?>
<div class="container main-content-wrap" style="margin-top:40px; margin-bottom:60px; min-height:60vh;">
    <div class="block-header-gov" style="margin-bottom:35px;">
        <h2><i class="fas fa-folder-open"></i> تصفح قسم: <?php post_type_archive_title(); ?></h2>
    </div>
    
    <div class="random-articles-grid">
        <?php if(have_posts()) : while(have_posts()) : the_post(); 
            $p_id = get_the_ID();
            $p_type = get_post_type($p_id);
            $card_sender = get_post_meta($p_id, '_gov_sender_name', true);
            $card_phone = get_post_meta($p_id, '_gov_phone_address', true);
            $badge_status = get_post_meta($p_id, '_appeal_badge_status', true);
            
            // تحديد أيقونة ونوع التسمية بناء على القسم
            $type_label = ($p_type == 'lost') ? 'صاحب البلاغ' : 'مقدم المناشدة';
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
                        <i class="fas fa-user-tie"></i> <strong><?php echo $type_label; ?>:</strong> <span><?php echo esc_html($card_sender); ?></span>
                    </div>
                <?php endif; ?>

                <div class="gov-archive-excerpt-6lines">
                    <?php 
                    $excerpt = get_the_excerpt();
                    if(empty($excerpt)) { $excerpt = get_the_content(); }
                    echo wp_trim_words(strip_tags($excerpt), 35, '...'); 
                    ?>
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
        <?php endwhile; else: ?>
            <p style="grid-column:1/-1; text-align:center; padding:50px; background:#fff; border:1px solid #e0e0e0; border-radius:8px;">لا توجد مواضيع مدرجة في هذا القسم حالياً.</p>
        <?php endif; ?>
    </div>
</div>
