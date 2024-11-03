<?php

// Inclusion du fichier contenant les règles de validation et les fonctions associées
require_once 'valider_formulaire.php';

// Initialisation du tableau des messages d'erreurs
$messagesErreurs = [];

// Validation de chaque champ du formulaire selon les règles définies dans $reglesValidation
foreach ($reglesValidation as $champ => $regles)
{
    if (isset($_POST[$champ]))
    {
        $valide = validerChamp($champ, $_POST[$champ], $regles, $messagesErreurs);
    }
}

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

        <ul class="list-group mb-4">
            <li class="list-group-item"><strong>Prénom :</strong> <?= htmlspecialchars($_POST['prenom']); ?></li>
            <li class="list-group-item"><strong>Nom :</strong> <?= htmlspecialchars($_POST['nom']); ?></li>
            <li class="list-group-item"><strong>Email :</strong> <?= htmlspecialchars($_POST['email']); ?></li>
            <li class="list-group-item"><strong>Années d'expérience professionnelle :</strong> <?= htmlspecialchars($_POST['experience']); ?></li>
            <li class="list-group-item"><strong>Date de Naissance :</strong> <?= htmlspecialchars($_POST['naissance']); ?></li>
            <li class="list-group-item"><strong>Site Web :</strong> <?= htmlspecialchars($_POST['site']); ?></li>
            <li class="list-group-item"><strong>Téléphone :</strong> <?= htmlspecialchars($_POST['tel']); ?></li>
        </ul>

        <?php
        // Affichage de la photo de profil si elle est valide
        if (isset($_FILES['photo_profil']) && $_FILES['photo_profil']['error'] === UPLOAD_ERR_OK && $photoValide)
        {
            $uploadDir = 'uploads/';
            $fileName = time() . '_' . basename($_FILES['photo_profil']['name']);
            $filePath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['photo_profil']['tmp_name'], $filePath))
            {
                echo '<div class="text-center">';
                echo '<h5 class="mb-3">Photo de Profil :</h5>';
                echo '<img src="' . htmlspecialchars($filePath) . '" alt="Photo de Profil" class="img-thumbnail mb-3" style="max-width: 150px;">';
                echo '<br>';
                echo '</div>';
            }
            else
            {
                echo '<p class="text-danger">Erreur : Le fichier n\'a pas pu être déplacé dans le dossier de destination.</p>';
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
                echo "<li>" . htmlspecialchars($erreur) . "</li>";
            }
            echo "</ul>";
            echo "</div>";
        }
        ?>

    </div>

</body>

</html>