<?php get_header(); ?>
<div class="container single-container">
    <?php while(have_posts()) : the_post(); ?>
    <div class="single-header">
        <h1 class="single-title"><?php the_title(); ?></h1>
        <div class="single-meta">
            <span><i class="far fa-calendar"></i> <?php echo get_the_date(); ?></span>
            <span><i class="far fa-folder"></i> <?php echo get_post_type_object(get_post_type())->labels->name; ?></span>
        </div>
    </div>
    <?php if(has_post_thumbnail()) : ?>
    <div class="single-image"><?php the_post_thumbnail('large'); ?></div>
    <?php endif; ?>
    <div class="single-content">
        <?php the_content(); ?>
    </div>
    <?php endwhile; ?>
</div>
<?php get_footer(); ?>
