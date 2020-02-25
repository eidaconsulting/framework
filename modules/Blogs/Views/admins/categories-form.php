<div class="my-3 p-3 is-bg-white-without rounded box-shadow">
    <a href="<?= $this->entity()->Blogs('a/categories') ?>" class="btn btn-success pull-right">Retour</a>
    <h4 class="is-block-title"><?= $action; ?> une categorie</h4>
    <hr>
    <div class="row no-margin p-lg shop-zone">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <form method="post">
                <?= $form->input('category', null, 'Saisissez le nom de la catégorie', [
                    'required' => 'required'
                ]); ?>

                <?= $form->input('create', null, $action, [
                    'class' => 'btn btn-primary pull-right',
                    'type' => 'submit'
                ]); ?>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>