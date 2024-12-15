<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsageExamplePostingRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsageExampleController extends Controller
{
    public function store(UsageExamplePostingRequest $request): Response
    {
        return response('');
    }
}
