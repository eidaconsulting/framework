<?php include 'partiels/_head.php'; ?>
<?php include 'partiels/_header.php'; ?>
<?php //include 'partiels/_nav_admin.php'; ?>


<?php
$entity = new Core\Entity\Entity();
$entity->notification();
?>

<input type="checkbox" id="a-toggle" class="">
<?php include 'partiels/_admin_sidebar.php'; ?>

<div class="a-content">
    <?php include 'partiels/_nav_admin.php'; ?>
    <div class="a-body">
        <?= $content; ?>
    </div>
</div>

<?php include 'partiels/_foot.php'; ?>