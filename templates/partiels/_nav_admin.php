<nav class="navbar navbar-expand-lg bg-white fixed-top flex-md-nowrap">
    <div class="col-md-3 text-center">
        <a class="navbar-brand text-dark text-center" href="<?= $this->entity()->app_info('app_url'); ?>">
            <img src="<?= $this->entity()->img_file('favicon.png'); ?>" width="30" height="30" class="d-inline-block align-top" alt="<?= $this->entity()->app_info('app_name'); ?>">
            &nbsp;&nbsp;<strong><?= strtoupper($this->entity()->app_info('app_name')); ?></strong>
        </a>
    </div>
    <div class="col-md-7">
        <div class="pl-3"><?= $page_titre; ?></div>
    </div>
    <div class="col-md-2 text-right">
        <a href="<?= $this->entity()->admins('index'); ?>"class="btn btn-sm btn-perso-primary">Menu</a>
        <a href="<?= $this->entity()->admins('signout'); ?>"class="btn btn-sm btn-outline-danger">Déconnexion</a>
    </div>
</nav>

