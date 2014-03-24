<?php

namespace Craft\Steam;

class Hildegarde extends Zeppelin
{

    /**
     * Setup zeppelin
     * @param array $roads
     */
    public function __construct(array $roads = [])
    {
        // setup airship
        parent::__construct();

        // defaults routes
        $roads = $roads + [
            '/'         => Zeppelin::go('home'),
            '/lost'     => Zeppelin::go('lost'),
            '/sorry'    => Zeppelin::go('sorry'),
        ];

        // add gears
        $this->engine->plug(new Crew\Cartographer($roads));
        $this->engine->plug(new Crew\Technician);
        $this->engine->plug(new Crew\Officer);
        $this->engine->plug(new Crew\Artist);

        // get ref
        $engine = $this->engine;

        // handle 404
        $this->engine->on(404, function() use($engine) {
            $engine->to('/lost');
        });

        // handle 403
        $this->engine->on(403, function() use($engine) {
            $engine->to('/sorry');
        });
    }

}