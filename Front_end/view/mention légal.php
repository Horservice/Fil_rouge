<?php 
//fini
$titles = "Futur Game -  Mention légale"; 
 ob_start(); 
?>

<style>

    .bg-custom {
        background-color: rgb(152, 56, 56);
    
    }
</style>



    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?page=account">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mention Légale</li>
            </ol>
        </nav>  
    </div>

    <div class="container">
        MENTIONS LÉGALES

        Le site www.futurgame.com est exploité par la société Futur Game, une société [à responsabilité limitée/SARL] enregistrée au [adresse de l'entreprise], immatriculée sous le numéro [numéro d'immatriculation] au Registre du Commerce et des Sociétés de [ville d'enregistrement].
        
        Coordonnées
        
        Adresse de l'entreprise : [Adresse complète]
        Téléphone : [Numéro de téléphone]
        Email : [Adresse e-mail]
        Directeur de la publication : [Nom du directeur de la publication]
        
        Hébergement
        
        Le site www.futurgame.com est hébergé par [Nom de l'hébergeur], dont le siège social est situé à [Adresse de l'hébergeur].
        
        Propriété intellectuelle
        
        Tous les contenus présents sur le site www.futurgame.com, incluant notamment les textes, les images, les vidéos, les logos et les marques, sont la propriété exclusive de Futur Game ou font l'objet d'une autorisation d'utilisation accordée à Futur Game. Toute reproduction, représentation, modification, publication ou adaptation, totale ou partielle, du contenu du site, quel que soit le moyen ou le procédé utilisé, est interdite, sauf autorisation préalable écrite de Futur Game.
        
        Protection des données personnelles
        
        Futur Game s'engage à respecter la confidentialité des informations personnelles fournies par les utilisateurs du site www.futurgame.com. Pour plus d'informations sur la collecte et le traitement des données personnelles, veuillez consulter notre Politique de Confidentialité.
        
        Cookies
        
        Le site www.futurgame.com peut utiliser des cookies pour améliorer l'expérience de navigation des utilisateurs. Pour plus d'informations sur l'utilisation des cookies, veuillez consulter notre Politique de Cookies.
        
        Limitation de responsabilité
        
        Futur Game s'efforce de fournir des informations précises et à jour sur le site www.futurgame.com, mais ne peut garantir l'exactitude, l'exhaustivité ou la pertinence de ces informations. En conséquence, Futur Game décline toute responsabilité quant à l'utilisation qui pourrait être faite du contenu du site.
        
        Loi applicable et juridiction compétente
        
        Les présentes mentions légales sont régies par le droit français. Tout litige relatif à l'interprétation ou à l'exécution des présentes sera soumis à la compétence exclusive des tribunaux français.

    </div>



<?php $content = ob_get_clean();
require('layout.php') ?>