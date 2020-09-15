<?php
$json = array('error' => true);
if (isset($_GET['id'])) {
    $product = $db->query('SELECT id FROM products WHERE id=:id', array('id' => $_GET['id']));
    if (empty($product)) {
        $json['message'] = "Ce produit n'exsite pas";
    }
    $panier->addCard($_SESSION['panier'], 1);
    $json['error'] = false;
    $json['total'] = $panier->totalCard($_SESSION['panier']);
    $json['count'] = $panier->countCard($_SESSION['panier']);
    $json['message'] = 'Le produit à bien été ajouté à votre panier';
} else {
    $json['message'] = "Vous n'avez pas sélectionné de produit à ajouter au panier";
}
echo json_encode($json);