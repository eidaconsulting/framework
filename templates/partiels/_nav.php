<div class="nav-zone">
    <nav class="navbar navbar-toggleable-md navbar-expand-md sticky-top">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                    data-target="#navbarText" aria-controls="navbarText" aria-expanded="false"
                    aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand" href="<?= $this->entity()->url(); ?>">
                <img src="<?= $this->entity()->img_file('logo.png'); ?>" alt="<?= $this->entity()->app_info('app_name'); ?>"
                     title="<?= $this->entity()->app_info('app_name'); ?>" width="65">
            </a>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ml-auto navbar-right">
                    <li class="nav-item  my-2 mr-3">
                        <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == "en"): ?>
                            <a href="<?= $lang->getUrl(); ?>?lang=fr">FR</a>
                        <?php else: ?>
                            <a href="<?= $lang->getUrl(); ?>?lang=en">EN</a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link <?= $this->entity()->nav_actif('/'); ?>" href="<?= $this->entity()->url(); ?>"><?= $lang->get('accueil'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $this->entity()->nav_actif('blog'); ?>" href="<?= $this->entity()->blogs(); ?>">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $this->entity()->nav_actif('contacts'); ?> signup-btn" href="<?= $this->entity()->publics('contacts'); ?>">Contacts</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</div>
