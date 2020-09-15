<div class="my-3 p-3 is-bg-white-without rounded box-shadow">
    <a href="<?= $this->entity()->Blogs('a/index/create') ?>"
       class="btn btn-success pull-right">Ajouter une publication</a>
    <h4 class="is-block-title">Liste de vos publications</h4>
    <hr>
    <div class="row no-gutters">
        <table id="datatable" class="display table table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Content</th>
                <th></th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Content</th>
                <th>Vue</th>
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
                    <td><img src="<?= $this->entity()->uploads('publication/resize/'.$data->image); ?>" title="<?= $data->title; ?>" alt="<?= $data->title; ?>" width="35"></td>
                    <td><?= $data->title; ?></td>
                    <td><?= $data->nameFromID('Blogcategorie', $data->category_id)->category; ?></td>
                    <td><?= $data->extrait(150, '...', htmlspecialchars_decode($data->content)); ?></td>
                    <td><?= $data->see; ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="<?= $this->entity()->blogs('/'.$data->id.'/'.$data->slug); ?>"
                               class="btn btn-info btn-sm"><i class="fas fa-link"></i>
                            </a>
                            <a href="<?= $this->entity()->blogs('a/index/'.$data->id.'/edit'); ?>"
                               class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i>
                            </a>

                            <?php if($data->state == 0): ?>
                                <a href="<?= $this->entity()->blogs('a/index/'.$data->id.'/activate'); ?>"
                                   class="btn btn-success btn-sm"><i class="fas fa-check"></i>
                                </a>
                            <?php elseif($data->state == 1): ?>
                                <a href="<?= $this->entity()->blogs('a/index/'.$data->id.'/activate'); ?>"
                                   class="btn btn-warning btn-sm"><i class="fas fa-times"></i>
                                </a>
                            <?php endif; ?>

                            <a href="<?= $this->entity()->blogs('a/index/'.$data->id.'/delete'); ?>"
                               class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>