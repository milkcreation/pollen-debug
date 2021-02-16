<?php

declare(strict_types=1);

namespace Pollen\Debug;

use Pollen\Container\BaseServiceProvider;

class DebugServiceProvider extends BaseServiceProvider
{
    /**
     * @var string[]
     */
    protected $provides = [
        DebugManagerInterface::class,
        DebugDriverInterface::class
    ];

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->getContainer()->share(DebugManagerInterface::class, function () {
            return new DebugManager([], $this->getContainer());
        });

        $this->getContainer()->share(DebugDriverInterface::class, function () {
            return new PhpDebugBarDriver($this->getContainer()->get(DebugManagerInterface::class));
        });
    }
}