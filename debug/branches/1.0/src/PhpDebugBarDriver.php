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
use DebugBar\JavascriptRenderer;
use Pollen\Http\UrlHelper;

class PhpDebugBarDriver extends DebugBar implements DebugBarInterface
{
    use DebugBarAwareTrait;

    /**
     * @var DebugManagerInterface
     */
    protected $debugManager;

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

        $this->jsRenderer = new JavascriptRenderer(
            $this, (new UrlHelper())->getAbsoluteUrl('/vendor/maximebf/debugbar/src/DebugBar/Resources')
        );
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
    public function renderHead(): string
    {
        return $this->enabled ? $this->getJavascriptRenderer()->renderHead(): '';
    }

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        return $this->enabled ? $this->getJavascriptRenderer()->render() : '';
    }
}
