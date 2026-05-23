<?php get_header(); ?>
<div class="container main-content-wrap" style="margin-top: 30px; margin-bottom: 60px; min-height: 75vh;">
    <div class="block-header-gov" style="margin-bottom: 25px; border-bottom: 2px solid #115c38; padding-bottom: 12px;">
        <h2 style="color: #115c38; font-weight: 900; font-size: 19px; margin: 0;"><i class="fas fa-newspaper" style="margin-left: 8px;"></i> غرفة الأخبار والتغطيات الرسمية بالحي</h2>
    </div>
    <div class="v2-news-premium-list" style="display: flex; flex-direction: column; gap: 12px;">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="v2-list-row-item" style="display: flex; align-items: center; justify-content: space-between; background: #fff; border: 1px solid #e2e8f0; border-right: 4px solid #115c38; padding: 14px 20px; border-radius: 6px; gap: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.01); transition: all 0.3s ease-in-out; opacity: 0; transform: translateY(10px); animation: v2ListReveal 0.4s forwards;">
            <div style="display: flex; align-items: center; gap: 15px; flex: 1;">
                <div style="width: 40px; height: 40px; background: rgba(17,92,56,0.05); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #115c38;"><i class="fas fa-bullhorn"></i></div>
                <div>
                    <h3 style="font-size: 14.5px; font-weight: 800; margin: 0;"><a href="<?php the_permalink(); ?>" style="color: #222; text-decoration: none;"><?php the_title(); ?></a></h3>
                    <div style="font-size: 12px; color: #777; margin-top: 4px;"><i class="far fa-eye"></i> <?php echo v2_global_smart_views(get_the_ID()); ?> قراءة</div>
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
