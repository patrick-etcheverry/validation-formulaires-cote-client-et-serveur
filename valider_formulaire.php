<?php

// Définition des règles de validation pour chaque champ du formulaire
$reglesValidation = [
    'prenom' => [
        'obligatoire' => true,
        'type' => 'string',
        'longueur_min' => 2,
        'longueur_max' => 10,
        'format' => '/^[a-zA-ZÀ-ÿ\'-]+$/',
        'message_erreur' => "Le prénom doit comporter entre 2 et 10 caractères et ne contenir que des lettres."
    ],
    'nom' => [
        'obligatoire' => true,
        'type' => 'string',
        'longueur_min' => 2,
        'longueur_max' => 10,
        'format' => '/^[a-zA-ZÀ-ÿ\'-]+$/',
        'message_erreur' => "Le nom doit comporter entre 2 et 10 caractères et ne contenir que des lettres."
    ],
    'email' => [
        'obligatoire' => true,
        'type' => 'string',
        'longueur_min' => 5,
        'longueur_max' => 255,
        'format' => FILTER_VALIDATE_EMAIL,
        'message_erreur' => "L'adresse email est invalide."
    ],
    'tel' => [
        'obligatoire' => false,
        'type' => 'string',
        'longueur_min' => 10,
        'longueur_max' => 14,
        'format' => '/^0\d(\s|-|.)?(\d{2}(\s|-|.)?){4}$/',
        'message_erreur' => "Le numéro de téléphone est invalide. Il doit comporter 10 chiffres en commençant par 0."
    ],
    'experience' => [
        'obligatoire' => false,
        'type' => 'numeric',
        'plage_min' => 0,
        'plage_max' => 50,
        'message_erreur' => "Les années d'expérience doivent être comprises entre 0 et 50."
    ],
    'naissance' => [
        'obligatoire' => false,
        'type' => 'string',
        'longueur_exacte' => 10,
        'format' => '/^\d{4}-\d{2}-\d{2}$/',
        'plage_min' => '1950-01-01',
        'plage_max' => '2010-12-31',
        'message_erreur' => "La date de naissance doit être valide et comprise entre 1950 et 2010."
    ],
    'site' => [
        'obligatoire' => false,
        'type' => 'string',
        'format' => FILTER_VALIDATE_URL,
        'message_erreur' => "L'URL du site web est invalide."
    ]
];

/**
 * @brief Valide UN champ du formulaire en fonction des règles spécifiées dans le tableau $reglesValidation.
 *
 * @param string $champ Le nom du champ à valider (par exemple, 'prenom', 'email').
 * @param mixed $valeur La valeur du champ à valider.
 * @param array $regles Un tableau contenant les règles de validation pour le champ.
 *               Exemples de règles : ['obligatoire' => true, 'type' => 'string', 'longueur_min' => 3].
 * @param array $messagesErreurs Référence vers le tableau des messages d'erreurs où les messages de validation
 *               seront ajoutés en cas d'erreur pour ce champ.
 *
 * @return bool Retourne true si toutes les règles de validation pour le champ sont respectées, sinon false.
 */
function validerChamp(string $champ, mixed $valeur, array $regles, array &$messagesErreurs): bool
{
    $valide = true;

    // 1. Champs obligatoires
    if ($regles['obligatoire'] && empty($valeur))
    {
        $messagesErreurs[] = "{$champ} est obligatoire.";
        return false;
    }

    // Si le champ est facultatif et vide, ne pas procéder aux validations suivantes
    if (!$regles['obligatoire'] && empty($valeur))
    {
        return true;
    }

    // 2. Type de données
    if (isset($regles['type']) && $regles['type'] === 'string' && !is_string($valeur))
    {
        $messagesErreurs[] = "{$champ} doit être une chaîne de caractères.";
        $valide = false;
    }
    if (isset($regles['type']) && $regles['type'] === 'numeric' && !is_numeric($valeur))
    {
        $messagesErreurs[] = "{$champ} doit être un nombre.";
        $valide = false;
    }

    // 3. Longueur des chaînes
    if (isset($regles['longueur_min']) && strlen($valeur) < $regles['longueur_min'])
    {
        $messagesErreurs[] = "{$champ} doit comporter au moins {$regles['longueur_min']} caractères.";
        $valide = false;
    }
    if (isset($regles['longueur_max']) && strlen($valeur) > $regles['longueur_max'])
    {
        $messagesErreurs[] = "{$champ} ne doit pas dépasser {$regles['longueur_max']} caractères.";
        $valide = false;
    }
    if (isset($regles['longueur_exacte']) && strlen($valeur) !== $regles['longueur_exacte'])
    {
        $messagesErreurs[] = "{$champ} doit avoir exactement {$regles['longueur_exacte']} caractères.";
        $valide = false;
    }

    // 4. Format des données
    if (isset($regles['format']))
    {
        if (is_string($regles['format']) && !preg_match($regles['format'], $valeur))
        {
            $messagesErreurs[] = $regles['message_erreur'];
            $valide = false;
        }
        elseif (is_int($regles['format']) && !filter_var($valeur, $regles['format']))
        {
            $messagesErreurs[] = $regles['message_erreur'];
            $valide = false;
        }
    }

    // 5. Plages de valeurs
    if (isset($regles['plage_min']) && isset($regles['plage_max']))
    {
        $valeurDate = strtotime($valeur);
        $plageMinDate = strtotime($regles['plage_min']);
        $plageMaxDate = strtotime($regles['plage_max']);
        if ($valeurDate < $plageMinDate || $valeurDate > $plageMaxDate)
        {
            $messagesErreurs[] = $regles['message_erreur'];
            $valide = false;
        }
    }
    elseif (isset($regles['plage_min']) && $valeur < $regles['plage_min'])
    {
        $messagesErreurs[] = "{$champ} doit être au moins {$regles['plage_min']}.";
        $valide = false;
    }
    elseif (isset($regles['plage_max']) && $valeur > $regles['plage_max'])
    {
        $messagesErreurs[] = "{$champ} doit être au maximum {$regles['plage_max']}.";
        $valide = false;
    }

    return $valide;
}


/**
 * @brief Valide l'upload et la validation spécifique de la photo de profil.
 * 
 * @param array $fichier Le tableau $_FILES correspondant à la photo.
 * @param array &$messagesErreurs Un tableau pour enregistrer les messages d'erreurs.
 * @return bool Retourne true si la validation réussit, false sinon.
 */
function validerUploadEtPhoto(array $fichier, array &$messagesErreurs): bool
{
    // Vérifie s'il y a un fichier uploadé sans erreur
    if (isset($fichier) && $fichier['error'] === UPLOAD_ERR_OK)
    {
        // Validation spécifique pour la photo de profil
        return validerPhotoProfil($fichier, $messagesErreurs);
    }
    else
    {
        // Gestion des erreurs d'upload pour la photo de profil
        switch ($fichier['error'])
        {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $messagesErreurs[] = "Le fichier dépasse la taille maximale autorisée sur le serveur.";
                return false;
            case UPLOAD_ERR_PARTIAL:
                $messagesErreurs[] = "Le fichier n'a été que partiellement téléchargé.";
                return false;
            case UPLOAD_ERR_NO_FILE:
                // Aucun fichier n'est téléchargé, mais la photo est facultative
                return true;
            default:
                $messagesErreurs[] = "Erreur lors du téléchargement du fichier.";
                return false;
        }
    }
}



/**
 * Valide le fichier de photo de profil uploadé en fonction des règles de type, de taille, etc.
 *
 * @param array $photo Informations sur le fichier uploadé provenant de $_FILES
 * @param array &$messagesErreurs Tableau de messages d'erreurs qui sera mis à jour si le fichier n'est pas valide
 * @return bool Retourne true si le fichier est valide, false sinon
 */
function validerPhotoProfil(array $photo, array &$messagesErreurs): bool
{
    $valide = true;

    // 1. Champs obligatoires : la photo de profil est facultative
    if ($photo['error'] === UPLOAD_ERR_NO_FILE)
    {
        return true;
    }

    // 6. Fichiers uploadés - vérifier type et taille
    $typesAutorises = ['image/jpeg', 'image/png'];
    $tailleMaxAutoriseeEnOctets = 2 * 1024 * 1024; // 2 Mo

    $typeMimeReel = mime_content_type($photo['tmp_name']);
    if (!in_array($typeMimeReel, $typesAutorises))
    {
        $messagesErreurs[] = "Le fichier doit être au format JPG ou PNG.";
        $valide = false;
    }

    if ($photo['size'] > $tailleMaxAutoriseeEnOctets)
    {
        $messagesErreurs[] = "Le fichier ne doit pas dépasser 2 Mo.";
        $valide = false;
    }

    $dimensions = getimagesize($photo['tmp_name']);
    if ($dimensions === false)
    {
        $messagesErreurs[] = "Le fichier doit être une image valide.";
        $valide = false;
    }

    return $valide;
}
