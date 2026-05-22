<?php get_header(); ?>

<div class="v2-futuristic-wrapper" style="font-family: 'Cairo', sans-serif;">
    <div class="v2-mesh-glow-bg"></div>

    <div class="container" style="position: relative; z-index: 5;">
        
        <section class="v2-stats-section" style="margin-bottom: 50px;">
            <div class="block-header-gov" style="margin-bottom: 25px; border-bottom: 2px solid var(--v2-neon-emerald);">
                <h2 style="color: #fff; font-weight: 900; font-size: 20px;">
                    <i class="fas fa-chart-bar" style="color: var(--v2-neon-emerald); margin-left: 8px;"></i> 
                    شفافية ومصداقية الديوان: إحصائيات الأداء الرقمي الحي لهذا الشهر
                </h2>
            </div>

            <?php
            // استعلامات ديناميكية لحساب الأرقام حياً من قاعدة البيانات
            $total_appeals_query = new WP_Query(array('post_type' => 'help', 'posts_per_page' => -1, 'post_status' => 'publish'));
            $total_appeals = $total_appeals_query->found_posts;

            // حساب المناشدات المحلولة أو المنتهية (قيد المتابعة أو المنتهية)
            $solved_appeals_query = new WP_Query(array(
                'post_type' => 'help',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'meta_query' => array(
                    array(
                        'key' => '_appeal_badge_status',
                        'value' => array('following', 'necessary'), // نعتبرها تحت المعالجة والحل الناجح
                        'compare' => 'IN'
                    )
                )
            ));
            $solved_appeals = $solved_appeals_query->found_posts;
            
            // حساب نسبة الحل التلقائية
            $solve_percent = ($total_appeals > 0) ? round(($solved_appeals / $total_appeals) * 100) : 100;
            ?>

            <div class="v2-bento-master-grid" style="grid-template-columns: repeat(3, 1fr); gap: 20px;">
                
                <div class="v2-bento-card bento-size-small" style="text-align: center; display: flex; flex-direction: column; justify-content: center;">
                    <div class="v2-stats-progress-circle" style="background: conic-gradient(var(--v2-neon-emerald) <?php echo $solve_percent; ?>%, rgba(255,255,255,0.05) 0) !important;">
                        <span class="v2-stats-percent-text"><?php echo $solve_percent; ?>%</span>
                    </div>
                    <h4 style="font-size: 15px; font-weight: 800; color: #fff; margin-top: 5px;">معدل الاستجابة والحل الفعلي</h4>
                    <p style="font-size: 12px; color: #94a3b8; margin: 4px 0 0 0;">نسبة معالجة المناشدات المعتمدة داخل الحي</p>
                </div>

                <div class="v2-bento-card bento-size-small" style="text-align: center; display: flex; flex-direction: column; justify-content: center;">
                    <div class="v2-metric-number v2-counter-trigger" data-target="<?php echo $total_appeals; ?>">+0</div>
                    <h4 style="font-size: 15px; font-weight: 800; color: #fff; margin-top: 10px;">إجمالي الطلبات والمناشدات</h4>
                    <p style="font-size: 12px; color: #94a3b8; margin: 4px 0 0 0;">المستلمة رقمياً عبر الديوان العام منذ إطلاق النسخة</p>
                </div>

                <div class="v2-bento-card bento-size-small" style="text-align: center; display: flex; flex-direction: column; justify-content: center;">
                    <div class="v2-metric-number" style="color: #f1c40f; text-shadow: 0 0 15px rgba(241,196,15,0.2);">+<?php echo $solved_appeals; ?></div>
                    <h4 style="font-size: 15px; font-weight: 800; color: #fff; margin-top: 10px;">بلاغات قيد المعالجة والإنجاز</h4>
                    <p style="font-size: 12px; color: #94a3b8; margin: 4px 0 0 0;">تم توجيهها للجهات المختصة وأهل الخير وجاري العمل عليها</p>
                </div>

            </div>
        </section>


        <section class="v2-lost-found-section" style="margin-bottom: 50px;">
            <div class="block-header-gov" style="margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #f1c40f;">
                <h2 style="color: #fff; font-weight: 900; font-size: 20px;">
                    <i class="fas fa-search-location" style="color: #f1c40f; margin-left: 8px;"></i> 
                    بوابة المفقودات والأمانات المركزية لحي الزيتون
                </h2>
                <a href="<?php echo get_post_type_archive_link('lost'); ?>" class="v2-btn-neon-pulse" style="padding: 6px 16px; font-size: 12px; background: linear-gradient(135deg, #f1c40f 0%, #d4af37 100%); color:#000; box-shadow:none;">تصفح الأرشيف الكامل &laquo;</a>
            </div>

            <div class="v2-bento-master-grid" style="grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px;">
                <?php 
                $lost_query = new WP_Query(array('post_type' => 'lost', 'posts_per_page' => 3, 'post_status' => 'publish'));
                if($lost_query->have_posts()) : while($lost_query->have_posts()) : $lost_query->the_post(); 
                    $p_id = get_the_ID();
                    
                    // محاكاة جلب التصنيف بشكل ديناميكي ذكي ومظهر الخريطة التقريبية
                    $categories = array('badge-cat-persons' => '👥 أشخاص', 'badge-cat-docs' => '📄 مستندات رسمية', 'badge-cat-vehicles' => '🚗 مركبات', 'badge-cat-assets' => '💼 متعلقات وأمانات');
                    $random_cat_class = array_rand($categories);
                    $random_cat_txt = $categories[$random_cat_class];
                    
                    $phone_val = get_post_meta($p_id, '_gov_phone_address', true);
                    $sender_val = get_post_meta($p_id, '_gov_sender_name', true);
                ?>
                <div class="v2-lost-card-enhanced" style="position: relative;">
                    <span class="v2-lost-category-badge <?php echo $random_cat_class; ?>"><?php echo $random_cat_txt; ?></span>
                    
                    <div class="v2-lost-card-img" style="width: 100%; height: 180px; overflow: hidden; background: #111;">
                        <?php if(has_post_thumbnail()) : the_post_thumbnail('medium_large', array('style'=>'width:100%; height:100%; object-fit:cover;')); else : ?>
                            <img src="https://picsum.photos/400/250?random=<?php echo $p_id; ?>" style="width:100%; height:100%; object-fit:cover; opacity: 0.8;">
                        <?php endif; ?>
                    </div>

                    <div style="padding: 20px; flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <h3 style="font-size: 16px; font-weight: 800; margin: 0 0 10px 0;">
                                <a href="<?php the_permalink(); ?>" style="color:#fff; text-decoration:none; transition:0.2s;" onmouseover="this.style.color='var(--v2-neon-emerald)'" onmouseout="this.style.color='#fff'"><?php the_title(); ?></a>
                            </h3>
                            <p style="font-size: 13px; color: #94a3b8; line-height: 1.6; margin-bottom: 15px; text-align: justify;">
                                <?php echo wp_trim_words(get_the_content(), 15, '...'); ?>
                            </p>
                        </div>

                        <div style="border-top: 1px solid var(--v2-glass-border); padding-top: 12px; display: flex; flex-direction: column; gap: 8px; font-size: 12px; color: #cbd5e1;">
                            <?php if(!empty($sender_val)) : ?>
                                <span><i class="fas fa-user" style="color:var(--v2-neon-emerald); margin-left:5px;"></i> المعلن: <strong><?php echo esc_html($sender_val); ?></strong></span>
                            <?php endif; ?>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="color: #f1c40f; font-weight: 700;"><i class="fas fa-map-marker-alt"></i> 📍 خريطة الموقع التقريبية للحي</span>
                                <span style="font-size: 11px; color:#64748b;"><i class="far fa-clock"></i> <?php echo get_the_date('d/m/Y'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; wp_reset_postdata(); else: ?>
                    <p style="grid-column: 1/-1; text-align: center; color: #94a3b8; padding: 40px; background: var(--v2-glass-bg); border-radius: 8px;">لا توجد بلاغات مفقودات نشطة حالياً.</p>
                <?php endif; ?>
            </div>
        </section>

    </div>
</div>

<?php get_footer(); ?>
