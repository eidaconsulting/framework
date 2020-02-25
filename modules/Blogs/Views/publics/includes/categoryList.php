<p class="mt-lg-5 mt-3"><strong>Catégories</strong></p>
<hr>
<ul class="list-unstyled">
    <li class="categorie-item mb-2">
        <a href="<?= $this->entity()->url() ?>/blogs">
            <i class="fas fa-arrow-right"></i> Toutes les publications
        </a>
    </li>
    <?php foreach ($categories as $data): ?>
        <li class="categorie-item mb-2">
            <a href="<?= $this->entity()->blogs('categorie/'.$data->slug.'/'.$data->id) ?>">
                <i class="fas fa-arrow-right"></i> <?= $data->category; ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>