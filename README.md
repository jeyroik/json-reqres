# json-reqres

Simple wrapper for JSON responses.

![tests](https://github.com/jeyroik/json-reqres/workflows/PHP%20Composer/badge.svg?branch=master&event=push)
![codecov.io](https://codecov.io/gh/jeyroik/json-reqres/coverage.svg?branch=master)
<a href="https://github.com/phpstan/phpstan"><img src="https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat" alt="PHPStan Enabled"></a> 
<a href="https://codeclimate.com/github/jeyroik/json-reqres/maintainability"><img src="https://api.codeclimate.com/v1/badges/cf047cab53a8030f14b6/maintainability" /></a>
[![Latest Stable Version](https://poser.pugx.org/jeyroik/json-reqres/v)](//packagist.org/packages/jeyroik/json-reqres)
[![Total Downloads](https://poser.pugx.org/jeyroik/json-reqres/downloads)](//packagist.org/packages/jeyroik/json-reqres)
[![Dependents](https://poser.pugx.org/jeyroik/json-reqres/dependents)](//packagist.org/packages/jeyroik/json-reqres)


# Usage

```php
$request = new Request([
  Request::FIELD__METHOD => Request::METHOD__GET,
  Request::FIELD__BASE_URL => 'https://github.com/',
  Request::FIELD__ENDPOINT => 'operationName',
  Request::FIELD__PARAMETERS => [
   'param1' => 'value1'
 ]
]);
 
$response = $request->run();

print_r($response->getResult(), true);
```

# Dispatchers

You can additionally dispatch request by dispatcher logic:

```php
$request = new Request([
  Request::FIELD__METHOD => Request::METHOD__GET,
  Request::FIELD__BASE_URL => 'https://github.com/',
  Request::FIELD__ENDPOINT => 'operationName',
  Request::FIELD__DISPATCHER_REQUEST => '\\dispatcher\\class\\Name',
  Request::FIELD__DISPATCHER_RESPONSE => '\\dispatcher\\class\\Name',
  Request::FIELD__PARAMETERS => [
   'param1' => 'value1'
 ]
]);
```

- Request dispatcher should implement `jeyroik\interfaces\requests\dispatchers\IDispatcher` interface.
- Response dispatcher should implement `jeyroik\interfaces\responses\dispatchers\IDispatcher` interface.
- Default request dispatcher is `jeyroik\components\requests\dispatchers\ApiKey`. See this class for usage details.
- Default response dispatcher is `jeyroik\components\responses\dispatchers\WrapResult`. See this class for usage details.

# Environment

This env parameters are available:

- `REQRES__CLIENT` client class name, for example `\\GuzzleHttp\\Client`.
- `REQRES__API_KEY__TOKEN` api key token for using with `ApiKey` dispatcher (see `src\components\requests\dispatchers` for details).