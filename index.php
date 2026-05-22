<?php get_header(); ?>

<div class="container main-content-wrap v2-list-cinema-container" style="margin-top: 30px; margin-bottom: 60px; min-height: 75vh;">
    
    <div class="block-header-gov" style="margin-bottom: 25px; border-bottom: 2px solid #115c38; padding-bottom: 10px;">
        <h2 style="color: #115c38; font-weight: 900; font-size: 19px; margin: 0;">
            <i class="fas fa-folder-open" style="margin-left: 8px;"></i> 
            تصفح السجلات والطلبات المعتمدة داخل الديوان
        </h2>
    </div>

    <div class="v2-premium-list-wrapper" style="display: flex; flex-direction: column; gap: 12px;">
        <?php if (have_posts()) : while (have_posts()) : the_post(); $p_id = get_the_ID(); ?>
        
        <article class="v2-list-row-item" style="display: flex; align-items: center; justify-content: space-between; background: #fff; border: 1px solid #e2e8f0; border-right: 4px solid #d4af37; padding: 12px 20px; border-radius: 6px; gap: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.01); transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); opacity: 0; transform: translateY(10px); animation: v2ListReveal 0.5s forwards;">
            
            <div style="display: flex; align-items: center; gap: 15px; flex: 1;">
                <div class="v2-list-icon-box" style="width: 40px; height: 40px; background: rgba(17,92,56,0.05); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #115c38; font-size: 14px;">
                    <i class="fas fa-file-alt"></i>
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 4px; flex: 1;">
                    <h3 style="font-size: 14.5px; font-weight: 800; margin: 0; line-height: 1.4;">
                        <a href="<?php the_permalink(); ?>" style="color: #222; text-decoration: none; transition: color 0.2s;"><?php the_title(); ?></a>
                    </h3>
                    <div class="v2-list-meta-inline" style="display: flex; align-items: center; flex-wrap: wrap; gap: 15px; font-size: 12px; color: #666;">
                        <span><i class="far fa-user" style="color:#d4af37;"></i> السجل العام للديوان</span>
                        <span><i class="far fa-eye"></i> <?php echo alzaytoon_get_post_views($p_id); ?> قراءة</span>
                    </div>
                </div>
            </div>

            <div class="v2-list-date-box" style="text-align: left; font-size: 12px; color: #999; white-space: nowrap;">
                <span style="display: block; font-weight: 700; color: #115c38;"><i class="far fa-calendar-alt"></i> <?php echo get_the_date('l'); ?></span>
                <span style="font-family: sans-serif; font-size: 11px;"><?php echo get_the_date('d/m/Y'); ?></span>
            </div>

        </article>

        <?php endwhile; else: ?>
            <p style="text-align: center; color: #666; padding: 40px; background: #fff; border-radius: 6px; border: 1px dashed #ccc;">لا توجد سجلات منشورة في هذا القسم حالياً.</p>
        <?php endif; ?>
    </div>

    <div class="v2-pagination-wrap" style="margin-top: 30px; text-align: center;">
        <?php the_posts_pagination(array('mid_size' => 2, 'prev_text' => __('&laquo; السابق', 'textdomain'), 'next_text' => __('التالي &raquo;', 'textdomain'))); ?>
    </div>

</div>

<div style="clear: both;"></div>
<?php get_footer(); ?>
<?php
// Clean injection closure
?>
