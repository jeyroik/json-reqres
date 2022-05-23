<?php
namespace jeyroik\components\requests\dispatchers;

use jeyroik\interfaces\requests\dispatchers\IDispatcher;

/**
 * Adds header X-API-KEY.
 * Token is getting from the current environment by REQRES__API_KEY__TOKEN name.
 */
class ApiKey implements IDispatcher
{
    protected const FIELD__HEADERS = 'headers';
    protected const FIELD__API_KEY = 'X-API-KEY';
    
    protected const TOKEN__ENV = 'REQRES__API_KEY__TOKEN';
    protected const TOKEN__DEFAULT = 'test';

    /**
     * @return array [<endpoint>, <parameters>]
     */
    public function __invoke(string $endpoint, array $requestParameters): array
    {
        if(!isset($requestParameters[static::FIELD__HEADERS])) {
            $requestParameters[static::FIELD__HEADERS] = [];
        }

        if (!isset($requestParameters[static::FIELD__HEADERS][static::FIELD__API_KEY])) {
            $requestParameters[static::FIELD__HEADERS][static::FIELD__API_KEY] = $this->getApiKeyToken();
        }

        return [$endpoint, $requestParameters];
    }

    protected function getApiKeyToken(): string
    {
        return getenv(static::TOKEN__ENV) ?? static::TOKEN__DEFAULT;
    }
}
