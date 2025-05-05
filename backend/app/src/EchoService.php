<?php

namespace App;

use Spiral\GRPC\ContextInterface;
use App\Echo\EchoInterface;
use App\Echo\Message;

class EchoService implements EchoInterface
{
    public function Ping(ContextInterface $ctx, Message $in): Message
    {
        $out = new Message();
        return $out->setMsg(strtoupper($in->getMsg()));
    }
}
