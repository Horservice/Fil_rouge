<?php
    $titles = "Futur Game - Panier";
    ob_start();
?>

<style>

    .resume-panier {
        position: sticky;
        top: 20px; /* Ajustez la valeur en fonction de votre mise en page */
    }

    /* Style pour le tableau de produits */

    th,
    td {
            text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    /* Style pour le bouton "Remove" */
    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    /* Style pour la carte de résumé du panier */
    .card-custom-cart {
        background-color: #f8f9fa;
    }




    .bg-custom {
        background-color: rgb(152, 56, 56);
    }

    .custom {

        background-color: rgba(128, 128, 128, 0.242);
    }


</style>

<div class="container">
<?=$msg?>
</div>

</form>


<div class="container-fluid py-5">
    <form  method="POST" enctype="multipart/form-data">
        <div class="card card-custom-cart shadow border-0">
            <div class="card-header  bg-custom">
                <h1 class="text-center text-white">Votre panier</h1>
            </div>
            <div class="card-body">

                <?php
                if (empty($carts)) {
                    echo "<p class='py-5 alert alert-secondary text-center'>Votre panier est actuellement vide !</p>";
                } else {
                ?>
                <div class="row row-cols-1 ">
                <div class="col-lg-8 ">

                      
                


                
                        <table class="table border-0 shadow">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($carts as $cart) { 
                                // Find the quantity associated with the ID of the current game
                                $quantity = 1; // Default value if the quantity is not found
                                foreach ($_SESSION['carts'] as $element) {
                                    if ($element['game_id'] == $cart['game_id'] && isset($element['quantity'])) {
                                        $quantity = $element['quantity'];
                                        break; // Exit the loop as soon as the quantity is found
                                    }
                                }

                            ?>
                                <tr>
                                    <td>
                                        <input type="hidden" value="<?= $cart['game_id'] ?>" name="<?= $cart['game_id'] ?>">
                                        <img src="../../Back_end/uploads/<?= $cart['path'] ?>" alt="Jacket du jeu <?= $cart['name'] ?>" class="img-thumbnail img-fluid" style="max-width: 200px; max-height: 200px;">
                                    </td>
                                    <td><?= $cart['name'] ?></td>

                                    <td class="price"><?= $cart['price'] ?> €</td>
                                    <td>
                                        <select name="quantity_<?= $cart['game_id'] ?>" class="form-control quantity w-75">
                                            <?php for ($i = 1; $i <= 10; $i++) : ?>
                                                <option value="<?= $i ?>" <?= ($i == $quantity) ? 'selected' : '' ?>><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </td>

                                    <td class="total"> <?= $cart['price'] * $quantity ?> €</td>
                                    <input type="hidden" name="price_<?=$cart['game_id'] ?>" value="<?=$cart['price']?>">
                                        <?php
                                            // Utilisez la même variable que celle utilisée dans le champ caché
                                            // var_dump("Prix unique : "  .$cart['price'] . "€ et sont id : " . $cart['game_id'] . " et sont nom : " .$cart['name']);
                                        ?>
                                    <td>

                                        <button class="btn btn-danger delete-product rounded-5" name="delete" type="submit" value="<?= $cart['game_id'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill mx-auto mb-1" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                          </svg></button> 
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-4">
                        <div class="card resume-panier custom shadow border border-0 ">
                            <div class="card-body text-center">
                                <?=$noaccount?>
                                <h5 class="card-title">Résumé du panier</h5>
                                <p id="total-jeux">Total de jeux : </p>
                                <p id="prix-final">Prix final :  €</p>
                                <input type="hidden" id="total-price" name="total_price" value="">
                                <button class="btn btn-primary" name="submit">Payer</button>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                }
                ?>
            </div>
        </div>
    </form>
</div>



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function() {
    // Fonction pour mettre à jour le total et le résumé du panier
    function updateCartSummary() {
        var totalJeux = 0;
        var prixFinal = 0;

        // Parcourir chaque ligne du panier
        $('.table tbody tr').each(function() {
            var price = parseFloat($(this).find('.price').text().replace(' €', ''));
            var quantity = parseInt($(this).find('.quantity').val());
            var total = price * quantity;

            // Mettre à jour le total de jeux et le prix final
            totalJeux += quantity;
            prixFinal += total;

            // Mettre à jour le total dans la ligne du panier
            $(this).find('.total').text(total.toFixed(2) + ' €');
        });
        // Mettre à jour le résumé du panier
        $('#total-jeux').text('Total de jeux : ' + totalJeux);
        $('#prix-final').text('Prix final : ' + prixFinal.toFixed(2) + ' €');

        

        $('#total-price').val(prixFinal.toFixed(2));

    }

    // Écouter les changements dans la quantité
    $('.quantity').on('input', function() {
        updateCartSummary();
    });


    // Appel initial pour mettre à jour le résumé du panier
    updateCartSummary();
});

</script>




<?php
    $content = ob_get_clean();
    require('layout.php');
?>