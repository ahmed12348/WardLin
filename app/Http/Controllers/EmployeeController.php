<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomEmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index() {
        return Employee::all();
    }

    public function store(CustomEmployeeRequest  $request) {
        return Employee::create($request->all());
    }

    public function show($id) {
        return Employee::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $employee = Employee::findOrFail($id);
        $employee->update($request->all());
        return $employee;
    }

    public function destroy($id) {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return response()->json(['message' => 'Employee deleted']);
    }
}
