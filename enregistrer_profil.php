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
            <li class="list-group-item"><strong>Prénom :</strong> <?= $_POST['prenom'] ?? ''; ?></li>
            <li class="list-group-item"><strong>Nom :</strong> <?= $_POST['nom'] ?? ''; ?></li>
            <li class="list-group-item"><strong>Email :</strong> <?= $_POST['email'] ?? ''; ?></li>
            <li class="list-group-item"><strong>Années d'expérience professionnelle :</strong> <?= $_POST['experience'] ?? ''; ?></li>
            <li class="list-group-item"><strong>Date de Naissance :</strong> <?= $_POST['naissance'] ?? ''; ?></li>
            <li class="list-group-item"><strong>Site Web :</strong> <?= $_POST['site'] ?? ''; ?></li>
            <li class="list-group-item"><strong>Téléphone :</strong> <?= $_POST['tel'] ?? ''; ?></li>
        </ul>

        <?php
        if (isset($_FILES['photo_profil']) && $_FILES['photo_profil']['error'] === UPLOAD_ERR_OK)
        {

            /* Répertoire de destination pour l'enregistrement du fichier 
               Attention : apache doit avoir des droits en écriture sur ce dossier */
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
                echo '<p class="text-danger">Erreur : Le fichier n\'a pas pu être téléchargé.</p>';
            }
        }
        else
        {
            echo '<p>Aucune photo de profil téléchargée ou erreur lors du téléchargement.</p>';
        }
        ?>

        <div class="text-center">
            <a href="index.html" class="btn btn-secondary mt-4">Retour à l'édition</a>
        </div>
    </div>

</body>

</html>