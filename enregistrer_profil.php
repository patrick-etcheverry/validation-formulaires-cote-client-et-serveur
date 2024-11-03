<?php

// Inclusion du fichier contenant la classe de validation
require_once 'validator.class.php';

// Définition des règles que l'on souhaite vérifier pour chaque champ du formulaire
$reglesValidation = [
    'prenom' => [
        'obligatoire' => true,
        'type' => 'string',
        'longueur_min' => 2,
        'longueur_max' => 10,
        'format' => '/^[a-zA-ZÀ-ÿ\'-]+$/'
    ],
    'nom' => [
        'obligatoire' => false,
        'type' => 'string',
        'longueur_min' => 2,
        'longueur_max' => 10,
        'format' => '/^[a-zA-ZÀ-ÿ\'-]+$/'
    ],
    'email' => [
        'obligatoire' => true,
        'type' => 'string',
        'longueur_min' => 5,
        'longueur_max' => 255,
        'format' => FILTER_VALIDATE_EMAIL
    ],
    'tel' => [
        'obligatoire' => false,
        'type' => 'string',
        'longueur_min' => 10,
        'longueur_max' => 14,
        'format' => '/^0\d(\s|-|.)?(\d{2}(\s|-|.)?){4}$/'
    ],
    'experience' => [
        'obligatoire' => false,
        'type' => 'numeric',
        'plage_min' => 0,
        'plage_max' => 50
    ],
    'naissance' => [
        'obligatoire' => false,
        'type' => 'string',
        'longueur_exacte' => 10,
        'format' => '/^\d{4}-\d{2}-\d{2}$/',
        'plage_min' => '1950-01-01',
        'plage_max' => '2010-12-31'
    ],
    'site' => [
        'obligatoire' => false,
        'type' => 'string',
        'format' => FILTER_VALIDATE_URL
    ]
];

// Instanciation de la classe de validation
$validator = new Validator($reglesValidation);

// Récupération des données du formulaire
$donnees = $_POST;

// Validation des données
$donneesValides = $validator->valider($donnees);
$messagesErreurs = $validator->getMessagesErreurs();

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
            <li class="list-group-item"><strong>Prénom :</strong> <?= $_POST['prenom']; ?></li>
            <li class="list-group-item"><strong>Nom :</strong> <?= $_POST['nom']; ?></li>
            <li class="list-group-item"><strong>Email :</strong> <?= $_POST['email']; ?></li>
            <li class="list-group-item"><strong>Années d'expérience professionnelle :</strong> <?= $_POST['experience']; ?></li>
            <li class="list-group-item"><strong>Date de Naissance :</strong> <?= $_POST['naissance']; ?></li>
            <li class="list-group-item"><strong>Site Web :</strong> <?= $_POST['site']; ?></li>
            <li class="list-group-item"><strong>Téléphone :</strong> <?= $_POST['tel']; ?></li>
        </ul>

        <div class="text-center mb-4">
            <a href="index.html" class="btn btn-secondary mt-4">Retour à l'édition</a>
        </div>

        <?php
        // Affichage des éventuels messages d'erreurs
        if (empty($messagesErreurs)) {
            echo "<p class='text-success'>Les données soumises sont valides.</p>";
        } else {
            echo "<div class='alert alert-danger'>";
            echo "<h4>Erreurs de Validation :</h4>";
            echo "<ul>";
            foreach ($messagesErreurs as $erreur) {
                echo "<li>$erreur</li>";
            }
            echo "</ul>";
            echo "</div>";
        }
        ?>

    </div>

</body>

</html>
