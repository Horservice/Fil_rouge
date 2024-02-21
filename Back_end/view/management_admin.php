<?php $title = "Gestion Admin";
 ob_start(); ?>

 <style>

.avatar-admin{

  width: 85px;
  height: 85px;
}
  </style>
<div class="container">

    <h1>Gestion des Administrateurs</h1>
    <p class="text-end">
        <a class="btn btn-primary text-end" href="index.php?page=add_admin" role="button">Ajouter un administrateur</a>
    </p>
  <div class= "table-responsive">
    <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Avatar</th>
            <th>Nom d'utilisateur</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Email</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
            <?php
            foreach($admins as $admin) { ?>
          <tr>
            <td><?= $admin['admin_id'] ?></td>
            <td class=""><img class="rounded-pill avatar-admin shadow" src="../uploads/<?= $admin['avatar'] ?>" alt="avatar"></td>
            <td><?= $admin['username'] ?></td>
            <td><?= $admin['firstname'] ?></td>
            <td><?= $admin['lastname'] ?></td>
            <td><?= $admin['email'] ?></td>
            
            <td class="text-center">
                <a class="btn btn-warning" href="index.php?page=edit_admin&id=<?= urlencode($admin['admin_id']) ?>" role="button" >Modifier</a>
                <a class="btn btn-danger"  href="index.php?page=del_admin&id=<?= urlencode($admin['admin_id']) ?>" role="button" >Supprimer</a>
            </td>
            <?php } ?>
        </tbody>
      </table>
      </div>

</div>

<?php $content = ob_get_clean(); ?>
<?php require('layout.php') ?>