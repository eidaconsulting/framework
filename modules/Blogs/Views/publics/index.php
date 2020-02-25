<div class="container">
    <div class="row no-gutters my-3">
        <div class="col-md-9 blog px-3 is-bg-white-without">
            <h2><?= $pageName; ?></h2>
            <hr>
            <?php foreach ($datas as $data): ?>
                <div class="row blog-item py-3">
                    <div class="col-md-3 py-3">
                        <div class="blog-item-image">
                            <img src="<?= $this->entity()->uploads('publication/resize/'.$data->image) ?>"
                                 class="img-fluid" title="<?= $data->title; ?>" alt="<?= $data->title; ?>" >
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="blog-item-title">
                            <h4 class="is-semibold mt-0 pt-0 mb-2 pb-0">
                                <a href="<?= $this->entity()->url(); ?>/blogs/<?= $data->slug; ?>/<?= $data->id ?>">
                                    <?= $data->title; ?>
                                </a>
                            </h4>
                        </div>
                        <div class="blog-item-info border-top border-bottom mb-2">
                            <span class="is-indication" title="Date de publication"><i class="fas fa-calendar"></i> <?= $data->dateFormat($data->add_date) ?></span> |
                            <span class="is-indication" title="Auteur"><i class="fas fa-user"></i> <?= ucfirst(strtolower($this->entity()->app_info('app_name'))); ?></span> |
                            <span class="is-indication" title="Catégorie"><i class="fas fa-folder-open"></i> <?= $data->nameFromID('Blogcategorie', $data->category_id)->category; ?></span> |
                            <span class="is-indication" title="Nombre de lecture"><i class="fas fa-signal"></i> <?= $data->see; ?></span>
                        </div>
                        <div class="blog-item-extrait">
                            <p><?= $data->extrait(300, '[...]', htmlspecialchars_decode($data->content)); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="pagination my-lg-5 my-3">
                <hr>
                <div class="mt-3">
                    <?= Core\Pagination\Pagination::getInstance()
                                                  ->paginationView($currentPage, $nb_page, $pageUrl)?>
                </div>
            </div>
        </div>

        <div class="col-md-3 categories px-3">
            <div class="mb-3">
                <p><strong>Rechercher</strong></p>
                <hr>
                <?php include 'includes/searchBarre.php'; ?>
            </div>

            <div class="mb-3">
                <?php include 'includes/categoryList.php'; ?>
            </div>

            <div class="mb-3">
                <?php include 'includes/newsletters.php'; ?>
            </div>
        </div>

    </div>
</div>