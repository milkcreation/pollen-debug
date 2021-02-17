<?php

declare(strict_types=1);

namespace Pollen\Debug;

use Pollen\Support\Concerns\BootableTrait;
use Pollen\Support\Concerns\ConfigBagTrait;
use Pollen\Support\Concerns\ContainerAwareTrait;
use Psr\Container\ContainerInterface as Container;
use Whoops\Run as ErrorHandler;
use Pollen\Support\Env;

class DebugManager implements DebugManagerInterface
{
    use ConfigBagTrait;
    use BootableTrait;
    use ContainerAwareTrait;

    /**
     * Instance du gestionnaire d'erreurs.
     * @var object
     */
    protected $errorHandler;

    /**
     * Instance du pilote de barre de débogage.
     * @var DebugBarInterface
     */
    protected $debugBar;

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

        if ($this->config('boot_enabled', true)) {
            $this->boot();
        }
    }

    /**
     * @inheritDoc
     */
    public function boot(): DebugManagerInterface
    {
        if (!$this->isBooted()) {
            if ($this->config('debug_bar.enabled', Env::isDev())) {
                $this->debugBar();
            }

            if ($this->config('error_handler.enabled', Env::isDev())) {
                $this->errorHandler();
            }

            $this->setBooted();
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function debugBar(): DebugBarInterface
    {
        if ($this->debugBar === null) {
            $this->debugBar = new PhpDebugBarDriver($this);
        }

        return $this->debugBar;
    }

    /**
     * @inheritDoc
     */
    public function errorHandler(): object
    {
        if ($this->errorHandler === null) {
            $this->errorHandler  = (new ErrorHandler())
                    ->pushHandler(new WhoopsErrorHandlerRenderer($this))
                    ->register();
        }
        return $this->errorHandler;
    }
}