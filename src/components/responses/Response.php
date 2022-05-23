<?php
namespace jeyroik\components\responses;

use jeyroik\interfaces\responses\IResponse;
use jeyroik\components\THasAttributes;

class Response implements IResponse
{
    use THasAttributes;

    public function getResult(): array
    {
        return $this->getBody()[static::FIELD__RESULT] ?? [];
    }

    public function getBody(): array
    {
        return $this->attributes[static::FIELD__BODY] ?? [];
    }

    public function getStatus(): int
    {
        return $this->attributes[static::FIELD__STATUS] ?? 0;
    }
}
