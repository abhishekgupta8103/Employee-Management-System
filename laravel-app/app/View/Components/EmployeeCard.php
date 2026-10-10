<?php
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmployeeCard extends Component
{
    public function __construct(
        public string $name,
        public string $role,
        public string $status
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.employee-card');
    }
}
