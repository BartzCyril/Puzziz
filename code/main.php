<?php

use Bill\BillServer;
use Diego\DiegoServer;
use Elise\EliseServer;
use utils\MODIFICATIONS;

require_once "Bill/BillServer.php";
require_once "Diego/DiegoServer.php";
require_once "Elise/EliseServer.php";
require_once "utils/Modifications.php";

$items = [
    [
        'name' => 'Server Diego',
        'ip' => '192.168.123.101'
    ],
    [
        'name' => 'Server Diego',
        'ip' => '192.168.123.102'
    ],
    [
        'name' => 'Server Diego',
        'ip' => '192.168.123.103'
    ],
    [
        'name' => 'Server Diego',
        'ip' => '192.168.123.104'
    ],
    [
        'name' => 'Server Diego',
        'ip' => '192.168.123.105'
    ],
    [
        'name' => 'Server Elise',
        'ip' => '192.168.123.201'
    ],
    [
        'name' => 'Server Elise',
        'ip' => '192.168.123.202'
    ],
    [
        'name' => 'Server Elise',
        'ip' => '192.168.123.203'
    ],
    [
        'name' => 'Server Elise',
        'ip' => '192.168.123.204'
    ],
    [
        'name' => 'Server Elise',
        'ip' => '192.168.123.205',
    ]];

$servers = array();

foreach ($items as $item) {
    if ($item['name'] === "Server Elise") {
        $servers[] = new EliseServer($item['ip']);
    } else {
        $servers[] = new DiegoServer($item['ip']);
    }
}

$billServer = new BillServer($servers);

$billServer->sendTransformations([MODIFICATIONS::EFFECT, MODIFICATIONS::EFFECT, MODIFICATIONS::FILTER, MODIFICATIONS::EFFECT, MODIFICATIONS::FILTER, MODIFICATIONS::FILTER], 'image1.png');
$billServer->sendTransformations([MODIFICATIONS::EFFECT, MODIFICATIONS::FILTER], 'image2.png');
$billServer->sendTransformations([MODIFICATIONS::FILTER, MODIFICATIONS::FILTER, MODIFICATIONS::FILTER, MODIFICATIONS::EFFECT, MODIFICATIONS::FILTER, MODIFICATIONS::EFFECT], 'image3.png');
