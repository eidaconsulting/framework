<h4 class="is-block-title">Vos informations personnelles</h4>
<hr>
<div class="row no-margin">
    <div class="col-md-8">
        <form action="" method="post">
            <?= $form->input('name', null, 'Votre nom complet', [
                'required' => 'required',
            ]) ?>
            <?= $form->input('email', null, 'Votre email', [
                'required' => 'required',
                'type' => 'email'
            ]) ?>
            <?= $form->input('phone', null, 'Votre téléphone', [
                'required' => 'required',
                'data-mask' => '(+999) 99999999'
            ]) ?>
            <?= $form->button('edit', 'Modifier', [
                'type' => 'submit'
            ]) ?>
        </form>
    </div>
</div>
