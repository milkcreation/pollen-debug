<?php

declare(strict_types=1);

namespace Pollen\Debug;

/**
 * @mixin \Pollen\Debug\DebugBarInterface
 */
trait DebugBarAwareTrait
{
    /**
     * Indicateur d'activation.
     */
    protected bool $enabled = false;

    /**
     * Activation.
     *
     * @return DebugBarInterface|static
     */
    public function enable(): DebugBarInterface
    {
        $this->enabled = true;

        return $this;
    }

    /**
     * Desactivation.
     *
     * @return DebugBarInterface|static
     */
    public function disable(): DebugBarInterface
    {
        $this->enabled = false;

        return $this;
    }

    /**
     * Vérification d'activation.
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }
}