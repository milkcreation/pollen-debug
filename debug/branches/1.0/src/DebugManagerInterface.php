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
     * Chargement.
     *
     * @return void
     */
    public function boot(): void;

    /**
     * Instance du pilote de barre de débogage.
     *
     * @return DebugBarInterface
     */
    public function debugBar(): DebugBarInterface;


    /**
     * Instance du gestionnaire d'erreurs.
     *
     * @return ErrorHandlerInterface
     */
    public function errorHandler(): ErrorHandlerInterface;
}