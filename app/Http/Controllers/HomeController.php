<?php

namespace App\Http\Controllers;

use App\Account;
use App\Expense;
use App\PersonalExpense;
use App\ProjectCost;
use App\ProjectDetails;
use App\SalaryManagement;
use App\SupplierMetarialDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $account = Account::with('bank')->get();
        $companyExpense = Expense::all();
        $personalExpense = PersonalExpense::all();

        return view('admin.template_layouts.dashboard.index', compact('account', 'companyExpense', 'personalExpense'));
    }


    public function Profile()
    {
        return view('admin.template_layouts.user.profile.profile');
    }

    public function historyGenerator()
    {
        $pageName = [
            1 => 'Salary Management',
            2 => 'Company Expense',
            3 => "Personal Expense",
            4 => 'Accounts',
            5 => 'Bank Statement',
            6 => 'Project Expense',
            7 => 'Supplier Material'
        ];

        return view('admin.template_layouts.history.historyGenerate', compact('pageName'));
    }

    public function generateHistory()
    {
        $date = $_REQUEST['date'] ?? null;
        $page_name = $_REQUEST['page_name'] ?? null;

        if ($date == null || $page_name == null) {
            return redirect()->back()->with('warning', 'Something Wrong!');
        }

        $salaryManagement = null;
        $companyExpense = null;
        $personalExpense = null;
        $accounts = null;
        $bankStatement = null;
        $projectExpense = null;
        $supplierMaterial = null;

        foreach ($page_name as $pageID) {
            switch ($date) {
                case 1:
                    switch ($pageID) {
                        case 1:
                            $salaryManagement = SalaryManagement::with('employee')->whereDate('created_at', Carbon::today())->get();
                            break;
                        case 2:
                            $companyExpense = Expense::whereDate('created_at', Carbon::today())->get();
                            break;
                        case 3:
                            $personalExpense = PersonalExpense::whereDate('created_at', Carbon::today())->get();
                            break;
                        case 4:
                            $accounts = Account::where('account_type', 0)->whereDate('created_at', Carbon::today())->get();
                            break;
                        case 5:
                            $bankStatement = Account::with('bank')->where('account_type', 1)->whereDate('created_at', Carbon::today())->get();
                            break;
                        case 6:
                            $projectExpense = ProjectCost::with('project')->whereDate('created_at', Carbon::today())->get();
                            break;
                        case 7:
                            $supplierMaterial = SupplierMetarialDetails::with('supplier')->whereDate('created_at', Carbon::today())->get();
                            break;
                    }

                    break;
                case 2:
                    switch ($pageID) {
                        case 1:
                            $salaryManagement = SalaryManagement::with('employee')->whereDate('created_at', '>', Carbon::now()->subDays(7))->get();
                            break;
                        case 2:
                            $companyExpense = Expense::whereDate('created_at', '>', Carbon::now()->subDays(7))->get();
                            break;
                        case 3:
                            $personalExpense = PersonalExpense::whereDate('created_at', '>', Carbon::now()->subDays(7))->get();
                            break;
                        case 4:
                            $accounts = Account::where('account_type', 0)->whereDate('created_at', '>', Carbon::now()->subDays(7))->get();
                            break;
                        case 5:
                            $bankStatement = Account::with('bank')->where('account_type', 1)->whereDate('created_at', '>', Carbon::now()->subDays(7))->get();
                            break;
                        case 6:
                            $projectExpense = ProjectCost::with('project')->whereDate('created_at', '>', Carbon::now()->subDays(7))->get();
                            break;
                        case 7:
                            $supplierMaterial = SupplierMetarialDetails::with('supplier')->whereDate('created_at', '>', Carbon::now()->subDays(7))->get();
                            break;
                    }

                    break;
                case 3:
                    switch ($pageID) {
                        case 1:
                            $salaryManagement = SalaryManagement::with('employee')->whereDate('created_at', '>', Carbon::now()->subDays(15))->get();
                            break;
                        case 2:
                            $companyExpense = Expense::whereDate('created_at', '>', Carbon::now()->subDays(15))->get();
                            break;
                        case 3:
                            $personalExpense = PersonalExpense::whereDate('created_at', '>', Carbon::now()->subDays(15))->get();
                            break;
                        case 4:
                            $accounts = Account::where('account_type', 0)->whereDate('created_at', '>', Carbon::now()->subDays(15))->get();
                            break;
                        case 5:
                            $bankStatement = Account::with('bank')->where('account_type', 1)->whereDate('created_at', '>', Carbon::now()->subDays(15))->get();
                            break;
                        case 6:
                            $projectExpense = ProjectCost::with('project')->whereDate('created_at', '>', Carbon::now()->subDays(15))->get();
                            break;
                        case 7:
                            $supplierMaterial = SupplierMetarialDetails::with('supplier')->whereDate('created_at', '>', Carbon::now()->subDays(15))->get();
                            break;
                    }

                    break;
                case 4:
                    switch ($pageID) {
                        case 1:
                            $salaryManagement = SalaryManagement::with('employee')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get();
                            break;
                        case 2:
                            $companyExpense = Expense::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get();
                            break;
                        case 3:
                            $personalExpense = PersonalExpense::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get();
                            break;
                        case 4:
                            $accounts = Account::where('account_type', 0)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get();
                            break;
                        case 5:
                            $bankStatement = Account::with('bank')->where('account_type', 1)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get();
                            break;
                        case 6:
                            $projectExpense = ProjectCost::with('project')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get();
                            break;
                        case 7:
                            $supplierMaterial = SupplierMetarialDetails::with('supplier')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get();
                            break;
                    }

                    break;
                case 5:
                    switch ($pageID) {
                        case 1:
                            $salaryManagement = SalaryManagement::with('employee')->whereYear('created_at', Carbon::now()->subMonth()->year)->whereMonth('created_at', Carbon::now()->subMonth()->month)->get();
                            break;
                        case 2:
                            $companyExpense = Expense::whereYear('created_at', Carbon::now()->subMonth()->year)->whereMonth('created_at', Carbon::now()->subMonth()->month)->get();
                            break;
                        case 3:
                            $personalExpense = PersonalExpense::whereYear('created_at', Carbon::now()->subMonth()->year)->whereMonth('created_at', Carbon::now()->subMonth()->month)->get();
                            break;
                        case 4:
                            $accounts = Account::where('account_type', 0)->whereYear('created_at', Carbon::now()->subMonth()->year)->whereMonth('created_at', Carbon::now()->subMonth()->month)->get();
                            break;
                        case 5:
                            $bankStatement = Account::with('bank')->where('account_type', 1)->whereYear('created_at', Carbon::now()->subMonth()->year)->whereMonth('created_at', Carbon::now()->subMonth()->month)->get();
                            break;
                        case 6:
                            $projectExpense = ProjectCost::with('project')->whereYear('created_at', Carbon::now()->subMonth()->year)->whereMonth('created_at', Carbon::now()->subMonth()->month)->get();
                            break;
                        case 7:
                            $supplierMaterial = SupplierMetarialDetails::with('supplier')->whereYear('created_at', Carbon::now()->subMonth()->year)->whereMonth('created_at', Carbon::now()->subMonth()->month)->get();
                            break;
                    }

                    break;
                case 6:
                    switch ($pageID) {
                        case 1:
                            $salaryManagement = SalaryManagement::with('employee')->whereYear('created_at', Carbon::now()->year)->get();
                            break;
                        case 2:
                            $companyExpense = Expense::whereYear('created_at', Carbon::now()->year)->get();
                            break;
                        case 3:
                            $personalExpense = PersonalExpense::whereYear('created_at', Carbon::now()->year)->get();
                            break;
                        case 4:
                            $accounts = Account::where('account_type', 0)->whereYear('created_at', Carbon::now()->year)->get();
                            break;
                        case 5:
                            $bankStatement = Account::with('bank')->where('account_type', 1)->whereYear('created_at', Carbon::now()->year)->get();
                            break;
                        case 6:
                            $projectExpense = ProjectCost::with('project')->whereYear('created_at', Carbon::now()->year)->get();
                            break;
                        case 7:
                            $supplierMaterial = SupplierMetarialDetails::with('supplier')->whereYear('created_at', Carbon::now()->year)->get();
                            break;
                    }

                    break;
                case 7:
                    switch ($pageID) {
                        case 1:
                            $salaryManagement = SalaryManagement::with('employee')->whereYear('created_at', Carbon::now()->subYear()->year)->get();
                            break;
                        case 2:
                            $companyExpense = Expense::whereYear('created_at', Carbon::now()->subYear()->year)->get();
                            break;
                        case 3:
                            $personalExpense = PersonalExpense::whereYear('created_at', Carbon::now()->subYear()->year)->get();
                            break;
                        case 4:
                            $accounts = Account::where('account_type', 0)->whereYear('created_at', Carbon::now()->subYear()->year)->get();
                            break;
                        case 5:
                            $bankStatement = Account::with('bank')->where('account_type', 1)->whereYear('created_at', Carbon::now()->subYear()->year)->get();
                            break;
                        case 6:
                            $projectExpense = ProjectCost::with('project')->whereYear('created_at', Carbon::now()->subYear()->year)->get();
                            break;
                        case 7:
                            $supplierMaterial = SupplierMetarialDetails::with('supplier')->whereYear('created_at', Carbon::now()->subYear()->year)->get();
                            break;
                    }

                    break;
            }
        }

        return view('admin.template_layouts.history.generatedHistory', compact('salaryManagement', 'companyExpense', 'personalExpense','accounts', 'bankStatement', 'projectExpense', 'supplierMaterial'));
    }
}
