<script src="<?= $this->entity()->vendor_file('jquery/jquery.min.js'); ?>"></script>
<script src="<?= $this->entity()->vendor_file('tether/tether.min.js'); ?>"></script>
<script src="<?= $this->entity()->js_file('popper.min.js'); ?>"></script>
<script src="<?= $this->entity()->js_file('tooltip.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.6/holder.min.js"></script>
<script src="<?= $this->entity()->js_file('social.js'); ?>"></script>
<script src="<?= $this->entity()->js_file('offcanvas.js'); ?>"></script>
<script src="<?= $this->entity()->vendor_file('jasny-bootstrap/jasny-bootstrap.min.js'); ?>"></script>
<script src="<?= $this->entity()->vendor_file('bootstrap/bootstrap.min.js'); ?>"></script>
<script src="<?= $this->entity()->vendor_file('wow/wow.min.js'); ?>"></script>
<script>
    new WOW().init();
</script>

<?php if (isset($javascript)) {
    echo $javascript;
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

<script src="<?= $this->entity()->js_file('script.js'); ?>"></script>
</body>
</html>

<?php ob_end_flush(); ?>