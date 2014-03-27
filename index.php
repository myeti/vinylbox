<?php

/**
 * Hello !
 */
require 'vendor/autoload.php';


/**
 * Config
 */
define('OWNER',     'Babor Lelefan');
define('COVER_DIR', '/public/img/cover/');
@chmod(COVER_DIR, 0777);


/**
 * Database connector
 */

use Craft\Orm\Syn;

Syn::MySQL('vinylbox_db')
    ->map('artist', 'My\Model\Artist')
    ->map('album',  'My\Model\Album')
    ->map('track',  'My\Model\Track')
    ->build();


/**
 * Route mapping
 */

$app = new Craft\App\Bundle([

    '/'                     => 'My\Logic\Front::hello',

    '/artist/create'        => 'My\Logic\Artists::create',
    '/artist/:id/update'    => 'My\Logic\Artists::update',
    '/artist/:id/delete'    => 'My\Logic\Artists::delete',
    '/artist/:id'           => 'My\Logic\Artists::show',

    '/album/create/:artist' => 'My\Logic\Albums::create',
    '/album/:id/update'     => 'My\Logic\Albums::update',
    '/album/:id/delete'     => 'My\Logic\Albums::delete',
    '/album/:id'            => 'My\Logic\Albums::show',

    '/lost'                 => 'My\Logic\Front::lost',
]);


/**
 * Error 404
 */
$app->on(404, function() use($app) {
    $app->to('/lost');
});


/**
 * Open the VinylBox !
 */
$app->handle();