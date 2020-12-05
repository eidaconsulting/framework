<nav class="sidebar py-5">
    <div class="sidebar-sticky">
        <div class="sidebar-user-icone">
            <img src="<?= $this->entity()->uploads('avatar/resize/img.jpg') ?>"
                 alt="<?= $_SESSION['a']['name'] ?>"
                 class="img-fluid rounded-circle border border-white" width="40px">
            <p class="ml-md-2 mt-3 sidebar-text">
                <?= $_SESSION['a']['name'] ?> <?= $_SESSION['a']['secondname'] ?><br>
                <span class="is-indication">
                    <?php
                    if($_SESSION['a']['userright'] == 1) { echo 'Administrateur'; }
                    elseif($_SESSION['a']['userright'] == 2) { echo 'Responsable'; }
                    elseif($_SESSION['a']['userright'] == 3) { echo 'Redacteur'; }
                    elseif($_SESSION['a']['userright'] == 4) { echo 'Utilisateur'; }
                    ?>
                </span>
            </p>
        </div>
        <ul class="nav flex-column">

            <li class="nav-item <?= $this->entity()->is_current('a/index'); ?>">
                <a class="nav-link" href="<?= $this->entity()->admins('index'); ?>">
                    <i class="sidebar-icone dw dw-right-arrow1" data-feather="settings" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Tableau de bord</span>
                </a>
            </li>

            <li class="nav-item <?= $this->entity()->is_current('a/communes'); ?>">
                <a class="nav-link" href="<?= $this->entity()->admins('communes'); ?>">
                    <i class="sidebar-icone dw dw-right-arrow1" data-feather="settings" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Communes</span>
                </a>
            </li>

            <li class="nav-item <?= $this->entity()->is_current('a/bienscategories'); ?>">
                <a class="nav-link" href="<?= $this->entity()->admins('bienscategories'); ?>">
                    <i class="sidebar-icone dw dw-right-arrow1" data-feather="settings" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Type de biens</span>
                </a>
            </li>

            <li class="nav-item <?= $this->entity()->is_current('a/immobiliers/vendre'); ?>">
                <a class="nav-link" href="<?= $this->entity()->admins('immobiliers/vendre'); ?>">
                    <i class="sidebar-icone dw dw-right-arrow1" data-feather="settings" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Immobiliers (Vendre)</span>
                </a>
            </li>

            <li class="nav-item <?= $this->entity()->is_current('a/immobiliers/louer'); ?>">
                <a class="nav-link" href="<?= $this->entity()->admins('immobiliers/louer'); ?>">
                    <i class="sidebar-icone dw dw-right-arrow1" data-feather="settings" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Immobiliers (Louer)</span>
                </a>
            </li>

            <li class="nav-item <?= $this->entity()->is_current('a/biens'); ?>">
                <a class="nav-link" href="<?= $this->entity()->admins('biens'); ?>">
                    <i class="sidebar-icone dw dw-right-arrow1" data-feather="settings" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Biens</span>
                </a>
            </li>

            <li class="nav-item <?= $this->entity()->is_current('a/demandesemplois'); ?>">
                <a class="nav-link" href="<?= $this->entity()->admins('demandesemplois'); ?>">
                    <i class="sidebar-icone dw dw-right-arrow1" data-feather="settings" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Demandes d'emploi</span>
                </a>
            </li>

            <li class="nav-item <?= $this->entity()->is_current('a/recrutements/recrutements'); ?>">
                <a class="nav-link" href="<?= $this->entity()->admins('recrutements/recrutements'); ?>">
                    <i class="sidebar-icone dw dw-right-arrow1" data-feather="settings" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Recrutements</span>
                </a>
            </li>

            <li class="nav-item <?= $this->entity()->is_current('a/savoirsfaires'); ?>">
                <a class="nav-link" href="<?= $this->entity()->admins('savoirsfaires'); ?>">
                    <i class="sidebar-icone dw dw-right-arrow1" data-feather="settings" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Savoirs faires</span>
                </a>
            </li>

            <li class="nav-item <?= $this->entity()->is_current('a/recrutements/promotions'); ?>">
                <a class="nav-link" href="<?= $this->entity()->admins('recrutements/promotions'); ?>">
                    <i class="sidebar-icone dw dw-right-arrow1" data-feather="settings" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Promotions</span>
                </a>
            </li>

            <li class="nav-item <?= $this->entity()->is_current('a/recrutements/sports'); ?>">
                <a class="nav-link" href="<?= $this->entity()->admins('recrutements/sports'); ?>">
                    <i class="sidebar-icone dw dw-right-arrow1" data-feather="settings" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Sports</span>
                </a>
            </li>

            <li class="nav-item <?= $this->entity()->is_current('a/recrutements/horoscopes'); ?>">
                <a class="nav-link" href="<?= $this->entity()->admins('recrutements/horoscopes'); ?>">
                    <i class="sidebar-icone dw dw-right-arrow1" data-feather="settings" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Horoscopes</span>
                </a>
            </li>

            <li class="nav-item <?= $this->entity()->is_current('a/recrutements/numerosverts'); ?>">
                <a class="nav-link" href="<?= $this->entity()->admins('recrutements/numerosverts'); ?>">
                    <i class="sidebar-icone dw dw-right-arrow1" data-feather="settings" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Numéros Verts</span>
                </a>
            </li>

            <li class="nav-item <?= $this->entity()->is_current('a/recrutements/spectacles'); ?>">
                <a class="nav-link" href="<?= $this->entity()->admins('recrutements/spectacles'); ?>">
                    <i class="sidebar-icone dw dw-right-arrow1" data-feather="settings" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Spectacles</span>
                </a>
            </li>

            <li class="nav-item <?= $this->entity()->is_current('a/recrutements/programmestv'); ?>">
                <a class="nav-link" href="<?= $this->entity()->admins('recrutements/programmestv'); ?>">
                    <i class="sidebar-icone dw dw-right-arrow1" data-feather="settings" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Programmes TV & Radios</span>
                </a>
            </li>

            <li class="nav-item <?= $this->entity()->is_current('a/recrutements/pharmacies'); ?>">
                <a class="nav-link" href="<?= $this->entity()->admins('recrutements/pharmacies'); ?>">
                    <i class="sidebar-icone dw dw-right-arrow1" data-feather="settings" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Pharmacies de garde</span>
                </a>
            </li>

            <li class="nav-item <?= $this->entity()->is_current('a/recrutements/marches'); ?>">
                <a class="nav-link" href="<?= $this->entity()->admins('recrutements/marches'); ?>">
                    <i class="sidebar-icone dw dw-right-arrow1" data-feather="settings" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Jours de marché</span>
                </a>
            </li>

            <li class="nav-item <?= $this->entity()->is_current('a/recrutements/programmesscolaires'); ?>">
                <a class="nav-link" href="<?= $this->entity()->admins('recrutements/programmesscolaires'); ?>">
                    <i class="sidebar-icone dw dw-right-arrow1" data-feather="settings" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Programmes scolaires</span>
                </a>
            </li>

            <li class="nav-item <?= $this->entity()->is_current('a/recrutements/autres'); ?>">
                <a class="nav-link" href="<?= $this->entity()->admins('recrutements/autres'); ?>">
                    <i class="sidebar-icone dw dw-right-arrow1" data-feather="settings" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Autres</span>
                </a>
            </li>

            <li class="nav-item <?= $this->entity()->is_current('a/slides'); ?>">
                <a class="nav-link" href="<?= $this->entity()->admins('slides'); ?>">
                    <i class="sidebar-icone dw dw-right-arrow1" data-feather="settings" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Slides</span>
                </a>
            </li>

            <li class="nav-item <?= $this->entity()->is_current('a/pubs'); ?>">
                <a class="nav-link" href="<?= $this->entity()->admins('pubs'); ?>">
                    <i class="sidebar-icone dw dw-right-arrow1" data-feather="settings" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Pubs</span>
                </a>
            </li>

            <li class="nav-item <?= $this->entity()->is_current('a/password'); ?>">
                <a class="nav-link" href="<?= $this->entity()->admins('password'); ?>">
                    <i class="sidebar-icone dw dw-password" data-feather="lock" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Mot de passe</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-danger" href="<?= $this->entity()->admins('signout'); ?>">
                    <i class="sidebar-icone dw dw-login" data-feather="log-out" stroke-width="1"></i> &nbsp;&nbsp;<span class="sidebar-text">Déconnexion</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
