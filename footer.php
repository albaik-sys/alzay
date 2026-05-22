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
                    <input type="number" name="captcha_input" placeholder="الإجابة؟" required class="gov-form-input" style="width:120px; margin-bottom:0;">
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
    // جافاسكربت التحكم في قائمة الموبايل الجانبية
    const mobileToggle = document.getElementById('mobileToggle');
    const navUl = document.getElementById('navUl');
    const mobileCloseMenu = document.getElementById('mobileCloseMenu');
    if(mobileToggle && navUl) { mobileToggle.addEventListener('click', () => { navUl.classList.add('mobile-active-ul'); }); }
    if(mobileCloseMenu && navUl) { mobileCloseMenu.addEventListener('click', () => { navUl.classList.remove('mobile-active-ul'); }); }

    // محرك البوب اب المتغير والذكي (المفقودات أو المناشدات)
    function openGovModal(type) {
        const modal = document.getElementById('govUnifiedModal');
        const hiddenType = document.getElementById('hiddenFormType');
        const dTitle = document.getElementById('modalDynamicTitle');
        const lblPhone = document.getElementById('lblPhoneAddress');
        const lblTitle = document.getElementById('lblFormTitle');
        const lblContent = document.getElementById('lblFormContent');
        
        hiddenType.value = type;
        
        // توليد الكابتشا الرياضية العشوائية المحدثة فوراً عند الفتح
        const num1 = Math.floor(Math.random() * 9) + 1;
        const num2 = Math.floor(Math.random() * 9) + 1;
        document.getElementById('captchaMathOp').innerText = `${num1} + ${num2} =`;
        document.getElementById('captchaCorrectValue').value = num1 + num2;

        if (type === 'lost') {
            dTitle.innerHTML = '<i class="fas fa-search"></i> نظام الإبلاغ المركزي عن المفقودات وحمايتها';
            lblPhone.innerText = 'رقم جوال للتواصل / مكان الفقد والاتصال *';
            lblTitle.innerText = 'ما الشيء المفقود؟ (عنوان البلاغ) *';
            lblContent.innerText = 'تفاصيل أخرى، أوصاف المفقود ومكان العثور المتوقع *';
        } else {
            dTitle.innerHTML = '<i class="fas fa-file-signature"></i> بوابة الديوان الإلكتروني لتقديم طلبات المناشدات الدعم';
            lblPhone.innerText = 'رقم الجوال / العنوان السكني الحالي للحالة *';
            lblTitle.innerText = 'موضوع وعنوان المناشدة الرئيسي والعاجل *';
            lblContent.innerText = 'تفاصيل أخرى وشرح كامل ومستوفى للظروف والاستغاثة *';
        }

        modal.style.display = 'flex';
    }

    function closeGovModal() { document.getElementById('govUnifiedModal').style.display = 'none'; }
    window.onclick = function(e) { if(e.target == document.getElementById('govUnifiedModal')) closeGovModal(); }

    // إرسال البيانات الموحدة عبر تقنية الأجاكس الفورية دون تحميل الصفحة
    const govUnifiedForm = document.getElementById('govUnifiedForm');
    if(govUnifiedForm) {
        govUnifiedForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = document.getElementById('govFormSubmitBtn');
            const msg = document.getElementById('govFormStatusResponse');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري معالجة الطلب وتأمين الكابتشا...';
            btn.disabled = true;

            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                body: new FormData(govUnifiedForm)
            })
            .then(res => res.json())
            .then(data => {
                btn.innerHTML = 'إرسال المعاملة فوراً للأنظمة';
                btn.disabled = false;
                msg.innerText = data.data.message;
                if(data.success) {
                    msg.style.color = '#115c38';
                    govUnifiedForm.reset();
                    setTimeout(() => { closeGovModal(); msg.innerText = ''; }, 3500);
                } else {
                    msg.style.color = '#e74c3c';
                    // تحديث الكابتشا في حالة الفشل تلقائياً لإعطاء فرصة أخرى
                    const num1 = Math.floor(Math.random() * 9) + 1; const num2 = Math.floor(Math.random() * 9) + 1;
                    document.getElementById('captchaMathOp').innerText = `${num1} + ${num2} =`;
                    document.getElementById('captchaCorrectValue').value = num1 + num2;
                }
            })
            .catch(() => {
                btn.innerHTML = 'إرسال المعاملة فوراً للأنظمة';
                btn.disabled = false;
                msg.style.color = '#e74c3c';
                msg.innerText = 'حدث خطأ غير متوقع في جدار الحماية الحسابي السحابي.';
            });
        });
    }

    // جافاسكربت تشغيل استطلاع الرأي الديناميكي بالرئيسية
    function triggerRoyalPollSubmit() {
        const options = document.querySelectorAll('input[name="poll_vote_radio"]');
        let checked = false;
        options.forEach(radio => { if(radio.checked) checked = true; });
        if(!checked) { alert('الرجاء تحديد خيار التصويت الرسمي أولاً قبل الاعتماد.'); return; }
        
        document.getElementById('barFill1').style.width = '60%'; document.getElementById('percentTxt1').innerText = '60%';
        if(document.getElementById('barFill2')) { document.getElementById('barFill2').style.width = '25%'; document.getElementById('percentTxt2').innerText = '25%'; }
        if(document.getElementById('barFill3')) { document.getElementById('barFill3').style.width = '15%'; document.getElementById('percentTxt3').innerText = '15%'; }
        
        document.querySelector('#royalPollForm button').style.display = 'none';
        document.getElementById('pollAckMsg').style.display = 'block';
    }
</script>

<?php wp_footer(); ?>
</body>
</html>
