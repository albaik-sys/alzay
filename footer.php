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
            <a href='#' class='btn-yellow'>أرسل خبرك</a>
        </div>
    </div>
</footer>

<div class="floating-social">
    <a href="https://wa.me/#" class="float-whatsapp" target="_blank"><i class="fab fa-whatsapp"></i></a>
    <a href="https://facebook.com/#" class="float-facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
</div>

<script>
    const menuToggle = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const closeMenu = document.getElementById('closeMenu');

    if(menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.add('active');
        });
        closeMenu.addEventListener('click', () => {
            mobileMenu.classList.remove('active');
        });
    }
</script>

<?php wp_footer(); ?>
</body>
</html>
