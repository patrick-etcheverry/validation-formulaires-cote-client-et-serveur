<?php

/**
 * @brief Valide le prénom en fonction de plusieurs critères (obligatoire, type, longueur, format).
 *
 * @param string $prenom Le prénom à valider.
 * @param array &$messagesErreurs Tableau de messages d'erreurs.
 * @return bool Retourne true si le prénom est valide, false sinon.
 */
function validerPrenom(string $prenom, array &$messagesErreurs): bool
{
    $valide = true;

    // 1. Champs obligatoires : vérifier la présence du champ
    if (empty($prenom))
    {
        $messagesErreurs[] = "Le prénom est obligatoire.";
        $valide = false;
    }

    // 2. Type de données : vérifier que le prénom est une chaîne de caractères
    if (!is_string($prenom))
    {
        $messagesErreurs[] = "Le prénom doit être une chaîne de caractères.";
        $valide = false;
    }

    // 3. Longueur des chaînes : vérifier la longueur minimale et maximale (par exemple, 2 à 10 caractères)
    if (strlen($prenom) < 2 || strlen($prenom) > 10)
    {
        $messagesErreurs[] = "Le prénom doit comporter entre 2 et 10 caractères.";
        $valide = false;
    }

    // 4. Format des données : vérifier que le prénom ne contient que des lettres et des traits d'union
    if (!preg_match("/^[a-zA-ZÀ-ÿ'-]+$/", $prenom))
    {
        $messagesErreurs[] = "Le prénom ne doit contenir que des lettres et éventuellement des traits d'union.";
        $valide = false;
    }

    // 5. Plages de valeurs : non pertinent pour le prénom

    // 6. Fichiers uploadés : non pertinent pour le prénom

    return $valide;
}

/**
 * @brief Valide le nom en fonction de plusieurs critères (obligatoire, type, longueur, format).
 *
 * @param string $nom Le nom à valider.
 * @param array &$messagesErreurs Tableau de messages d'erreurs.
 * @return bool Retourne true si le nom est valide, false sinon.
 */
function validerNom(string $nom, array &$messagesErreurs): bool
{
    $valide = true;

    // 1. Champs obligatoires : vérifier la présence du champ
    if (empty($nom))
    {
        $messagesErreurs[] = "Le nom est obligatoire.";
        $valide = false;
    }

    // 2. Type de données : vérifier que le nom est une chaîne de caractères
    if (!is_string($nom))
    {
        $messagesErreurs[] = "Le nom doit être une chaîne de caractères.";
        $valide = false;
    }

    // 3. Longueur des chaînes : vérifier la longueur minimale et maximale (par exemple, 2 à 10 caractères)
    if (strlen($nom) < 2 || strlen($nom) > 10)
    {
        $messagesErreurs[] = "Le nom doit comporter entre 2 et 10 caractères.";
        $valide = false;
    }

    // 4. Format des données : vérifier que le nom ne contient que des lettres et des traits d'union
    if (!preg_match("/^[a-zA-ZÀ-ÿ'-]+$/", $nom))
    {
        $messagesErreurs[] = "Le nom ne doit contenir que des lettres et éventuellement des traits d'union.";
        $valide = false;
    }

    // 5. Plages de valeurs : non pertinent pour le nom

    // 6. Fichiers uploadés : non pertinent pour le nom
    return $valide;
}

/**
 * @brief Valide l'adresse email en fonction de plusieurs critères (obligatoire, type, longueur, format).
 *
 * @param string $email L'adresse email à valider.
 * @param array &$messagesErreurs Tableau de messages d'erreurs.
 * @return bool Retourne true si l'email est valide, false sinon.
 */
function validerEmail(string $email, array &$messagesErreurs): bool
{
    $valide = true;

    // 1. Champs obligatoires : vérifier la présence du champ
    if (empty($email))
    {
        $messagesErreurs[] = "L'adresse email est obligatoire.";
        $valide = false;
    }

    // 2. Type de données : vérifier que l'email est une chaîne de caractères
    if (!is_string($email))
    {
        $messagesErreurs[] = "L'email doit être une chaîne de caractères.";
        $valide = false;
    }

    // 3. Longueur des chaînes : vérifier la longueur minimale et maximale (par exemple, 5 à 255 caractères)
    if (strlen($email) < 5 || strlen($email) > 255)
    {
        $messagesErreurs[] = "L'email doit comporter entre 5 et 255 caractères.";
        $valide = false;
    }

    // 4. Format des données : vérifier le format de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $messagesErreurs[] = "L'adresse email est invalide.";
        $valide = false;
    }

    // 5. Plages de valeurs : non pertinent pour l'email

    // 6. Fichiers uploadés : non pertinent pour l'email

    return $valide;
}

/**
 * @brief Valide les années d'expérience (facultatif, type numérique, plage de valeurs).
 *
 * @param int|string $experience Le nombre d'années d'expérience.
 * @param array &$messagesErreurs Tableau de messages d'erreurs.
 * @return bool Retourne true si l'expérience est valide, false sinon.
 */
function validerAnneesExperience(int|string $experience, array &$messagesErreurs): bool
{
    $valide = true;

    // 1. Champs obligatoires : l'expérience est facultative
    if (empty($experience))
    {
        // L'expérience est facultative. Si elle est vide, inutile de faire des validations supplémentaires.
        return $valide;
    }

    // 2. Type de données : vérifier que l'expérience est un nombre
    if (!is_numeric($experience))
    {
        $messagesErreurs[] = "Les années d'expérience doivent être un nombre.";
        $valide = false;
    }

    // 3. Longueur des chaînes : non pertinent pour les années d'expérience

    // 4. Format des données : non pertinent car type numérique déjà vérifié

    // 5. Plages de valeurs : vérifier que le nombre est compris entre 0 et 50
    if ((int)$experience < 0 || (int)$experience > 50)
    {
        $messagesErreurs[] = "Les années d'expérience doivent être comprises entre 0 et 50.";
        $valide = false;
    }

    // 6. Fichiers uploadés : non pertinent pour les années d'expérience

    return $valide;
}

/**
 * @brief Valide la date de naissance (facultative, format, plage de valeurs).
 *
 * @param string $date La date de naissance au format YYYY-MM-DD.
 * @param array &$messagesErreurs Tableau de messages d'erreurs.
 * @return bool Retourne true si la date de naissance est valide, false sinon.
 */
function validerDateNaissance(string $date, array &$messagesErreurs): bool
{
    $valide = true;

    // 1. Champs obligatoires : la date de naissance est facultative
    if (empty($date))
    {
        // La date de naissance est facultative. Si elle est vide, inutile de faire des validations supplémentaires.
        return $valide; // Aucun message d'erreur, la validation est positive pour un champ facultatif non rempli.
    }

    // 2. Type de données : vérifier que la date est une chaîne de caractères
    if (!is_string($date))
    {
        $messagesErreurs[] = "La date de naissance doit être une chaîne de caractères.";
        $valide = false;
    }

    // 3. Longueur des chaînes
    if (strlen($date) !== 10)
    {
        $messagesErreurs[] = "La date de naissance doit être une chaîne de longueur 10.";
        $valide = false;
    }

    // 4. Format des données : vérifier que la date suit le format YYYY-MM-DD
    /* Dans le formulaire HTML, l'utilisateur saisit la date au format jj/mm/aaaa, mais lorsque la date est transmise au serveur,
     elle est convertie automatiquement par le navigateur en format ISO (YYYY-MM-DD) et c'est sous ce format que la date est 
     récupérée dans $_POST. L'expression régulière doit donc vérifier que la date est bien au format YYYY-MM-DD */
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date))
    {
        $messagesErreurs[] = "La date de naissance récupérée au niveau du serveur n'est pas au format YYYY-MM-DD.";
        $valide = false;
    }

    // 5. Plages de valeurs : vérifier que la date est comprise entre 1950 et 2010
    // Convertir les dates en timestamp UNIX pour faciliter les comparaisons
    $timestamp = strtotime($date);
    $dateMin = strtotime('1950-01-01');
    $dateMax = strtotime('2010-12-31');

    /// Vérifier que le timestamp de la date est bien dans les bornes spécifiées
    if ($timestamp < $dateMin || $timestamp > $dateMax)
    {
        $messagesErreurs[] = "La date de naissance doit être comprise entre le 1er janvier 1950 et le 31 décembre 2010.";
        $valide = false;
    }
    // 6. Fichiers uploadés : non pertinent pour la date de naissance

    return $valide;
}

/**
 * @brief Valide l'URL du site web (facultatif, format).
 *
 * @param string $site L'URL du site web.
 * @param array &$messagesErreurs Tableau de messages d'erreurs.
 * @return bool Retourne true si l'URL est valide, false sinon.
 */
function validerUrlSiteWeb(string $site, array &$messagesErreurs): bool
{
    $valide = true;

    // 1. Champs obligatoires : l'URL du site est facultative
    if (empty($site))
    {
        // L'URL du site est facultative. Si elle est vide, inutile de faire des validations supplémentaires.
        return $valide; // Aucun message d'erreur, la validation est positive pour un champ facultatif non rempli.
    }

    // 2. Type de données : non pertinent pour une URL

    // 3. Longueur des chaînes : non pertinent pour l'URL

    // 4. Format des données : vérifier que l'URL est valide si fournie
    if (!empty($site) && !filter_var($site, FILTER_VALIDATE_URL))
    {
        $messagesErreurs[] = "L'URL du site web est invalide.";
        $valide = false;
    }

    // 5. Plages de valeurs : non pertinent pour l'URL

    // 6. Fichiers uploadés : non pertinent pour l'URL

    return $valide;
}

/**
 * @brief Valide le numéro de téléphone (facultatif, format, longueur).
 *
 * @param string $telephone Le numéro de téléphone.
 * @param array &$messagesErreurs Tableau de messages d'erreurs.
 * @return bool Retourne true si le numéro de téléphone est valide, false sinon.
 */
function validerTelephone(string $telephone, array &$messagesErreurs): bool
{
    $valide = true;

    // 1. Champs obligatoires : le numéro de téléphone est facultatif
    if (empty($telephone))
    {
        // Le numéro de téléphone est facultatif. S'il est vide, inutile de faire des validations supplémentaires.
        return $valide; // Aucun message d'erreur, la validation est positive pour un champ facultatif non rempli.
    }

    // 2. Type de données : vérifier que le numéro est une chaîne de caractères
    if (!is_string($telephone))
    {
        $messagesErreurs[] = "Le numéro de téléphone doit être une chaîne de caractères.";
        $valide = false;
    }

    // 3. Longueur des chaînes : vérifier que le numéro a 10 caractères (sans séparateurs) ou 14 caractères (avec séparateurs)
    define('LONGUEUR_TELEPHONE_SANS_SEPARATEURS', 10); // Objectif :
    define('LONGUEUR_TELEPHONE_AVEC_SEPARATEURS', 14); // Eviter les nombres magiques dans le code ;-)

    $longueurValide = (strlen($telephone) === LONGUEUR_TELEPHONE_SANS_SEPARATEURS || strlen($telephone) === LONGUEUR_TELEPHONE_AVEC_SEPARATEURS);
    if (!$longueurValide)
    {
        // Construction progressive du message d'erreur
        $message = "Le numéro de téléphone doit comporter exactement ";
        $message .= LONGUEUR_TELEPHONE_SANS_SEPARATEURS . " chiffres ";
        $message .= "ou " . LONGUEUR_TELEPHONE_AVEC_SEPARATEURS . " caractères avec séparateurs.";
        $messagesErreurs[] = $message;
        $valide = false;
    }

    /* 4. Format des données : vérifier que le numéro commence par un 0, est composé de chiffres 
          avec éventuellement des blocs de deux chiffres séparés par des séparateurs */
    if (!preg_match('/^0\d(\s|-|.)?(\d{2}(\s|-|.)?){4}$/', $telephone))
    {
        $messagesErreurs[] = "Le numéro de téléphone est invalide. Veuillez entrer 10 chiffres en commençant par 0, avec ou sans séparateurs (espaces, tirets ou points) entre chaque paire de chiffres.";
        $valide = false;
    }

    // 5. Plages de valeurs : non pertinent pour le téléphone

    // 6. Fichiers uploadés : non pertinent pour le téléphone

    return $valide;
}

/**
 * @brief Valide l'upload et les caractéristiques de la photo de profil.
 * 
 * @param array $photo Le tableau contenant les informations du fichier uploadé ($_FILES['photo_profil']).
 * @param array &$messagesErreurs Un tableau pour enregistrer les messages d'erreur.
 * @return bool Retourne true si la validation réussit, false sinon.
 */
function validerUploadEtPhoto(array $photo, array &$messagesErreurs): bool
{
    // Initialisation de la validité de la photo à true
    $valide = true;

    // Vérifie la présence et l'absence d'erreurs de téléchargement
    if (isset($photo) && $photo['error'] === UPLOAD_ERR_OK)
    {
        // Si le fichier a été téléchargé sans erreur, on procède à la validation du fichier
        $valide = validerPhotoProfil($photo, $messagesErreurs);
    }
    else
    {
        // Gestion des erreurs d'upload
        switch ($photo['error'])
        {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $messagesErreurs[] = "Le fichier dépasse la taille maximale autorisée sur le serveur.";
                $valide = false;
                break;
            case UPLOAD_ERR_PARTIAL:
                $messagesErreurs[] = "Le fichier n'a été que partiellement téléchargé.";
                $valide = false;
                break;
            case UPLOAD_ERR_NO_FILE:
                // Aucun fichier n'est téléchargé. Si le champ est facultatif, on ne marque pas de validation échouée.
                $valide = true; // Indique qu'il n'y a pas d'erreur si le fichier est facultatif
                break;
            default:
                $messagesErreurs[] = "Erreur lors du téléchargement du fichier.";
                $valide = false;
                break;
        }
    }

    return $valide;
}

/**
 * @brief Valide la photo de profil (facultative, type MIME, taille, dimensions).
 *
 * @param array $photo Les informations sur le fichier uploadé.
 * @param array &$messagesErreurs Tableau de messages d'erreurs.
 * @return bool Retourne true si la photo est valide, false sinon.
 */
function validerPhotoProfil(array $photo, array &$messagesErreurs): bool
{
    $valide = true;

    // 1. Champs obligatoires : la photo de profil est facultative
    if ($photo['error'] === UPLOAD_ERR_NO_FILE)
    {
        // La photo de profil est facultative. Si aucun fichier n'est uploadé, on passe directement à la validation positive.
        return $valide; // Aucun message d'erreur, la validation est positive pour un champ facultatif non rempli.
    }

    // 2. Type de données : le type de fichier est vérifié au point 6.

    // 3. Longueur des chaînes : non pertinent pour un fichier

    // 4. Format des données : non pertinent pour un fichier

    // 5. Plages de valeurs : non pertinent pour un fichier

    // 6. Fichiers uploadés - vérifier type et taille
    $typesAutorises = ['image/jpeg', 'image/png'];

    // Vérification du type MIME réel pour contrer les falsifications d’extension
    $typeMimeReel = mime_content_type($photo['tmp_name']);
    if (!in_array($typeMimeReel, $typesAutorises))
    {
        $messagesErreurs[] = "Le fichier doit être au format JPG ou PNG.";
        $valide = false;
    }

    // Vérification du poids du fichier
    $tailleMaxAutoriseeEnOctets = 2 * 1024 * 1024; // 2 Mo
    if ($photo['size'] > $tailleMaxAutoriseeEnOctets)
    {
        $messagesErreurs[] = "Le fichier ne doit pas dépasser 2 Mo.";
        $valide = false;
    }

    // Vérification des dimensions pour s’assurer qu'il s’agit d’une image
    $dimensions = getimagesize($photo['tmp_name']);
    if ($dimensions === false)
    {
        $messagesErreurs[] = "Le fichier doit être une image valide.";
        $valide = false;
    }

    // Suppression du fichier temporaire en cas de validation échouée
    if (!$valide)
    {
        unlink($photo['tmp_name']); // Supprime le fichier temporaire
    }

    return $valide;
}
