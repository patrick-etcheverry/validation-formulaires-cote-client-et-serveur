# Validation des formulaires côté client et côté serveur

Ce dépôt héberge des codes à vocation pédagogique illustrant comment mettre en place des validation de formulaires à la fois côté client et côté serveur. Les codes proposés ont pour objectif d’aider les étudiants à comprendre comment structurer et organiser le code pour gérer la validation de formulaires de manière rigoureuse et méthodique.

Ce dépôt est donc avant tout un support pédagogique et a été conçu pour offrir une base de travail. N’hésitez pas à adapter les exemples de code à votre projet pour répondre aux spécificités de votre application.

## Structure du dépôt

Ce dépôt est structuré en plusieurs commits et branches de travail, chacun correspondant à une étape ou une technique spécifique de validation.

#### Description des commits

Les commits sont organisés pour correspondre aux étapes clés de la validation côté client :
- **commit 3ddf834** : il contient le code de départ du formulaire sans aucune validation.
- **commit 124dd01** : il contient une première amélioration dans laquelle les champs du formulaire ont été typés pour mettre en place les premières vérifications.
- **commit 82ffad0** : des validations côté client (vérification du format de certaines données, de la longueur de certains champs...) ont été ajoutées.
- **commit fa85385** :  des directives de guidage ont été ajoutées via les balises *placeholder* et *title* pour accompagner l'utilisteur dans sa saisie.

#### Description des branches

A partir du **commit fa85385** , le projet de divise en 3 branches distinctes, chacune implantant une validation côté serveur avec une technique et une organisation du code différente :
- **branche technique-1-validation-serveur** : elle contient un code qui montre comment mettre en place une validation côté serveur avec des fonctions de validation dédiées à chaque champ du formulaire. Cette approche est simple et adaptée aux petits formulaires.
- **branche technique-2-validation-serveur** : elle contient un code qui montre comment mettre en place une validation côté serveur à l'aide d'un tableau de configuration qui centralise les règles à vérifier. L’approche permet de rendre le code plus flexible et de faciliter l’ajout de nouveaux champs au formulaire sans avoir à écrire de nouvelles fonctions de validation.
- **branche technique-3-validation-serveur** : elle contient un code qui montre comment mettre en place une validation côté serveur à l'aide d'une classe de validation dédiée. La classe centralise le process de validation afin d'avoir un code modulaire et réutilisable dans divers projets.

## Récupération du dépôt et paramétrage
Pour cloner ce dépôt sur votre machine locale, exécutez la commande suivante :
```bash
git clone https://github.com/patrick-etcheverry/validation-formulaires-cote-client-et-serveur.git
```
Pour tester la fonctionnalité d’upload de fichier côté serveur, il est nécessaire de vérifier que le l'utilisateur Apache dispose des droits d’accès au dossier *uploads*. Voici quelques pistes à considérer selon votre système d’exploitation :

#### Windows
Sur Windows, assurez-vous qu’Apache a les autorisations de lecture/écriture sur le dossier *uploads*. Vous général vous pouvez effectuer cette opération avec un clic droit sur le dossier, puis en sélectionnant *Propriétés > Sécurité* et en ajoutant l’utilisateur système correspondant à Apache avec des permissions en lecture / écriture.

#### Linux
Selon la configuration de votre distribution Linux, il sera d'abord nécessaire d'identifier le nom de l'utilisateur Apache. Généralement, il s'agit de noms comme *www-data*, *apache* ou encore *http*.

Pour identifier ce nom vous pouvez utiliser l'une des commandes ci-dessous :
```bash
ps aux | grep apache
```
```bash
ps aux | grep httpd
```
Dans le résultat qui s'affiche, la première colonne correspond à l'utilisateur associé au processus Apache.

Une fois que vous avez identifié le nom de l'utilisateur apache vous pouvez, pour les tests, le rendre propriétaire du dossier *uploads*. Par exemple :
```bash
sudo chown -R http:http uploads
```

## Consulter les différentes versions de code disponibles

#### Concernant les validations côté client

- Pour voir comment faire évoluer le formulaire en typant ses champs :
```bash
git checkout 124dd01
```

- Pour voir comment ajouter quelques règles de validation :
```bash
git checkout 82ffad0
```

- Pour voir comment ajouter un peu de guidage pour l'utilisateur :
```bash
git checkout fa85385
```

- Pour revenir au code de départ :
```bash
git checkout master
```

#### Concernant les validations côté serveur

- Pour voir l'organisation du code avec la mise en place de fonctions de validation dédiées :
```bash
git switch technique-1-validation-serveur
```

- Pour voir l'organisation du code avec un tableau de configuration centralisant les règles de validation :
```bash
git switch technique-2-validation-serveur
```

- Pour voir l'organisation du code avec une classe de validation dédiée :
```bash
git switch technique-3-validation-serveur
```

- Pour revenir au code de départ :
```bash
git switch master
```
