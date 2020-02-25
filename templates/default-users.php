<?php $lang = new \Core\i18n\i18n(); ?>
<?php include 'partiels/_head.php'; ?>
<?php include 'partiels/_header.php'; ?>
<?php include 'partiels/_nav_users.php'; ?>


<?php
$entity = new Core\Entity\Entity();
$entity->notification();
?>

    <main role="main" class="container">
        <div class="my-3 p-3 is-bg-white-without rounded box-shadow">
            <?= $content; ?>
        </div>
    </main>

<?php //include 'partiels/_footer.php'; ?>
<?php include 'partiels/_foot.php'; ?>