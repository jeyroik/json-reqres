<?php
namespace jeyroik\interfaces\requests;

use jeyroik\interfaces\responses\IResponse;
use jeyroik\interfaces\IHaveAttributes;

interface IRequest extends IHaveAttributes
{
    public const FIELD__METHOD = 'method';
    public const METHOD__GET = 'GET';
    public const METHOD__POST = 'POST';
    public const METHOD__DEFAULT = self::METHOD__GET;

    public const FIELD__ENDPOINT = 'endpoint';

    public const FIELD__PARAMETERS = 'parameters';
    public const FIELD__BASE_URL = 'base_url';

    public const FIELD__DISPATCHER_REQUEST = 'dispatcher_request';
    public const DISPATCHER_REQUEST__DEFAULT = '\\jeyroik\\components\\requests\\dispatchers\\ApiKey';

    public const FIELD__DISPATCHER_RESPONSE = 'dispatcher_response';
    public const DISPATCHER_RESPONSE__DEFAULT = '\\jeyroik\\components\\responses\\dispatchers\\WrapResult';

    public const ENV__CLIENT = 'REQRES__CLIENT';
    public const CLIENT__DEFAULT = '\\GuzzleHttp\\Client';

    public function run(): IResponse;

    public function getMethod(): string;
    public function getEndpoint(): string;
    public function getParameters(): array;
    public function getBaseUrl(): string;
}
