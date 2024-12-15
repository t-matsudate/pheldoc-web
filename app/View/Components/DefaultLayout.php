<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DefaultLayout extends Component
{
    public function __construct(private string $title, private string $scripts = '')
    {
    }

    public function render(): View|Closure|string
    {
        return view('components.default-layout', ['title' => $this->title, 'scripts' => explode(' ', $this->scripts)]);
    }
}
