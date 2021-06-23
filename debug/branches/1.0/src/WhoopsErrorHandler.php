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
    use ErrorHandlerAwareTrait;

    protected ?DebugManagerInterface $debugManager = null;

    private Run $whoops;

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

        $this->enabled = true;
        $this->whoops->register();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function disable(): ErrorHandlerInterface
    {
        $this->enabled = false;
        $this->whoops->unregister();

        return $this;
    }
}
