<?php

namespace App\Http\Controllers;

use App\AssetManagement;
use Illuminate\Http\Request;

class AssetManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allAssets = AssetManagement::orderBy('id','DESC')->get();

        return view('admin.template_layouts.assets.assetManagement', compact('allAssets'));
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
        $all = $request->all();

        AssetManagement::create($all);

        return redirect()->back()->with('success', 'Successfully Inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\AssetManagement $assetManagement
     * @return \Illuminate\Http\Response
     */
    public function show(AssetManagement $assetManagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\AssetManagement $assetManagement
     * @return \Illuminate\Http\Response
     */
    public function edit(AssetManagement $assetManagement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\AssetManagement $assetManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $all = $request->all();

        $updated_at = AssetManagement::findorfail($id);

        $updated_at->update($all);

        return redirect()->back()->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\AssetManagement $assetManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted_at = AssetManagement::findorfail($id);

        $deleted_at->delete();

        return redirect()->back()->with('warning', 'Successfully Deleted');
    }
}
