<?php declare(strict_types=1);

namespace Room11\Platter\WebSocket\Client;

class Collection
{
    private $clients = [];

    public function add(Client $client)
    {
        $this->clients[$client->getId()] = $client;
    }

    public function delete(int $clientId)
    {
        unset($this->clients[$clientId]);
    }
}
