<div class="row no-gutters">
    <div class="col-md-4 my-5 p-4 is-bg-white-without text-center offset-md-4">
        <?php if(isset($erreurs)){
            echo App\App::getInstance()->alerte('danger', $erreurs);
        } ?>
        <form method="post" action="">
            <div class="sign-avatar">
                <img src="<?= $this->entity()->img_file('avatar-sign.png'); ?>" width="75" alt="<?= App\App::getInstance()->app_info('app_name'); ?>">
            </div>
            <p class="sign-title">Connexion</p>
            <?= $form->input('username', null, 'Votre email', ['required' => 'required']) ?>
            <?= $form->input('password', null, 'Votre mot de passe', ['type' => 'password', 'required' => 'required']) ?>
            <div class="d-flex justify-content-between">
                <div>
                    <?= $form->input('connexion', null, 'Connectez-vous', ['type' => 'submit']) ?>
                </div>
                <div>
                    <a href="<?= $this->entity()->users('forgetpw') ?>" class="is-indication">Mot de passe oublié</a>
                </div>
            </div>
            <hr>
            <p>Vous êtes nouveau ?
                <a href="<?= $this->entity()->users('signup') ?>">Créez un compte</a>
            </p>
        </form>
    </div>
</div>
