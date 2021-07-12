<?php

declare(strict_types=1);

namespace Pollen\Debug;

interface DebugBarInterface
{
    /**
     * Enabling.
     *
     * @return static
     */
    public function enable(): DebugBarInterface;

    /**
     * Disabling.
     *
     * @return static
     */
    public function disable(): DebugBarInterface;

    /**
     * Checks if its enabled.
     *
     * @return bool
     */
    public function isEnabled(): bool;

    /**
     * HTML page footer render.
     *
     * @return string
     */
    public function renderFooter(): string;

    /**
     * HTML page head CSS render.
     *
     * @return string
     */
    public function renderHeadCss(): string;

    /**
     * HTML page head JS render.
     *
     * @return string
     */
    public function renderHeadJs(): string;

    /**
     * HTML page bar render.
     *
     * @return string
     */
    public function render(): string;
}