<?php get_header(); ?>
<div class='container' style='margin-top: 40px; margin-bottom: 50px; min-height: 50vh;'>
    <?php while ( have_posts() ) : the_post(); 
        // تفعيل العداد عند فتح الصفحة
        alzaytoon_set_post_views(get_the_ID());
    ?>
        <div class="single-post-wrapper" style='background: #fff; padding: 40px; border-radius: 12px; border: 1px solid #e0e0e0;'>
            
            <h1 style='color: #115c38; font-size: 32px; font-weight: 900; margin-bottom: 15px;'><?php the_title(); ?></h1>
            
            <div class="single-meta">
                <span><i class='far fa-calendar-alt'></i> <?php echo get_the_date(); ?></span>
                <span><i class='far fa-folder-open'></i> شبكة حي الزيتون</span>
                <span style="color: #d9534f; font-weight:700;"><i class='fas fa-eye'></i> <?php echo alzaytoon_get_post_views(get_the_ID()); ?> قراءة</span>
            </div>
            
            <?php if ( has_post_thumbnail() ) : ?>
                <div style='margin-bottom: 30px; text-align: center;'>
                    <?php the_post_thumbnail('large', array('style' => 'max-width: 100%; height: auto; border-radius: 12px;')); ?>
                </div>
            <?php endif; ?>
            
            <div style='line-height: 1.9; font-size: 17px; color: #333;'>
                <?php the_content(); ?>
            </div>

            <div class="share-box">
                <h4 style="margin-bottom: 10px; color: #115c38;">شارك هذا الخبر:</h4>
                <div class="share-buttons">
                    <a href="https://api.whatsapp.com/send?text=<?php echo urlencode(get_the_title() . ' - ' . get_permalink()); ?>" target="_blank" class="share-btn btn-wa"><i class="fab fa-whatsapp"></i> واتساب</a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-btn btn-fb"><i class="fab fa-facebook-f"></i> فيسبوك</a>
                    <a href="https://t.me/share/url?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share-btn btn-tg"><i class="fab fa-telegram"></i> تيليجرام</a>
                </div>
            </div>

        </div>

        <div class="related-posts">
            <h3 style="color: #115c38; font-weight: 900; border-right: 4px solid #f5b915; padding-right: 10px; margin-bottom: 20px;">أخبار ومناشدات ذات صلة</h3>
            <div class="related-grid">
                <?php
                $related = new WP_Query(array(
                    'post_type' => get_post_type(),
                    'post__not_in' => array(get_the_ID()),
                    'posts_per_page' => 3
                ));
                if($related->have_posts()) : while($related->have_posts()) : $related->the_post();
                ?>
                <div class="related-item">
                    <?php if (has_post_thumbnail()) : the_post_thumbnail('medium'); else : ?>
                        <img src='https://picsum.photos/300/200?random'>
                    <?php endif; ?>
                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                </div>
                <?php endwhile; wp_reset_postdata(); else: ?>
                    <p style="color:#777; font-size:14px;">لا توجد أخبار ذات صلة حالياً.</p>
                <?php endif; ?>
            </div>
        </div>

    <?php endwhile; ?>
</div>
<?php get_footer(); ?>