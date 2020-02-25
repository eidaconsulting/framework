<?php include 'partiels/_head.php'; ?>
<?php include 'partiels/_header.php'; ?>
<?php include 'partiels/_nav_admin.php'; ?>


<?php
$entity = new Core\Entity\Entity();
$entity->notification();
?>

    <main role="main" class="container">
        <div class="my-3 p-3 rounded box-shadow">
            <?= $content; ?>
        </div>
    </main>

<?php //include 'partiels/_footer.php'; ?>
<?php include 'partiels/_foot.php'; ?>