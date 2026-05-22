<footer class='footer-strip'>
    <div class='container'>
        <div class="footer-left">
            <h3>اشترك في نشرتنا البريدية ليصلك كل جديد <i class='far fa-envelope'></i></h3>
            <form class='subscribe-form'>
                <input type='email' placeholder='أدخل بريدك الإلكتروني' required>
                <button type='submit'>اشترك</button>
            </form>
        </div>
        <div class="footer-right">
            <h3>شاركنا أخبار حيكم ومناسباته</h3>
            <a href='https://wa.me/<?php echo esc_attr(get_theme_mod("alzaytoon_whatsapp", "")); ?>' class='btn-yellow royal-btn'>أرسل خبرك</a>
        </div>
    </div>
</footer>

<div class="floating-social">
    <a href="https://wa.me/<?php echo esc_attr(get_theme_mod("alzaytoon_whatsapp", "")); ?>" class="float-whatsapp" target="_blank"><i class="fab fa-whatsapp"></i></a>
    <a href="<?php echo esc_url(get_theme_mod("alzaytoon_facebook", "#")); ?>" class="float-facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
</div>

<script>
    // الجافاسكربت الخاص بالقائمة الجانبية
    const menuToggle = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const closeMenu = document.getElementById('closeMenu');
    if(menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', () => { mobileMenu.classList.add('active'); });
        closeMenu.addEventListener('click', () => { mobileMenu.classList.remove('active'); });
    }

    // الجافاسكربت الخاص بنموذج إرسال المناشدة عبر AJAX
    const appealForm = document.getElementById('submitAppealForm');
    if(appealForm) {
        appealForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = document.getElementById('submitAppealBtn');
            const msgBox = document.getElementById('appealFormMsg');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الإرسال...';
            btn.disabled = true;

            const formData = new FormData(appealForm);
            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                btn.innerHTML = 'إرسال المناشدة للإدارة';
                btn.disabled = false;
                if(data.success) {
                    msgBox.style.color = '#2ecc71';
                    msgBox.innerText = data.data.message;
                    appealForm.reset();
                    setTimeout(() => { document.getElementById('appealModal').style.display='none'; msgBox.innerText=''; }, 3000);
                } else {
                    msgBox.style.color = '#e74c3c';
                    msgBox.innerText = data.data.message;
                }
            })
            .catch(error => {
                btn.innerHTML = 'إرسال المناشدة للإدارة';
                btn.disabled = false;
                msgBox.style.color = '#e74c3c';
                msgBox.innerText = 'حدث خطأ في الاتصال، يرجى المحاولة لاحقاً.';
            });
        });
    }

    // إغلاق النافذة المنبثقة عند الضغط خارجها
    window.onclick = function(event) {
        const modal = document.getElementById('appealModal');
        if (event.target == modal) { modal.style.display = "none"; }
    }
</script>
<?php wp_footer(); ?>
</body>
</html>
