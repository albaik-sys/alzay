<?php get_header(); ?>

<div class="container main-content-wrap" style="margin-top:40px; margin-bottom:60px; min-height:60vh;">
    <div class="block-header-gov" style="margin-bottom:35px;">
        <h2><i class="fas fa-award"></i> رموز ونماذج مشرفة: <?php post_type_archive_title(); ?></h2>
    </div>
    
    <div class="random-articles-grid" style="display:grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap:25px;">
        <?php if(have_posts()) : while(have_posts()) : the_post(); $p_id = get_the_ID(); ?>
        <article class="random-article-card gov-archive-card" style="display:flex; flex-direction:column; background:#fff; border:1px solid #eee; border-radius:8px; overflow:hidden;">
            <a href="<?php the_permalink(); ?>" class="random-card-img-wrap" style="display:block; position:relative;">
                <?php if(has_post_thumbnail()) { the_post_thumbnail('medium_large'); } else { echo "<img src='https://picsum.photos/400/260?random=".$p_id."'>"; } ?>
            </a>
            
            <div class="random-card-text" style="padding:20px; flex:1; display:flex; flex-direction:column; justify-content:space-between;">
                <div>
                    <h3 class="gov-archive-title" style="font-size:16px; font-weight:800; margin-bottom:12px;">
                        <a href="<?php the_permalink(); ?>" style="color:var(--primary); text-decoration:none;"><?php the_title(); ?></a>
                    </h3>
                    <div class="person-excerpt" style="font-size:13.5px; color:#666; line-height:1.6; margin-bottom:15px; text-align:justify;">
                        <?php echo wp_trim_words(strip_tags(get_the_content()), 25, '...'); ?>
                    </div>
                </div>

                <div class="random-card-footer-meta" style="border-top:1px solid #f5f5f5; padding-top:12px; display:flex; justify-content:space-between; font-size:12px; color:#888;">
                    <span><i class="far fa-calendar-alt"></i> <?php echo get_the_date('d F Y'); ?></span>
                    <span><i class="far fa-eye"></i> <?php echo alzaytoon_get_post_views($p_id); ?> قراءة</span>
                </div>
            </div>
        </article>
        <?php endwhile; else: ?>
            <p style="grid-column:1/-1; text-align:center; padding:50px; background:#fff; border:1px solid #e0e0e0; border-radius:8px;">لا توجد شخصيات مدرجة حالياً.</p>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
