<script src="<?= $this->entity()->vendor_file('jquery/jquery.min.js'); ?>" async defer></script>
<script src="<?= $this->entity()->vendor_file('tether/tether.min.js'); ?>" async defer></script>
<script src="<?= $this->entity()->js_file('popper.min.js'); ?>" async defer></script>
<script src="<?= $this->entity()->js_file('tooltip.min.js'); ?>" async defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.6/holder.min.js" async defer></script>
<script src="<?= $this->entity()->vendor_file('bootstrap/bootstrap.min.js'); ?>" async defer></script>
<script src="<?= $this->entity()->vendor_file('wow/wow.min.js'); ?>" async defer></script>
<script async defer>
    new WOW().init();
</script>

<?php if (method_exists($this, 'js')) {
    echo $this->js();
} ?>

<?php if($this->entity()->app_info('google_UA') != ''): ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= $this->entity()->app_info("google_UA"); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '<?= $this->entity()->app_info("google_UA"); ?>');
    </script>
<?php endif; ?>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PBHHSCZ');</script>
<!-- End Google Tag Manager -->

<script src="<?= $this->entity()->js_file('script.js'); ?>" async defer></script>
</body>
</html>

<?php ob_end_flush(); ?>