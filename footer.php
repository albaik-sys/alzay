<?php
// حماية حديدية: تظهر الكتلة مرة واحدة فقط فوق الفوتر الأخضر بالرئيسية
if ((is_home() || is_front_page()) && !defined('V2_AID_TOTAL_BLOCK_DONE')) {
    define('V2_AID_TOTAL_BLOCK_DONE', true);
?>
<div class="container v2-aid-master-wrap" style="margin-top: 40px; margin-bottom: 40px; clear: both !important;">

    <div class="v2-aid-news-section" style="background:#fff; border:1px solid #e2e8f0; border-top:4px solid #e74c3c; padding:22px; border-radius:8px; margin-bottom: 25px; box-shadow:0 4px 12px rgba(0,0,0,0.02);">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:18px; border-bottom:1px solid #f0f0f0; padding-bottom:12px; flex-wrap:wrap; gap:10px;">
            <h3 style="margin:0; font-size:16.5px; font-weight:900; color:#e74c3c; display:flex; align-items:center; gap:8px;">
                <i class="fas fa-bullhorn" style="animation: pulse 1s infinite;"></i> آخر التحديثات وأخبار المساعدات الحالية
            </h3>
            <span style="font-size:11.5px; background:rgba(231,76,60,0.08); color:#e74c3c; padding:4px 10px; border-radius:4px; font-weight:bold;">📍 تحديث فوري مباشر</span>
        </div>

        <div style="display: flex; flex-direction: column; gap: 14px;">
            
            <div style="background: #fff5f5; border-right: 4px solid #e74c3c; padding: 15px; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px; flex-wrap: wrap; gap: 5px;">
                    <strong style="color: #c0392b; font-size: 14px; font-weight: 900;"><i class="fas fa-gas-pump"></i> عاجل: كشوفات وتحديثات توزيع غاز الطهي للحي</strong>
                    <span style="font-size: 11px; color: #777; background: #fff; padding: 2px 8px; border-radius: 10px; border: 1px solid #ebd3d3;">منذ ساعتين</span>
                </div>
                <p style="margin: 0; font-size: 13px; color: #444; line-height: 1.6; font-weight: 700;">
                    نلفت عناية الإخوة السكان الكرام إلى أنه تم تحديث كشوفات تعبئة غاز الطهي للدورة الحالية بالتعاون مع لجنة الحي الرسمية. يرجى من الواردة أسماؤهم التوجه مباشرة إلى نقطة التوزيع المعتمدة مصطحبين الهوية الشخصية والجرار المسجلة لضمان سير العملية بسلاسة.
                </p>
            </div>

            <div style="background: #f4faf7; border-right: 4px solid #115c38; padding: 15px; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px; flex-wrap: wrap; gap: 5px;">
                    <strong style="color: #115c38; font-size: 14px; font-weight: 900;"><i class="fas fa-box-open"></i> إعلان: بدء توزيع الطرود الغذائية الدورية</strong>
                    <span style="font-size: 11px; color: #777; background: #fff; padding: 2px 8px; border-radius: 10px; border: 1px solid #d3ebd3;">اليوم صباحاً</span>
                </div>
                <p style="margin: 0; font-size: 13px; color: #444; line-height: 1.6; font-weight: 700;">
                    تعلن الهيئة الإغاثية بالتعاون مع المندوبين المحليين عن البدء الفعلي لتوزيع الحصص والطرود الغذائية الجافة للعائلات المستحقة داخل المربعات السكنية المحددة. يرجى مراجعة الرابط أدناه في بوابة المنصات للتحقق من حالة الاستحقاق والدور المخصص لعائلتكم.
                </p>
            </div>

            <?php 
            // دمج ديناميكي اختياري في حال رغبت مستقبلاً بربط القسم بنوع منشورات (Aid News CPT)
            $aid_news_query = new WP_Query(array('post_type' => 'aid_news', 'posts_per_page' => 3, 'post_status' => 'publish'));
            if($aid_news_query->have_posts()): while($aid_news_query->have_posts()): $aid_news_query->the_post();
            ?>
            <div style="background: #f8fafc; border-right: 4px solid #64748b; padding: 15px; border-radius: 4px;">
                <strong style="color: #334155; font-size: 14px;"><?php the_title(); ?></strong>
                <div style="font-size: 13px; color: #444; margin-top: 5px;"><?php the_excerpt(); ?></div>
            </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>

        </div>
    </div>


    <div class="v2-aid-links-section" style="background:#fff; border:1px solid #e2e8f0; border-top:4px solid #115c38; padding:22px; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.02);">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:18px; border-bottom:1px solid #f0f0f0; padding-bottom:12px; flex-wrap:wrap; gap:10px;">
            <h3 style="margin:0; font-size:16.5px; font-weight:900; color:#115c38; display:flex; align-items:center; gap:8px;">
                <i class="fas fa-hand-holding-heart" style="color:#e74c3c;"></i> بوابة منصات وروابط المساعدات الرسمية للحي
            </h3>
            <span style="font-size:11.5px; background:rgba(17,92,56,0.06); color:#115c38; padding:4px 10px; border-radius:4px; font-weight:bold;"><i class="fas fa-shield-alt"></i> روابط موثوقة ومعتمدة</span>
        </div>
        
        <div class="v2-aid-grid" style="display:grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap:14px;">
            <?php 
            $aid_query = new WP_Query(array('post_type' => 'aid_links', 'posts_per_page' => -1, 'post_status' => 'publish'));
            if($aid_query->have_posts()): while($aid_query->have_posts()): $aid_query->the_post();
                $aid_url = get_post_meta(get_the_ID(), '_v2_aid_url', true);
                $is_up = get_post_meta(get_the_ID(), '_v2_aid_is_updated', true);
            ?>
            <a href="<?php echo esc_url($aid_url); ?>" target="_blank" class="v2-aid-card" style="display:flex; align-items:center; justify-content:space-between; background:#f8fafc; border:1px solid #edf2f7; padding:14px 18px; border-radius:6px; text-decoration:none; color:#222; font-weight:800; font-size:13.5px; transition:all 0.25s ease-in-out; box-shadow: 0 1px 3px rgba(0,0,0,0.01);">
                <span style="display:flex; align-items:center; gap:10px;">
                    <i class="fas fa-external-link-alt" style="color:#115c38; font-size:11px;"></i>
                    <?php the_title(); ?>
                </span>
                <?php if($is_up === '1'): ?>
                <span class="badge-updated" style="background:#e74c3c; color:#fff; font-size:10px; padding:3px 8px; border-radius:3px; font-weight:900; animation: pulse 1.5s infinite; white-space:nowrap;"><i class="fas fa-fire"></i> مُحدّث</span>
                <?php endif; ?>
            </a>
            <?php endwhile; wp_reset_postdata(); else: ?>
                <p style="font-size:13px; color:#777; margin:0; padding:10px 0; font-style:italic;">📍 يرجى إضافة الروابط الرسمية للمنصات والمواقع الآن من لوحة تحكم ووردبريس لتظهر هنا فوراً...</p>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php 
} 
?>
<footer class="main-royal-footer">
    <div class="container">
        <div class="footer-grid-layout">
            <div class="footer-brand-column">
                <h3><i class="fas fa-tree"></i> شبكة حي الزيتون</h3>
                <p>الديوان والمنصة المعتمدة الرسمية لنشر وبث أخبار ومناشدات ومناسبات أهالي حي الزيتون بكل شفافية ومصداقية وعمل مجتمعي مشترك.</p>
            </div>
            <div class="footer-newsletter-column">
                <h4>الاشتراك في النشرة والبيانات الرسمية</h4>
                <form class="footer-subscribe-form-wrap">
                    <input type="email" placeholder="أدخل البريد الإلكتروني الرسمي" required class="footer-mail-input">
                    <button type="submit" class="footer-submit-btn">اشترك الآن</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom-copyright-strip">
            <p>جميع الحقوق محفوظة ومحمية برمجياً وقانونياً &copy; لشبكة حي الزيتون الإعلامية <?php echo date('Y'); ?></p>
            <p style="font-size:11px; color:#aaa; margin-top:5px;">تطوير وهندسة وتصميم: م. خالد البيك</p>
        </div>
    </div>
</footer>

<div class="floating-social-anchor-box">
    <a href="https://wa.me/<?php echo esc_attr(get_theme_mod('alzaytoon_whatsapp', '')); ?>" class="float-btn-item f-whatsapp" target="_blank"><i class="fab fa-whatsapp"></i></a>
    <a href="<?php echo esc_url(get_theme_mod('alzaytoon_facebook', '#')); ?>" class="float-btn-item f-facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
</div>

<div id="govUnifiedModal" class="gov-modal-overlay">
    <div class="gov-modal-container">
        <span class="gov-modal-close-icon" onclick="closeGovModal()">&times;</span>
        <div class="gov-modal-title-header">
            <h3 id="modalDynamicTitle"><i class="fas fa-file-signature"></i> بوابة الديوان الإلكتروني للطلبات والمعاملات</h3>
        </div>
        <form id="govUnifiedForm" class="gov-form-wrapper" enctype="multipart/form-data">
            <div class="gov-form-row-grid">
                <div class="form-group-box">
                    <label>الاسم الكامل أو اسم العضوية:</label>
                    <input type="text" name="appeal_name" placeholder="أدخل الاسم رباعي" class="gov-form-input">
                </div>
                <div class="form-group-box">
                    <label id="lblPhoneAddress">رقم الجوال / العنوان الحالي *:</label>
                    <input type="text" name="appeal_phone" placeholder="رقم الجوال أو مكان السكن" required class="gov-form-input">
                </div>
            </div>
            <div class="form-group-box">
                <label id="lblFormTitle">عنوان البلاغ أو المناشدة الرئيسي *:</label>
                <input type="text" name="appeal_title" placeholder="اكتب مسمى مختصر وواضح" required class="gov-form-input">
            </div>
            <div class="form-group-box">
                <label id="lblFormContent">تفاصيل أخرى وشرح كامل للموضوع *:</label>
                <textarea name="appeal_content" placeholder="اكتب الشرح المكتمل والتفاصيل الهامة هنا..." required class="gov-form-input" rows="4"></textarea>
            </div>
            <div class="form-group-box">
                <label>تاريخ انتهاء النشر والاهتمام تلقائياً:</label>
                <input type="date" name="appeal_end" class="gov-form-input">
            </div>
            <div class="form-group-box">
                <label>إرفاق صورة داعمة واضحة (مفقود / تقارير حالة):</label>
                <label class="custom-gov-file-uploader">
                    <i class="fas fa-upload"></i> اضغط هنا لتحميل الصورة من جهازك
                    <input type="file" name="appeal_image" accept="image/*" style="display:none;">
                </label>
            </div>
            <div class="form-group-box" style="background:#f4f6f9; padding:15px; border-radius:4px; margin-top:10px;">
                <label style="color:var(--primary); font-weight:800;" id="captchaLabelTxt">نظام التحقق الأمني الرقمي العشوائي</label>
                <div style="display:flex; gap:15px; align-items:center; margin-top:5px;">
                    <span id="captchaMathOp" style="font-size:18px; font-weight:900; color:#111; background:#fff; padding:6px 15px; border:1px solid #ccc;">0 + 0 =</span>
                    <input type="number" name="captcha_input" placeholder="الإجابة?" required class="gov-form-input" style="width:120px; margin-bottom:0;">
                </div>
                <input type="hidden" name="captcha_correct" id="captchaCorrectValue">
            </div>
            <input type="hidden" name="form_type" id="hiddenFormType" value="help">
            <input type="hidden" name="action" value="submit_gov_form">
            <button type="submit" class="btn-royal-gold full-width-btn" id="govFormSubmitBtn" style="margin-top:20px; font-size:16px; font-weight:900;">إرسال المعاملة فوراً للأنظمة</button>
            <div id="govFormStatusResponse" class="gov-ajax-response-message"></div>
        </form>
    </div>
</div>

<script>
    // جافاسكربت القائمة الجانبية المحدث والمنظم للموبايل
    const mobileToggle = document.getElementById('mobileToggle');
    const navUl = document.getElementById('navUl');
    const mobileCloseMenu = document.getElementById('mobileCloseMenu');
    if(mobileToggle && navUl) { mobileToggle.addEventListener('click', () => { navUl.classList.add('mobile-active-ul'); }); }
    if(mobileCloseMenu && navUl) { mobileCloseMenu.addEventListener('click', () => { navUl.classList.remove('mobile-active-ul'); }); }

    function openGovModal(type) {
        const modal = document.getElementById('govUnifiedModal');
        const hiddenType = document.getElementById('hiddenFormType');
        const dTitle = document.getElementById('modalDynamicTitle');
        const lblPhone = document.getElementById('lblPhoneAddress');
        const lblTitle = document.getElementById('lblFormTitle');
        const lblContent = document.getElementById('lblFormContent');
        hiddenType.value = type;
        const num1 = Math.floor(Math.random() * 9) + 1; const num2 = Math.floor(Math.random() * 9) + 1;
        document.getElementById('captchaMathOp').innerText = `${num1} + ${num2} =`;
        document.getElementById('captchaCorrectValue').value = num1 + num2;
        if (type === 'lost') {
            dTitle.innerHTML = '<i class="fas fa-search"></i> نظام الإبلاغ المركزي عن المفقودات وحمايتها';
            lblPhone.innerText = 'رقم جوال للتواصل / مكان الفقد والاتصال *'; lblTitle.innerText = 'ما الشيء المفقود؟ (عنوان البلاغ) *'; lblContent.innerText = 'تفاصيل أخرى، أوصاف المفقود ومكان العثور المتوقع *';
        } else {
            dTitle.innerHTML = '<i class="fas fa-file-signature"></i> بوابة الديوان الإلكتروني لتقديم طلبات المناشدات الدعم';
            lblPhone.innerText = 'رقم الجوال / العنوان السكني الحالي للحالة *'; lblTitle.innerText = 'موضوع وعنوان المناشدة الرئيسي والعاجل *'; lblContent.innerText = 'تفاصيل أخرى وشرح كامل ومستوفى للظروف والاستغاثة *';
        }
        modal.style.display = 'flex';
    }
    function closeGovModal() { document.getElementById('govUnifiedModal').style.display = 'none'; }
    window.onclick = function(e) { if(e.target == document.getElementById('govUnifiedModal')) closeGovModal(); }

    const govUnifiedForm = document.getElementById('govUnifiedForm');
    if(govUnifiedForm) {
        govUnifiedForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = document.getElementById('govFormSubmitBtn');
            const msg = document.getElementById('govFormStatusResponse');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري معالجة الطلب...'; btn.disabled = true;
            fetch('<?php echo admin_url('admin-ajax.php'); ?>', { method: 'POST', body: new FormData(govUnifiedForm) })
            .then(res => res.json()).then(data => {
                btn.innerHTML = 'إرسال المعاملة فوراً للأنظمة'; btn.disabled = false; msg.innerText = data.data.message;
                if(data.success) { msg.style.color = '#115c38'; govUnifiedForm.reset(); setTimeout(() => { closeGovModal(); msg.innerText = ''; }, 3500); } 
                else { msg.style.color = '#e74c3c'; const num1 = Math.floor(Math.random() * 9) + 1; const num2 = Math.floor(Math.random() * 9) + 1; document.getElementById('captchaMathOp').innerText = `${num1} + ${num2} =`; document.getElementById('captchaCorrectValue').value = num1 + num2; }
            }).catch(() => { btn.innerHTML = 'إرسال المعاملة فوراً للأنظمة'; btn.disabled = false; msg.style.color = '#e74c3c'; msg.innerText = 'خطأ حمايتي سحابي.'; });
        });
    }

    function triggerRoyalPollSubmit() {
        const options = document.querySelectorAll('input[name="poll_vote_radio"]'); let checked = false; options.forEach(radio => { if(radio.checked) checked = true; });
        if(!checked) { alert('الرجاء تحديد خيار التصويت الرسمي أولاً قبل الاعتماد.'); return; }
        document.getElementById('barFill1').style.width = '60%'; document.getElementById('percentTxt1').innerText = '60%';
        if(document.getElementById('barFill2')) { document.getElementById('barFill2').style.width = '25%'; document.getElementById('percentTxt2').innerText = '25%'; }
        if(document.getElementById('barFill3')) { document.getElementById('barFill3').style.width = '15%'; document.getElementById('percentTxt3').innerText = '15%'; }
        document.querySelector('#royalPollForm button').style.display = 'none'; document.getElementById('pollAckMsg').style.display = 'block';
    }

    // 🟢 جافاسكربت محاكي آلة الكتابة لشريط الأخبار العاجلة (Typing Effect) 🟢
    const tickerText = "<?php echo esc_js(get_theme_mod('alzaytoon_ticker_text', 'باقي 5 أيام على الإطلاق الرسمي للمنصة الإلكترونية الموحدة لحي الزيتون... شاركنا الآن برأيك وبلاغاتك.')); ?>";
    const typingElement = document.getElementById('typingTickerElement');
    let index = 0;
    function typeEffect() {
        if (index < tickerText.length) {
            typingElement.innerHTML += tickerText.charAt(index);
            index++;
            setTimeout(typeEffect, 45); // سرعة ضربة الحرف بالملي ثانية
        } else {
            setTimeout(() => { typingElement.innerHTML = ""; index = 0; typeEffect(); }, 5000); // إيقاف 5 ثواني ثم إعادة الكتابة من جديد
        }
    }
    if(typingElement) { document.addEventListener('DOMContentLoaded', typeEffect); }
</script>

<?php wp_footer(); ?>
</body>
</html>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // 🖥️ جافاسكربت الـ Terminal Live Typing Effect
    const lines = [
        "> initializing alzaytoon v2 intelligence layer... [OK]",
        "> establishing end-to-end secure gateway... [SECURE]",
        "> indexing dynamic civic database records... [READY]",
        "> system online. welcome to the future core."
    ];
    let lineIdx = 0, charIdx = 0;
    const termBody = document.getElementById("v2TerminalBody");
    
    function typeTerminal() {
        if (lineIdx < lines.length) {
            if (charIdx === 0) {
                if(lineIdx > 0) termBody.innerHTML += "<br>";
            }
            termBody.innerHTML += lines[lineIdx].charAt(charIdx);
            charIdx++;
            if (charIdx < lines[lineIdx].length) {
                setTimeout(typeTerminal, 30);
            } else {
                charIdx = 0;
                lineIdx++;
                setTimeout(typeTerminal, 600);
            }
        }
    }
    if(termBody) typeTerminal();

    // 📈 جافاسكربت الـ Live Metrics Counter الأوتوماتيكي
    const counters = document.querySelectorAll('.v2-counter-trigger');
    counters.forEach(counter => {
        const updateCount = () => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText.replace('+', '');
            const speed = 200; 
            const inc = target / speed;
            if (count < target) {
                counter.innerText = '+' + Math.ceil(count + inc);
                setTimeout(updateCount, 15);
            } else {
                counter.innerText = '+' + target.toLocaleString();
            }
        };
        updateCount();
    });
});
</script>
<script>
    // 1. فتح الـ Modal الأصلي للمفقودات المتواجد بالمنصة
    if(typeof openGovModal === 'function') {
        openGovModal('lost'); 
    }
    
    // 2. البحث عن عناصر النموذج لتعديل موضوعها ونوعها حياً بناءً على ضغطة الزر
    setTimeout(function() {
        const modalTitle = document.querySelector('#govLostModal h3, .lost-modal-title, #govLostModal .modal-header');
        const typeInputField = document.querySelector('#govLostModal input[name="lost_type"], #govLostModal .select-lost-type');
        
        if(actionType === 'lost') {
            if(modalTitle) {
                modalTitle.innerText = "📋 استمارة التبليغ عن مفقودات جديدة بالحي";
                modalTitle.style.color = "#e74c3c";
            }
            if(typeInputField) typeInputField.value = "lost";
        } else if(actionType === 'found') {
            if(modalTitle) {
                modalTitle.innerText = "🟢 استمارة إثبات أمانات ومفقودات معثور عليها";
                modalTitle.style.color = "#2ecc71";
            }
            if(typeInputField) typeInputField.value = "found";
        }
    }, 150); // تأخير بسيط ملي ثانية للتأكد من رندرة الـ DOM للبوب أب
}
</script>
