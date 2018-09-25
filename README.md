# UrgentCargus PHP API
The API is RESTful JSON over HTTP using [GuzzleHttp](http://docs.guzzlephp.org/en/latest/) as a HTTP client.

# Usage example
```php
    $client = new \MNIB\UrgentCargus\Client($apiKey, $apiUri);
    ...
    $token = $client->getToken('username', 'password');
    ...
    $result = $client->get('PickupLocations', [], $token);
```
