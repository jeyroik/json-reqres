<?php
namespace jeyroik\interfaces\responses\dispatchers;

use Psr\Http\Message\ResponseInterface;

interface IDispatcher
{
    /**
     * @return array [<string status>, <array body>]
     */
    public function __invoke(int $status, array $body, ResponseInterface $response): array;
}
