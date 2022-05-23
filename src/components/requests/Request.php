<?php
namespace jeyroik\components\requests;

use \GuzzleHttp\ClientInterface;
use jeyroik\interfaces\responses\IResponse;
use jeyroik\components\responses\Response;
use jeyroik\interfaces\requests\IRequest;
use Psr\Http\Message\ResponseInterface;
use jeyroik\components\THasAttributes;

/**
 * Usage:
 * 
 * $request = new Request([
 *  Request::FIELD__METHOD => Request::METHOD__GET,
 *  Request::FIELD__ENDPOINT => 'operationName', //for example getAddressInformation
 *  Request::FIELD__PARAMETERS => [
 *    'param1' => 'value1'
 *  ]
 * ]);
 * 
 * $response = $request->run();
 * 
 * print_r($response->getResult(), true);
 */
class Request implements IRequest
{
    use THasAttributes;

    public function run(): IResponse
    {
        return $this->getMethod() == static::METHOD__GET ? $this->runGet() : $this->runPost();
    }

    public function getMethod(): string
    {
        return $this->attributes[static::FIELD__METHOD] ?? static::METHOD__DEFAULT;
    }

    public function getEndpoint(): string
    {
        $path = $this->attributes[static::FIELD__ENDPOINT] ?? '';

        return $this->getBaseUrl() . $path;
    }

    public function getParameters(): array
    {
        return $this->attributes[static::FIELD__PARAMETERS] ?? [];
    }

    public function getBaseUrl(): string
    {
        return $this->attributes[static::FIELD__BASE_URL] ?? '';
    }

    public function dispatchRequest(string $endpoint, array $parameters): array
    {
        $dispatcherClass = $this->attributes[static::FIELD__DISPATCHER_REQUEST] ?? static::DISPATCHER_REQUEST__DEFAULT;

        if ($dispatcherClass) {
            $dispatcher = new $dispatcherClass();
            list($endpoint, $parameters) = $dispatcher($endpoint, $parameters);
        }

        return [$endpoint, $parameters];
    }

    public function dispatchResponse(ResponseInterface $response): array
    {
        $dispatcherClass = $this->attributes[static::FIELD__DISPATCHER_RESPONSE] ?? static::DISPATCHER_RESPONSE__DEFAULT;

        $status = $response->getStatusCode();
        $body = json_decode($response->getBody(), true);

        if ($dispatcherClass) {
            $dispatcher = new $dispatcherClass();
            list($status, $body) = $dispatcher($status, $body, $response);
        }

        return [$status, $body];
    }

    protected function runGet(): IResponse
    {
        $client = $this->getHttpClient();
        list($endpoint, $parameters) = $this->dispatchRequest($this->getEndpoint() . '?' . http_build_query($this->getParameters()), []);

        $response = $client->request(
            $this->getMethod(), 
            $endpoint,
            $parameters
        );

        list($status, $body) = $this->dispatchResponse($response);

        return new Response([
            Response::FIELD__BODY => $body,
            Response::FIELD__STATUS => $status
        ]);
    }

    protected function runPost(): IResponse
    {
        $client = $this->getHttpClient();
        $parameters = ['form_params' => $this->getParameters()];

        list($endpoint, $parameters) = $this->dispatchRequest($this->getEndpoint() . '?' . http_build_query($this->getParameters()), $parameters);

        $response = $client->request(
            $this->getMethod(), 
            $endpoint,
            $parameters
        );

        list($status, $body) = $this->dispatchResponse($response);

        return new Response([
            Response::FIELD__BODY => $body,
            Response::FIELD__STATUS => $status
        ]);
    }

    protected function getHttpClient(): ClientInterface
    {
        $clientClass = getenv(static::ENV__CLIENT) ?: static::CLIENT__DEFAULT;
        return new $clientClass();
    }
}
