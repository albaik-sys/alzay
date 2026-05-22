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

<script>
    // التحكم في قائمة الجوال الهامبرغر
    const mobileToggle = document.getElementById('mobileToggle');
    const navUl = document.getElementById('navUl');
    const mobileCloseMenu = document.getElementById('mobileCloseMenu');
    
    if(mobileToggle && navUl) {
        mobileToggle.addEventListener('click', () => { navUl.classList.add('mobile-active-ul'); });
    }
    if(mobileCloseMenu && navUl) {
        mobileCloseMenu.addEventListener('click', () => { navUl.classList.remove('mobile-active-ul'); });
    }

    // فتح وإغلاق نافذة المناشدات المنبثقة للديوان
    function openAppealModal() { document.getElementById('appealGovModal').style.display = 'flex'; }
    function closeAppealModal() { document.getElementById('appealGovModal').style.display = 'none'; }
    
    window.onclick = function(event) {
        const modal = document.getElementById('appealGovModal');
        if (event.target == modal) { modal.style.display = "none"; }
    }

    // جافاسكربت التصويت واستطلاع الرأي التفاعلي
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

    // جافاسكربت معالجة وإرسال نموذج المناشدات عبر الـ AJAX المباشر لووردبريس
    const govForm = document.getElementById('govAppealForm');
    if(govForm) {
        govForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = document.getElementById('govAppealSubmitBtn');
            const msg = document.getElementById('govAppealStatusMsg');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري تشفير وإرسال المعاملة...';
            btn.disabled = true;

            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                body: new FormData(govForm)
            })
            .then(res => res.json())
            .then(data => {
                btn.innerHTML = 'إرسال المعاملة بشكل رسمي للديوان';
                btn.disabled = false;
                msg.innerText = data.data.message;
                if(data.success) {
                    msg.style.color = '#115c38';
                    govForm.reset();
                    setTimeout(() => { closeAppealModal(); msg.innerText = ''; }, 3000);
                } else {
                    msg.style.color = '#e74c3c';
                }
            })
            .catch(() => {
                btn.innerHTML = 'إرسال المعاملة بشكل رسمي للديوان';
                btn.disabled = false;
                msg.style.color = '#e74c3c';
                msgBox.innerText = 'خطأ في معالجة البيانات السحابية.';
            });
        });
    }
</script>

<?php wp_footer(); ?>
</body>
</html>
