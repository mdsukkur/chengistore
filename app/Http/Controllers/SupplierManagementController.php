<?php

namespace App\Http\Controllers;

use App\SupplierManagement;
use App\SupplierMetarialDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = $_REQUEST['name'] ?? null;
        $mobile = $_REQUEST['mobile'] ?? null;
        $status = $_REQUEST['status'] ?? null;

        if ($name != null) {
            $allSupplier = SupplierManagement::with('user')->where('name', 'like', "%$name%")->paginate(10);
        } elseif ($mobile != null) {
            $allSupplier = SupplierManagement::with('user')->where('mobile', 'like', "%$mobile%")->paginate(10);
        } elseif ($status != null) {
            $allSupplier = SupplierManagement::with('user')->where('status', $status)->paginate(10);
        } else {
            $allSupplier = SupplierManagement::with('user')->paginate(10);
        }

        return view('admin.template_layouts.supplier.supplierManagement', compact('allSupplier'));
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

        $all['submitted_by'] = Auth::id();

        SupplierManagement::create($all);

        return redirect()->back()->with('success', 'Successfully Inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\SupplierManagement $supplierManagement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplierInfo = SupplierManagement::find($id);

        if ($supplierInfo->count() > 0) {
            $date = $_REQUEST['date'] ?? null;

            if ($date != null) {
                $date = date('Y-m-d', strtotime($date));
                $metarialDetails = SupplierMetarialDetails::where('created_at', 'like', "$date%")->where('supplier_id', $id)->orderBy('id', 'DESC')->paginate(10);
            } else {
                $metarialDetails = SupplierMetarialDetails::where('supplier_id', $id)->orderBy('id', 'DESC')->paginate(10);
            }

            return view('admin.template_layouts.supplier.singleSupplierDetails', compact('supplierInfo', 'metarialDetails'));

        } else {
            return redirect()->back()->with('warning', 'Access Denied');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\SupplierManagement $supplierManagement
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplierManagement $supplierManagement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\SupplierManagement $supplierManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $all = $request->all();

        $all['submitted_by'] = Auth::id();

        SupplierManagement::findorfail($id)->update($all);

        return redirect()->back()->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\SupplierManagement $supplierManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SupplierManagement::findorfail($id)->delete();

        return redirect()->back()->with('warning', 'Successfully Deleted');
    }
}
