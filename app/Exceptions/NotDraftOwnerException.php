<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotDraftOwnerException extends Exception
{
    public function __construct(private string $context, private string $userId, private string $item)
    {
        parent::__construct("$context: $userId requested a not owned draft of $item.");
    }
    
    public function report(): void
    {
    }

    public function render(Request $request): Response
    {
        return response(view('errors.403', ['request' => $request]), 403);
    }
}
