<?php

interface Server
{
    public function process($data): string;
}

class EliseServer implements Server
{
    private static int $serverNumber = 0;
    private string $ip;

    public function __construct(string $ip)
    {
        self::$serverNumber++;
        $this->ip = $ip;
    }

    public function process($data): string
    {
        return "Effet appliqué sur " . $data . " par le serveur Elise #" . EliseServer::$serverNumber++ . "à l'adresse : " . $this->ip . "\n";
    }
}

class DiegoServer implements Server
{

    private static int $serverNumber = 0;
    private string $ip;

    public function __construct(string $ip)
    {
        self::$serverNumber++;
        $this->ip = $ip;
    }

    public function process($data): string
    {
        return "Filtre appliqué sur " . $data . " par le serveur Diego #" . DiegoServer::$serverNumber . "à l'adresse : " . $this->ip . "\n";
    }
}

class BillServer
{
    private array $servers_filter;
    private array $servers_effect;
    private int $index_effect;
    private int $index_filter;

    public function __construct(array $transformations_servers)
    {
        $this->servers_filter = array_filter($transformations_servers, function ($item) {
            return $item instanceof DiegoServer;
        });
        $this->servers_effect = array_filter($transformations_servers, function ($item) {
            return $item instanceof EliseServer;
        });
        $this->servers_filter = array_values($this->servers_filter);
        $this->servers_effect = array_values($this->servers_effect);
        $this->index_effect = 0;
        $this->index_filter = 0;
    }

    public function sendTransformations($types, $data) : void
    {
        foreach ($types as $type) {
            if ($type === "effet") {
                $this->index_effect = ($this->index_effect + 1) % count($this->servers_effect);
                echo $this->servers_effect[$this->index_effect-1]->process($data);
            } else if ($type === "filtre") {
                $this->index_filter = ($this->index_filter + 1) % count($this->servers_filter);
                echo $this->servers_filter[$this->index_filter-1]->process($data);
            }
        }
    }
}

$items = [
    [
        'nom' => 'Serveur Diego',
        'ip' => '192.168.123.101',
        'operation_type' => 'filtre'
    ],
    [
        'nom' => 'Serveur Diego',
        'ip' => '192.168.123.102',
        'operation_type' => 'filtre'
    ],
    [
        'nom' => 'Serveur Diego',
        'ip' => '192.168.123.103',
        'operation_type' => 'filtre'
    ],
    [
        'nom' => 'Serveur Diego',
        'ip' => '192.168.123.104',
        'operation_type' => 'filtre'
    ],
    [
        'nom' => 'Serveur Diego',
        'ip' => '192.168.123.105',
        'operation_type' => 'filtre'
    ],
    [
        'nom' => 'Serveur Elise',
        'ip' => '192.168.123.201',
        'operation_type' => 'effet'
    ],
    [
        'nom' => 'Serveur Elise',
        'ip' => '192.168.123.202',
        'operation_type' => 'effet'
    ],
    [
        'nom' => 'Serveur Elise',
        'ip' => '192.168.123.203',
        'operation_type' => 'effet'
    ],
    [
        'nom' => 'Serveur Elise',
        'ip' => '192.168.123.204',
        'operation_type' => 'effet'
    ],
    [
        'nom' => 'Serveur Elise',
        'ip' => '192.168.123.205',
        'operation_type' => 'effet'
    ]];

$servers = array();

foreach ($items as $item) {
    if ($item['nom'] === "Serveur Elise") {
        $servers[] = new EliseServer($item['ip']);
    } else {
        $servers[] = new DiegoServer($item['ip']);
    }
}

$billServer = new BillServer($servers);

$sequence = ['effet', 'effet', 'filtre', 'effet', 'filtre', 'filtre'];

$billServer->sendTransformations($sequence, 'image1.png');
