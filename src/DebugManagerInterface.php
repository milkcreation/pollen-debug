<?php

declare(strict_types=1);

namespace Pollen\Debug;

/**
 * @mixin \Pollen\Support\Concerns\BootableTrait
 * @mixin \Pollen\Support\Concerns\ConfigBagTrait
 * @mixin \Pollen\Support\Concerns\ContainerAwareTrait
 */
interface DebugManagerInterface
{
    /**
     * Chargement.
     *
     * @return static
     */
    public function boot(): DebugManagerInterface;

    /**
     * Instance du pilote associé.
     *
     * @return DebugDriverInterface
     */
    public function driver(): DebugDriverInterface;

    /**
     * Récupération du pied de page du site.
     *
     * @return string
     */
    public function getFooter(): string;

    /**
     * Récupération de l'entête du site.
     *
     * @return string
     */
    public function getHead(): string;

    /**
     * Récupération du rendu de l'affichage.
     *
     * @return string
     */
    public function render(): string;
}