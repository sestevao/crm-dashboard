<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PriorityIndicator extends Component
{
    public string $priority;

    public function __construct(?string $priority = null)
    {
        $this->priority = $priority;
    }

    public function render()
    {
        return view('components.priority-indicator');
    }
}
