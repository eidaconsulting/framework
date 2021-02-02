<?php $lang = new \Core\i18n\i18n(); ?>
<?php include 'partiels/_head.php'; ?>
<?php include 'partiels/_header.php'; ?>
<?php include 'partiels/_nav_users.php'; ?>


<?php
$entity = new Core\Entity\Entity();
$entity->notification();
?>

<?= $content; ?>


<?php include 'partiels/_foot.php'; ?>