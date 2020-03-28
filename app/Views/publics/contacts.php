<section>
    <div class="container">
        <div class="is-bg-white-without px-3 pt-3 pb-5 mt-4">
            <div class="row no-gutters">
                <div class="col-md-5 pr-3">
                    <h5>Nous contacter</h5>
                    <hr>
                    <p>
                        <strong><i class="fa fa-phone"></i></strong>  &nbsp;&nbsp;&nbsp;<?= $this->entity()->app_info('company_first_phone') ?>
                        <?php if($this->entity()->app_info('company_second_phone') != ''): ?>
                            / <?= $this->entity()->app_info('company_second_phone') ?>
                        <?php endif; ?>
                    </p>
                    <?php if($this->entity()->app_info('company_whatsapp') != ''): ?>
                        <p><strong><i class="fa fa-whatsapp"></i></strong> &nbsp;&nbsp;&nbsp;(+229) <?= $this->entity()->app_info('company_whatsapp') ?> </p>
                    <?php endif; ?>

                    <?php if($this->entity()->app_info('company_email') != ''): ?>
                        <p><strong><i class="fa fa-envelope"></i></strong>  &nbsp;&nbsp;&nbsp;<?= $this->entity()->app_info('company_email') ?> </p>
                    <?php endif; ?>

                    <?php if($this->entity()->app_info('company_bp') != ''): ?>
                        <p><strong><i class="fa fa-book"></i></strong>  &nbsp;&nbsp;&nbsp;<?= $this->entity()->app_info('company_bp') ?> </p>
                    <?php endif; ?>

                    <?php if($this->entity()->app_info('company_address') != ''): ?>
                        <p><strong><i class="fa fa-map-marker"></i></strong>  &nbsp;&nbsp;&nbsp;<?= $this->entity()->app_info('company_address') ?> </p>
                    <?php endif; ?>
                    <hr>
                    <div class="text-center mt-3">
                        <img src="<?= $this->entity()->img_file('logo.png'); ?>" class="img-fluid w-50" >
                    </div>


                </div>
                <div class="col-md-7 pl-3">
                    <h5>Nous écrire</h5>
                    <hr>
                    <form class="" method="post">
                        <?= $form->input('name', '', 'Nom et prénom(s)', [
                            'required' => 'required'
                        ]) ?>
                        <?= $form->input('email', '', 'Email', [
                            'required' => 'required',
                            'type' => 'email',
                        ]) ?>
                        <?= $form->input('phone', '', 'Téléphone', [
                            'required' => 'required'
                        ]) ?>
                        <?= $form->input('objet', '', 'Objet', [
                            'required' => 'required'
                        ]) ?>
                        <?= $form->input('message', '', 'Message', [
                            'required' => 'required',
                            'type' => 'textarea',
                        ]) ?>

                        <?= $this->entity()->captcha(); ?>

                        <?= $form->input('envoyer', '', 'Envoyer le message', [
                            'class' => 'btn btn-perso-third btn-block pull-right',
                            'type' => 'submit',
                        ]) ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="is-bg-noree">
    <div class="container">
        <div class="is-bg-white-without px-3 pt-3 pb-5 mt-4">
            <div class="row no-gutters">
                <div class="col-md-3"></div>
                <div class="col-md-6 text-center">
                    <h3 style="color: #2A502C;">Suivez nous également sur les réseaux sociaux.</h3><br>

                    <div class="contact-social-area d-flex justify-content-between align-items-center">
                        <?php if($this->entity()->social_url('facebook') != ''): ?>
                            <a href="<?= $this->entity()->social_url('facebook'); ?>" target="_blank" >
                                <i class="fab fa-facebook d-flex justify-content-center align-items-center fa-2x"></i>
                            </a>
                        <?php endif; ?>
                        <?php if($this->entity()->social_url('youtube') != ''): ?>
                            <a href="<?= $this->entity()->social_url('youtube'); ?>" target="_blank">
                                <i class="fab fa-youtube d-flex justify-content-center align-items-center fa-2x"></i>
                            </a>
                        <?php endif; ?>
                        <?php if($this->entity()->social_url('twitter') != ''): ?>
                            <a href="<?= $this->entity()->social_url('twitter'); ?>" target="_blank">
                                <i class="fab fa-twitter d-flex justify-content-center align-items-center fa-2x"></i>
                            </a>
                        <?php endif; ?>
                        <?php if($this->entity()->social_url('flickr') != ''): ?>
                            <a href="<?= $this->entity()->social_url('flickr'); ?>" target="_blank">
                                <i class="fab fa-flickr fa-2x"></i>
                            </a>
                        <?php endif; ?>
                        <?php if($this->entity()->social_url('instagram') != ''): ?>
                            <a href="<?= $this->entity()->social_url('instagram'); ?>" target="_blank">
                                <i class="fab fa-instagram fa-2x"></i>
                            </a>
                        <?php endif; ?>&nbsp;
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</section>