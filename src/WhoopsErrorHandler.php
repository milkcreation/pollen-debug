<?php

declare(strict_types=1);

namespace Pollen\Debug;

use BadMethodCallException;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
use Throwable;

class WhoopsErrorHandler implements ErrorHandlerInterface
{
    /**
     * Indicateur d'activation.
     * @var bool
     */
    protected $enabled = false;

    /**
     * @var DebugManagerInterface
     */
    protected $debugManager;

    /**
     * @var Run
     */
    private $whoops;

    /**
     * @param DebugManagerInterface $debugManager
     */
    public function __construct(DebugManagerInterface $debugManager)
    {
        $this->debugManager = $debugManager;
        $this->whoops = new Run();
    }

    /**
     * Délégation d'appel des méthodes de Whoops.
     *
     * @param string $method
     * @param array $arguments
     *
     * @return mixed
     */
    public function __call(string $method, array $arguments)
    {
        try {
            return $this->whoops->{$method}(...$arguments);
        } catch (Throwable $e) {
            throw new BadMethodCallException(
                sprintf(
                    'Cookie Instance method call [%s] throws an exception: %s',
                    $method,
                    $e->getMessage()
                )
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function enable(): ErrorHandlerInterface
    {
        if (!$this->whoops->getHandlers()) {
            $this->whoops->pushHandler(new PrettyPageHandler());
        }

        $this->whoops->register();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function disable(): ErrorHandlerInterface
    {
        $this->whoops->unregister();

        return $this;
    }
}
