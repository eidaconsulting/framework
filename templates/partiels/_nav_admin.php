<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <a class="navbar-brand mr-auto mr-lg-0" href="<?= $this->entity()->app_info('app_url'); ?>">
        <?= strtoupper($this->entity()->app_info('app_name')); ?></a>
    <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?= $this->entity()->admins('index'); ?>"> Tableau de bord <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Paramètre</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="<?= $this->entity()->admins('admin'); ?>">Administrateurs</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>
        <div class="dropleft">
            <a class="dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= $_SESSION['a']['name'] ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="<?= $this->entity()->admins('password'); ?>"><i class="fa fa-key"></i>&nbsp;&nbsp;&nbsp;Mot de passe</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"><i class="fa fa-cog"></i>&nbsp;&nbsp;&nbsp;Paramètres</a>
                <div class="dropdown-divider"></div>
                <a class="text-danger dropdown-item" href="<?= $this->entity()->admins('signout') ?>"><i class="fa fa-sign-out-alt"></i>&nbsp;&nbsp;&nbsp;Déconnexion</a>
            </div>
        </div>
    </div>
</nav>


<div class="nav-scroller bg-white shadow-sm">
    <nav class="nav nav-underline">
        <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Blog
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="<?= $this->entity()->blogs('a/categories'); ?>">Catégories</a>
            <a class="dropdown-item" href="<?= $this->entity()->blogs('a/index'); ?>">Publications</a>
            <a class="dropdown-item" href="<?= $this->entity()->blogs('a/comments'); ?>">Commentaires</a>
        </div>
        <a class="nav-link" href="<?= $this->entity()->admins('clubwp'); ?>">Club WP</a>
        <a class="nav-link active" href="#">Dashboard</a>
        <a class="nav-link" href="#">
            Friends
            <span class="badge badge-pill bg-light align-text-bottom">27</span>
        </a>
    </nav>
</div>