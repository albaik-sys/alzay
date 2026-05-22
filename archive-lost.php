<?php get_header(); ?>

<div class="container main-content-wrap" style="margin-top: 30px; margin-bottom: 60px; min-height: 75vh;">
    
    <div class="block-header-gov" style="margin-bottom: 25px; border-bottom: 2px solid #f1c40f; padding-bottom: 15px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
        <h2 style="color: #115c38; font-weight: 900; font-size: 19px; margin: 0;">
            <i class="fas fa-search-location" style="margin-left: 8px;"></i> 
            دليل الاستعلام المطور عن المفقودات والأمانات
        </h2>
        
        <div class="v2-lost-actions-wrapper" style="display: flex; gap: 10px; flex-wrap: wrap;">
            <button class="btn-lost-report text-urgent" onclick="openGovModal('lost_report')" style="background: #e74c3c; color: #fff; border: none; padding: 7px 14px; cursor: pointer; font-weight: bold; font-size: 12.5px; border-radius: 4px; box-shadow: 0 2px 5px rgba(231,76,60,0.2); transition: transform 0.2s;">
                <i class="fas fa-exclamation-circle" style="margin-left: 5px;"></i> تبليغ عن مفقودات
            </button>
            <button class="btn-lost-found text-success" onclick="openGovModal('lost_found')" style="background: #2ecc71; color: #fff; border: none; padding: 7px 14px; cursor: pointer; font-weight: bold; font-size: 12.5px; border-radius: 4px; box-shadow: 0 2px 5px rgba(46,204,113,0.2); transition: transform 0.2s;">
                <i class="fas fa-check-circle" style="margin-left: 5px;"></i> وجود مفقودات
            </button>
        </div>
    </div>

    <div class="v2-lost-premium-list" style="display: flex; flex-direction: column; gap: 12px;">
        <?php if (have_posts()) : while (have_posts()) : the_post(); $p_id = get_the_ID();
            $sender = get_post_meta($p_id, '_gov_sender_name', true);
            $phone = get_post_meta($p_id, '_gov_phone_address', true);
        ?>
        <article class="v2-lost-row-item" style="display: flex; align-items: center; justify-content: space-between; background: #fff; border: 1px solid #e2e8f0; border-right: 4px solid #f1c40f; padding: 14px 20px; border-radius: 6px; gap: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.01); transition: all 0.3s ease-in-out; opacity: 0; transform: translateY(10px); animation: v2ListReveal 0.4s forwards;">
            <div style="display: flex; align-items: center; gap: 15px; flex: 1;">
                <span style="background: rgba(155, 89, 182, 0.1); color: #9b59b6; padding: 3px 8px; font-size: 11px; font-weight: 800; border-radius: 4px; white-space: nowrap;">💼 أمانات</span>
                <div style="display: flex; flex-direction: column; gap: 4px; flex: 1;">
                    <h3 style="font-size: 14.5px; font-weight: 800; margin: 0;">
                        <a href="<?php the_permalink(); ?>" style="color: #222; text-decoration: none; transition: color 0.2s;"><?php the_title(); ?></a>
                    </h3>
                    <div style="display: flex; align-items: center; flex-wrap: wrap; gap: 15px; font-size: 12px; color: #666;">
                        <?php if(!empty($sender)) : ?><span><i class="far fa-user"></i> <strong>المعلن:</strong> <?php echo esc_html($sender); ?></span><?php endif; ?>
                        <?php if(!empty($phone)) : ?><span style="color: #115c38; font-weight: bold; font-family: sans-serif;"><i class="fas fa-phone-alt"></i> <?php echo esc_html($phone); ?></span><?php endif; ?>
                    </div>
                </div>
            </div>
            <div style="text-align: left; font-size: 12px; color: #999; white-space: nowrap;">
                <span style="display: block; font-weight: bold; color: #115c38;"><i class="far fa-clock"></i> <?php echo get_the_date('l'); ?></span>
                <span style="font-family: sans-serif; font-size: 11px;"><?php echo get_the_date('d/m/Y'); ?></span>
            </div>
        </article>
        <?php endwhile; else: ?>
            <p style="text-align: center; color: #777; padding: 50px; background: #fff; border-radius: 8px; border: 1px dashed #e2e8f0;">لا توجد مفقودات أو أمانات منشورة حالياً في هذا القسم.</p>
        <?php endif; ?>
    </div>

    <div class="v2-pagination-container" style="margin-top: 35px; text-align: center;">
        <?php the_posts_pagination(array('mid_size' => 2, 'prev_text' => __('&laquo; السابق', 'textdomain'), 'next_text' => __('التالي &raquo;', 'textdomain'))); ?>
    </div>

</div>

<div style="clear: both;"></div>
<?php get_footer(); ?>
