<?php

declare(strict_types=1);

namespace Pollen\Debug;

class DebugDriver implements DebugDriverInterface
{
    /**
     * Instance du gestionnaire de débogage
     * @var DebugManagerInterface
     */
    protected $debugManager;

    /**
     * Instance de l'adapter du pilote associé.
     * @var object|null
     */
    protected $adapter;

    /**
     * @param DebugManager $debugManager
     * @param object|null $adapter
     */
    public function __construct(DebugManager $debugManager, ?object $adapter = null)
    {
        $this->debugManager = $debugManager;

        if (!is_null($adapter)) {
            $this->setAdapter($adapter);
        }
    }

    /**
     * @inheritDoc
     */
    public function adapter(): ?object
    {
        return $this->adapter;
    }

    /**
     * @inheritDoc
     */
    public function getFooter(): string
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function getHead(): string
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function setAdapter(object $adapter): DebugDriverInterface
    {
        $this->adapter = $adapter;

        return $this;
    }
}
