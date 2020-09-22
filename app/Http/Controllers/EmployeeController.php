<?php

namespace App\Http\Controllers;

use App\Employee;
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
        $status = [
            '1' => "Active",
            '2' => 'Deactive'
        ];
        $allEmployees = Employee::all();
        return view('admin.template_layouts.employee.employee', compact('allEmployees', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'status' => 'required'
        ]);

        $all = $request->all();

        $all['mobile'] = str_replace('+88', '', $request->mobile);

        Employee::create($all);

        return redirect()->back()->with('success', 'Successfully Added New Employee');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'status' => 'required'
        ]);

        $all = $request->all();

        $all['mobile'] = str_replace('+88', '', $request->mobile);

        Employee::findorfail($id)->update($all);

        return redirect()->back()->with('success', 'Successfully Updated Employee Information');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::findorfail($id)->delete();

        return redirect()->back()->with('warning', 'Successfully Employee Deleted');
    }
}
