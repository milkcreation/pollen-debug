<?php

declare(strict_types=1);

namespace Pollen\Debug;

use DebugBar\DebugBar;
use DebugBar\JavascriptRenderer;
use Pollen\Routing\RouteInterface;
use Pollen\Support\Proxy\DebugProxy;

class PhpDebugBarJavascriptRender extends JavascriptRenderer
{
    use DebugProxy;

    protected ?RouteInterface $debugBarJsRoute = null;

    protected ?RouteInterface $debugBarCssRoute = null;

    public function __construct(DebugBar $debugBar, $baseUrl = null, $basePath = null)
    {
        parent::__construct($debugBar, $baseUrl, $basePath);

        $this->cssVendors['fontawesome'] = dirname(__DIR__) . '/resources/assets/dist/css/font-awesome.css';
    }
}