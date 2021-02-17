<?php

declare(strict_types=1);

namespace Pollen\Debug;

use Whoops\Handler\PrettyPageHandler;

class WhoopsErrorHandlerRenderer extends PrettyPageHandler
{
    /**
     * @var DebugManagerInterface
     */
    protected $debugManager;

    /**
     * @param DebugManagerInterface $debugManager
     */
    public function __construct(DebugManagerInterface $debugManager)
    {
        $this->debugManager = $debugManager;

        parent::__construct();

        if ($editor = $this->debugManager->config('editor')) {
            $this->setEditor($editor);
        }
    }
}