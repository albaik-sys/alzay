<?php get_header(); ?>

<div class="container main-content-wrap" style="margin-top: 40px; margin-bottom: 60px; min-height: 70vh;">
    <div class="gov-two-column-master-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px; align-items: start;">
        
        <main class="royal-content-panel royal-box" style="background:#fff; padding:30px; border-radius:8px; border:1px solid #eee;">
            <?php if (have_posts()) : while (have_posts()) : the_post(); $p_id = get_the_ID(); ?>
                
                <div class="event-single-meta" style="margin-bottom:20px; font-size:13px; color:#777;">
                    <span><i class="far fa-calendar-alt"></i> <?php echo get_the_date('l, d F Y'); ?></span>
                    <span style="margin-right:15px;"><i class="far fa-eye"></i> <?php echo alzaytoon_get_post_views($p_id); ?> مشاهدة</span>
                </div>

                <h1 class="single-event-title" style="font-size:24px; font-weight:900; color:var(--primary); line-height:1.4; margin-bottom:25px; border-bottom:1px solid #f5f5f5; padding-bottom:15px;">
                    <?php the_title(); ?>
                </h1>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="single-event-cover" style="margin-bottom:30px; border-radius:6px; overflow:hidden; box-shadow:0 4px 15px rgba(0,0,0,0.05);">
                        <?php the_post_thumbnail('large', array('style'=>'width:100%; height:auto; display:block;')); ?>
                    </div>
                <?php endif; ?>

                <div class="single-event-content-body" style="font-size:15.5px; color:#2c3e50; line-height:1.8; text-align:justify;">
                    <?php the_content(); ?>
                </div>

            <?php endwhile; endif; ?>
        </main>

        <aside class="sidebar-widgets-wrap" style="display:flex; flex-direction:column; gap:25px;">
            <div class="royal-content-panel royal-box" style="background:#fff; border:1px solid #eee; padding:20px; border-radius:8px;">
                <div class="panel-header-gov" style="font-weight:800; font-size:14px; margin-bottom:15px; border-bottom:2px solid var(--gold); padding-bottom:8px;">
                    <i class="far fa-calendar-check"></i> فعاليات ومناسبات أخرى
                </div>
                <div class="related-events-list" style="display:flex; flex-direction:column; gap:15px;">
                    <?php
                    $related_query = new WP_Query(array('post_type' => 'events', 'posts_per_page' => 3, 'post__not_in' => array($p_id), 'post_status' => 'publish'));
                    if ($related_query->have_posts()) : while ($related_query->have_posts()) : $related_query->the_post();
                    ?>
                        <div style="font-size:13.5px; font-weight:700;">
                            <a href="<?php the_permalink(); ?>" style="color:var(--primary); text-decoration:none; display:block; line-height:1.4;"><?php the_title(); ?></a>
                            <small style="color:#aaa; font-weight:normal; font-size:11px;"><?php echo get_the_date('d/m/Y'); ?></small>
                        </div>
                    <?php endwhile; wp_reset_postdata(); endif; ?>
                </div>
            </div>
        </aside>

    </div>
</div>

<?php get_footer(); ?>
