<?php

namespace App\Http\Controllers;

use App\ProjectInvestAmount;
use Illuminate\Http\Request;

class ProjectInvestAmountController extends Controller
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
        $request['created_at'] = date('Y-m-d h:i:s', strtotime($request->created_at));

        $all = $request->all();

        ProjectInvestAmount::create($all);

        return redirect()->back()->with('success', 'Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\ProjectInvestAmount $projectInvestAmount
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectInvestAmount $projectInvestAmount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ProjectInvestAmount $projectInvestAmount
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectInvestAmount $projectInvestAmount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ProjectInvestAmount $projectInvestAmount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request['created_at'] = date('Y-m-d h:i:s', strtotime($request->created_at));

        $all = $request->all();

        $updated_id = ProjectInvestAmount::findorfail($id);

        $updated_id->update($all);

        return redirect()->back()->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ProjectInvestAmount $projectInvestAmount
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted_id = ProjectInvestAmount::findorfail($id);

        $deleted_id->delete();

        return redirect()->back()->with('warning', 'Successfully Deleted');
    }
}
