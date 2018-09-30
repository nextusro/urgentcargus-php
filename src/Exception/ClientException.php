<?php

declare(strict_types=1);

namespace MNIB\UrgentCargus\Exception;

use GuzzleHttp\Exception\ClientException as GuzzleClientException;
use RuntimeException;
use function GuzzleHttp\json_decode;

class ClientException extends RuntimeException
{
    public static function fromException(GuzzleClientException $exception): self
    {
        $code = $exception->getResponse() !== null ? $exception->getResponse()->getStatusCode() : 0;
        $message = $exception->getMessage();

        $contents = (string)$exception->getResponse();

        if ($contents === '') {
            return new self('Received empty content.');
        }

        $data = json_decode($contents);

        if (isset($data->message) && $data->message !== '') {
            $message = $data->message;
        } elseif (isset($data->Error) && $data->Error !== '') {
            $message = $data->Error;
        }

        return new self($message, $code);
    }
}
