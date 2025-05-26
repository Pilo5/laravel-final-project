<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    // Admin dashboard: list employees + status
    public function index() {
        $employees = DB::table('employees')
            ->join('user_accounts', 'employees.id', '=', 'user_accounts.useraccount_id')
            ->select('employees.*', 'user_accounts.username', 'user_accounts.status', 'user_accounts.id as ua_id')
            ->paginate(10);

        return view('dashboard', compact('employees'));
    }

    // Show form to add new employee
    public function create() {
        return view('newUserAccount');
    }

    // Store new employee and user account
    public function store(Request $request) {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $year = now()->format('y');
        $count = Employee::whereYear('created_at', now()->year)->count() + 1;
        $employeeid = "E-$year-$count";

        // Handle image upload
        $image_path = null;
        if ($request->hasFile('image')) {
            $image_name = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $image_name);
            $image_path = 'images/' . $image_name;
        }

        $employee = Employee::create([
            'employeeid' => $employeeid,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'image_path' => $image_path
        ]);

        UserAccount::create([
            'useraccount_id' => $employee->id,
            'username' => $request->email,
            'password' => Hash::make($employeeid . $request->first_name),
            'status' => 'active',
            'role' => 'user'
        ]);

        return redirect('/dashboard')->with('success', 'Employee added successfully.');
    }

    // Show edit form for an employee
    public function edit($id) {
        $employee = Employee::findOrFail($id);
        return view('editEmployee', compact('employee'));
    }

    // Update employee information
    public function update(Request $request, $id) {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email'
        ]);

        $employee = Employee::findOrFail($id);

        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;

        if ($request->hasFile('image')) {
            if ($employee->image_path && file_exists(public_path($employee->image_path))) {
                unlink(public_path($employee->image_path));
            }
            $image_name = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $image_name);
            $employee->image_path = 'images/' . $image_name;
        }

        $employee->save();

        // Optionally update user account's email (username)
        UserAccount::where('useraccount_id', $id)->update([
            'username' => $request->email
        ]);

        return redirect('/dashboard')->with('success', 'Employee updated successfully.');
    }

    // Delete employee and user account
    public function destroy($id) {
        $employee = Employee::findOrFail($id);

        if ($employee->image_path && file_exists(public_path($employee->image_path))) {
            unlink(public_path($employee->image_path));
        }

        UserAccount::where('useraccount_id', $id)->delete();
        $employee->delete();

        return redirect('/dashboard')->with('success', 'Employee deleted successfully.');
    }

    // Toggle status between active/inactive
    public function toggleStatus($id) {
        $user = UserAccount::findOrFail($id);
        $user->status = ($user->status === 'active') ? 'inactive' : 'active';
        $user->save();

        return redirect('/dashboard')->with('success', 'User status updated.');
    }
}
