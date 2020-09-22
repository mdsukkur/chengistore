<?php

namespace App\Http\Controllers;

use App\ProjectPartner;
use Illuminate\Http\Request;

class ProjectPartnerController extends Controller
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'project_id' => 'required',
            'percent' => 'required'
        ]);

        $all = $request->all();

        ProjectPartner::create($all);

        return redirect()->back()->with('success', 'Successfully Inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectPartner $projectPartner
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectPartner $projectPartner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectPartner $projectPartner
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectPartner $projectPartner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\ProjectPartner $projectPartner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'project_id' => 'required',
            'percent' => 'required'
        ]);

        $all = $request->all();

        $updatedData = ProjectPartner::findorfail($id);

        $updatedData->update($all);

        return redirect()->back()->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectPartner $projectPartner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedData = ProjectPartner::findorfail($id);

        $deletedData->delete();

        return redirect()->back()->with('warning', 'Successfully Deleted');
    }
}
