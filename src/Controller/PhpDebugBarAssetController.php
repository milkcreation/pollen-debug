<?php

declare(strict_types=1);

namespace Pollen\Debug\Controller;

use Pollen\Debug\PhpDebugBarDriver;
use Pollen\Http\ResponseInterface;
use Pollen\Routing\BaseController;
use Pollen\Support\Proxy\DebugProxy;

class PhpDebugBarAssetController extends BaseController
{
    use DebugProxy;

    protected ?PhpDebugBarDriver $debugBar = null;

    /**
     * @return ResponseInterface
     */
    public function js(): ResponseInterface
    {
        $renderer = $this->debugBar()->getJavascriptRenderer();

        $content = '';
        foreach($renderer->getAssets('js') as $asset) {
            $content .= file_get_contents($asset) . "\n";
        }

        foreach($renderer->getAssets('inline_js') as $asset) {
            $content .= file_get_contents($asset) . "\n";
        }

        $response = $this->response($content, 200, [
            'Content-Type' => 'text/javascript',
        ]);

        return $this->cachedResponse($response);
    }

    /**
     * @return ResponseInterface
     */
    public function css(): ResponseInterface
    {
        $renderer = $this->debugBar()->getJavascriptRenderer();

        $content = '';
        foreach($renderer->getAssets('css') as $asset) {
            $content .= file_get_contents($asset) . "\n";
        }

        foreach($renderer->getAssets('inline_css') as $asset) {
            $content .= file_get_contents($asset) . "\n";
        }

        $response = $this->response($content, 200, [
            'Content-Type' => 'text/css',
        ]);

        return $this->cachedResponse($response);
    }

    /**
     * @return PhpDebugBarDriver
     */
    protected function debugbar(): PhpDebugBarDriver
    {
        if ($this->debugBar === null) {
            $this->debugBar = $this->debug()->debugBar();
        }

        return $this->debugBar;
    }
}