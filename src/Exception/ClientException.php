<?php

declare(strict_types=1);

namespace MNIB\UrgentCargus\Exception;

use GuzzleHttp\Exception\ClientException as GuzzleClientException;
use function GuzzleHttp\json_decode;

class ClientException extends \RuntimeException
{
    public static function fromException(GuzzleClientException $exception): self
    {
        $code = $exception->getResponse()->getStatusCode();
        $message = $exception->getMessage();

        if ($result = json_decode((string)$exception->getResponse()->getBody())) {
            switch (true) {
                case isset($result->message) && $result->message:
                    $message = $result->message;
                    break;
                case isset($result->Error) && $result->Error:
                    $message = $result->Error;
                    break;
            }
        }

        return new self($message, $code);
    }
}
