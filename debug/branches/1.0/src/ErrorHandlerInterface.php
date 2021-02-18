<?php

declare(strict_types=1);

namespace Pollen\Debug;

interface ErrorHandlerInterface
{
    /**
     * Activation.
     *
     * @return static
     */
    public function enable(): ErrorHandlerInterface;

    /**
     * Désactivation
     *
     * @return static
     */
    public function disable(): ErrorHandlerInterface;
}