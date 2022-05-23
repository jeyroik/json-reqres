<?php
namespace tests;

use jeyroik\interfaces\requests\dispatchers\IDispatcher;

class Dispatcher404 implements IDispatcher
{
    /**
     * @return array [<endpoint>, <parameters>]
     */
    public function __invoke(string $endpoint, array $requestParameters): array
    {
        $requestParameters['http_errors'] = false;

        return [$endpoint, $requestParameters];
    }
}
