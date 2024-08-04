<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        return view('home.index');
    }

    public function search(Request $request): Response
    {
        return response('', 200);
    }
}
