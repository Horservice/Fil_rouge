<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Contact</title>
</head>
<style>
        .bg-custom {
      background-color: rgb(152, 56, 56);
    }
</style>
<body>


    <div class="container mt-5">
        <div class="card rounded-5 shadow">
            <div class="card-header text-white bg-custom rounded-top-5">
                <h1>Contactez-nous</h1>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" placeholder="Votre nom">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input type="email" class="form-control" id="email" placeholder="Votre adresse e-mail">
                    </div>
                    <div class="mb-3">
                        <label for="sujet" class="form-label">Sujet</label>
                        <input type="text" class="form-control" id="sujet" placeholder="Sujet de votre message">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="4" placeholder="Votre message"></textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="accepter">
                        <label class="form-check-label" for="accepter">En soumettant ce formulaire, j'accepte que mes données personnelles soient utilisées pour me recontacter. Aucun autre traitement ne sera effectué avec mes informations. Pour connaître et exercer vos droits, veuillez consulter la Politique de confidentialité.</label>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-mzgF/6p8B6AqS4f5qSNn5dpwn6jA4b9Auw2F/+C2MqMAF5D5zDpT6f5E9Tu7p9EY" crossorigin="anonymous"></script>
</body>
</html>