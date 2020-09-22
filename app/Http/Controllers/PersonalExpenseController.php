<?php

namespace App\Http\Controllers;

use App\PersonalExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_method = $_REQUEST['payment_method'] ?? null;
        $status = $_REQUEST['status'] ?? null;
        $date = isset($_REQUEST['date']) ? date('Y-m-d', strtotime($_REQUEST['date'])) : null;

        if (($payment_method ?? null) != null) {
            $allExpenses = PersonalExpense::with('user')->where('payment_method', $payment_method)->orderBy('created_at', 'DESC')->paginate(10);
        } elseif (($status ?? null) != null) {
            $allExpenses = PersonalExpense::with('user')->where('status', $status)->orderBy('created_at', 'DESC')->paginate(10);
        } elseif (($date ?? null) != null) {
            $allExpenses = PersonalExpense::with('user')->where('created_at', 'like', "$date%")->orderBy('created_at', 'DESC')->paginate(10);
        } else {
            $allExpenses = PersonalExpense::with('user')->orderBy('created_at', 'DESC')->paginate(10);
        }

        $todayExpense = PersonalExpense::where('created_at', 'like', date('Y-m-d') . '%')->sum('amount');
        $crntMonthExpense = PersonalExpense::where('created_at', 'like', date('Y-m') . '%')->sum('amount');
        $lastMonthExpense = PersonalExpense::where('created_at', 'like', date('Y-m', strtotime('today' . '-1month')) . '%')->sum('amount');

        return view('admin.template_layouts.expenses.personalExpenses', compact('allExpenses', 'todayExpense', 'crntMonthExpense', 'lastMonthExpense'));
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
            'expense_type' => 'required',
            'amount' => 'required',
            'payment_method' => 'required',
            'purpose' => 'required',
            'status' => 'required',
            'document' => 'mimes:jpeg,jpg,png|max:2048'
        ]);

        $request['created_at'] = date('Y-m-d h:i:s', strtotime($request->created_at));
        $all = $request->all();

        if ($request->hasFile('document') && $request['document'] != null) {
            $file = $request->file('document');
            $file_name = time() . "expense." . $file->getClientOriginalExtension();
            $file->move("upload/personalexpense", $file_name);
        }

        $all['document'] = isset($file_name) ? $file_name : null;

        $all['submitted_by'] = Auth::id();

        PersonalExpense::create($all);

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
            'expense_type' => 'required',
            'amount' => 'required',
            'payment_method' => 'required',
            'purpose' => 'required',
            'status' => 'required',
            'document' => 'mimes:jpeg,jpg,png|max:2048'
        ]);

        $id = PersonalExpense::findorfail($id);

        $request['created_at'] = date('Y-m-d h:i:s', strtotime($request->created_at));
        $all = $request->all();

        if ($request->hasFile('document') && $request['document'] != null) {
            $file = $request->file('document');
            $file_name = time() . "expense." . $file->getClientOriginalExtension();
            $file->move("upload/personalexpense", $file_name);

            if (isset($id->document)) {
                if (file_exists(public_path('/upload/personalexpense/' . $id->document))) {

                    unlink(public_path('/upload/personalexpense/' . $id->document));

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
        $id = PersonalExpense::findorfail($id);

        if (isset($id->document)) {

            if (file_exists(public_path('/upload/personalexpense/' . $id->document))) {

                unlink(public_path('/upload/personalexpense/' . $id->document));

            }
        }

        $id->delete();

        return redirect()->back()->with('warning', 'Successfully Deleted');
    }
}
