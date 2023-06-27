# WEFRIP' PROJECT
PROJET POUR NOTRE SOUTENANCE SUR L'UPCYCLING 
Notre site propose une expérience interactive avec une carte interactive pour localiser les centres de collecte, les magasins de fripes ainsi que des tutoriels.

# Welcome! 👋
Pour relever cet exercice, vous devez avoir des connaissances de base en HTML, CSS, PHP ET SYMFONY. 

# L'exercice
Votre exercice est de construire un site fonctionnel avec une map où les membres peuvent ajouter des marqueurs, les voir, les modifier et également voir des tutorials qu'ils peuvent mettre en favori. 

Vos utilisateurs devraient être en mesure de :

- Naviguer sur le site en tant qu'utilisateur anonyme et voir les évènements et les tutorials
- Naviguer sur le site en tant que membre inscrit, proposer des évènements (vides-dressings, ateliers) et voir des tutorials et pouvoir les mettre en favori dans leur profil. 

# Où tout trouver
Votre tâche consiste à élaborer le projet à partir de PHP et du framework SYMFONY. 
Vous devez aussi télécharger la bibliothèque LEAFLET.

# Pré requis pour le projet :
– télécharger Composer (packages PHP) et l'exécuter
– Faire un repository Git
– s’assurer que la commande PHP est bien disponible dans le terminal : php -v
– Installer la CLI de Symfony : https://symfony.com/download scoop install symfony-cli
– Lancer la commande symfony check:requirements pour s’assurer que tout est ok
– Relancer tous les terminaux et lancer la commande symfony -v

# Construction de votre projet
N'hésitez pas à utiliser le flux de travail qui vous convient. Vous trouverez ci-dessous une suggestion de processus, mais ne vous sentez pas obligé de suivre ces étapes :

Une fois que tous les pré-requis sont réunis, on lance la commande pour créer l’arborescence de notre projet Symfony : symfony new ProjectName –webapp –version=5.4
Configurez la base de données dans le fichier .env en ajoutant les informations de connexion appropriées.
Générez la structure de la base de données : php bin/console doctrine:database:create
Créer les entités et les propriétés avec la commande php bin/console make:entity, créer aussi l'entité make:user
Migration de la base de données vers phpMyAdmin en exécutant la commande make:migration
Création du dashboard avec php bin/console make:controller
Création du CRUD 
Et enfin on lance la commande qui permet d’importer les packages fixtures : composer require –dev orm-fixtures 
puis on créé les dossiers de fixtures avec la commande : php bin/console make:fixture
Lancez le serveur de développement : symfony server:start
Accédez à l'application dans votre navigateur à l'adresse http://localhost:8000
Initialisez votre projet en tant que dépôt public sur GitHub. La création d'un dépôt facilitera le partage de votre code avec la communauté si vous avez besoin d'aide. Si vous n'êtes pas sûr de savoir comment procéder, lisez attentivement cette ressource Essayer Git.
Configurez votre dépôt pour publier votre code à une adresse web. Cela sera également utile si vous avez besoin d'aide pendant un exercice, car vous pouvez partager l'URL de votre projet avec l'URL de votre dépôt. Il y a plusieurs façons de le faire, et nous fournissons quelques recommandations ci-dessous.
Déployer votre projet


# Contribution
Les contributions à ce projet sont les bienvenues. Si vous souhaitez apporter des améliorations, veuillez suivre ces étapes :

# Fork du projet depuis le référentiel GitHub.
Créez une branche pour votre fonctionnalité

# Il existe plusieurs endroits où vous pouvez partager votre solution :
Partagez votre page de solution dans le canal #finished-projects de la communauté Slack.
Partagez votre solution sur d'autres canaux sociaux comme LinkedIn.
