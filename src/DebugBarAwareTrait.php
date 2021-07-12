<?php

declare(strict_types=1);

namespace Pollen\Debug;

/**
 * @mixin \Pollen\Debug\DebugBarInterface
 */
trait DebugBarAwareTrait
{
    /**
     * Enabling indicator.
     * @var bool
     */
    protected bool $enabled = false;

    /**
     * Enabling.
     *
     * @return DebugBarInterface|static
     */
    public function enable(): DebugBarInterface
    {
        $this->enabled = true;

        return $this;
    }

    /**
     * Disabling.
     *
     * @return DebugBarInterface|static
     */
    public function disable(): DebugBarInterface
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