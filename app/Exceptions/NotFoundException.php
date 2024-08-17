<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotFoundException extends Exception
{
    public function __construct(private string $message)
    {
        parent::__construct($message);
    }
    
    public function report(): void
    {
    }

    public function render(Request $request): Response
    {
        return response(view('errors.404', ['request' => $request]));
    }
}
