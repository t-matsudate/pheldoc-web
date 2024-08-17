<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Models\PhelFunction;
use App\Models\PhelNamespace;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PhelFunctionController extends Controller
{
    /**
     * Shows a Phel's function.
     *
     * @param string $namespace One of Phel's namespace.
     * @param string $name One of Phel's function name.
     * @throws NotFoundException When either specified namespace or specified name didn't find.
     * @return View When both of specified namespace and specified name found.
     */
    public function show(string $namespace, string $name): View
    {
        $phel_namespace = PhelNamespace::where('namespace', '=', $namespace)->first();

        if (is_null($phel_namespace)) {
            throw new NotFoundException("$namespace didn't find.");
        }
        
        $function = PhelFunction::where(['phel_namespace_id' => $phel_namespace->id, 'name' => $name])->first();

        if (is_null($function)) {
            throw new NotFoundException("$name didn't find.");
        }

        return view('function.show', ['function' => $function]);
    }
}
