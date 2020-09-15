
<a href="<?= $this->entity()->admins('admin') ?>" class="btn btn-success pull-right">Retour</a>
<h4 class="is-block-title"><?= $action; ?> un administrateur</h4>
<hr>
<div class="row no-margin p-lg shop-zone">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <form method="post">
            <?= $form->input('username', null, 'Saisissez le nom d\'utilisateur', [
                'required' => 'required'
            ]); ?>

            <?= $form->input('password', null, '**********', [
                'required' => 'required',
                'type' => 'password'
            ]); ?>

            <?= $form->input('email', null, 'Un email valide', [
                'required' => 'required',
                'type' => 'email'
            ]); ?>

            <?= $form->input('name', null, 'Saisissez le nom et prénom(s) de l\'utilisateur', [
                'required' => 'required'
            ]); ?>

            <?= $form->input('phone', null, 'Saisissez le numero de téléphone de l\'utilisateur', [
                'required' => 'required',
                'data-mask' => '(+999)99999999'
            ]); ?>

            <?= $form->select('userright', null, 'Sélectionner un type d\'administrateur', [
                'required' => 'required'
            ], [
                '1' => 'Super Administateur',
                '2' => 'Administateur',
                '3' => 'Rédacteur',
                '4' => 'Utilisateur',
            ]); ?>

            <?= $form->input('create', null, $action, [
                'class' => 'btn btn-primary pull-right',
                'type' => 'submit'
            ]); ?>
        </form>
    </div>
    <div class="col-sm-3"></div>
</div>
