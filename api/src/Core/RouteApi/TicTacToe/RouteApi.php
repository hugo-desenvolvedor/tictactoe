<?php
declare(strict_types=1);

namespace App\RouteApi\TicTacToe;

abstract class RouteApi
{
    /**
     * @var array $payload
     */
    private $payload;

    /**
     * @param mixed ...$params
     * @return mixed
     */
    abstract public function handle(array $params);

    /**
     * @param array $payload
     */
    public function setPayload(array $payload): void
    {
        $this->payload = $payload;
    }

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return $this->payload;
    }
}