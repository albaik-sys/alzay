<?php get_header(); ?>

<div class='container news-container'>
    <?php while ( have_posts() ) : the_post(); alzaytoon_set_post_views(get_the_ID()); ?>
        
        <header class="news-header">
            <div class="news-breadcrumbs">
                <a href="<?php echo home_url(); ?>">الرئيسية</a> / 
                <a href="<?php echo get_post_type_archive_link(get_post_type()); ?>"><?php echo get_post_type_object(get_post_type())->labels->name; ?></a>
            </div>
            <h1 class="news-title"><?php the_title(); ?></h1>
            
            <div class="news-meta-info">
                <div class="meta-publish">
                    نشر في: <?php echo get_the_date('d F Y'); ?> <span class="time-sep">م</span> <?php echo get_the_time('h:i A'); ?>
                </div>
                <div class="meta-reading">
                    <span><i class='far fa-clock'></i> <?php echo alzaytoon_reading_time(); ?> للقراءة</span>
                    <span class="meta-views"><i class='far fa-eye'></i> <?php echo alzaytoon_get_post_views(get_the_ID()); ?> قراءة</span>
                </div>
            </div>
        </header>

        <div class="news-layout">
            <article class="news-content-area">
                
                <?php if ( has_post_thumbnail() ) : ?>
                    <figure class="news-featured-image">
                        <?php the_post_thumbnail('full'); ?>
                    </figure>
                <?php endif; ?>
                
                <div class="news-typography">
                    <?php the_content(); ?>
                </div>

                <div class="news-related-section">
                    <h3 class="related-title">مواضيع ذات صلة</h3>
                    <div class="related-grid-news">
                        <?php
                        $related = new WP_Query(array('post_type' => get_post_type(), 'post__not_in' => array(get_the_ID()), 'posts_per_page' => 2));
                        if($related->have_posts()) : while($related->have_posts()) : $related->the_post();
                        ?>
                        <a href="<?php the_permalink(); ?>" class="related-news-card">
                            <?php if (has_post_thumbnail()) : the_post_thumbnail('medium'); else: ?>
                                <img src="https://picsum.photos/300/200?random" alt="خبر">
                            <?php endif; ?>
                            <h4><?php the_title(); ?></h4>
                        </a>
                        <?php endwhile; wp_reset_postdata(); endif; ?>
                    </div>
                </div>

            </article>

            <aside class="news-sidebar">
                <div class="sticky-share-box">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-icon fb"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://api.whatsapp.com/send?text=<?php echo urlencode(get_the_title() . ' - ' . get_permalink()); ?>" target="_blank" class="share-icon wa"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share-icon tw"><i class="fab fa-x-twitter"></i></a>
                    <a href="https://t.me/share/url?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share-icon tg"><i class="fab fa-telegram-plane"></i></a>
                    <a href="javascript:window.print()" class="share-icon print"><i class="fas fa-print"></i></a>
                </div>
            </aside>
        </div>

    <?php endwhile; ?>
</div>

<?php get_footer(); ?>
