<?php get_header(); ?>
<div class="container main-content-wrap" style="margin-top: 30px; margin-bottom: 60px; min-height: 75vh;">
    <div class="block-header-gov" style="margin-bottom: 25px; border-bottom: 2px solid #f1c40f; padding-bottom: 12px;">
        <h2 style="color: #115c38; font-weight: 900; font-size: 19px; margin: 0;"><i class="fas fa-search-location" style="margin-left: 8px;"></i> دليل الاستعلام المطور عن المفقودات والأمانات</h2>
    </div>
    <div class="v2-lost-premium-list" style="display: flex; flex-direction: column; gap: 12px;">
        <?php if (have_posts()) : while (have_posts()) : the_post(); $p_id = get_the_ID();
            $sender = get_post_meta($p_id, '_gov_sender_name', true);
            $phone = get_post_meta($p_id, '_gov_phone_address', true);
        ?>
        <article class="v2-list-row-item" style="display: flex; align-items: center; justify-content: space-between; background: #fff; border: 1px solid #e2e8f0; border-right: 4px solid #f1c40f; padding: 14px 20px; border-radius: 6px; gap: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.01); transition: all 0.3s ease-in-out; opacity: 0; transform: translateY(10px); animation: v2ListReveal 0.4s forwards;">
            <div style="display: flex; align-items: center; gap: 15px; flex: 1;">
                <span style="background: rgba(155, 89, 182, 0.1); color: #9b59b6; padding: 3px 8px; font-size: 11px; font-weight: 800; border-radius: 4px;">💼 أمانات</span>
                <div style="display: flex; flex-direction: column; gap: 4px; flex: 1;">
                    <h3 style="font-size: 14.5px; font-weight: 800; margin: 0;"><a href="<?php the_permalink(); ?>" style="color: #222; text-decoration: none;"><?php the_title(); ?></a></h3>
                    <div style="display: flex; gap: 15px; font-size: 12px; color: #666;">
                        <?php if(!empty($sender)) : ?><span><i class="far fa-user"></i> المعلن: <?php echo esc_html($sender); ?></span><?php endif; ?>
                        <?php if(!empty($phone)) : ?><span style="color: #115c38; font-weight: bold;"><i class="fas fa-phone-alt"></i> <?php echo esc_html($phone); ?></span><?php endif; ?>
                    </div>
                </div>
            </div>
            <div style="text-align: left; font-size: 12px; color: #999; white-space: nowrap;">
                <span style="display: block; font-weight: bold; color: #115c38;"><?php echo get_the_date('l'); ?></span>
                <span style="font-family: sans-serif; font-size: 11px;"><?php echo get_the_date('d/m/Y'); ?></span>
            </div>
        </article>
        <?php endwhile; endif; ?>
    </div>
</div>
<?php get_footer(); ?>
