<?php

declare(strict_types=1);

namespace Pollen\Debug;

use BadMethodCallException;
use Exception;
use Throwable;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

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
     *
     * @throws Exception
     */
    public function __call(string $method, array $arguments)
    {
        try {
            return $this->whoops->{$method}(...$arguments);
        } catch (Exception $e) {
            throw $e;
        } catch (Throwable $e) {
            throw new BadMethodCallException(
                sprintf(
                    "Delegate [%s] method call [%s] throws an exception: %s",
                    Run::class,
                    $method,
                    $e->getMessage()
                ), 0, $e
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