<?php

declare(strict_types=1);

namespace Pollen\Debug;

/**
 * @mixin \Pollen\Debug\ErrorHandlerInterface
 */
trait ErrorHandlerAwareTrait
{
    /**
     * Enabling indicator.
     * @var bool
     */
    protected bool $enabled = false;

    /**
     * Enabling.
     *
     * @return ErrorHandlerInterface|static
     */
    public function enable(): ErrorHandlerInterface
    {
        $this->enabled = true;

        return $this;
    }

    /**
     * Disabling.
     *
     * @return ErrorHandlerInterface|static
     */
    public function disable(): ErrorHandlerInterface
    {
        $this->enabled = false;

        return $this;
    }

    /**
     * Checks if its enabled.
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }
}