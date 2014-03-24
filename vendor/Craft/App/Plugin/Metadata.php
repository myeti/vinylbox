<?php

namespace Craft\App\Plugin;

use Craft\App\Plugin;
use Craft\App\Request;
use Craft\Reflect\Resolver;
use Craft\Reflect\ResolverInterface;

class Metadata extends Plugin
{

    /** @var ResolverInterface */
    protected $resolver;


    /**
     * Set resolver
     * @param ResolverInterface $resolver
     */
    public function __construct(ResolverInterface $resolver = null)
    {
        $this->resolver = $resolver ?: new Resolver;
    }


    /**
     * Handle request
     * @param Request $request
     * @return Request
     */
    public function before(Request $request)
    {
        $action = $this->resolver->resolve($request->action);
        $request->action = $action->callable;
        $request->meta = array_merge($request->meta, $action->meta);

        return $request;
    }

}