<div class="my-3 p-3 is-bg-white-without rounded box-shadow">
    <a href="<?= $this->entity()->blogs('a/index'); ?>" class="btn btn-success pull-right">Retour</a>
    <h4 class="is-block-title">Modifier</h4>
    <hr>
    <div class="row no-margin p-lg shop-zone">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <form method="post" enctype="multipart/form-data">
                <?= $form->input('title', null, 'Titre de la publication', [
                    'required' => 'required',
                    'maxlength' => 150,
                ]); ?>
                <?= $form->select('category_id', null, 'Categorie de la publication', [
                    'required' => 'required',
                ], $categories); ?>

                <?= $form->input('content', null, 'Contenu de la publication', [
                    'required' => 'required',
                    'type' => 'textarea',
                    'id' => 'summernote',
                ]); ?>

                <div class="form-group">
                    <?= $form->input('image', null, 'Image de profil de la publication', [
                        'type' => 'file',
                        'accept' => 'image/*',
                    ]); ?>
                </div>

                <?= $form->input('edit', null, 'Modifier', [
                    'class' => 'btn btn-primary pull-right',
                    'type' => 'submit'
                ]); ?>
            </form>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>