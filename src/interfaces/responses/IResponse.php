<?php
namespace jeyroik\interfaces\responses;

use jeyroik\interfaces\IHaveAttributes;

interface IResponse extends IHaveAttributes
{
    public const FIELD__BODY = 'body';
    public const FIELD__STATUS = 'status';

    public const FIELD__RESULT = 'result';

    public function getResult(): array;
    public function getBody(): array;
    public function getStatus(): int;
}
