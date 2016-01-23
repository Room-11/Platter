<?php declare(strict_types=1);

namespace Room11\Platter\WebSocket;

use Aerys\WebSocket;
use Aerys\Request;
use Aerys\Response;
use Aerys\Websocket\Endpoint;
use Aerys\Websocket\Message;
use Room11\Platter\WebSocket\Client\Collection;
use Room11\Platter\WebSocket\Client\Unauthenticated;

class Handler implements WebSocket
{
    private $clients;

    private $endpoint;

    public function __construct(Collection $clients)
    {
        $this->clients = $clients;
    }

    public function onStart(Endpoint $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function onHandshake(Request $request, Response $response)
    {
        return $request->getConnectionInfo()['client_addr'];
    }

    public function onOpen(int $clientId, $handshakeData)
    {
        $this->clients->add(new Unauthenticated($clientId));

        $this->endpoint->send($clientId, json_encode([
            'type'    => 'debug',
            'message' => 'connected',
        ]));
    }

    public function onData(int $clientId, Message $msg)
    {
        $this->endpoint->send($clientId, yield $msg);
    }

    public function onClose(int $clientId, int $code, string $reason)
    {
        $this->clients->delete($clientId);
    }

    public function onStop()
    {

    }
}
