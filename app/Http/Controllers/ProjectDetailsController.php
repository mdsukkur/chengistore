<?php

namespace App\Http\Controllers;

use App\ProjectDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project_name = $_REQUEST['name'] ?? null;
        $status = $_REQUEST['status'] ?? null;

        if ($project_name != null) {
            $allProject = ProjectDetails::with('partner', 'cost')->where('project_name', 'like', "%$project_name%")->paginate(10);
        } elseif ($status != null) {
            $allProject = ProjectDetails::with('partner', 'cost')->where('status', $status)->paginate(10);
        } else {
            $allProject = ProjectDetails::with('partner', 'cost')->paginate(10);
        }


        return view('admin.template_layouts.projects.projectDetails', compact('allProject'));
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
            'project_name' => 'required',
            'project_budget' => 'required',
        ]);

        $all = $request->all();

        $all['submitted_by'] = Auth::id();

        ProjectDetails::create($all);

        return redirect()->back()->with('success', 'Successfully Stored your Information');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\ProjectDetails $projectDetails
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projectDetails = ProjectDetails::with('cost', 'partner', 'invest_amount')->find($id);

        if (!is_null($projectDetails)) {
            return view('admin.template_layouts.projects.singleProjectDetails', compact('projectDetails'));
        } else {
            return $this->index()->with('warning', "Access Denied");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ProjectDetails $projectDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectDetails $projectDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ProjectDetails $projectDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'project_name' => 'required',
            'project_budget' => 'required',
        ]);

        $updatedData = ProjectDetails::findorfail($id);

        $all = $request->all();

        $all['submitted_by'] = Auth::id();

        $updatedData->update($all);

        return redirect()->back()->with('success', 'Successfully Updated your Information');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ProjectDetails $projectDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $updatedData = ProjectDetails::findorfail($id);

        $updatedData->delete();

        return redirect()->back()->with('warning', 'Successfully Deleted');
    }
}
