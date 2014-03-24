<?php

/**
 * Hello !
 */
require 'vendor/autoload.php';


/**
 * Time tracking
 */

use Craft\Trace\Tracker;

$tracker = new Tracker();
$tracker->start('app');


/**
 * Database connector
 */

use Craft\Orm\Syn;

Syn::SQLite('vinylbox.db')
    ->map('artist', 'My\Model\Artist')
    ->map('album', 'My\Model\Album')
    ->map('track', 'My\Model\Track')
    ->build();


/**
 * Route mapping
 */

$app = new Craft\App\Bundle([
    '/'             => 'My\Logic\Manager::dashboard',
    '/artist/:id'   => 'My\Logic\Manager::artist',
    '/album/:id'    => 'My\Logic\Manager::album',
    '/lost'         => 'My\Logic\Error::lost',
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


/**
 * Tracking report
 */

echo $tracker->end('app')->report();