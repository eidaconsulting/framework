<?php

namespace Globals;

use Core\Entity\Entity;

class GlobalEntity extends Entity
{

    public function confirm($id, $url, $action = 'delete', $message = 'Voulez-vous vraiment supprimez cette ligne ?'){
        return '<div class="modal fade" id="'.$action.$id. '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <form action="'.$url.'" method="post">
                            <p> '.$message.'</p>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                            <button type="submit" class="btn btn-success">Oui</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>';
    }

}