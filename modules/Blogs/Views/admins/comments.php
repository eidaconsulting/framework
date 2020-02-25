<div class="my-3 p-3 is-bg-white-without rounded box-shadow">
    <h4 class="is-block-title">Liste des commentaires</h4>
    <hr>
    <div class="row no-gutters">
        <table id="datatable" class="display table table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Publication</th>
                <th>Utilisateur</th>
                <th>Commentaire</th>
                <th>Etat</th>
                <th></th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>#</th>
                <th>Publication</th>
                <th>Utilisateur</th>
                <th>Commentaire</th>
                <th>Etat</th>
                <th></th>
            </tr>
            </tfoot>
            <tbody>
            <?php
            $nbre = 0;
            foreach ($datas AS $data):
                $nbre++;
                ?>
                <tr>
                    <td><?= $nbre; ?></td>
                    <td><?= $data->nameFromID('Blog', $data->post_id)->title ?></td>
                    <td>
                        <ul>
                            <li>Nom : <?= $data->name; ?></li>
                            <li>Email : <?= $data->email; ?></li>
                            <li>IP : <?= $data->user_ip; ?></li>
                        </ul>
                    </td>
                    <td><?= $data->comment; ?></td>
                    <td>
                        <?php if($data->state == 0): ?>
                            <span class="badge badge-secondary">En Attente</span>
                        <?php elseif($data->state == 1): ?>
                            <span class="badge badge-success">Publier</span>
                        <?php elseif($data->state == 2): ?>
                            <span class="badge badge-warning">Dépublier</span>
                        <?php else: ?>
                            <span class="badge badge-secondary">En Attente</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="btn-group">
                            <?php if($data->state == 0 || $data->state == 2): ?>
                                <a href="<?= $this->entity()->blogs('a/comments/published/'.$data->id); ?>"
                                   class="btn btn-success btn-sm"><i class="fas fa-check"></i>
                                </a>
                            <?php elseif($data->state == 1): ?>
                                <a href="<?= $this->entity()->blogs('a/comments/depublished/'.$data->id); ?>"
                                   class="btn btn-secondary btn-sm"><i class="fas fa-times"></i>
                                </a>
                            <?php endif; ?>

                            <a href="<?= $this->entity()->blogs('a/comments/delete/'.$data->id); ?>"
                               class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>