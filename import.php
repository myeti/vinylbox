<?php

/**
 * Hello !
 */
require 'vendor/autoload.php';


/**
 * Config
 */
define('DEV', true);
define('COVER_DIR', '/public/img/cover/');
@chmod(COVER_DIR, 0777);


/**
 * Database connector
 */

use Craft\Orm\Syn;
if(!DEV) {
    Syn::MySQL('vinylbox_db')
        ->map('artist', 'My\Model\Artist')
        ->map('album',  'My\Model\Album')
        ->map('track',  'My\Model\Track')
        ->build();
}

/**
 * Import xml file
 */
use Craft\Storage\File;
use My\Model\Album;
use My\Model\Artist;
use My\Model\Track;

// stats
$time = microtime(true);
$count = [
    'artists' => 0,
    'albums' => 0,
    'tracks' => 0
];

// albums
$xml = simplexml_load_file('import/collection.xml');
foreach($xml->album as $node) {

    // get artist
    $artist = DEV ? false : Artist::one(['fullname' => $node->artist]);
    if(!$artist) {
        $artist = new Artist;
        $artist->fullname = $node->artist;
        $artist->country = $node->pays;
        $artist->id = DEV ? uniqid() : Artist::save($artist);
        $count['artists']++;
    }

    // create album
    $album = new Album;
    $album->artist_id = $artist->id;
    $album->title = (string)$node->titre;
    $album->date = (string)$node->annee;
    $album->genre = (string)$node->genre;

    // infos
    if((string)$node->compositeur) {
        $album->infos .= 'Compositeur : ' . (string)$node->compositeur . "\n";
    }
    if((string)$node->parolier) {
        $album->infos .= 'Parolier : ' . (string)$node->parolier . "\n";
    }
    if((string)$node->editeur) {
        $album->infos .= 'Editeur : ' . (string)$node->editeur . "\n";
    }
    if((string)$node->musiciens) {
        $album->infos .= 'Musiciens : ' . (string)$node->musiciens . "\n";
    }
    if((string)$node->chef) {
        $album->infos .= 'Chef : ' . (string)$node->chef . "\n";
    }
    if((string)$node->orchestre) {
        $album->infos .= 'Orchestre : ' . (string)$node->orchestre . "\n";
    }
    if((string)$node->reference) {
        $album->infos .= 'Réference : ' . (string)$node->reference . "\n";
    }
    if((string)$node->dateAchat) {
        $album->infos .= 'Achat : ' . (string)$node->dateAchat . "\n";
    }
    if((string)$node->commentaire) {
        $album->infos .= 'Commentaire : ' . (string)$node->commentaire . "\n";
    }

    $id = DEV ? uniqid() : Album::save($album);
    $count['albums']++;

    // cover
    $file = 'import/' . str_replace('\\', '/', $node->image->fichier);
    if(file_exists($file) and $file != 'import/') {
        $album->cover = COVER_DIR . $id . '.' . pathinfo($file, PATHINFO_EXTENSION);
        File::write($file, path($album->cover));
    }

    // add tracks
    foreach($node->disques->disque as $subnode) {

        $i = 'A';

        // side 1
        foreach($subnode->faceA->plage as $plage) {
            $track = new Track;
            $track->side = $i . '1';
            $track->title = (string)$plage->titre;
            $track->duration = date('i:s', (int)$plage->duree);
            $track->album_id = $id;
            if(!DEV) {
                Track::save($track);
            }
            $count['tracks']++;
        }

        // side 2
        foreach($subnode->faceB->plage as $plage) {
            $track = new Track;
            $track->side = $i . '2';
            $track->title = (string)$plage->titre;
            $track->duration = date('i:s', (int)$plage->duree);
            $track->album_id = $id;
            if(!DEV) {
                Track::save($track);
            }
            $count['tracks']++;
        }

        $i++;
    }

}

$now = microtime(true);
echo 'finished : ', $count['artists'], ' artists, ', $count['albums'],
' albums and ', $count['tracks'], ' tracks in ', number_format($now - $time, 4), 's.';