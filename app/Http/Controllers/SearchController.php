<?php

namespace App\Http\Controllers;

use App\Models\PhelFunction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Searches Phel's functions as exact matches by specified keyword.
     *
     * @param Request $request A request data which contains searching keyword.
     * @return View The view of searching results.
     * @todo Implementing fuzzy searching (if it's required).
     */
    public function index(Request $request): View
    {
        $name = $request->str('q');
        $functions = PhelFunction::where('name', '=', $name)->get();
        return view('search', ['name' => $name, 'functions' => $functions]);
    }
}
