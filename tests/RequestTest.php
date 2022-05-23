<?php

use PHPUnit\Framework\TestCase;
use jeyroik\components\requests\Request;

class RequestTest extends TestCase
{
    public function testDefault()
    {
        $request = new Request([
            Request::FIELD__METHOD => Request::METHOD__GET,
            Request::FIELD__BASE_URL => 'https://api.github.com/',
            Request::FIELD__ENDPOINT => 'users/jeyroik',
            Request::FIELD__PARAMETERS => [
                'param1' => 'value1'
            ]
        ]);

        $response = $request->run();

        $this->assertTrue(isset($response->getResult()['login']));
        $this->assertEquals(200, $response->getStatus());
    }

    public function testPost()
    {
        $request = new Request([
            Request::FIELD__METHOD => Request::METHOD__POST,
            Request::FIELD__BASE_URL => 'https://api.github.com/',
            Request::FIELD__ENDPOINT => 'users/jeyroik',
            Request::FIELD__DISPATCHER_REQUEST => '\\tests\\Dispatcher404',
            Request::FIELD__PARAMETERS => [
                'param1' => 'value1'
            ]
        ]);

        $response = $request->run();
 
        $this->assertTrue(isset($response->getResult()['message']));
        $this->assertEquals(404, $response->getStatus());
    }
}
