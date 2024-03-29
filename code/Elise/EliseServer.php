<?php

namespace Elise;

use utils\Server;

require_once "utils/Server.php";

class EliseServer implements Server
{
    private static int $serverNumber = 0;
    private int $id;
    private string $ip;

    public function __construct(string $ip)
    {
        $this->id = ++self::$serverNumber;
        $this->ip = $ip;
    }

    public function process(string $data): string
    {
        return "\nEffet appliqué sur " . $data . " par le serveur Elise #" . $this->id . " à l'adresse : " . $this->ip . "\n";
    }
}