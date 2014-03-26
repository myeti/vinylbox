<?php

namespace My\Logic;

use Craft\Box\Mog;
use Craft\Text\Regex;
use My\Model\Album;
use My\Model\Track;

class Albums
{

    /**
     * Get album
     * @param $id
     * @render views/albums.show
     * @return array
     */
    public function show($id)
    {
        $album = Album::one($id);

        return ['album' => $album];
    }


    /**
     * Create album
     * @render views/albums.form
     * @return array
     */
    public function create($artist)
    {
        // create album
        $album = new Album;
        $album->artist_id = $artist;

        //form submitted
        if($data = Mog::post()) {

            // get tracks
            $sides = $data['sides'];
            unset($data['sides']);

            // save album
            $album = hydrate($album, $data);
            $id = Album::save($album);

            // save tracks
            foreach($sides as $side) {

                // parse side
                $tracks = explode("\n", $side['tracks']);
                foreach($tracks as $line) {

                    // create track
                    $track = new Track;
                    $track->album_id = $id;
                    $track->side = $side['name'];

                    // parse track
                    if($out = Regex::match($line, '/(.*) \(([0-9]+:[0-9]+)\)/')) {
                        $track->title = $out[0];
                        $track->duration = $out[1];
                    }
                    else {
                        $track->title = $line;
                    }

                    // save track
                    Track::save($track);
                }
            }

            go('/#', $artist, $id);
        }

        // fake tracklist
        $tracklist = [
            'A1' => []
        ];

        return [
            'album' => $album,
            'tracklist' => $tracklist
        ];
    }


    /**
     * Update album
     * @render views/albums.form
     * @param $id
     * @return array
     */
    public function update($id)
    {
        // getalbum
        $album = Album::one($id);

        // form submitted
        if($data = Mog::post()) {

            // get tracks
            $sides = $data['sides'];
            unset($data['sides']);

            // save album
            $album = hydrate($album, $data);
            Album::save($album);

            // delete all tracks
            Track::get()->where('album_id', $id)->drop();

            // save tracks
            foreach($sides as $side) {

                // clean
                $side['tracks'] = trim($side['tracks']);
                if(!$side['tracks']) {
                    continue;
                }

                // parse side
                $tracks = explode("\n", $side['tracks']);
                foreach($tracks as $line) {

                    // create track
                    $track = new Track;
                    $track->album_id = $id;
                    $track->side = $side['name'];

                    // parse track
                    if($out = Regex::match($line, '/(.*) \(([0-9]+:[0-9]+)\)/')) {
                        $track->title = $out[0];
                        $track->duration = $out[1];
                    }
                    else {
                        $track->title = $line;
                    }

                    // save track
                    Track::save($track);
                }
            }

            go('/#', $album->artist_id, $id);
        }

        // get tracklist
        $tracklist = $album->tracks() ?: [
            'A1' => []
        ];

        return [
            'album' => $album,
            'tracklist' => $tracklist
        ];
    }


    /**
     * Delete album
     * @param $id
     */
    public function delete($id)
    {
        // get artist id
        $artist = Album::one($id)->artist_id;

        // delete album
        Album::drop($id);

        // delete tracks
        Track::get()->where('album_id', $id)->drop();

        go('/#', $artist);
    }

} 