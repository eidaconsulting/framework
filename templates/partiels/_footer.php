<div class="row no-gutters"></div>
<a href="#0" class="is-scroll opacity">
    <i class="fas fa-arrow-up"></i>
</a>
<footer class="pt-5">
    <div class="container">
        <div class="row no-margin">
            <div class="col-md-3">
                <h5 class="block-title"><strong><?= $this->entity()->app_info('app_name'); ?></strong></h5>
                <span class="is-soulignement is-soulignement-red"></span>
                <p class="is-indication">
                    Nous travaillons à l'amélioration de votre image de marque, de votre réputation, de votre présence
                    sur Internet, et l'automatisation de votre système de gestion et de vos services.
                </p>
                <div class="social-area">
                    <?php if($this->entity()->social_url('facebook') != ''): ?>
                        <a href="<?= $this->entity()->social_url('facebook'); ?>" target="_blank"><i class="fab fa-facebook-f"></i> </a>&nbsp;&nbsp;
                    <?php endif; ?>
                    <?php if($this->entity()->social_url('twitter') != ''): ?>
                        <a href="<?= $this->entity()->social_url('twitter'); ?>" target="_blank"><i class="fab fa-twitter"></i></a>&nbsp;
                    <?php endif; ?>
                    <?php if($this->entity()->social_url('youtube') != ''): ?>
                        <a href="<?= $this->entity()->social_url('youtube'); ?>" target="_blank"><i class="fab fa-youtube"></i></a>
                    <?php endif; ?>
                    <?php if($this->entity()->social_url('flickr') != ''): ?>
                        <a href="<?= $this->entity()->social_url('flickr'); ?>" target="_blank"><i class="fab fa-flickr"></i></a>
                    <?php endif; ?>&nbsp;
                    <?php if($this->entity()->social_url('instagram') != ''): ?>
                        <a href="<?= $this->entity()->social_url('instagram'); ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                    <?php endif; ?>&nbsp;
                </div>
            </div>
            <div class="col-md-3">
                <h5 class="block-title"><strong>Liens additionnels</strong></h5>
                <span class="is-soulignement is-soulignement-red"></span>
                <ul class="list-unstyled">
                    <li><a href="<?= $this->entity()->url() ?>/evenements"><i class="fas fa-caret-right"></i> Nos Evènements</a></li>
                    <li><a href="<?= $this->entity()->url() ?>/formations"><i class="fas fa-caret-right"></i> Nos Formations</a></li>
                    <li><a href="<?= $this->entity()->url() ?>/recrutement"><i class="fas fa-caret-right"></i> Nous recrutons</a></li>
                    <li><a href="<?= $this->entity()->url() ?>/faq"><i class="fas fa-caret-right"></i> Vos questions</a></li>
                    <li><a href="<?= $this->entity()->url() ?>/contacts"><i class="fas fa-caret-right"></i> Nous contacter</a></li>
                </ul>
            </div>
            <div class="col-md-3 footer-contact">
                <h5 class="block-title"><strong>Adresse</strong></h5>
                <span class="is-soulignement is-soulignement-red"></span>
                <div class="row no-margin mb-1">
                    <div class="col-md-2">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="col-md-10 is-indication">
                        <?= $this->entity()->app_info('company_address'); ?>
                    </div>
                </div>
                <div class="row no-margin mb-1">
                    <div class="col-md-2">
                        <i class="far fa-envelope mt-2"></i>
                    </div>
                    <div class="col-md-10 is-indication">
                        <?= $this->entity()->app_info('app_email'); ?>
                        <?= $this->entity()->app_info('app_url'); ?>
                    </div>
                </div>
                <div class="row no-margin mb-1">
                    <div class="col-md-2">
                        <i class="fas fa-mobile-alt mt-2"></i>
                    </div>
                    <div class="col-md-10 is-indication">
                        <?= $this->entity()->app_info('company_first_phone') ?> <br>
                        <?= $this->entity()->app_info('company_second_phone') ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
    <div class="row no-gutters copyright">
        <div class="container">
            <di class="row no-margin no-padding">
                <div class="col-md-8 small">
                    <?= date('Y') ?> &copy; <?= strtoupper($this->entity()->app_info('company_name')); ?>. <?= $lang->get('copyright'); ?>
                    <span class="">
                        <a href="https://www.eidaconsulting.com" target="new" title="Réaliser par EIDA CONSULTING">
                            <img src="https://www.eidaconsulting.com/assets/img/favicon.144x144.png" height="10"
                                 title="Réaliser par EIDA CONSULTING" alt="Réaliser par EIDA CONSULTING">
                        </a>
                    </span>
                </div>
                <div class="col-md-4 small text-md-right">
                    <ul class="list-unstyled list-inline">
                        <li class="list-inline-item">
                            <a href="<?= $this->entity()->url(); ?>"><?= $lang->get('accueil'); ?></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="<?= $this->entity()->url(); ?>/plans"><?= $lang->get('plan'); ?></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="<?= $this->entity()->url(); ?>/mentions"><?= $lang->get('mention'); ?></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="<?= $this->entity()->url(); ?>/contacts"><?= $lang->get('contact'); ?></a>
                        </li>
                    </ul>
                </div>
            </di>
        </div>
    </div>
</footer>