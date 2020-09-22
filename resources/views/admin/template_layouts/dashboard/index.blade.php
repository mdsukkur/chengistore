@extends('admin.template_parts.master')

@section('title','Home')

@section('css')
    <style>
        td, th {
            text-align: center;
            border-right: 1px solid #e5e5e5;
        }
    </style>
@endsection

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">

                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card credit-card-wrapper card-wrapper">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <i class="fa fa-money font-large-2 white" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="custom-card-text"><i class="icofont-taka "></i>
                                            ট {{number_format($account->where('account_type',0)->sum('amount'),2)}}
                                        </p>
                                    </div>
                                    <div class="col-sm-12">
                                        <p class="custom-card-text card-total">
                                            Company Account Amount
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer custom-card-footer text-muted">
                                <a class="text-left" href="{{route('account.index')}}">View Details</a>
                                <a href="{{route('account.index')}}"><i class="ft-arrow-right text-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card debit-card-wrapper card-wrapper">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <i class="fa fa-money font-large-2 white" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="custom-card-text"><i class="icofont-taka "></i>
                                            ট {{number_format($account->where('account_type',1)->sum('amount'),2)}}
                                        </p>
                                    </div>
                                    <div class="col-sm-12">
                                        <p class="custom-card-text card-total">
                                            Bank Transection Amount
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer custom-card-footer text-muted">
                                <a class="text-left" href="{{route('account.bank_statement')}}">View Details</a>
                                <a href="{{route('account.bank_statement')}}"><i class="ft-arrow-right text-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card wallet-card-wrapper card-wrapper">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <i class="fa fa-money font-large-2 white" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="custom-card-text"><i class="icofont-taka"></i>
                                            ট {{number_format($companyExpense->sum('amount'),2)}}
                                        </p>
                                    </div>
                                    <div class="col-sm-12">
                                        <p class="custom-card-text card-total">Company Expense Amount</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer custom-card-footer text-muted">
                                <a class="text-left" href="{{route('expense.index')}}">View Details</a>
                                <a href="{{route('expense.index')}}"><i class="ft-arrow-right text-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card withdrawable-card-wrapper card-wrapper">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <i class="fa fa-money font-large-2 white" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="custom-card-text"><i class="icofont-taka "></i>
                                            ট {{number_format($personalExpense->sum('amount'),2)}}
                                        </p>
                                    </div>
                                    <div class="col-sm-12">
                                        <p class="custom-card-text card-total">Personal Expense Amount</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer custom-card-footer text-muted">
                                <a class="text-left" href="{{route('personal_expense.index')}}">View Details</a>
                                <a href="{{route('personal_expense.index')}}"><i class="ft-arrow-right text-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Company Expense -->
                <div class="row match-height">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <h4 class="card-title">Latest Ten Company Expense</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div id="audience-list-scroll" class="table-responsive height-300 position-relative">
                                    <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th style="width: 20% !important;">Purpose</th>
                                            <th>Amount</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($companyExpense->sortByDesc('created_at')->take(10) as $expense)
                                            <tr>
                                                <td>
                                                    {{date('d M, Y',strtotime($expense->created_at))}}
                                                </td>
                                                <td>
                                                    {{$expense->expense_type ?? '-----'}}
                                                </td>
                                                <td>
                                                    {{$expense->purpose ?? '---'}}
                                                </td>
                                                <td>
                                                    {{number_format($expense->amount)}} ট
                                                </td>
                                                <td>
                                                    @if($expense->payment_method == 1)
                                                        {{"Cash"}}
                                                    @else
                                                        {{"Bank"}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($expense->status == 1)
                                                        <span class="badge badge-primary badge-pill">
                                                                    Active
                                                                </span>
                                                    @elseif($expense->status == 0)
                                                        <span class="badge badge-danger badge-pill">
                                                                    Deactive
                                                                </span>
                                                    @else
                                                        -----
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Accounts -->
                <div class="row match-height">
                    <div class="col-xl-6 col-lg-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <h4 class="card-title">Last Ten Account Statement</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div id="audience-list-scroll" class="table-responsive height-300 position-relative">
                                    <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Purpose</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($account->where('account_type',0)->sortByDesc('created_at')->take(10) as $ac)
                                            <tr>
                                                <td>
                                                    {{date('d M, Y',strtotime($ac->created_at))}}
                                                </td>
                                                <td>
                                                    @if($ac->type == 1)
                                                        {{'Receivable'}}
                                                    @elseif($ac->type == 2)
                                                        {{'Payble'}}
                                                    @else
                                                        {{$ac->type ?? '---'}}
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$ac->purpose ?? '---'}}
                                                </td>
                                                <td>
                                                    {{number_format($ac->amount)}} ট
                                                </td>
                                                <td>
                                                    @if($ac->status == 1)
                                                        <span class="badge badge-primary badge-pill">
                                                                    Active
                                                                </span>
                                                    @elseif($ac->status == 0)
                                                        <span class="badge badge-danger badge-pill">
                                                                    Deactive
                                                                </span>
                                                    @else
                                                        -----
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <h4 class="card-title">Last Ten Bank Statement</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div id="audience-list-scroll" class="table-responsive height-300 position-relative">
                                    <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Bank Details</th>
                                            <th>Purpose</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($account->where('account_type',1)->sortByDesc('created_at')->take(10) as $ac)
                                            <tr>
                                                <td>
                                                    {{date('d M, Y',strtotime($ac->created_at))}}
                                                </td>
                                                <td>
                                                    @if($ac->type == 1)
                                                        {{'Receivable'}}
                                                    @elseif($ac->type == 2)
                                                        {{'Payble'}}
                                                    @else
                                                        {{$ac->type ?? '---'}}
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$ac->bank->bank_name ?? '----'}}
                                                    &nbsp;&nbsp;&nbsp;{{$ac->bank->account_number ?? '----'}}
                                                    <br>{{$ac->bank->branch_name ?? '----'}}
                                                    &nbsp;&nbsp;&nbsp;{{$ac->bank->account_holder_name ?? '----'}}
                                                </td>
                                                <td>
                                                    {{$ac->purpose ?? '---'}}
                                                </td>
                                                <td>
                                                    {{number_format($ac->amount)}} ট
                                                </td>
                                                <td>
                                                    @if($ac->status == 1)
                                                        <span class="badge badge-primary badge-pill">
                                                                    Active
                                                                </span>
                                                    @elseif($ac->status == 0)
                                                        <span class="badge badge-danger badge-pill">
                                                                    Deactive
                                                                </span>
                                                    @else
                                                        -----
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
