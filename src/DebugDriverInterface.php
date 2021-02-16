<?php

declare(strict_types=1);

namespace Pollen\Debug;

interface DebugDriverInterface
{
    /**
     * Récupération de l'adapteur.
     *
     * @return object|null
     */
    public function adapter(): ?object;

    /**
     * Récupération du pied de page du site
     *
     * @return string
     */
    public function getFooter(): string;

    /**
     * Récupération de l'entête du site
     *
     * @return string
     */
    public function getHead(): string;

    /**
     * Récupération du rendu de l'affichage
     *
     * @return string
     */
    public function render(): string;

    /**
     * Définition de l'adapteur.
     *
     * @param object $adapter
     *
     * @return static
     */
    public function setAdapter(object $adapter): DebugDriverInterface;
}