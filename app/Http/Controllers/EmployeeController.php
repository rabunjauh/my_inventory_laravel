<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee/index', [
            'title' => 'Employee',
            'employees' => Employee::with(['department', 'position', 'hod'])->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee/create', [
            'title' => 'Add Employee',
            'departments' => Department::all(),
            'positions' => Position::all(),
            'hods' => Employee::where('isHod', 1)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $validatedData = $request->validate([
            'employee_id' => 'numeric|unique:employees',
            'name' => 'required|max:255',
            'status' => 'required',
            'department_id' => 'required',
            'position_id' => 'required',
            'isHod' => 'required',
            'hod_id' => 'required',
            'join_date' => 'required|date'
        ]);

        $validatedData['name'] = ucwords($validatedData['name']);
        Employee::create($validatedData);
        return redirect('/employee')->with('success', 'Employee data successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('employee/edit', [
            'title' => 'Edit Employee',
            'departments' => Department::all(),
            'positions' => Position::all(),
            'hods' => Employee::where('isHod', 1)->get(),
            'employee' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $validatedData = $request->validate([
            'employee_id' => 'numeric',
            'name' => 'required|max:255',
            'status' => 'required',
            'department_id' => 'required',
            'position_id' => 'required',
            'isHod' => 'required',
            'hod_id' => 'required',
            'join_date' => 'required|date'
        ]);

        $validatedData['name'] = ucwords($validatedData['name']);
        Employee::where('id', $employee->id)->update($validatedData);
        return redirect('/employee')->with('success', 'Employee data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        Employee::destroy($employee->id);
        return redirect('/employee')->with('success', 'Employee data successfully deleted');
    }
}
