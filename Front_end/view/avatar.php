<?php
    $titles = "Avatar";
    ob_start();
?>

<style>
    .bg-custom {
      background-color: rgb(152, 56, 56);
    }
  </style>


<div class="container py-2">
    <div class="card shadow border-0">
        <div class="card-header bg-custom text-white">
            <h1>Avatar</h1>


        </div>
        <div class="card-header text-white">

<?= $msg ?>
</div>
        <div class="card-body mb-3">
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="avatar" class="form-label">Avatar</label>
                <input type="file" class="form-control" name="avatar" accept="image/*" required>

                <a href="index.php?page=account" class="btn btn-secondary mt-5" name="submit">Retour</a>

                <?php
                    if (!empty($_SESSION['avatar'])) {
                        echo '<button type="submit" class="btn btn-primary mt-5" name="submit">Modifier avatar</button>';
                    } else {
                        echo '<button type="submit" class="btn btn-primary mt-5" name="submit">Ajouter avatar</button>';
                    }
                ?>


            </form>
        </div>
    </div>
</div>

<?php
    $content = ob_get_clean();
    require('layout.php');
?>