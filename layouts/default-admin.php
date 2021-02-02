<?php include 'partiels/_head.php'; ?>
<?php include 'partiels/_header.php'; ?>
<?php include 'partiels/_nav_admin.php'; ?>


<?php
$entity = new Core\Entity\Entity();
$entity->notification();
?>

    <div class="container-fluid">
        <div class="row admin-area mt-5 pt-3">
            <?php include 'partiels/_sidebar.php'; ?>

            <main role="main" class="admin-main">
                <?= $content; ?>
            </main>
        </div>
    </div>

<?php include 'partiels/_foot.php'; ?>