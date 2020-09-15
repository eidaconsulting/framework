<div class="row no-gutters">
    <div class="col-sm-4"></div>
    <div class="col-sm-4 my-5 p-4 is-bg-white-without text-center">
        <?php if(isset($erreurs)){
            echo App\App::getInstance()->alerte('danger', $erreurs);
        } ?>
        <form method="post" action="">
            <div class="sign-avatar">
                <img src="<?= $this->entity()->img_file('logo.png'); ?>" width="75" alt="<?= App\App::getInstance()->app_info('app_name'); ?>">
            </div>
            <p class="sign-title">Administration <?= App\App::getInstance()->app_info('app_name'); ?></p>
            <?= $form->input('username', null, 'Votre email ou votre identifiant') ?>
            <?= $form->input('password', null, 'Mots de passe', ['type' => 'password']) ?>
            <?= $form->button('connexion', 'Se connecter') ?>
        </form>
    </div>
    <div class="col-sm-4"></div>
</div>

