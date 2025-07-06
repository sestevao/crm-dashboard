<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProgressCircle extends Component
{
    public ?int $progress;
    public string $color;

    public function __construct(?int $progress = 0, string $color = 'blue')
    {
        $progress = $progress ?? 0;
        $this->progress = max(0, min($progress, 100)); // clamp 0 to 100
        $this->color = $color;
    }

    public function render()
    {
        return view('components.progress-circle');
    }
}
