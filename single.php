<?php get_header(); ?>

<div class="container main-content-wrap v2-single-article-container" style="margin-top: 25px; margin-bottom: 60px; min-height: 75vh;">
    
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        <div class="v2-article-breadcrumb" style="margin-bottom: 20px; font-size: 13px; color: #666; border-bottom: 1px solid #f0f0f0; padding-bottom: 10px;">
            <a href="<?php echo esc_url(home_url('/')); ?>" style="color: #115c38; font-weight: 900; text-decoration: none; transition: color 0.2s;">
                <i class="fas fa-home"></i> شبكة حي الزيتون الرسمية
            </a> 
            <span style="margin: 0 8px; color: #ccc;">/</span> 
            <span style="color: #333; font-weight: bold;"><?php the_title(); ?></span>
        </div>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="background: #fff; padding: 25px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.01);">
            
            <h1 style="color: #115c38; font-size: 20px; font-weight: 900; line-height: 1.5; margin-top: 0; margin-bottom: 15px;"><?php the_title(); ?></h1>
            
            <div class="v2-article-meta" style="font-size: 12px; color: #888; margin-bottom: 20px; display: flex; gap: 15px; flex-wrap: wrap;">
                <span><i class="far fa-calendar-alt"></i> <?php echo get_the_date('l, d/m/Y'); ?></span>
                <span><i class="far fa-eye"></i> <?php echo alzaytoon_get_post_views(get_the_ID()); ?> مشاهدة</span>
            </div>

            <div class="v2-entry-content" style="font-size: 15px; color: #333; line-height: 1.8; margin-bottom: 30px;">
                <?php the_content(); ?>
            </div>

            <div class="v2-interactive-actions-bar" style="display: flex; align-items: center; justify-content: space-between; border-top: 1px solid #f0f0f0; border-bottom: 1px solid #f0f0f0; padding: 12px 10px; margin-bottom: 35px; flex-wrap: wrap; gap: 15px;">
                
                <div style="display: flex; gap: 12px;">
                    <button class="v2-action-btn btn-like" onclick="alert('❤️ تم تسجيل إعجابك بالمقال!')" style="background: rgba(231, 76, 60, 0.05); color: #e74c3c; border: 1px solid rgba(231, 76, 60, 0.1); padding: 6px 15px; border-radius: 4px; font-weight: bold; font-size: 13px; cursor: pointer; display: flex; align-items: center; gap: 6px; transition: all 0.2s;">
                        <i class="fas fa-heart"></i> إعجاب
                    </button>
                    <a href="#respond" style="background: rgba(41, 128, 185, 0.05); color: #2980b9; border: 1px solid rgba(41, 128, 185, 0.1); padding: 6px 15px; border-radius: 4px; font-weight: bold; font-size: 13px; text-decoration: none; display: flex; align-items: center; gap: 6px; transition: all 0.2s;">
                        <i class="fas fa-comment-dots"></i> أضف تعليقاً
                    </a>
                </div>

                <div class="v2-single-share-block" style="display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 12.5px; font-weight: bold; color: #555;">مشاركة:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" style="width: 32px; height: 32px; background: #3b5998; color: #fff; border-radius: 4px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 14px;"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://api.whatsapp.com/send?text=<?php the_permalink(); ?>" target="_blank" style="width: 32px; height: 32px; background: #25d366; color: #fff; border-radius: 4px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 14px;"><i class="fab fa-whatsapp"></i></a>
                </div>

            </div>

            <div class="v2-comments-section-wrapper" style="background: #f8fafc; padding: 20px; border-radius: 6px; border: 1px solid #edf2f7;">
                <?php 
                if (comments_open() || get_comments_number()) {
                    // تخصيص حقول النموذج ليكون سريعاً ولا يطلب شروط معقدة
                    comment_form(array(
                        'title_reply' => '<i class="far fa-comments"></i> شاركنا برأيك وتعليقك فوراً وحالاً',
                        'title_reply_to' => 'رد على %s',
                        'label_submit' => 'إرسال التعليق علناً',
                        'comment_notes_before' => '',
                        'logged_in_as' => '',
                        'comment_field' => '<p class="comment-form-comment" style="margin-bottom:15px;"><textarea id="comment" name="comment" cols="45" rows="4" required placeholder="اكتب تعليقك الحر هنا..." style="width:100%; padding:12px; border:1px solid #cbd5e1; border-radius:4px; font-family:inherit; font-size:14px; outline:none; resize:vertical;"></textarea></p>',
                        'fields' => array(
                            'author' => '<p class="comment-form-author" style="margin-bottom:12px;"><input id="author" name="author" type="text" placeholder="الاسم (اختياري)" value="زائر الحي" size="30" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:4px; font-size:13px;" /></p>',
                            'email' => '', // مسح الإيميل لتسهيل الإرسال بدون تعقيد برميوم
                            'url' => '',
                        )
                    ));
                }
                ?>
            </div>

        </article>

    <?php endwhile; endif; ?>
    
</div>

<div style="clear: both;"></div>
<?php get_footer(); ?>
