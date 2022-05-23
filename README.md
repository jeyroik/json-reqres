# json-reqres

Simple wrapper for JSON responses.

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
  Request::FIELD__DISPATCHER => '\\dispatcher\\class\\Name',
  Request::FIELD__PARAMETERS => [
   'param1' => 'value1'
 ]
]);
```

- Dispatcher should implement `jeyroik\interfaces\requests\dispatchers\IDispatcher` interface.
- Default dispatcher is `jeyroik\components\requests\dispatchers\ApiKey`. See this class for usage details.

# Environment

This env parameters are available:

- `REQRES__CLIENT` client class name, for example `\\GuzzleHttp\\Client`.
- `REQRES__API_KEY__TOKEN` api key token for using with `ApiKey` dispatcher (see `src\components\requests\dispatchers` for details).