<?php
namespace jeyroik\interfaces\requests\dispatchers;

interface IDispatcher
{
    /**
     * @return array [<endpoint>, <parameters>]
     */
    public function __invoke(string $endpoint, array $requestParameters): array;
}
