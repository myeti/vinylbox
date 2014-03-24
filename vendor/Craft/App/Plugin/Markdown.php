<?php

namespace Craft\App\Plugin;

use Craft\App\Plugin;
use Craft\App\Request;
use Craft\App\Response;
use Craft\Text\Markdown as MarkdownParser;

class Markdown extends Plugin
{

    /** @var MarkdownParser */
    protected $md;


    /**
     * Setup markdown parser
     */
    public function __construct()
    {
        $this->md = new MarkdownParser;
    }


    /**
     * Format markdown text
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function after(Request $request, Response $response)
    {
        $response->content = $this->md->perform($response->content);
        return $response;
    }

} 