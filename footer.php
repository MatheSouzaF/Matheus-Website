<footer class="footer">
    <div class="box-footer wrapper">
        <div class="logo-VF">
            <h1 class="color-primary logo-footer">VF</h1>
        </div>
        <div class="contact">
            <a href="" class="contact-link color-primary">Instagram</a>
            <a href="" class="contact-link color-primary">Whatsaap</a>
            <a href="" class="contact-link color-primary">Sobre</a>
        </div>
    </div>
    <div class="copy wrapper d-flex justify-flex-end my-32">

        <h2 class=" color-primary">© 2024 Vini Floriani. Todos os Direitos Reservados.</h2>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.thumbs.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    const container = document.getElementById("myCarousel");
    const options = {
        Dots: false,
        PerPage: 2,
    };

    new Carousel(container, options, {
        Thumbs
    });

    const fancybox = Fancybox.bind("[data-fancybox]", {
        // Configurações do FancyBox
        loop: false,
        Toolbar: true, // Certifique-se de habilitar a barra de ferramentas
    });

    // Adicione o botão de download à barra de ferramentas
    fancybox.Thumbs = Carousel;
    fancybox.Toolbar = ["zoom", "slideShow", "fullScreen", "download", "thumbs", "close"];
</script>

</html>