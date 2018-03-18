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
- php bin/console debug:autowiring
### Annotations (pour les roots en commentaire)
- composer require annotations
### Barre de debug
- composer require profiler --dev
### Add "encore" > add webpack.config.js
- composer require encore
### Asset support (ex : for add css/js)
- composer require asset
### Security : 
- composer require sec-checker
- php bin/console security:check
- [packagist](https://packagist.org/packages/sensiolabs/security-checker)
### Package
- [packagist](https://packagist.org)
- [symfony.sh](https://symfony.sh)
### PHPStorm
- [shortcuts PC/Mac](https://www.thirdandgrove.com/8-must-use-shortcuts-for-phpstorm)

## Form :
composer require form
### Validator (@Assert)
composer require validator
### Source 
- https://symfony.com/doc/current/doctrine/registration_form.html
- http://symfony.com/doc/current/forms.html
- https://openclassrooms.com/courses/developpez-votre-site-web-avec-le-framework-symfony/creer-des-formulaires-avec-symfony, section "Personnaliser l'affichage d'un formulaire"
### Required field form
**NEW BROWSER > Class ProductType (for remove the default 'required'):**
>->add('price', NumberType::class, array('required'  => false))

**OLD BROWSER > class Product (entity) :**

*(You can use NotBlank or NotNull)*
>@Assert\NotBlank
>
>@ORM\Column(type="decimal", scale=2, nullable=true)
>
>private $price;

## RECIPE :
- https://github.com/symfony/recipes
- https://github.com/symfony/recipes-contrib
- Ex : composer req admin 
(https://github.com/javiereguiluz/EasyAdminBundle)

## FAKER
### tuto : https://blog.dev-web.io/

## Make :
### Pour créer un CRUD 
composer require security-csrf
php bin/console make:crud User
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
ou 
php bin/console doctrine:schema:update --dump-sql
### Lance la migration
php bin/console doctrine:migrations:migrate
ou 
php bin/console doctrine:schema:update --force
### Rendu Sql (for the fun)
php bin/console doctrine:query:sql 'SELECT * FROM product'

### Propriétaire / Inverse
Propriétaire : celui qui stockera xxx_id (ex : address_id)
https://openclassrooms.com/courses/developpez-votre-site-web-avec-le-framework-symfony2/les-relations-entre-entites-avec-doctrine2#/id/r-2086605

## Pagination :
[KNP Paginator](https://github.com/KnpLabs/KnpPaginatorBundle)

## TWIG :
Doc : https://twig.symfony.com/doc/2.x/
### Theme
http://symfony.com/doc/current/form/form_customization.html

> _/config/packages/twig.yaml_ :
>
> twig:
>
>     form_themes: ['bootstrap_4_horizontal_layout.html.twig']

## DEBUG : 
- Php (in controller) : dump($your_var, $this, $other);
- Twig : {{ dump() }}
- composer require profiler --dev
- composer require debug

## Test Unit :
- https://symfony.com/doc/current/testing.html

## Command : 
- php bin/console debug:router
- php bin/console cache:clear
