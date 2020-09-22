<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allExpenses = Expense::all()->groupBy('branch_id');

        $allBranch = Branch::where('status', 1)->get();

        $expense_type = [
            'Administration' => 'Administration',
            'Site' => 'Site',
            'Others' => 'Others',
        ];

        $todayExpense = Expense::where('created_at', 'like', date('Y-m-d') . '%')->sum('amount');
        $crntMonthExpense = Expense::where('created_at', 'like', date('Y-m') . '%')->sum('amount');
        $lastMonthExpense = Expense::where('created_at', 'like', date('Y-m', strtotime('today' . '-1month')) . '%')->sum('amount');

        return view('admin.template_layouts.expenses.expenses', compact('allBranch', 'expense_type', 'allExpenses', 'todayExpense', 'crntMonthExpense', 'lastMonthExpense'));
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
            $file->move("upload/expense", $file_name);
        }

        $all['document'] = isset($file_name) ? $file_name : null;

        $all['submitted_by'] = Auth::id();

        Expense::create($all);

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

        $id = Expense::findorfail($id);

        $request['created_at'] = date('Y-m-d h:i:s', strtotime($request->created_at));
        $all = $request->all();

        if ($request->hasFile('document') && $request['document'] != null) {
            $file = $request->file('document');
            $file_name = time() . "expense." . $file->getClientOriginalExtension();
            $file->move("upload/expense", $file_name);

            if (isset($id->document)) {
                if (file_exists(public_path('/upload/expense/' . $id->document))) {

                    unlink(public_path('/upload/expense/' . $id->document));

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
        $id = Expense::findorfail($id);

        if (isset($id->document)) {

            if (file_exists(public_path('/upload/expense/' . $id->document))) {

                unlink(public_path('/upload/expense/' . $id->document));

            }
        }

        $id->delete();

        return redirect()->back()->with('warning', 'Successfully Deleted');
    }

    public function showExpenseDetails($branch_id)
    {
        $expenses = Expense::where('branch_id', $branch_id)->orderBy('created_at', 'desc')->get();

        $html = '';
        $note = '';
        $document = '---';

        if ($expenses->count() > 0) {

            foreach ($expenses as $expense) {

                if (!is_null($expense->purpose)) {

                    $note = "<span data-placement=\"top\" data-toggle=\"tooltip\"
                                  data-original-title=\"Expense Purpose\">
                                <a class=\"btn btn-warning btn-xs ml-1 purposeModal\"
                                   data-content=\"$expense->purpose\">
                                    <i class=\"fa fa-info\"></i>
                                </a>
                            </span>";

                }
                $amount = $expense->amount;
                $date = date('d M, Y', strtotime($expense->created_at));
                $create_date = date('Y-m-d', strtotime($expense->created_at));

                if ($expense->payment_method == 1)
                    $payment_method = "Cash";
                elseif ($expense->payment_method == 2)
                    $payment_method = "Bank";
                elseif ($expense->payment_method == 3)
                    $payment_method = "Bkash";
                else
                    $payment_method = "---";


                if (($expense->document ?? null) != null) {
                    $document = "<a href=\"{{asset('upload/expense/'.($expense->document ?? null))}}\" target=\"_blank\" data-placement=\"top\"
                                    data-toggle=\"tooltip\" data-original-title=\"Document Zooming\">
                                    <img class=\"img-fluid\" width=\"120px\" height=\"120px\"
                                         src=\"{{asset('upload/expense/'.($expense->document ?? null))}}\">
                                </a>";
                }


                $html .= "<div class='row px-1'>
                          <div class='col-2 t-c'><p>$date</p></div>
                          <div class='col-2 t-c'><p>$expense->expense_type</p></div>
                          <div class='col-2 t-c'><p>$amount ট &nbsp;&nbsp; $note</p></div>
                          <div class='col-2 t-c'><p>$payment_method</p></div>
                          <div class='col-2 t-c'><p>$document</p></div>
                          <div class='col-2 t-c'>
                            <span data-placement=\"top\" data-toggle=\"tooltip\"
                                  data-original-title=\"Edit\">
                                <a class=\"btn btn-warning btn-xs updateModal\"
                                   data-action=\"$expense->id\"
                                   data-content=\"$expense->expense_type\"
                                   data-col=\"$expense->purpose\"
                                   data-end=\"$amount\"
                                   data-animation=\"$expense->document\"
                                   data-goto=\"$expense->payment_method\"
                                   data-toggle=\"$expense->status\"
                                   data-icon=\"$expense->branch_id\"
                                   datatype=\"$create_date\">
                                    <i class=\"fa fa-edit\"></i>
                                </a>
                            </span>

                            <span data-placement=\"top\" data-toggle=\"tooltip\"
                                  data-original-title=\"Delete\"
                                  aria-describedby=\"tooltip406983\">
                                <a class=\"btn btn-danger btn-xs deleteModal\"
                                   data-action=\"$expense->id\">
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
