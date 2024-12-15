<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UpdateFailureException extends Exception
{
    public function __construct(private string $context, private string $item)
    {
        parent::__construct("$context: Failed to update $item.");
    }
    
    public function report(): void
    {
    }

    public function render(Request $request): Response
    {
        return response(view('errors.500', ['request' => $request]), 500);
    }
}
