<?php

declare(strict_types=1);

namespace Pollen\Debug;

/**
 * @mixin \Pollen\Debug\ErrorHandlerInterface
 */
trait ErrorHandlerAwareTrait
{
    /**
     * Indicateur d'activation.
     * @var bool
     */
    protected $enabled = false;

    /**
     * Activation.
     *
     * @return ErrorHandlerInterface|static
     */
    public function enable(): ErrorHandlerInterface
    {
        $this->enabled = true;

        return $this;
    }

    /**
     * Desactivation.
     *
     * @return ErrorHandlerInterface|static
     */
    public function disable(): ErrorHandlerInterface
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