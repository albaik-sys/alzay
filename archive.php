<?php get_header(); ?>
<div class="container main-content-wrap" style="margin-top:40px; margin-bottom:60px; min-height:60vh;">
    <div class="block-header-gov" style="margin-bottom:30px;">
        <h2><i class="fas fa-folder-open"></i> تصفح قسم: <?php post_type_archive_title(); ?></h2>
    </div>
    
    <div class="random-articles-grid">
        <?php if(have_posts()) : while(have_posts()) : the_post(); 
            $p_id = get_the_ID();
            $p_type = get_post_type($p_id);
            $card_sender = get_post_meta($p_id, '_gov_sender_name', true);
            $card_phone = get_post_meta($p_id, '_gov_phone_address', true);
        ?>
        <article class="random-article-card">
            <a href="<?php the_permalink(); ?>" class="random-card-img-wrap">
                <?php if(has_post_thumbnail()) { the_post_thumbnail('medium_large'); } else { echo "<img src='https://picsum.photos/400/260?random=".rand(1,999)."'>"; } ?>
                <span class="random-type-badge"><?php echo get_post_type_object($p_type)->labels->singular_name; ?></span>
            </a>
            <div class="random-card-text">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                
                <?php if(in_array($p_type, array('help', 'lost')) && (!empty($card_sender) || !empty($card_phone))) : ?>
                    <div class="archive-gov-info-strip">
                        <?php if(!empty($card_sender)) : ?>
                            <span><i class="fas fa-user-circle"></i> <?php echo esc_html($card_sender); ?></span>
                        <?php endif; ?>
                        <?php if(!empty($card_phone)) : ?>
                            <span class="archive-phone-badge"><i class="fas fa-phone-alt"></i> <?php echo esc_html($card_phone); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="random-card-footer-meta">
                    <span><i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
                    <span><i class="far fa-eye"></i> <?php echo alzaytoon_get_post_views($p_id); ?> قراءة</span>
                </div>
            </div>
        </article>
        <?php endwhile; else: ?>
            <p style="grid-column:1/-1; text-align:center; padding:50px; background:#fff; border:1px solid #e0e0e0; border-radius:8px;">لا توجد مواضيع مدرجة في هذا القسم حالياً.</p>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>
