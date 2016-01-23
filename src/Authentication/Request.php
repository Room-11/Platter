<?php declare(strict_types=1);

namespace Room11\Platter\Authentication;

class Request
{
    private $userId;

    private $timestamp;

    private $key;

    public function __construct(int $userId, \DateTimeImmutable $timestamp)
    {
        $this->userId    = $userId;
        $this->timestamp = $timestamp;
        $this->key       = bin2hex(random_bytes(32));
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getTimestamp(): \DateTimeImmutable
    {
        return $this->timestamp;
    }

    public function getKey(): string
    {
        return $this->key;
    }
}
