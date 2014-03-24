<?php

namespace Craft\App\Plugin;

use Craft\App\Event\NotFound;
use Craft\App\Plugin;
use Craft\App\Request;
use Craft\Text\Regex;

class FlatFiles extends Plugin
{

    /** @var string */
    protected $route = '/([a-zA-Z0-9-_.]+)';

    /** @var string */
    protected $root;

    /** @var string */
    protected $ext;


    /**
     * Set root dir
     * @param string $root
     * @param string $ext
     */
    public function __construct($root = null, $ext = null)
    {
        $this->root = rtrim($root, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        $this->ext = '.' . ltrim($ext, '.');
    }


    /**
     * Handle request
     * @param Request $request
     * @throws \Craft\App\Event\NotFound
     * @return Request
     */
    public function before(Request $request)
    {
        // route
        if($data = Regex::match($request->query, $this->route)) {

            // get filename
            $filename = array_shift($data);
            $filename = ltrim($filename, DIRECTORY_SEPARATOR);

            // file not found
            if(!file_exists($this->root . $filename . $this->ext)) {
                throw new NotFound('Route "' . $request->query . '" not found.');
            }

            // set meta render
            $request->action = function() {};
            $request->meta['render'] = $this->root . $filename . $this->ext;

            return $request;
        }
        // 404
        else {
            throw new NotFound('Route "' . $request->query . '" not found.');
        }
    }

} 