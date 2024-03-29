<div class="row no-gutters"></div>
<!-- Bouton retour en haut -->
<a href="#0" class="is-scroll opacity">
    <i class="fas fa-arrow-up"></i>
</a>

<!-- Cookies -->
<?php if(!isset($_COOKIE['acceptCookies']) || $_COOKIE['acceptCookies'] != 1 ): ?>
<div class="cookies">
    <div class="row no-gutters">
        <div class="col-md-10">
            <p>En poursuivant votre navigation sur ce site, vous acceptez l’utilisation de [Cookies ou autres traceurs] pour vous proposer [Par exemple, des publicités ciblées adaptés à vos centres d’intérêts] et [Par exemple, réaliser des statistiques de visites].</p>
        </div>
        <div class="col-md-2">
            <a href="#" class="btn btn-light btn-sm" id="cookiesbtn">Accepter</a>
        </div>
    </div>
</div>
<?php endif; ?>

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
                    <?php if($this->entity()->social_url('youtube_url') != ''): ?>
                        <a href="<?= $this->entity()->social_url('youtube_url'); ?>" target="_blank"><i class="fab fa-youtube"></i> </a>&nbsp;&nbsp;
                    <?php endif; ?>
                    <?php if($this->entity()->social_url('facebook_url') != ''): ?>
                        <a href="<?= $this->entity()->social_url('facebook_url'); ?>" target="_blank"><i class="fab fa-facebook-f"></i> </a>&nbsp;&nbsp;
                    <?php endif; ?>
                    <?php if($this->entity()->social_url('twitter_url') != ''): ?>
                        <a href="<?= $this->entity()->social_url('twitter_url'); ?>" target="_blank"><i class="fab fa-twitter"></i></a>&nbsp;
                    <?php endif; ?>
                    <?php if($this->entity()->social_url('instagram_url') != ''): ?>
                        <a href="<?= $this->entity()->social_url('instagram_url'); ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                    <?php endif; ?>&nbsp;
                    <?php if($this->entity()->social_url('flickr_url') != ''): ?>
                        <a href="<?= $this->entity()->social_url('flickr_url'); ?>" target="_blank"><i class="fab fa-flickr"></i></a>
                    <?php endif; ?>&nbsp;
                    <?php if($this->entity()->social_url('telegram_url') != ''): ?>
                        <a href="<?= $this->entity()->social_url('telegram_url'); ?>" target="_blank"><i class="fab fa-telegram"></i></a>
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
                        <?= $this->entity()->app_info('company_email'); ?>
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
    <div class="copyright">
        <div class="container">
            <div class="row no-gutters">
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
            </div>
        </div>
    </div>
</footer>