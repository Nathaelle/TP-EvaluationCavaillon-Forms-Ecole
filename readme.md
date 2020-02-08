# TP Evaluation de fin de 2nde période : PHP-MySQL Cavaillon session 2019-2020

------------------------------------------------

## Eléments de correction

1. MCD (voir fichier mcd)
2. Implémenter le schéma dans MySQL (avec Doctrine)
    - Modification du fichier .env
    - Création de la base de données `php bin/console doctrine:database:create`

    Création des entities: `php bin/console make:entity NomDeLaTable`
    Création spécifique pour l'utilisateur: `php bin/console make:user User`

    Une fois les entités créées, créer le fichier de migration: `php bin/console make:migration`
    Et l'exécuter: `php bin/console doctrine:migration:migrate`

3. Insertion de données via les fixtures: 
    - Installer le bundle: `composer require doctrine/doctrine-fixtures-bundle`
    - Installer Faker: `composer require fzaninotto/faker`

4. Création du controller responsable de l'espace perso: `php bin/console make:controller PersoController`
    - Définition des 3 méthodes pour l'affichage des 3 vues demandées + routes + création de 2 templates supplémentaires
    - Implémentation des traitements pour chaque vue

5. Ajout des restrictions (access_control) dans security.yaml
    - Création de 4 utilisateurs via fixtures
    - Création Authenticator: `php bin/console make:auth` -> par formulaire 
    - Ajout redirection vers espace perso si authentification réussie
    - Ajout du chemin vers le formulaire de login dans le menu du site

    - Modification d'un utilisateur pour compte Mme Delcourt: `php bin/console doctrine:query:sql "UPDATE user SET pseudo = 'delcourt', roles = '[\"ROLE_ADMIN\"]' WHERE user.id = 1;"`
    - Création d'un AdminController pour Mme Delcourt, (et du template associé): `php bin/console make:controller AdminController`
    - Ajout dans le menu d'un lien d'accès à l'espace admin pour Mme Delcourt seulement
    
6. Création d'un formulaire d'ajout d'un nouvelle thématique: `php bin/console make:form ThematiqueType`
Création du formulaire d'ajout d'un nouveau questionnaire : `php bin/console make:form QuestionnaireType`

Création du formulaire d'ajout d'une nouvelle question, et des réponses associées: `php bin/console make:form QuestionType`

7. Création d'un controller pour la gestion de la soumission des questionnaires: `php bin/console make:controller ResultController`

8. Modification de notre entité UserQuestionnaire (ajout clé composite) (puis migration vers la base)
    - Modification de notre PersoController pour récupérer les notes
    - Modification du template

9. Moyenne par thématique et affichage

## Enoncé initial

>Mme Delcourt, professeure des écoles, aimerait disposer d'un outil pédagogique innovant pour évaluer les acquis de ses élèves. 
>Elle aimerait pouvoir, en fonction des thématiques abordées en classe, disposer d'un outil lui permettant de proposer un bilan des notions vues sous la forme de QCM (questions à choix multiples).
>
>Pour ne pas déstabiliser les élèves, le principe sera toujours le même : Mme Delcourt conçoit, en fonction des matières ou thématiques, un questionnaire. 
>Si le nombre de questions de celui-ci n'est pas connu à l'avance, en revanche, le nombre de réponses possibles l'est.
>De ce fait, pour chaque question, l'élève aura le choix entre 4 réponses possibles.
>
>Mme Delcourt souhaite concevoir elle-même les questionnaires, aussi, elle devra pouvoir:
> - créer un questionnaire
> - y ajouter un certain nombre de questions
> - définir 4 réponses pour chaque question, en indiquant en plus quelle réponse est la bonne
> - pouvoir organiser ses questionnaires dans une thématique précise
>
>Chaque élève pourra accéder aux questionnaires sur son espace personnel.
>Il pourra : 
> - répondre à un questionnaire
> - obtenir une note, qui sera visible pour les questionnaires auxquels il aura répondu
> - obtenir une moyenne par thématique 

>Nous regrouperons les élèves et Mme Delcourt au sein d'un même objet de gestion: les utilisateurs, qui auront un pseudo de connexion, un mot de passe, et un niveau d'autorisation.
>Les thématiques auront un nom.
>Les questionnaires un titre.
>Les questions un intitulé.
>Les réponses un libellé, ainsi qu'un attribut de vérification (qui contiendra vrai | faux)
>Les résultats une note (qui correspondra à la fois à un questionnaire, ainsi qu'à un élève)
>
>### PARTIE 1
>1. Analyser la problématique. Dégager les données utiles. Etablir le MCD. En dégager le MLD, puis le MPD.
>2. Implémenter le système dans MySQL, directement ou en utilisant Doctrine (le choix vous est laissé sur l'utilisation ou non d'un framework)
>3. Insérer des données dans le système, en prenant en considération les contraintes de clés étrangères (en SQL directement, ou en utilisant des fixtures)
>
>### PARTIE 2
>4. Afficher les données sur une page « mon espace » selon 3 vues différentes: 
>- toutes les thématiques 
>- questionnaires par thématiques
>- questions (et réponses) d'un questionnaire 
>
>### PARTIE 3
>5. Gestion des comptes utilisateurs: Faites en sorte que seul un élève connecté puisse accéder à ses questionnaires, et que seule Mme Delcourt puisse ajouter un nouveau questionnaire.
>6. Créer le formulaire pour l'ajout d'un nouveau questionnaire pour Mme Delcourt.
>
>### PARTIE 4
>7. Faites en sorte que les questionnaires soient fonctionnels: lorsqu'un élève répond à l'un d'eux, son résultat est calculé (en fonction du nombre de questions, ce peut-être un pourcentage ou une note /nombre de questions).
>8. Lorsqu'un questionnaire à déjà été réalisé par un élève, il ne peut plus y répondre, et son résultat apparaît à coté.
>9. La moyenne des résultats apparaîtra par thématique 