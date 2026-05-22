<?php get_header(); ?>

<div class="container main-content-wrap v2-help-archive-container" style="margin-top: 30px; margin-bottom: 60px; min-height: 75vh;">
    
    <div class="block-header-gov" style="margin-bottom: 25px; border-bottom: 2px solid #115c38; padding-bottom: 12px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
        <h2 style="color: #115c38; font-weight: 900; font-size: 19px; margin: 0;">
            <i class="fas fa-hand-holding-heart" style="margin-left: 8px;"></i> 
            تصفح ديوان ومتابعة المناشدات والمساعدات الحالية بالحي
        </h2>
        <button class="btn-yellow" onclick="openGovModal('help')" style="background:#d4af37; color:#fff; border:none; padding:6px 16px; cursor:pointer; font-weight:bold; font-size:12.5px; border-radius:4px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">+ تقديم مناشدة جديدة</button>
    </div>

    <div class="v2-filter-status-bar" style="display: flex; gap: 10px; margin-bottom: 25px; flex-wrap: wrap;">
        <span style="font-size: 13px; font-weight: bold; color: #555; align-self: center; margin-left: 5px;">فرز سريع:</span>
        <span class="v2-filter-tag active-tag" style="font-size: 12px; font-weight: 700; background: #115c38; color: #fff; padding: 4px 12px; border-radius: 4px; cursor: pointer;">الكل</span>
        <span class="v2-filter-tag" style="font-size: 12px; font-weight: 700; background: rgba(231, 76, 60, 0.1); color: #e74c3c; border: 1px solid rgba(231, 76, 60, 0.2); padding: 4px 12px; border-radius: 4px;">🔴 عاجلة</span>
        <span class="v2-filter-tag" style="font-size: 12px; font-weight: 700; background: rgba(41, 128, 185, 0.1); color: #2980b9; border: 1px solid rgba(41, 128, 185, 0.2); padding: 4px 12px; border-radius: 4px;">🔵 قيد المتابعة</span>
        <span class="v2-filter-tag" style="font-size: 12px; font-weight: 700; background: rgba(46, 204, 113, 0.1); color: #2ecc71; border: 1px solid rgba(46, 204, 113, 0.2); padding: 4px 12px; border-radius: 4px;">🟢 جديد</span>
    </div>

    <div class="v2-help-premium-list" style="display: flex; flex-direction: column; gap: 12px;">
        <?php if (have_posts()) : while (have_posts()) : the_post(); $p_id = get_the_ID(); 
            // جلب الميتا كود الخاص بالشارات والمقدمين لضمان دقة البيانات حياً
            $badge = get_post_meta($p_id, '_appeal_badge_status', true);
            $card_sender = get_post_meta($p_id, '_gov_sender_name', true);
            $card_phone = get_post_meta($p_id, '_gov_phone_address', true);
            
            $badge_class = 'v2-b-new'; $badge_txt = 'جديد'; $badge_ico = 'fas fa-star'; $badge_color = '#2ecc71';
            if($badge == 'urgent') { $badge_class = 'v2-b-urgent'; $badge_txt = 'عاجلة'; $badge_ico = 'fas fa-exclamation-triangle'; $badge_color = '#e74c3c'; }
            elseif($badge == 'necessary') { $badge_class = 'v2-b-necessary'; $badge_txt = 'ضرورية'; $badge_ico = 'fas fa-exclamation-circle'; $badge_color = '#e67e22'; }
            elseif($badge == 'following') { $badge_class = 'v2-b-following'; $badge_txt = 'قيد المتابعة'; $badge_ico = 'fas fa-sync'; $badge_color = '#2980b9'; }
        ?>
        
        <article class="v2-help-list-row" style="display: flex; align-items: center; justify-content: space-between; background: #fff; border: 1px solid #e2e8f0; border-right: 4px solid <?php echo $badge_color; ?>; padding: 14px 20px; border-radius: 6px; gap: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.01); transition: all 0.3s ease-in-out; opacity: 0; transform: translateY(12px); animation: v2HelpReveal 0.4s forwards;">
            
            <div style="display: flex; align-items: center; gap: 18px; flex: 1;">
                <span class="v2-appeal-list-tag" style="background: <?php echo $badge_color; ?>; color: #fff; padding: 4px 10px; font-size: 11px; font-weight: 800; border-radius: 4px; display: inline-flex; align-items: center; gap: 5px; white-space: nowrap;">
                    <i class="<?php echo $badge_ico; ?>"></i> <?php echo $badge_txt; ?>
                </span>
                
                <div style="display: flex; flex-direction: column; gap: 5px; flex: 1;">
                    <h3 style="font-size: 14.5px; font-weight: 800; margin: 0; line-height: 1.45;">
                        <a href="<?php the_permalink(); ?>" style="color: #222; text-decoration: none; transition: color 0.2s;"><?php the_title(); ?></a>
                    </h3>
                    
                    <div class="v2-help-meta-row" style="display: flex; align-items: center; flex-wrap: wrap; gap: 15px; font-size: 12px; color: #666;">
                        <?php if(!empty($card_sender)) : ?>
                            <span><i class="far fa-user" style="color: #115c38;"></i> <strong>المقدم:</strong> <?php echo esc_html($card_sender); ?></span>
                        <?php endif; ?>
                        <?php if(!empty($card_phone)) : ?>
                            <span style="color: #115c38; font-weight: 700; font-family: sans-serif;"><i class="fas fa-phone-alt" style="font-size: 11px;"></i> <?php echo esc_html($card_phone); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="v2-help-date-stamp" style="text-align: left; font-size: 12px; color: #999; white-space: nowrap;">
                <span style="display: block; font-weight: bold; color: #115c38;"><i class="far fa-clock"></i> <?php echo get_the_date('l'); ?></span>
                <span style="font-family: sans-serif; font-size: 11px;"><?php echo get_the_date('d/m/Y'); ?></span>
            </div>

        </article>

        <?php endwhile; else: ?>
            <p style="text-align: center; color: #777; padding: 50px; background: #fff; border-radius: 8px; border: 1px dashed #e2e8f0; grid-column: 1/-1;">لا توجد مناشدات أو مساعدات منشورة حالياً في هذا القسم.</p>
        <?php endif; ?>
    </div>

    <div class="v2-pagination-container" style="margin-top: 35px; text-align: center;">
        <?php the_posts_pagination(array('mid_size' => 2, 'prev_text' => __('&laquo; السابق', 'textdomain'), 'next_text' => __('التالي &raquo;', 'textdomain'))); ?>
    </div>

</div>

<div style="clear: both;"></div>
<?php get_footer(); ?>
