<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display employees with search, filter and pagination.
     */
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('position')) {
            $query->where('position', $request->input('position'));
        }

        $employees = $query->latest('id')
            ->paginate(10)
            ->withQueryString();

        $positions = Employee::query()
            ->whereNotNull('position')
            ->where('position', '!=', '')
            ->distinct()
            ->orderBy('position')
            ->pluck('position');

        return view('employees.index', [
            'employees' => $employees,
            'positions' => $positions,
        ]);
    }

    /**
     * Show the employee creation form.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a new employee after validation.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email',
            'phone' => 'nullable|string|max:20',
            'position' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric|min:0',
        ], [
            'name.required' => 'Employee name is required.',
            'name.string' => 'Name must be valid text.',
            'name.max' => 'Name cannot exceed 255 characters.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email cannot exceed 255 characters.',
            'email.unique' => 'This email is already registered.',
            'phone.string' => 'Phone number must be valid text.',
            'phone.max' => 'Phone number cannot exceed 20 characters.',
            'position.string' => 'Position must be valid text.',
            'position.max' => 'Position cannot exceed 255 characters.',
            'salary.numeric' => 'Salary must be a valid number.',
            'salary.min' => 'Salary cannot be negative.',
        ]);

        Employee::create($data);

        return redirect()->route('employees.index')
            ->with('success', 'Employee added successfully!');
    }

    /**
     * Display a single employee.
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the employee edit form.
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update an existing employee after validation.
     */
    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('employees', 'email')
                    ->ignore($employee->id),
            ],
            'phone' => 'nullable|string|max:20',
            'position' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric|min:0',
        ], [
            'name.required' => 'Employee name is required.',
            'name.string' => 'Name must be valid text.',
            'name.max' => 'Name cannot exceed 255 characters.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email cannot exceed 255 characters.',
            'email.unique' => 'This email is already registered.',
            'phone.string' => 'Phone number must be valid text.',
            'phone.max' => 'Phone number cannot exceed 20 characters.',
            'position.string' => 'Position must be valid text.',
            'position.max' => 'Position cannot exceed 255 characters.',
            'salary.numeric' => 'Salary must be a valid number.',
            'salary.min' => 'Salary cannot be negative.',
        ]);

        $employee->update($data);

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully!');
    }

    /**
     * Delete an employee.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully!');
    }
}
