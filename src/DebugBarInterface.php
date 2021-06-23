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
     * Vérification d'activation.
     *
     * @return bool
     */
    public function isEnabled(): bool;

    /**
     * Récupération du pied de page du site
     *
     * @return string
     */
    public function renderFooter(): string;

    /**
     * Récupération du rendu des feuilles de styles CSS.
     *
     * @return string
     */
    public function renderHeadCss(): string;

    /**
     * Récupération du rendu des feuilles de scripts JS.
     *
     * @return string
     */
    public function renderHeadJs(): string;

    /**
     * Récupération du rendu de l'affichage
     *
     * @return string
     */
    public function render(): string;
}