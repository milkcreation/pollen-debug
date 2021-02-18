<?php

declare(strict_types=1);

namespace Pollen\Debug;

interface DebugBarInterface
{
    /**
     * Activation.
     *
     * @return static
     */
    public function enable(): DebugBarInterface;

    /**
     * Désactivation
     *
     * @return static
     */
    public function disable(): DebugBarInterface;

    /**
     * Récupération du pied de page du site
     *
     * @return string
     */
    public function renderFooter(): string;

    /**
     * Récupération de l'entête du site
     *
     * @return string
     */
    public function renderHead(): string;

    /**
     * Récupération du rendu de l'affichage
     *
     * @return string
     */
    public function render(): string;
}