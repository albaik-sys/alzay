<?php get_header(); ?>
<div class="container main-content-wrap" style="margin-top:40px; margin-bottom:60px; min-height:60vh;">
    <div class="block-header-gov" style="margin-bottom:30px;">
        <h2><i class="fas fa-folder-open"></i> تصفح قسم: <?php post_type_archive_title(); ?></h2>
    </div>
    
    <div class="random-articles-grid">
        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
        <article class="random-article-card">
            <a href="<?php the_permalink(); ?>" class="random-card-img-wrap">
                <?php if(has_post_thumbnail()) { the_post_thumbnail('medium_large'); } else { echo "<img src='https://picsum.photos/400/260?random=".rand(1,999)."'>"; } ?>
            </a>
            <div class="random-card-text">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <div class="random-card-footer-meta">
                    <span><i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
                    <span><i class="far fa-eye"></i> <?php echo alzaytoon_get_post_views(get_the_ID()); ?> قراءة</span>
                </div>
            </div>
        </article>
        <?php endwhile; else: ?>
            <p style="grid-column:1/-1; text-align:center; padding:50px; background:#fff; border:1px solid #e0e0e0; border-radius:8px;">لا توجد مواضيع مدرجة في هذا القسم حالياً.</p>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>
