<?php

namespace Tests\EchoService;

use PHPUnit\Framework\TestCase;
use App\EchoService\Message;
use App\EchoService\EchoInterface;
use App\EchoService;
use Spiral\GRPC\Server;

class EchoTest extends TestCase
{
    public function testInvoke(): void
    {
        $s = new Server();
        $s->registerService(EchoInterface::class, new EchoService());

        $w = new TestWorker($this, [
            [
                'ctx'     => [
                    'service' => 'service.Echo',
                    'method'  => 'Ping',
                    'context' => [],
                ],
                'send'    => $this->packMessage('hello world'),
                'receive' => $this->packMessage('hello world')
            ]
        ]);

        $s->serve($w);

        $this->assertTrue($w->done());
    }

    public function testNotFound2(): void
    {
        $s = new Server();
        $s->registerService(EchoInterface::class, new EchoService());

        $w = new TestWorker($this, [
            [
                'ctx'   => [
                    'service' => 'service.Echo',
                    'method'  => 'Ping2',
                    'context' => [],
                ],
                'send'  => $this->packMessage('hello world'),
                'error' => '5|:|Method `Ping2` not found in service `service.Echo`.'
            ]
        ]);

        $s->serve($w);

        $this->assertTrue($w->done());
    }

    private function packMessage(string $message): string
    {
        $m = new Message();
        $m->setMsg($message);

        return $m->serializeToString();
    }
}
