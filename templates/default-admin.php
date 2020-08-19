<?php include 'partiels/_head.php'; ?>
<?php include 'partiels/_header.php'; ?>
<?php include 'partiels/_nav_admin.php'; ?>


<?php
$entity = new Core\Entity\Entity();
$entity->notification();
?>

<?= $content; ?>

<?php include 'partiels/_foot.php'; ?>