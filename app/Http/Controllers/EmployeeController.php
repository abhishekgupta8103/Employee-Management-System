
<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = Employee::count();

        $totalPositions = Employee::query()
            ->whereNotNull('position')
            ->where('position', '!=', '')
            ->distinct()
            ->count('position');

        $totalSalary = Employee::sum('salary');

        $positionData = Employee::query()
            ->selectRaw('position, COUNT(*) as total')
            ->whereNotNull('position')
            ->where('position', '!=', '')
            ->groupBy('position')
            ->orderBy('position')
            ->get();

        $recentEmployees = Employee::latest('id')
            ->take(5)
            ->get();

        return view('employee', [
            'name' => Auth::user()->name,
            'role' => 'Frontend Developer Intern',
            'totalEmployees' => $totalEmployees,
            'totalPositions' => $totalPositions,
            'totalSalary' => $totalSalary,
            'positionData' => $positionData,
            'recentEmployees' => $recentEmployees,
        ]);
    }
}
