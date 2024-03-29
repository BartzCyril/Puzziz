<?php

namespace Bill;

use Diego\DiegoServer;
use Elise\EliseServer;
use utils\MODIFICATIONS;

require_once "utils/Modifications.php";

class BillServer
{
    /**
     * @var DiegoServer[]
     */
    private array $servers_filter;
    /**
     * @var EliseServer[]
     */
    private array $servers_effect;
    private int $index_effect;
    private int $index_filter;

    /**
     * @param (EliseServer|DiegoServer)[] $transformations_servers
     */
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

    /**
     * Cette fonction envoie des demandes de transformation à des serveurs spécifiques en fonction des types de modifications à effectuer.
     * Elle utilise un load balancer pour répartir équitablement les demandes entre les serveurs disponibles.
     * @param MODIFICATIONS[] $types
     * @param string $data
     * @return void
     */
    public function sendTransformations(array $types, string $data): void
    {
        foreach ($types as $type) {
            if ($type === MODIFICATIONS::EFFECT) {
                echo $this->servers_effect[$this->index_effect]->process($data);
                $this->index_effect = ($this->index_effect + 1) % count($this->servers_effect);
            } else if ($type === MODIFICATIONS::FILTER) {
                echo $this->servers_filter[$this->index_filter]->process($data);
                $this->index_filter = ($this->index_filter + 1) % count($this->servers_filter);
            }
        }
    }
}