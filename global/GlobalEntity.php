<?php

namespace Globals;

use Core\Entity\Entity;

class GlobalEntity extends Entity
{

    /**
     * Permet d'afficher une alerte au niveau de l'espace d'administation afin
     * que l'utilisateur confirme l'action qu'il veux effectuer. Exemple: Lors de la suppression
     * l'utilisateur aura le message : Voulez-vous vraiment supprimer cette ligne ?
     * @param        $id    : identifiant de la ligne à supprimer
     * @param        $url   : l'url vers lequel l'utilisateur sera rédiriger lorsqu'il confirme
     *                      l'action
     * @param string $action : il permet de composer avec l'id pour générer un idenfiant unique
     *                       pour la modal
     * @param string $message : Le message à afficher à l'utilisateur.
     * @return string           : Fait apparaitre un modal avec deux bouton 'Oui ou Non'
     */
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

    /**
     * Permet de gerer les droits d'utilisation au nivea du site. Elle permet de
     * definir les choses qui s'afficheront suivant l'utilisateur et son rôle
     * @param array  $users     :   Un tableau contenant les droits (superAdmin, admin, redacteur, ...)
     * @param string $contents  :   le contenu a afficher
     * @return bool|string      :   Retourne le contenu
     */
    public function userRight(array $users, string $contents){
        if(isset($_SESSION["a"])){
            $datas = [];

            $userright = [
                'superAdmin' => '1',
                'admin' => '2',
                'redacteur' => '3',
            ];

            foreach ($users as $user){
                if(array_key_exists($user, $userright)){
                    $datas [] = $userright[$user];
                }
            }

            if(in_array($_SESSION['a']['userright'], $datas)){
                return $contents;
            }

        }
        return false;
    }

}