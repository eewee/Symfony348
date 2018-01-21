# SYMFONY 4 :

## Creer un nouveau projet dans le dossier sf4
composer create-project symfony/skeleton sf4

## Lancer un serveur :
php -S 127.0.0.1:8000 -t public

## Ouvrir le serveur (browser)
http://localhost:8000/

ou

composer require server

bin/console server:run

## AutoWiring
php bin/console debug:autowiring

## Annotations (pour les roots en commentaire)
composer require annovations

## Barre de debug
composer require profiler --dev

## Form
composer require form
## validator
composer require validator
## ORM
composer require orm

## Pour la génération de code
composer require maker-bundle
### Pour créer une controller
php bin/console make:controller Posts
### Pour créer un form
php bin/console make:form Post
### Entite Post
php bin/console make:entity Post

### Génère le sql à utiliser pour la migration (db)
php bin/console doctrine:migrations:diff
### Lance la migration
php bin/console doctrine:migrations:migrate

## Add "encore" > add webpack.config.js
composer require encore

## Asset support (ex : for add css/js)
composer require asset

## Security : 
composer require sec-checker

php bin/console security:check

[packagist](https://packagist.org/packages/sensiolabs/security-checker)

## Package : 
[packagist](https://packagist.org)

[symfony.sh](https://symfony.sh)

# TWIG :
Doc : https://twig.symfony.com/doc/2.x/

# DEBUG : 
Php (in controller) : dump($your_var, $this, $other);
Twig : {{ dump() }}

composer require profiler --dev

composer require debug

Command : bin/console debug:router