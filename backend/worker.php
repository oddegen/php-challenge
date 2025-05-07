<?php

use App\EchoService\EchoInterface;
use App\EchoService;
use Spiral\Goridge\StreamRelay;
use Spiral\GRPC\Server;
use Spiral\RoadRunner\Worker;

require __DIR__ . '/vendor/autoload.php';

$server = new Server(null, [
    'debug' => false,
]);

$server->registerService(EchoInterface::class, new EchoService());

$worker = new Worker(new StreamRelay(STDIN, STDOUT));

$server->serve($worker);
