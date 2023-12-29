<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class PreconditionFailedException extends Exception
{
    public function __construct(string $message = "")
    {
        parent::__construct($message, Response::HTTP_PRECONDITION_FAILED);
    }

    public function render($request)
    {
        return response()->json(['error' => $this->message], $this->code);
    }
}
