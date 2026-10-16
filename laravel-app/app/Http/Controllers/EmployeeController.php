<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
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

        return view('employees.index', compact('employees', 'positions'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email',
            'phone' => 'nullable|string|max:20',
            'position' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'name.required' => 'Employee name is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'salary.numeric' => 'Salary must be a valid number.',
            'salary.min' => 'Salary cannot be negative.',
            'photo.image' => 'Please upload a valid image.',
            'photo.mimes' => 'Photo must be JPG, JPEG, PNG or WEBP.',
            'photo.max' => 'Photo size cannot exceed 2 MB.',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')
                ->store('employees', 'public');
        }

        Employee::create($data);

        return redirect()->route('employees.index')
            ->with('success', 'Employee added successfully!');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('employees', 'email')->ignore($employee->id),
            ],
            'phone' => 'nullable|string|max:20',
            'position' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'name.required' => 'Employee name is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'salary.numeric' => 'Salary must be a valid number.',
            'salary.min' => 'Salary cannot be negative.',
            'photo.image' => 'Please upload a valid image.',
            'photo.mimes' => 'Photo must be JPG, JPEG, PNG or WEBP.',
            'photo.max' => 'Photo size cannot exceed 2 MB.',
        ]);

        if ($request->hasFile('photo')) {
            $newPhoto = $request->file('photo')
                ->store('employees', 'public');

            if ($employee->photo) {
                Storage::disk('public')->delete($employee->photo);
            }

            $data['photo'] = $newPhoto;
        }

        $employee->update($data);

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully!');
    }

    public function destroy(Employee $employee)
    {
        if ($employee->photo) {
            Storage::disk('public')->delete($employee->photo);
        }

        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully!');
    }
}
