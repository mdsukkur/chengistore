<?php

namespace App\Http\Controllers;

use App\ProjectCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'project_id' => 'required',
            'purpose' => 'required',
            'amount' => 'required',
            'payment_method' => 'required'
        ]);

        $all = $request->all();

        $all['payment_date'] = date('Y-m-d', strtotime($request->payment_date));

        $all['submitted_by'] = Auth::id();

        ProjectCost::create($all);

        return redirect()->back()->with('success', "Successfully Inserted");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\ProjectCost $projectCost
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectCost $projectCost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ProjectCost $projectCost
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectCost $projectCost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ProjectCost $projectCost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'project_id' => 'required',
            'purpose' => 'required',
            'amount' => 'required',
            'payment_method' => 'required'
        ]);

        $all = $request->all();

        $all['payment_date'] = date('Y-m-d', strtotime($request->payment_date));

        $all['submitted_by'] = Auth::id();

        $updatedData = ProjectCost::findorfail($id);

        $updatedData->update($all);

        return redirect()->back()->with('success', "Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ProjectCost $projectCost
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedData = ProjectCost::findorfail($id);

        $deletedData->delete();

        return redirect()->back()->with('warning', "Successfully Deleted");
    }

    public function showCostDateWise($date, $project_id)
    {
        $costs = ProjectCost::where('payment_date', $date)->where('project_id', $project_id)->get();

        if ($costs->count() > 0) {

            $html = '';

            foreach ($costs as $cost) {
                $date = date('Y-m-d', strtotime($cost->payment_date ?? $cost->created_at));
                $amount = number_format($cost->amount, 2);
                $payment_method = payment_method()["$cost->payment_method"] ?? '---';

                $html .= "<div class='row px-1'>
                          <div class='col-4 t-c'><p>$cost->purpose</p></div>
                          <div class='col-2 t-c'><p>$payment_method</p></div>
                          <div class='col-4 t-c'><p>$amount BDT</p></div>
                          <div class='col-2 t-c'>
                            <span data-placement=\"top\" data-toggle=\"tooltip\" data-original-title=\"Edit\">
                                <a class=\"btn btn-warning btn-xs costUpdateModal mb-1\"
                                   data-action=\"$cost->id\"
                                   data-content=\"$cost->purpose\"
                                   data-end=\"$cost->payment_method\"
                                   data-col=\"$cost->amount\"
                                   data-toggle=\"$date\">
                                    <i class=\"fa fa-edit\"></i>
                                </a>
                            </span>

                            <span data-placement=\"top\" data-toggle=\"tooltip\"
                                  data-original-title=\"Delete\"
                                  aria-describedby=\"tooltip406983\">
                                <a class=\"btn btn-danger btn-xs costDeleteModal\"
                                   data-action=\"$cost->id\">
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
