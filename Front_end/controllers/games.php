<?php
// controllers/game.php
require_once('../model/games.php');

function games($id) {



    


    $Game = GetGame($id);

    if (!$Game) {
        header("Location: index.php?page=homepage");
        exit();
    }




    $msg = null;

    $disabled = null;

    // $totalQuantity =null;

    if (isset($_POST['submit'])) {
        if (!isset($_SESSION['carts'])) {
            $_SESSION['carts'] = array();
        }

        // Récupérer l'ID du jeu et la quantité à ajouter depuis le formulaire
        $gameId = $Game['game_id'];
        $quantityToAdd = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

        // Rechercher l'index du jeu dans le panier
        $cartIndex = array_search($gameId, array_column($_SESSION['carts'], 'game_id'));

        // Vérifier si la quantité totale après l'ajout dépasse 10
        $totalQuantity = $cartIndex !== false ? $_SESSION['carts'][$cartIndex]['quantity'] + $quantityToAdd : $quantityToAdd;

        // Mettre à jour le panier uniquement si la quantité totale n'atteint pas 10
        if ($totalQuantity <= 10) {
            // Mettre à jour le panier en conséquence
            if ($cartIndex !== false) {
                // Le jeu est déjà dans le panier
                $_SESSION['carts'][$cartIndex]['quantity'] += $quantityToAdd;

                // Message indiquant que le jeu est déjà présent avec la nouvelle quantité
                $msg = "<div class='alert alert-info shadow' role='alert'>
                            Le jeu est déjà dans le panier. Quantité mise à jour : {$_SESSION['carts'][$cartIndex]['quantity']}
                        </div>";
            } else {
                // Le jeu n'est pas dans le panier, l'ajouter avec la quantité souhaitée
                $_SESSION['carts'][] = array('game_id' => $gameId, 'quantity' => $quantityToAdd);

                // Message de succès
                $msg = "<div class='alert alert-success shadow' role='alert'>
                            Le jeux a été ajouté au panier.
                        </div>";
            }

        } else {
            // Afficher un message si la quantité dépasse 10
            $msg = '<div class="alert alert-warning shadow" role="alert">
            Vous avez atteint la quantité   maximale d\'ajout du jeu ' . $Game['name'] . ', qui est de 10.
        </div>';

        $disabled = "disabled";

        }

        

        // var_dump($_SESSION['carts']);
    }

    require_once('../view/games.php');
}
