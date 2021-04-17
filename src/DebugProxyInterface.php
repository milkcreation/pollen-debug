<?php

declare(strict_types=1);

namespace Pollen\Debug;

interface DebugProxyInterface
{
    /**
     * Instance du gestionnaire de débogage.
     *
     * @return DebugManagerInterface
     */
    public function debug(): DebugManagerInterface;

    /**
     * Définition du gestionnaire de débogage.
     *
     * @param DebugManagerInterface $debugManager
     *
     * @return void
     */
    public function setDebugManager(DebugManagerInterface $debugManager): void;
}