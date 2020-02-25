<button class="btn btn-social-icon btn-facebook share_facebook"
        data-url="<?= $this->entity()->url(); ?><?= $_SERVER['REQUEST_URI']; ?>">
    <i class="fab fa-facebook-f"></i>
</button>
<button class="btn btn-social-icon btn-twitter share_twitter"
        data-url="<?= $this->entity()->url(); ?><?= $_SERVER['REQUEST_URI']; ?>">
    <i class="fab fa-twitter"></i>
</button>
<button class="btn btn-social-icon btn-linkedin share_linkedin"
        data-url="<?= $this->entity()->url(); ?><?= $_SERVER['REQUEST_URI']; ?>">
    <i class="fab fa-linkedin"></i>
</button>
<button class="btn btn-social-icon btn-whatsapp share_whatsapp"
        data-url="<?= $this->entity()->url(); ?><?= $_SERVER['REQUEST_URI']; ?>"
        data-text="<?= $this->entity()->extrait(250, ' [ ...La suite sur]', $data->content); ?> "
        data-title=" *<?= $data->title; ?>*  ">
    <i class="fab fa-whatsapp"></i>
</button>