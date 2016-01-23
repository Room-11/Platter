<?php declare(strict_types=1);

namespace Room11\Platter\Authentication;

class RequestCollection
{
    const GC_THRESHOLD = 10;

    const EXPIRATION_TIME = 'PT5M';

    private $requests;

    public function add(Request $request)
    {
        $this->requests[] = $request;

        $this->collectGarbage();
    }

    public function exists(string $key): bool
    {
        foreach ($this->requests as $i => $request) {
            if ($this->isExpired($request->getTimestamp()) || $request->getKey() !== $key) {
                continue;
            }

            return true;
        }

        return false;
    }

    public function get(string $key): Request
    {
        foreach ($this->requests as $i => $request) {
            if ($this->isExpired($request->getTimestamp()) || $request->getKey() !== $key) {
                continue;
            }

            return $request;
        }

        throw new \Exception('Invalid authentication request or request is expired.');
    }

    private function collectGarbage()
    {
        if (count($this->requests) < self::GC_THRESHOLD) {
            return;
        }

        $this->invalidateExpired();
    }

    private function invalidateExpired()
    {
        foreach ($this->requests as $i => $request) {
            if (!$this->isExpired($request->getTimestamp())) {
                return;
            }

            unset($this->requests[$i]);
        }
    }

    private function isExpired(\DateTimeImmutable $timestamp): bool
    {
        $expirationTimestamp = $timestamp->add(new \DateInterval(self::EXPIRATION_TIME));

        return $expirationTimestamp < (new \DateTime());
    }
}
