<?php

namespace App\Http\Controllers;

use App\Employee;
use App\SalaryManagement;
use Illuminate\Http\Request;

class SalaryManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allSalaries = SalaryManagement::all()->groupBy('emp_id');

        $allEmployees = Employee::where('status', 1)->get();

        return view('admin.template_layouts.salary.salary', compact('allEmployees', 'allSalaries'));
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
        $request['created_at'] = date('Y-m-d h:i:s', strtotime($request->created_at));
        $all = $request->all();

        SalaryManagement::create($all);

        return redirect()->back()->with('success', 'Successfully Inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\SalaryManagement $salaryManagement
     * @return \Illuminate\Http\Response
     */
    public function show(SalaryManagement $salaryManagement)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\SalaryManagement $salaryManagement
     * @return \Illuminate\Http\Response
     */
    public function edit(SalaryManagement $salaryManagement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\SalaryManagement $salaryManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request['created_at'] = date('Y-m-d h:i:s', strtotime($request->created_at));
        $all = $request->all();

        SalaryManagement::findorfail($id)->update($all);

        return redirect()->back()->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\SalaryManagement $salaryManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted_data = SalaryManagement::findorfail($id);

        $deleted_data->delete();

        return redirect()->back()->with('warning', 'Successfully Deleted');
    }

    public function showSalaryDetails($emp_id)
    {
        $salaries = SalaryManagement::where('emp_id', $emp_id)->orderBy('created_at', 'DESC')->get();

        if ($salaries->count() > 0) {

            $html = '';

            foreach ($salaries as $salary) {
                $date = date('d M, Y', strtotime($salary->created_at));
                $amount = number_format($salary->amount, 2);

                $created_at = date('Y-m-d',strtotime($salary->created_at));

                $note = '';
                if (!is_null($salary->note)){

                    $note = "<span data-placement=\"top\" data-toggle =\"tooltip\"
                                  data-original-title = \"Note\"
                                  aria-describedby = \"tooltip406983\" >
                                <a class=\"btn btn-primary btn-xs noteModal\"
                                   data-action = \"$salary->note\" >
                                    <i class=\"fa fa-info\" ></i >
                                </a >
                            </span >";

                }



                $html .= "<div class='row px-1'>
                          <div class='col-3 t-c'><p>$date</p></div>
                          <div class='col-3 t-c'><p>$salary->payment_method &nbsp;&nbsp; $note</p></div>
                          <div class='col-3 t-c'><p>$amount ট</p></div>
                          <div class='col-3 t-c'>
                            <span data-placement='top' data-toggle='tooltip'
                                  data-original-title='Edit'>
                                <a class=\"btn btn-warning btn-xs updateModal\"
                                   data-action=\"$salary->id\"
                                   data-content=\"$salary->amount\"
                                   data-col=\"$salary->payment_method\"
                                   data-goto=\"$salary->note\"
                                   datatype=\"$created_at\"
                                   data-end=\"$salary->salary_month\">
                                    <i class=\"fa fa-edit\"></i>
                                </a>
                            </span>

                            <span data-placement=\"top\" data-toggle=\"tooltip\"
                                  data-original-title=\"Delete\"
                                  aria-describedby=\"tooltip406983\">
                                <a class=\"btn btn-danger btn-xs deleteModal\"
                                   data-action=\"$salary->id\">
                                    <i class=\"fa fa-trash\"></i>
                                </a>
                            </span>
                          </div>
                      </div> ";

            }

        } else {
            $html .= "<div class='row px-1'>
                          <div class='col-sm-12 t-c'><p>No data available in table</p></div>
                      </div> ";
        }

        return $html;
    }
}
