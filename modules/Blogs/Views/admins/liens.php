<div class="my-3 p-3 is-bg-white-without rounded box-shadow">
    <h4 class="is-block-title">Ajouter une publication</h4>
    <hr>
    <div class="row no-margin p-lg shop-zone">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <?php if(isset($lesimages) && count($lesimages) > 0): ?>
                <form method="post" enctype="multipart/form-data">
                    <?= $form->input('liens', null, 'Ajouter le lien', [
                        'required' => 'required',
                    ]); ?>

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

                    <p>Choisissez une image</p>
                    <hr>
                    <div class="pb-5">
                        <?php foreach ($lesimages as $data) : ?>
                            <?php $image_src = $data->getAttribute('src'); ?>
                            <p>
                                <input type="radio" name="img" style="margin: 0 auto;" value="<?php echo $image_src; ?>">
                                <img src="<?= $image_src ?>" class="img-thumbnail" style="max-width: 150px;">
                            </p>

                        <?php endforeach; ?>
                    </div>
                    <hr>
                    <?= $form->input('create', null, 'Ajouter', [
                        'class' => 'btn btn-primary pull-right',
                        'type' => 'submit'
                    ]); ?>
                </form>
            <?php else: ?>
                <form method="post" enctype="multipart/form-data">
                    <?= $form->input('liens', null, 'Ajouter le lien', [
                        'required' => 'required',
                        'indication' => 'Copier et coller le lien depuis le site source avec http:// ou https://',
                    ]); ?>

                    <?= $form->input('check', null, 'Charger', [
                        'class' => 'btn btn-primary pull-right',
                        'type' => 'submit'
                    ]); ?>
                </form>
            <?php endif; ?>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>