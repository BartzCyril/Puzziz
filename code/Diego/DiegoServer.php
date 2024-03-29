<?php

namespace Diego;

use utils\Server;

require_once "utils/Server.php";

class DiegoServer implements Server
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
        return "\nFiltre appliqué sur " . $data . " par le serveur Diego #" . $this->id . " à l'adresse : " . $this->ip . "\n";
    }
}