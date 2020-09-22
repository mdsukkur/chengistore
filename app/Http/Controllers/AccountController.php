<?php

namespace App\Http\Controllers;

use App\Account;
use App\BankDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = $_REQUEST['status'] ?? null;
        $account_type = $_REQUEST['account_type'] ?? null;
        $date = $_REQUEST['date'] ?? null;

        if (($account_type ?? null) != null) {
            if ($account_type == 3) {
                $allAccounts = Account::with('user')->where('account_type', 0)->where('type', '!=', 1)->where('type', '!=', 2)->orderBy('id', 'DESC')->paginate(10);
            } else {
                $allAccounts = Account::with('user')->where('account_type', 0)->where('type', $account_type)->orderBy('id', 'DESC')->paginate(10);
            }
        } elseif (($status ?? null) != null) {
            $allAccounts = Account::with('user')->where('account_type', 0)->where('status', $status)->orderBy('id', 'DESC')->paginate(10);
        } elseif (($date ?? null) != null) {
            $allAccounts = Account::with('user')->where('account_type', 0)->where('created_at', 'like', "$date%")->orderBy('id', 'DESC')->paginate(10);
        } else {
            $allAccounts = Account::with('user')->where('account_type', 0)->orderBy('id', 'DESC')->paginate(10);
        }

        return view('admin.template_layouts.account.account', compact('allAccounts'));
    }


    public function bankStatement()
    {
        $status = $_REQUEST['status'] ?? null;
        $account_type = $_REQUEST['account_type'] ?? null;
        $date = $_REQUEST['date'] ?? null;
        $bank_id = $_REQUEST['bank_id'] ?? null;

        $bankDetails = BankDetails::all();

        if (($account_type ?? null) != null) {
            if ($account_type == 3) {
                $allAccounts = Account::with('bank')->where('account_type', 1)->where('type', '!=', 1)->where('type', '!=', 2)->orderBy('id', 'DESC')->paginate(10);
            } else {
                $allAccounts = Account::with('bank')->where('account_type', 1)->where('type', $account_type)->orderBy('id', 'DESC')->paginate(10);
            }
        } elseif (($status ?? null) != null) {
            $allAccounts = Account::with('bank')->where('account_type', 1)->where('status', $status)->orderBy('id', 'DESC')->paginate(10);
        } elseif (($bank_id ?? null) != null) {
            $allAccounts = Account::with('bank')->where('account_type', 1)->where('bank_id', $bank_id)->orderBy('id', 'DESC')->paginate(10);
        } elseif (($date ?? null) != null) {
            $allAccounts = Account::with('bank')->where('account_type', 1)->where('created_at', 'like', "$date%")->orderBy('id', 'DESC')->paginate(10);
        } else {
            $allAccounts = Account::with('bank')->where('account_type', 1)->orderBy('id', 'DESC')->paginate(10);
        }

        return view('admin.template_layouts.account.bankStatement', compact('allAccounts', 'bankDetails'));
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
            'type' => 'required',
            'amount' => 'required',
            'purpose' => 'required',
            'status' => 'required',
            'document' => 'mimes:jpeg,jpg,png|max:2048'
        ]);

        $request['created_at'] = date('Y-m-d h:i:s', strtotime($request->created_at));

        $all = $request->all();

        if ($request->hasFile('document') && $request['document'] != null) {
            $file = $request->file('document');
            $file_name = time() . "expense." . $file->getClientOriginalExtension();
            $file->move("upload/account", $file_name);
        }

        $all['document'] = isset($file_name) ? $file_name : null;

        $all['submitted_by'] = Auth::id();

        Account::create($all);

        return redirect()->back()->with('success', 'Successfully Stored Your Information');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Expense $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Expense $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Expense $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'amount' => 'required',
            'purpose' => 'required',
            'status' => 'required',
            'document' => 'mimes:jpeg,jpg,png|max:2048'
        ]);

        $id = Account::findorfail($id);

        $request['created_at'] = date('Y-m-d h:i:s', strtotime($request->created_at));

        $all = $request->all();

        if ($request->hasFile('document') && $request['document'] != null) {
            $file = $request->file('document');
            $file_name = time() . "expense." . $file->getClientOriginalExtension();
            $file->move("upload/account", $file_name);

            if (isset($id->document)) {
                if (file_exists(public_path('/upload/account/' . $id->document))) {

                    unlink(public_path('/upload/account/' . $id->document));

                }
            }
        }

        $all['document'] = isset($file_name) ? $file_name : $id->document;

        $id->update($all);

        return redirect()->back()->with('success', 'Successfully Updated Your Information');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Expense $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Account::findorfail($id);

        if (isset($id->document)) {

            if (file_exists(public_path('/upload/account/' . $id->document))) {

                unlink(public_path('/upload/account/' . $id->document));

            }
        }

        $id->delete();

        return redirect()->back()->with('warning', 'Successfully Deleted');
    }
}
