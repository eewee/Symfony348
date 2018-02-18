# SYMFONY 4 :

## Creer un nouveau projet dans le dossier sf4
composer create-project symfony/skeleton sf4

## Lancer un serveur :
php -S 127.0.0.1:8000 -t public

ou

composer require server

bin/console server:run

### Ouvrir le serveur (browser)
http://localhost:8000/

## Vrac :
### AutoWiring
php bin/console debug:autowiring
### Annotations (pour les roots en commentaire)
composer require annovations
### Barre de debug
composer require profiler --dev

## Form :
composer require form
### Validator
composer require validator
### Source 
- https://symfony.com/doc/current/doctrine/registration_form.html
- http://symfony.com/doc/current/forms.html
- https://openclassrooms.com/courses/developpez-votre-site-web-avec-le-framework-symfony/creer-des-formulaires-avec-symfony    

## Make :
### Pour la génération de code
composer require maker-bundle
### Pour créer une controller
php bin/console make:controller Posts
### Pour créer un form
php bin/console make:form Post
### Entite Post
php bin/console make:entity Post

## DB (ORM / Doctrine):
### ORM
composer require orm
### Doctrine
composer require doctrine maker
### Config .env 
- db_user
- db_password
- db_host
- db_name
### create db
php bin/console doctrine:database:create
### create entity class
php bin/console make:entity Product
### Génère le sql à utiliser pour la migration (db)
php bin/console doctrine:migrations:diff
### Lance la migration
php bin/console doctrine:migrations:migrate
### Rendu Sql (for the fun)
php bin/console doctrine:query:sql 'SELECT * FROM product'

## Vrac :
### Add "encore" > add webpack.config.js
composer require encore
### Asset support (ex : for add css/js)
composer require asset
### Security : 
- composer require sec-checker
- php bin/console security:check
- [packagist](https://packagist.org/packages/sensiolabs/security-checker)

### Package
- [packagist](https://packagist.org)
- [symfony.sh](https://symfony.sh)

## TWIG :
Doc : https://twig.symfony.com/doc/2.x/
### Theme
http://symfony.com/doc/current/form/form_customization.html

## DEBUG : 
- Php (in controller) : dump($your_var, $this, $other);
- Twig : {{ dump() }}
- composer require profiler --dev
- composer require debug

## Command : 
- php bin/console debug:router
- php bin/console cache:clear
