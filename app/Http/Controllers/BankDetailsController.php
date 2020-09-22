<?php

namespace App\Http\Controllers;

use App\BankDetails;
use Illuminate\Http\Request;

class BankDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allBankDetails = BankDetails::all();

        return view('admin.template_layouts.account.bankDetails', compact('allBankDetails'));
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

        BankDetails::create($all);

        return redirect()->back()->with('success', 'Successfully Inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\BankDetails $bankDetails
     * @return \Illuminate\Http\Response
     */
    public function show(BankDetails $bankDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\BankDetails $bankDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(BankDetails $bankDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\BankDetails $bankDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updated_at = BankDetails::findorfail($id);

        $all = $request->all();

        $updated_at->update($all);

        return redirect()->back()->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\BankDetails $bankDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted_at = BankDetails::findorfail($id);

        $deleted_at->delete();

        return redirect()->back()->with('warning', 'Successfully Deleted');
    }
}
