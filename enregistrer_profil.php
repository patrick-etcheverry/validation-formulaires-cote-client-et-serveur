<?php

// Inclusion du fichier contenant les fonctions de validation
require_once 'fonctions_validations.php';

// Initialisation du tableau des messages d'erreurs
$messagesErreurs = [];

// Validation de chaque champ du formulaire (excepté la photo de profil)
$prenomValide = validerPrenom($_POST['prenom'], $messagesErreurs);
$nomValide = validerNom($_POST['nom'], $messagesErreurs);
$emailValide = validerEmail($_POST['email'], $messagesErreurs);
$telephoneValide = validerTelephone($_POST['tel'], $messagesErreurs);
$experienceValide = validerAnneesExperience($_POST['experience'], $messagesErreurs);
$dateNaissanceValide = validerDateNaissance($_POST['naissance'], $messagesErreurs);
$urlSiteValide = validerUrlSiteWeb($_POST['site'], $messagesErreurs);

// Validation spécifique pour la photo de profil
$photoValide = validerUploadEtPhoto($_FILES['photo_profil'], $messagesErreurs);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat du Profil Utilisateur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4">Détails du Profil Utilisateur</h2>


        <?php echo "Date naissance : " . $_POST['naissance'] . "<br>"; ?>

        <ul class="list-group mb-4">
            <li class="list-group-item"><strong>Prénom :</strong> <?= $_POST['prenom']; ?></li>
            <li class="list-group-item"><strong>Nom :</strong> <?= $_POST['nom']; ?></li>
            <li class="list-group-item"><strong>Email :</strong> <?= $_POST['email']; ?></li>
            <li class="list-group-item"><strong>Années d'expérience professionnelle :</strong> <?= $_POST['experience']; ?></li>
            <li class="list-group-item"><strong>Date de Naissance :</strong> <?= $_POST['naissance']; ?></li>
            <li class="list-group-item"><strong>Site Web :</strong> <?= $_POST['site']; ?></li>
            <li class="list-group-item"><strong>Téléphone :</strong> <?= $_POST['tel']; ?></li>
        </ul>

        <?php
        /* Si l'utilisateur a donné un fichier, que ce fichier a pu être uploadé sur le dossier temporaire du serveur
         e t que le fichier a été jugé valide, alors on le déplace dans le dossier 'uploads' de notre application et
         on affiche cette photo */
        if (isset($_FILES['photo_profil']) && $_FILES['photo_profil']['error'] === UPLOAD_ERR_OK && $photoValide)
        {
            /* Répertoire de destination pour l'enregistrement de la photo de profil.
               Note : Apache doit avoir des droits en écriture sur ce dossier pour sauvegarder l'image. */
            $uploadDir = 'uploads/';

            /* Création d'un nom de fichier unique
               Utilisation de time() pour ajouter un timestamp au nom d'origine du fichier.
               Cela permet d'éviter les conflits lorsque plusieurs utilisateurs téléchargent des fichiers 
               ayant le même nom (par exemple, plusieurs fichiers nommés "profil.jpg").
               Sans un nom de fichier unique, chaque nouvel upload avec le même nom écraserait le fichier précédent, 
               ce qui entraînerait la perte de l'image de profil d'autres utilisateurs.
               Avec ce système, chaque fichier a un nom distinct basé sur le timestamp au moment du téléchargement. */
            $fileName = time() . '_' . basename($_FILES['photo_profil']['name']);

            /* Chemin complet de destination du fichier
               Concatène le répertoire de destination (`uploads/`) avec le nom de fichier unique généré.
               Cela crée le chemin complet où le fichier sera stocké sur le serveur.
               Exemple : "uploads/1633024800_profil.jpg" */
            $filePath = $uploadDir . $fileName;

            // Déplacement du fichier téléchargé vers le répertoire cible
            if (move_uploaded_file($_FILES['photo_profil']['tmp_name'], $filePath))
            {
                echo '<div class="text-center">';
                echo '<h5 class="mb-3">Photo de Profil :</h5>';
                echo '<img src="' . $filePath . '" alt="Photo de Profil" class="img-thumbnail mb-3" style="max-width: 150px;">';
                echo '<br>';
                echo '</div>';
            }
            else
            {
                // Problème d’autorisation d'écriture ou d'accès si le fichier ne peut être déplacé
                echo '<p class="text-danger">Erreur : Le fichier n\'a pas pu être téléchargé.</p>';
            }
        }
        else
        {
            echo '<p>Aucune photo de profil téléchargée ou erreur lors du téléchargement.</p>';
        }
        ?>

        <div class="text-center mb-4">
            <a href="index.html" class="btn btn-secondary mt-4">Retour à l'édition</a>
        </div>


        <?php
        // Affichage des éventuels messages d'erreurs
        if (empty($messagesErreurs))
        {
            echo "<p class='text-success'>Les données soumises sont valides.</p>";
        }
        else
        {
            echo "<div class='alert alert-danger'>";
            echo "<h4>Erreurs de Validation :</h4>";
            echo "<ul>";
            foreach ($messagesErreurs as $erreur)
            {
                echo "<li>$erreur</li>";
            }
            echo "</ul>";
            echo "</div>";
        }
        ?>

    </div>

</body>

</html>
