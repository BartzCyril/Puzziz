<?php

namespace utils;
interface Server
{
    /**
     * Cette fonction représente la réponse du serveur lorsque l'image est modifiée
     * @param string $data L'image à traiter
     * @return string La réponse du serveur
     */
    public function process(string $data): string;
}