<?php get_header(); ?>

<div class="container main-content-wrap v2-master-home-layout" style="margin-top: 20px; margin-bottom: 60px; min-height: 75vh;">

    <div class="v2-aid-links-section" style="background:#fff; border:1px solid #e2e8f0; border-top:4px solid #115c38; padding:22px; border-radius:8px; margin-bottom:30px; box-shadow:0 4px 12px rgba(0,0,0,0.02); clear:both;">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:18px; border-bottom:1px solid #f0f0f0; padding-bottom:12px; flex-wrap:wrap; gap:10px;">
            <h3 style="margin:0; font-size:16.5px; font-weight:900; color:#115c38; display:flex; align-items:center; gap:8px;">
                <i class="fas fa-hand-holding-heart" style="color:#e74c3c;"></i> بوابة منصات وروابط المساعدات الرسمية للحي
            </h3>
            <span style="font-size:11.5px; background:rgba(17,92,56,0.06); color:#115c38; padding:4px 10px; border-radius:4px; font-weight:bold;"><i class="fas fa-shield-alt"></i> روابط موثوقة ومعتمدة</span>
        </div>
        
        <div class="v2-aid-grid" style="display:grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap:14px;">
            <?php 
            $aid_query = new WP_Query(array('post_type' => 'aid_links', 'posts_per_page' => -1, 'post_status' => 'publish'));
            if($aid_query->have_posts()): while($aid_query->have_posts()): $aid_query->the_post();
                $aid_url = get_post_meta(get_the_ID(), '_v2_aid_url', true);
                $is_up = get_post_meta(get_the_ID(), '_v2_aid_is_updated', true);
            ?>
            <a href="<?php echo esc_url($aid_url); ?>" target="_blank" class="v2-aid-card" style="display:flex; align-items:center; justify-content:space-between; background:#f8fafc; border:1px solid #edf2f7; padding:14px 18px; border-radius:6px; text-decoration:none; color:#222; font-weight:800; font-size:13.5px; transition:all 0.25s ease-in-out; box-shadow: 0 1px 3px rgba(0,0,0,0.01);">
                <span style="display:flex; align-items:center; gap:10px;">
                    <i class="fas fa-external-link-alt" style="color:#115c38; font-size:11px;"></i>
                    <?php the_title(); ?>
                </span>
                <?php if($is_up === '1'): ?>
                <span class="badge-updated" style="background:#e74c3c; color:#fff; font-size:10px; padding:3px 8px; border-radius:3px; font-weight:900; animation: pulse 1.5s infinite; white-space:nowrap;"><i class="fas fa-fire"></i> مُحدّث</span>
                <?php endif; ?>
            </a>
            <?php endwhile; wp_reset_postdata(); else: ?>
                <p style="font-size:13px; color:#777; margin:0; padding:10px 0; font-style:italic;">📍 يرجى إضافة الروابط الرسمية للمنصات والمواقع الآن من لوحة تحكم ووردبريس لتظهر هنا فوراً...</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="main-home-news-feed" style="margin-top:20px;">
        <?php 
        // هنا ينساب اللوب الكلاسيكي الطبيعي لعرض أحدث الأخبار كالمعتاد
        if (have_posts()) : while (have_posts()) : the_post();
            // رندرة الكروت الكلاسيكية
        endwhile; endif; 
        ?>
    </div>

</div>

<div style="clear: both;"></div>
<?php get_footer(); ?>
