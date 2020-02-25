<div class="my-3 p-3 is-bg-white-without rounded box-shadow">
    <a href="<?= $this->entity()->Blogs('a/categories/create') ?>"
       class="btn btn-success pull-right">Ajouter une ligne</a>
    <h4 class="is-block-title">Liste des categories</h4>
    <hr>
    <div class="row no-gutters">
        <table id="datatable" class="display table table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Catégories</th>
                <th></th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>#</th>
                <th>Catégories</th>
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
                    <td><?= $data->category; ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="<?= $this->entity()->blogs('a/categories/edit/'.$data->id); ?>"
                               class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i>
                            </a>
                            <a href="<?= $this->entity()->blogs('a/categories/delete/'.$data->id); ?>"
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