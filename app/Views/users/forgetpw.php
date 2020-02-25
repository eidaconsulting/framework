<div class="row no-gutters is-max-height">
    <div class="col-sm-4"></div>
    <div class="col-sm-4 my-5 p-4 is-bg-white-without text-center">
        <?php if(isset($erreurs)){
            echo App\App::getInstance()->alerte('danger', $erreurs);
        } ?>
        <form method="post" action="">
            <div class="sign-avatar">
                <img src="<?= $this->entity()->img_file('avatar-sign.png'); ?>" width="75" alt="<?= App\App::getInstance()->app_info('app_name'); ?>">
            </div>
            <p class="sign-title">Mot de passe perdu</p>
            <?= $form->input('email', null, 'Votre email', ['required' => 'required']) ?>
            <?= $form->input('recuperer', null, 'Récupérer mon mot de passe', ['type' => 'submit']) ?>
            <hr>
            <p>Vous êtes nouveau ?
                <a href="<?= $this->entity()->users('signup') ?>">Créez un compte</a>
            </p>
        </form>
    </div>
    <div class="col-sm-4"></div>
</div>