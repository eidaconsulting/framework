<?php
//ob_start("ob_gzhandler");
if ((ini_get('zlib.output_compression') != true) &&
    function_exists('ob_gzhandler')) {
    ob_start('ob_gzhandler');
} else {
    ob_start();
}
?>
<?php $lang = new \Core\i18n\i18n(); ?>
<?php include 'partiels/_head.php'; ?>
<?php include 'partiels/_header.php'; ?>
<?php include 'partiels/_nav.php'; ?>
<?php
$entity = new Core\Entity\Entity();
$entity->notification();
?>

<?= $content; ?>

<?php include 'partiels/_footer.php'; ?>
<?php include 'partiels/_foot.php'; ?>

<?php $content = ob_end_flush(); ?>

<?php
$cache = new Core\Caches\Cache();
echo $cache->getCache($content);
?>
