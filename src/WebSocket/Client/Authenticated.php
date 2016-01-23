<?php declare(strict_types=1);

namespace Room11\Platter\WebSocket\Client;

class Authenticated implements Client
{
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
