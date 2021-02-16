<?php

declare(strict_types=1);

namespace Pollen\Debug;

use Pollen\Support\Concerns\BootableTrait;
use Pollen\Support\Concerns\ConfigBagTrait;
use Pollen\Support\Concerns\ContainerAwareTrait;
use Psr\Container\ContainerInterface as Container;
use Whoops\Run as ErrorHandler;
use Whoops\Handler\PrettyPageHandler as ErrorHandlerRenderer;
use Pollen\Support\Env;

class DebugManager implements DebugManagerInterface
{
    use ConfigBagTrait;
    use BootableTrait;
    use ContainerAwareTrait;

    /**
     * Instance du pilote associé.
     * @var DebugDriverInterface
     */
    private $driver;

    /**
     * @param array $config
     * @param Container|null $container
     *
     * @return void
     */
    public function __construct(array $config = [], ?Container $container = null)
    {
        $this->setConfig($config);

        if (!is_null($container)) {
            $this->setContainer($container);
        }
    }

    /**
     * @inheritDoc
     */
    public function boot(): DebugManagerInterface
    {
        if (!$this->isBooted()) {
            if (Env::isDev()) {
                $handler = new ErrorHandlerRenderer();
                $handler->setEditor('phpstorm');

                (new ErrorHandler())
                    ->pushHandler($handler)
                    ->register();
            }

            $this->setBooted();
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function driver(): DebugDriverInterface
    {
        if (is_null($this->driver)) {
            $this->driver = $this->containerHas(DebugDriverInterface::class)
                ? $this->containerGet(DebugDriverInterface::class)
                : new DebugDriver($this);
        }

        return $this->driver;
    }

    /**
     * @inheritDoc
     */
    public function getFooter(): string
    {
        return $this->driver()->getFooter();
    }

    /**
     * @inheritDoc
     */
    public function getHead(): string
    {
        return $this->driver()->getHead();
    }

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        return $this->driver()->render();
    }
}