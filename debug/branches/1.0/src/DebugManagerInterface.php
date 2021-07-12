<?php

declare(strict_types=1);

namespace Pollen\Debug;

use Pollen\Support\Concerns\BootableTraitInterface;
use Pollen\Support\Concerns\ConfigBagAwareTraitInterface;
use Pollen\Support\Proxy\ContainerProxyInterface;

interface DebugManagerInterface extends
    BootableTraitInterface,
    ContainerProxyInterface,
    ConfigBagAwareTraitInterface
{
    /**
     * Booting.
     *
     * @return void
     */
    public function boot(): void;

    /**
     * Debug bar instance.
     *
     * @return DebugBarInterface
     */
    public function debugBar(): DebugBarInterface;


    /**
     * Error handler instance.
     *
     * @return ErrorHandlerInterface
     */
    public function errorHandler(): ErrorHandlerInterface;
}