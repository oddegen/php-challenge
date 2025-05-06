<?php

use App\EchoService\EchoInterface;
use App\EchoService;
use Spiral\Goridge\StreamRelay;
use Spiral\GRPC\Server;
use Spiral\RoadRunner\Worker;

ini_set('display_errors', 'stderr');
require __DIR__ . '/vendor/autoload.php';

$server = new Server(null, [
    'debug' => true, // optional (default: false)
]);

$server->registerService(EchoInterface::class, new EchoService());

$worker = new Worker(new StreamRelay(STDIN, STDOUT));

$server->serve($worker);
