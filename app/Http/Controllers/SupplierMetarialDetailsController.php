<?php

namespace App\Http\Controllers;

use App\SupplierMetarialDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierMetarialDetailsController extends Controller
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

        SupplierMetarialDetails::create($all);

        return redirect()->back()->with('success', 'Successfully Inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\SupplierMetarialDetails $supplierMetarialDetails
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierMetarialDetails $supplierMetarialDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\SupplierMetarialDetails $supplierMetarialDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplierMetarialDetails $supplierMetarialDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\SupplierMetarialDetails $supplierMetarialDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request['created_at'] = date('Y-m-d h:i:s', strtotime($request->created_at));
        $all = $request->all();

        $updated_at = SupplierMetarialDetails::findorfail($id);

        $updated_at->update($all);

        return redirect()->back()->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\SupplierMetarialDetails $supplierMetarialDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted_at = SupplierMetarialDetails::findorfail($id);

        $deleted_at->delete();

        return redirect()->back()->with('warning', 'Successfully Deleted');
    }
}
