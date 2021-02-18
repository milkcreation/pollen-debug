<?php

declare(strict_types=1);

namespace Pollen\Debug;

/**
 * @mixin \Pollen\Support\Concerns\ConfigBagTrait
 * @mixin \Pollen\Support\Concerns\ContainerAwareTrait
 */
interface DebugManagerInterface
{
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