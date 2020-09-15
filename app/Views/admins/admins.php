
<a href="<?= $this->entity()->admins('admin/create'); ?>" class="btn btn-success pull-right">Ajouter un administrateur</a>
<h4 class="is-block-title">Liste des administrateurs</h4>
<hr>
<div class="row no-gutters p-lg shop-zone">
    <table id="datatable" class="table table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>#</th>
            <th>Nom d'utilisateur</th>
            <th>Email</th>
            <th>Nom</th>
            <th>Téléphone</th>
            <th>Droits</th>
            <th></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>#</th>
            <th>Nom d'utilisateur</th>
            <th>Email</th>
            <th>Nom</th>
            <th>Téléphone</th>
            <th>Droits</th>
            <th></th>
        </tr>
        </tfoot>
        <tbody>
        <?php
        $nbre = 0;
        foreach ($admins AS $data):
            $nbre++;
            ?>
            <tr>
                <td><?= $nbre; ?></td>
                <td><?= $data->username; ?></td>
                <td><?= $data->email; ?></td>
                <td><?= $data->name; ?></td>
                <td><?= $data->phone; ?></td>
                <td>
                    <?php if($data->userright == 1 ): ?> Super Administrateur
                    <?php elseif($data->userright == 2 ): ?> Administrateur
                    <?php elseif($data->userright == 3 ): ?> Rédacteur
                    <?php else: ?> Utilisateur
                    <?php endif; ?>
                </td>
                <td>
                    <div class="btn-group">
                        <a href="<?= $this->entity()->admins('admin/edit/'.$data->id) ?>"
                           class="btn btn-secondary btn-sm" title="modifier"><i class="fas fa-edit"></i>
                        </a>
                        <a href="<?= $this->entity()->admins('admin/delete/'.$data->id) ?>"
                           class="btn btn-danger btn-sm" title="supprimer"><i class="fas fa-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
