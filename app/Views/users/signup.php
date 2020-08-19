<div class="row no-gutters is-max-height">
    <div class="col-sm-4"></div>
    <div class="col-sm-4 my-5 p-4 is-bg-white-without text-center">
        <?php if(isset($erreurs)){
            echo App\App::getInstance()->alerte('danger', $erreurs);
        } ?>
        <?php if(isset($success)){
            echo App\App::getInstance()->alerte('success', $success);
        } ?>
        <?php if(isset($url)){
            echo '<a href="'.$url.'">Activer</a>';
        } ?>
        <form method="post" action="">
            <div class="sign-avatar">
                <img src="<?= $this->entity()->img_file('avatar-sign.png'); ?>" width="75" alt="<?= App\App::getInstance()->app_info('app_name'); ?>">
            </div>
            <p class="sign-title">Inscription</p>
            <?= $form->input('name', null, 'Votre nom et Prenom', ['required' => 'required']) ?>
            <?= $form->input('email', null, 'Saisissez votre email', [
                'required' => 'required',
                'type' => 'email'
            ]) ?>
            <?= $form->input('phone', null, 'Saisissez votre téléphone', [
                'required' => 'required',
                'data-mask' => '(+999) 99999999',
            ]) ?>
            <?= $form->input('password', null, 'Un mot de passe', [
                'type' => 'password',
                'required' => 'required'
            ]); ?>
            <?= $form->input('password2', null, 'Répétez votre mot de passe', [
                'type' => 'password',
                'required' => 'required'
            ]); ?>
            <?= $form->input('inscription', null, 'Créez votre compte', [
                'type' => 'submit',
                'class' => 'btn btn-success sign-up'
            ]); ?>
            <hr>
            <p>Vous avez déjà un compte ?
                <a href="<?= $this->entity()->users('login') ?>">Connectez vous</a>
            </p>
        </form>
    </div>
    <div class="col-sm-4"></div>
</div>


