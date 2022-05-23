<?php
namespace jeyroik\components\responses\dispatchers;

use jeyroik\interfaces\responses\dispatchers\IDispatcher;
use jeyroik\interfaces\responses\IResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * Wrap response into field IResponse::FIELD__RESULT
 */
class WrapResult implements IDispatcher
{
    /**
     * @return array [<string status>, <array body>]
     */
    public function __invoke(int $status, array $body, ResponseInterface $response): array
    {
        if (!isset($body[IResponse::FIELD__RESULT])) {
            $body[IResponse::FIELD__RESULT] = $body;
        }

        return [$status, $body];
    }
}
