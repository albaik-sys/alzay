<?php get_header(); ?>

<div class='container archive-container'>
    <header class="archive-header">
        <h1 class="archive-main-title">
            <?php 
                if ( is_post_type_archive() ) {
                    post_type_archive_title();
                } elseif ( is_category() ) {
                    single_cat_title();
                } else {
                    the_archive_title();
                }
            ?>
        </h1>
        <?php if ( get_the_archive_description() ) : ?>
            <div class="archive-description"><?php the_archive_description(); ?></div>
        <?php endif; ?>
    </header>

    <div class="archive-grid">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article class="archive-card">
                <a href="<?php the_permalink(); ?>" class="archive-img-link">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail('medium_large'); ?>
                    <?php else: ?>
                        <img src="https://picsum.photos/400/250?random=<?php echo rand(1,999); ?>" alt="صورة افتراضية">
                    <?php endif; ?>
                </a>
                
                <div class="archive-content">
                    <div class="archive-meta">
                        <span><i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
                        <span style="color:#d9534f;font-weight:700;"><i class="far fa-eye"></i> <?php echo alzaytoon_get_post_views(get_the_ID()); ?></span>
                    </div>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?></p>
                    <a href="<?php the_permalink(); ?>" class="archive-readmore">اقرأ المزيد <i class="fas fa-chevron-left" style="font-size:10px;"></i></a>
                </div>
            </article>
        <?php endwhile; else : ?>
            <div class="no-posts-found">
                <h3>عذراً، لا توجد مقالات منشورة في هذا القسم حالياً.</h3>
            </div>
        <?php endif; ?>
    </div>

    <div class="archive-pagination">
        <?php 
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( '<i class="fas fa-angle-right"></i> السابق', 'alzaytoon' ),
                'next_text' => __( 'التالي <i class="fas fa-angle-left"></i>', 'alzaytoon' ),
            ) ); 
        ?>
    </div>
</div>

<?php get_footer(); ?>
