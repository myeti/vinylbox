# Craft 2.1.1

Craft est un framework PHP5.4+ simple, précis et efficace pour construire des webapps performantes.
Cet outil ne fournit que le strict nécessaire et utile, le reste dépend de votre créativité !

### Aperçu

Créer une app en 2min ? Facile : déployez le package sur votre serveur local ou distant,
pointez votre sous-domaine éventuel vers la racine et vérifiez bien que PHP 5.4 est activé.

le fichier `index.php` est configurer par défaut pour une utilisation basique :

```php
<?php

require 'vendor/autoload.php';

$app = new Craft\App\Bundle([
    '/'         => 'My\Logic\Front::hello',
    '/lost'     => 'My\Logic\Error::lost',
    '/sorry'    => 'My\Logic\Error::sorry'
]);

$app->handle();
```

Ici, l'app est initialisée avec 3 routes :
- la landing page
- l'erreur 404
- l'erreur 403

A vous de customisez et d'ajouter vos routes vers vos actions !


### Plus loin

Si vous souhaitez créer votre app personalisée et non utiliser le bundle,
il est possible d'utiliser directement le coeur, et d'ajouter vos propres plugins (voir la classe `Craft\App\Plugin`) :

```php
<?php

require 'vendor/autoload.php';

$app = new Craft\App\Kernel;

// ajout d'un router
$app->plug(new Craft\App\Plugin\Router([
    '/'         => 'My\Logic\Front::hello',
    '/lost'     => 'My\Logic\Error::lost',
    '/sorry'    => 'My\Logic\Error::sorry'
]);

// utilisation des templates
$app->plug(new Craft\App\Plugin\Templates);

$app->handle();
```


### Et la base de données ?

Vous utilisez une base de dev en local ainsi que des classes pour mapper vos entités ?

```php
<?php

use Craft\Orm\Syn;

Syn::MySQL('nomdeladb')
    ->map('user', 'Your\User')
    ->build(); // créer la table user en fonction de votre classe

$users = Syn::all('user');
$users = Syn::all('user', ['id =' => 10]); // or
$users = Syn::get('user')->where('age =', 10)->all();

$user = Syn::one('user', ['id =' => 10]); // or
$user = new Your\User;
$user->age = 15;

Syn::save('user', $user);

Syn::get('user')->where('id =', 2)->drop();
```

Votre MySQL est sur un serveur distant ?

```php
Syn::MySQL('nomdeladb', [
    'host' => '123.12.12',
    'username' => 'Foo',
    'password' => 'Bar',
    'prefix' => 'app_'
]);
```

SQLite peut-être ?

```php
Syn::SQLite('votrefichier.db');
```

Non vraiment, vous souhaitez utiliser votre propre driver `PDO` :

```php
$pdo = new \PDO(...);
$jar = new Craft\Orm\Jar($pdo);

Syn::load($jar);
```

Aussi simple que ça !