<?php
    $titles = "Futur Game - compte";
    ob_start();
?>

  <style>
    .bg-custom {
      background-color: rgb(152, 56, 56);
    }
  </style>


  <div class="container py-5">

    <div class="container text-center">
      <div class="row gy-5">
        <div class="col-md-4">
          <div class="card shadow border-0 h-100">
            <div class="card-header bg-custom text-white">
              <h5>Avatar</h5>
            </div>
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
              <?php if (!empty($_SESSION['avatar'])) { ?>  
                  <img src="../uploads/<?=$accounts['avatar']?>" class="rounded-circle img-fluid mb-3" style="width: 50%; height: auto;" alt="Avatar">
                  <p class="">Votre Avatar</p>
              <?php } else { ?>
                  <img src="../public/assets/image/user-solid.svg" class="img-fluid mb-3" style="width: 30%; height: auto;" alt="Avatar">
                  <p class="">Vous n'avez pas d'avatar</p>
              <?php } ?>
              <div>
                  <?php if (!empty($_SESSION['avatar'])) { ?>
                      <a href="index.php?page=avatar" class="btn btn-primary">Modifier l'avatar</a>
                  <?php } else { ?>
                      <a href="index.php?page=avatar" class="btn btn-primary">Ajouter un avatar</a>
                  <?php } ?>
              </div>
          </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card  shadow border-0">
            <div class="card-header bg-custom text-white">
              <h5>Mes Informations</h5>
            </div>
            <div class="card-body align-self-center">
              <ul class="list-group list-group-flush text-start ">
                <li class="list-group-item">
                  <span class="fw-bold">Email :</span> <?= $accounts['email'] ?>
                </li>
                <li class="list-group-item">
                  <span class="fw-bold">Nom :</span> <?= $accounts['lastname'] ?>
                </li>
                <li class="list-group-item">
                  <span class="fw-bold">Prénom :</span> <?= $accounts['firstname'] ?>
                </li>
                <li class="list-group-item">
                  <span class="fw-bold">Nom utilistateur :</span> <?= $accounts['username'] ?>
                </li>
                <li class="list-group-item">
                  <span class="fw-bold">Adresse de facturation :</span> <?= $accounts['billing_address'] ?>
                </li>
                <li class="list-group-item">
                  <span class="fw-bold">Adresse de livraison :</span> <?= $accounts['delivery_address'] ?>
                </li>
              </ul>
              <div class="mt-4">
                <a href="index.php?page=edit_account" class="btn btn-success">Modifier mes informations</a>

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                  Supprimer le compte
                </button>

              <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header bg-custom text-white">
                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Suppresion du compte</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Attention ! La suppression du compte est définitive ! <br>

                    </div>
                    
                  <form action="" method="POST">
                    <div class="modal-footer">
                      
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                      <button type="submit" name="delete_account" class="btn btn-danger">Supprimer</button>
                    </div>
                  </form>
                  </div>
                </div>
              </div>


              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
            <div class="card shadow border-0" id="orders">
              <div class="card-header bg-custom text-white">
                <h3 class="card-title">Mes Commandes</h3>
              </div>
              <div class="card-body">
              <?php
                      if (empty($orders)) {
                        echo "<p class='py-5 alert alert-secondary'>Vous avez fait aucun achat </p>";
                      } else {
              ?>
                <table class="table" >
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Date de la commande</th>
                      <th>Prix total</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
  
                        foreach ($orders as $order) {
                      ?>
                          <tr>
                            <td><?= $order['order_id'] ?></td>
                            <td><?= $order['order_date'] ?></td>
                            <td><?= $order['price_total'] ?> €</td>
                            <td><a class="btn btn-info text-white" href="index.php?page=orders&id=<?= urlencode($order['order_id']) ?>">Voir la commande</a></td>
                          </tr>

                  </tbody>
                </table>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>


  

  <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php if ($currentPage > 1) : ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?page=account&pages=<?= $currentPage - 1 ?>#orders" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                        <a class="page-link" href="index.php?page=account&pages=<?= $i ?>#orders"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($currentPage < $totalPages) : ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?page=account&pages=<?= $currentPage + 1 ?>#orders" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
  
        <?php
                        }
                      }
                      ?>
<?php
  $content = ob_get_clean();
  require('layout.php');
?>