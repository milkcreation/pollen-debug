<?php

declare(strict_types=1);

namespace Pollen\Debug;

use DebugBar\DataCollector\ConfigCollector;
use DebugBar\DataCollector\ExceptionsCollector;
use DebugBar\DataCollector\MemoryCollector;
use DebugBar\DataCollector\MessagesCollector;
use DebugBar\DataCollector\PhpInfoCollector;
use DebugBar\DataCollector\RequestDataCollector;
use DebugBar\DataCollector\TimeDataCollector;
use DebugBar\DebugBar;
use DebugBar\DebugBarException;
use Pollen\Debug\Controller\PhpDebugBarAssetController;
use Pollen\Routing\RouteInterface;
use Pollen\Support\Proxy\RouterProxy;

class PhpDebugBarDriver extends DebugBar implements DebugBarInterface
{
    use DebugBarAwareTrait;
    use RouterProxy;

    protected DebugManagerInterface $debugManager;

    protected ?RouteInterface $debugBarJsRoute = null;

    protected ?RouteInterface $debugBarCssRoute = null;

    /**
     * @param DebugManagerInterface $debugManager
     */
    public function __construct(DebugManagerInterface $debugManager)
    {
        $this->debugManager = $debugManager;

        try {
            $this->addCollector(new PhpInfoCollector());
            $this->addCollector(new MessagesCollector());
            $this->addCollector(new ConfigCollector());
            $this->addCollector(new RequestDataCollector());
            $this->addCollector(new TimeDataCollector());
            $this->addCollector(new MemoryCollector());
            $this->addCollector(new ExceptionsCollector());
        } catch (DebugBarException $e) {
            unset($e);
        }

        $routePrefix = '_debugbar';

        $this->debugBarJsRoute = $this->router()->get(
            "$routePrefix/js", [PhpDebugBarAssetController::class, 'js']
        );
        $this->debugBarCssRoute = $this->router()->get(
            "$routePrefix/css", [PhpDebugBarAssetController::class, 'css']
        );
    }

    /**
     * @inheritDoc
     */
    public function getJavascriptRenderer($baseUrl = null, $basePath = null)
    {
        if ($this->jsRenderer === null) {
            $this->jsRenderer = new PhpDebugBarJavascriptRender($this, $baseUrl, $basePath);
        }
        return $this->jsRenderer;
    }

    /**
     * @inheritDoc
     */
    public function renderFooter(): string
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function renderHeadCss(): string
    {
        $href = $this->router()->getRouteUrl($this->debugBarCssRoute);

        return "<link rel=\"stylesheet\" type=\"text/css\" href=\"$href\">";
    }

    /**
     * @inheritDoc
     */
    public function renderHeadJs(): string
    {
        $src = $this->router()->getRouteUrl($this->debugBarJsRoute);

        $output = "<script type=\"text/javascript\" src=\"$src\"></script>";

        $renderer = $this->getJavascriptRenderer();
        if ($renderer->isJqueryNoConflictEnabled() && !$renderer->isRequireJsUsed()) {
            $output .= "<script type=\"text/javascript\">jQuery.noConflict(true);</script>\n";
        }

        return $output;
    }

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        return $this->getJavascriptRenderer()->render();
    }
}
