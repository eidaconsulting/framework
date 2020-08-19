<div class="container">
    <div class="row no-gutters my-3">
        <div class="col-md-9 px-3 is-bg-white-without pb-5">
            <h2 class="mb-0 pb-0 is-semibold"><?= $data->title; ?></h2>
            <div class="blog-item-info border-top border-bottom my-3">
                <span class="is-indication" title="Date de publication"><i class="fas fa-calendar"></i> <?= $data->dateFormat($data->add_date) ?></span> |
                <span class="is-indication" title="Auteur"><i class="fas fa-user"></i> <?= ucfirst(strtolower($this->entity()->app_info('app_name'))); ?></span> |
                <span class="is-indication" title="Catégorie"><i class="fas fa-folder-open"></i> <?= $data->nameFromID('Blogcategorie', $data->category_id)->category; ?></span> |
                <span class="is-indication" title="Nombre de lecture"><i class="fas fa-signal"></i> <?= $data->see; ?></span>
            </div>
            <div class="blog-single-item-image mt-2">
                <img src="<?= $this->entity()->uploads('publication/'.$data->image); ?>"
                     title="<?= $data->title; ?>" alt="<?= $data->title; ?>" class="img-fluid py-3 rounded" width="100%">
            </div>

            <div class="blog-single-item-content py-2">
                <?= htmlspecialchars_decode($data->content); ?>
            </div>

            <hr>
            <p><strong>Partager :</strong></p>
            <?php include('includes/shares.php'); ?>
            <hr>
            <h5><strong><?= $nb_comments; ?></strong></h5>
            <?php foreach ($comments as $data): ?>
                <div class="py-3">
                    <p class="small">Commentaire laissé par <strong><?= $data->name; ?></strong> (<?= $data->email; ?>)</p>
                    <div class="pb-2">
                        <?= $data->comment; ?>
                    </div>
                    <span class="is-indication"><?= $data->dateFormat($data->add_date, 'jj mmmm yyyy hhmm'); ?></span>
                    <hr>
                </div>
            <?php endforeach; ?>
            <div class="mt-4">
                <a href="#" id="comment-btn" class="btn btn-outline-perso-third btn-sm">Laissez un commentaire</a>
                <a href="#" id="comment-forget" class="btn btn-outline-danger btn-sm">Ne pas laisser un commentaire</a>
                <div class="comment-area py-3" id="comment-form">
                    <form method="post" action="">
                        <?= $form->input('name', '', 'Votre nom', [
                            'required' => 'required'
                        ]); ?>
                        <?= $form->input('email', '', 'Votre email', [
                            'type' => 'email',
                            'required' => 'required'
                        ]); ?>
                        <?= $form->input('comment', '', 'Votre commentaire', [
                            'type' => 'textarea',
                            'required' => 'required'
                        ]); ?>

                        <?= $this->entity()->captcha(); ?>

                        <?= $form->input('comment-send', '', 'Envoyer mon commentaire', [
                            'type' => 'submit',
                            'class' => 'btn btn-outline-perso-secondary btn-sm'
                        ]) ?>
                    </form>

                </div>
            </div>
        </div>


        <div class="col-md-3 px-3">
            <div class="mb-3">
                <p><strong>Rechercher</strong></p>
                <hr>
                <?php include 'includes/searchBarre.php'; ?>
            </div>

            <div class="mb-3">
                <?php include 'includes/categoryList.php'; ?>
            </div>

            <div class="mb-3">
                <p class="mt-lg-5 mt-3"><strong>Dans la même catégorie</strong></p>
                <hr>
                <?php foreach($datas as $data): ?>
                    <div class="row">
                        <div class="col py-3">
                            <a href="<?= $this->entity()->blogs($data->id.'/'.$data->slug); ?>">
                                <img src="<?= $this->entity()->uploads('publication/resize/'.$data->image); ?>"
                                     title="<?= $data->title; ?>" alt="<?= $data->title; ?>" class="img-fluid" width="100%">
                                <h5><strong><?= $data->title; ?></strong></h5>
                            </a>
                            <p><?= html_entity_decode($data->extrait('100', '[...]', $data->content)) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mb-3">
                <?php include 'includes/newsletters.php'; ?>
            </div>
        </div>
    </div>
</div>