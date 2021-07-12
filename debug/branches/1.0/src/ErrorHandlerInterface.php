<?php

declare(strict_types=1);

namespace Pollen\Debug;

interface ErrorHandlerInterface
{
    /**
     * Enabling.
     *
     * @return static
     */
    public function enable(): ErrorHandlerInterface;

    /**
     * Disabling.
     *
     * @return static
     */
    public function disable(): ErrorHandlerInterface;

    /**
     * Checks if its enabled.
     *
     * @return bool
     */
    public function isEnabled(): bool;
}