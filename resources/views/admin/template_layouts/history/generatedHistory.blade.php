@extends('admin.template_parts.master')

@section('css')
    <style>
        .customHead {
            background: transparent !important;
            color: #000000 !important;
            border: 1px solid #0c1d2f !important;
        }
    </style>
@endsection

@section('content')
    <div style="min-height: 0 !important;" class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <section id="validation">


                    <button class="btn btn-primary float-right mr-2 mt-1" onclick="printDiv()">Print</button>
                    <div class="clearfix"></div>


                    <!--============================== History ==============================-->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title text-left pl-2 ml-2">Generated History</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard" id="printarea">

                                        <!--############################ Salary Report ############################-->
                                        @if ($salaryManagement != null && $salaryManagement->count() > 0)

                                            <div class="text-center mb-1">
                                                <h3><b>Employee Salary Report</b></h3>
                                            </div>

                                            <div class="row px-1">
                                                <div class="col-3 t-head customHead align-self-center">
                                                    <p>#</p>
                                                </div>
                                                <div class="col-3 t-head customHead align-self-center">
                                                    <p>Employee Name</p>
                                                </div>
                                                <div class="col-3 t-head customHead align-self-center">
                                                    <p>Amount</p>
                                                </div>
                                                <div class="col-3 t-head customHead align-self-center">
                                                    <p>Date</p>
                                                </div>
                                            </div>

                                            @foreach($salaryManagement as $key => $salary)
                                                <div class="row px-1">

                                                    <div class="col-md-3 col-12 t-c">{{$key + 1}}</div>

                                                    <div class="col-md-3 col-12 t-c">
                                                        {{$salary->employee->name}}
                                                    </div>

                                                    <div
                                                        class="col-md-3 col-12 t-c">{{number_format($salary->amount,2)}}
                                                        BDT
                                                    </div>

                                                    <div class="col-md-3 col-12 t-c">
                                                        {{date('d M, Y',strtotime($salary->created_at))}}
                                                    </div>

                                                </div>
                                            @endforeach

                                        @endif


                                    <!--############################ Company Expense ############################-->
                                        @if ($companyExpense != null && $companyExpense->count() > 0)

                                            <div class="text-center mb-1 mt-1">
                                                <h3><b>Company Expense Report</b></h3>
                                            </div>

                                            <div class="row px-1">
                                                <div class="col-2 t-head customHead align-self-center">
                                                    <p>Date</p>
                                                </div>
                                                <div class="col-2 t-head customHead align-self-center">
                                                    <p>Type</p>
                                                </div>
                                                <div class="col-3 t-head customHead align-self-center">
                                                    <p>Amount</p>
                                                </div>
                                                <div class="col-3 t-head customHead align-self-center">
                                                    <p>Purpose</p>
                                                </div>
                                                <div class="col-2 t-head customHead align-self-center">
                                                    <p>Method</p>
                                                </div>
                                            </div>

                                            @foreach($companyExpense as $expense)
                                                <div class="row px-1">

                                                    <div class="col-md-2 col-12 t-c">
                                                        {{date('d M, Y',strtotime($expense->created_at))}}
                                                    </div>

                                                    <div class="col-md-2 col-12 t-c">
                                                        {{$expense->expense_type ?? '-----'}}
                                                    </div>

                                                    <div class="col-md-3 col-12 t-c">{{round($expense->amount,2)}}BDT
                                                    </div>

                                                    <div
                                                        class="col-md-3 col-12 t-c">{{$expense->purpose ?? '----'}}</div>

                                                    <div class="col-md-2 col-12 t-c">
                                                        @if($expense->payment_method == 1)
                                                            {{"Cash"}}
                                                        @elseif($expense->payment_method == 2)
                                                            {{"Bank"}}
                                                        @elseif($expense->payment_method == 3)
                                                            {{"Bkash"}}
                                                        @endif
                                                    </div>

                                                </div>
                                            @endforeach

                                        @endif


                                    <!--############################ Personal Expense ############################-->
                                        @if ($personalExpense != null && $personalExpense->count() > 0)

                                            <div class="text-center mb-1 mt-1">
                                                <h3><b>Personal Expense Report</b></h3>
                                            </div>

                                            <div class="row px-1">
                                                <div class="col-2 t-head customHead align-self-center">
                                                    <p>Date</p>
                                                </div>
                                                <div class="col-2 t-head customHead align-self-center">
                                                    <p>Type</p>
                                                </div>
                                                <div class="col-3 t-head customHead align-self-center">
                                                    <p>Amount</p>
                                                </div>
                                                <div class="col-3 t-head customHead align-self-center">
                                                    <p>Purpose</p>
                                                </div>
                                                <div class="col-2 t-head customHead align-self-center">
                                                    <p>Method</p>
                                                </div>
                                            </div>

                                            @foreach($personalExpense as $expense)
                                                <div class="row px-1">

                                                    <div class="col-md-2 col-12 t-c">
                                                        {{date('d M, Y',strtotime($expense->created_at))}}
                                                    </div>

                                                    <div class="col-md-2 col-12 t-c">
                                                        {{$expense->expense_type ?? '-----'}}
                                                    </div>

                                                    <div
                                                        class="col-md-3 col-12 t-c">{{number_format($expense->amount,2)}}
                                                        BDT
                                                    </div>

                                                    <div
                                                        class="col-md-3 col-12 t-c">{{$expense->purpose ?? '----'}}</div>

                                                    <div class="col-md-2 col-12 t-c">
                                                        @if($expense->payment_method == 1)
                                                            {{"Cash"}}
                                                        @elseif($expense->payment_method == 2)
                                                            {{"Bank"}}
                                                        @elseif($expense->payment_method == 3)
                                                            {{"Bkash"}}
                                                        @endif
                                                    </div>

                                                </div>
                                            @endforeach

                                        @endif


                                    <!--############################ Company Account ############################-->
                                        @if ($accounts != null && $accounts->count() > 0)

                                            <div class="text-center mb-1 mt-1">
                                                <h3><b>Company Account Report</b></h3>
                                            </div>

                                            <div class="row px-1">
                                                <div class="col-3 t-head customHead align-self-center">
                                                    <p>Date</p>
                                                </div>
                                                <div class="col-3 t-head customHead align-self-center">
                                                    <p>Type</p>
                                                </div>
                                                <div class="col-3 t-head customHead align-self-center">
                                                    <p>Amount</p>
                                                </div>
                                                <div class="col-3 t-head customHead align-self-center">
                                                    <p>Purpose</p>
                                                </div>
                                            </div>

                                            @foreach($accounts as $account)
                                                <div class="row px-1">

                                                    <div class="col-md-3 col-12 t-c">
                                                        {{date('d M, Y',strtotime($account->created_at))}}
                                                    </div>

                                                    <div class="col-md-3 col-12 t-c">
                                                        @if($account->type == 1)
                                                            {{'Receivable'}}
                                                        @elseif($account->type == 2)
                                                            {{'Payble'}}
                                                        @else
                                                            {{$account->type ?? '---'}}
                                                        @endif
                                                    </div>

                                                    <div
                                                        class="col-md-3 col-12 t-c">{{number_format($account->amount,2)}}
                                                        BDT
                                                    </div>

                                                    <div
                                                        class="col-md-3 col-12 t-c">{{$account->purpose ?? '----'}}</div>

                                                </div>
                                            @endforeach

                                        @endif


                                    <!--############################ Bank Statement ############################-->
                                        @if ($bankStatement != null && $bankStatement->count() > 0)

                                            <div class="text-center mb-1 mt-1">
                                                <h3><b>Bank Statement Report</b></h3>
                                            </div>

                                            <div class="row px-1">
                                                <div class="col-2 t-head customHead align-self-center">
                                                    <p>Date</p>
                                                </div>
                                                <div class="col-2 t-head customHead align-self-center">
                                                    <p>Type</p>
                                                </div>
                                                <div class="col-3 t-head customHead align-self-center">
                                                    <p>Bank Details</p>
                                                </div>
                                                <div class="col-2 t-head customHead align-self-center">
                                                    <p>Amount</p>
                                                </div>
                                                <div class="col-3 t-head customHead align-self-center">
                                                    <p>Purpose</p>
                                                </div>
                                            </div>

                                            @foreach($bankStatement as $account)
                                                <div class="row px-1">

                                                    <div class="col-md-2 col-12 t-c">
                                                        {{date('d M, Y',strtotime($account->created_at))}}
                                                    </div>

                                                    <div class="col-md-2 col-12 t-c">
                                                        @if($account->type == 1)
                                                            {{'Receivable'}}
                                                        @elseif($account->type == 2)
                                                            {{'Payble'}}
                                                        @else
                                                            {{$account->type ?? '---'}}
                                                        @endif
                                                    </div>

                                                    <div class="col-md-3 col-12 t-c">
                                                        {{$account->bank->bank_name ?? '----'}}
                                                        &nbsp;&nbsp;&nbsp;{{$account->bank->account_number ?? '----'}}
                                                        <br>{{$account->bank->branch_name ?? '----'}}
                                                        &nbsp;&nbsp;&nbsp;{{$account->bank->account_holder_name ?? '----'}}
                                                    </div>

                                                    <div
                                                        class="col-md-2 col-12 t-c">{{number_format($account->amount,2)}}
                                                        BDT
                                                    </div>

                                                    <div
                                                        class="col-md-3 col-12 t-c">{{$account->purpose ?? '----'}}</div>

                                                </div>
                                            @endforeach

                                        @endif


                                    <!--############################ Bank Statement ############################-->
                                        @if ($projectExpense != null && $projectExpense->count() > 0)

                                            <div class="text-center mb-1 mt-1">
                                                <h3><b>Project Expense</b></h3>
                                            </div>

                                            <div class="row px-1">
                                                <div class="col-2 t-head customHead align-self-center">
                                                    <p>Payment Date</p>
                                                </div>
                                                <div class="col-3 t-head customHead align-self-center">
                                                    <p>Project Name</p>
                                                </div>
                                                <div class="col-2 t-head customHead align-self-center">
                                                    <p>Purpose</p>
                                                </div>
                                                <div class="col-2 t-head customHead align-self-center">
                                                    <p>Amount</p>
                                                </div>
                                                <div class="col-3 t-head customHead align-self-center">
                                                    <p>Payment Method</p>
                                                </div>
                                            </div>

                                            @foreach($projectExpense as $expense)
                                                <div class="row px-1">

                                                    <div class="col-md-2 col-12 t-c">
                                                        @if (!is_null($expense->payment_date))
                                                            {{date('d M, Y',strtotime($expense->payment_date))}}
                                                        @else
                                                            {{date('d M, Y',strtotime($expense->created_at))}}
                                                        @endif
                                                    </div>

                                                    <div class="col-md-3 col-12 t-c">
                                                        {{$expense->project->project_name ?? '---'}}
                                                    </div>

                                                    <div class="col-md-2 col-12 t-c">
                                                        {{$expense->purpose ?? '--'}}
                                                    </div>

                                                    <div
                                                        class="col-md-2 col-12 t-c">{{number_format($expense->amount,2)}}
                                                        BDT
                                                    </div>

                                                    <div class="col-md-3 col-12 t-c">
                                                        @if ($expense->payment_method == 1)
                                                            {{"Cash"}}
                                                        @elseif ($expense->payment_method == 2)
                                                            {{"Bank"}}
                                                        @elseif ($expense->payment_method == 3)
                                                            {{"Bkash"}}
                                                        @endif
                                                    </div>

                                                </div>
                                            @endforeach

                                        @endif


                                    <!--############################ Bank Statement ############################-->
                                        @if ($supplierMaterial != null && $supplierMaterial->count() > 0)

                                            <div class="text-center mb-1 mt-1">
                                                <h3><b>Supplier Material Report</b></h3>
                                            </div>

                                            <div class="row px-1">
                                                <div class="col-2 t-head customHead align-self-center">
                                                    <p>Date</p>
                                                </div>
                                                <div class="col-2 t-head customHead align-self-center">
                                                    <p>Supplier Name</p>
                                                </div>
                                                <div class="col-2 t-head customHead align-self-center">
                                                    <p>Total Amount</p>
                                                </div>
                                                <div class="col-2 t-head customHead align-self-center">
                                                    <p>Advanced Amount</p>
                                                </div>
                                                <div class="col-2 t-head customHead align-self-center">
                                                    <p>Due Amount</p>
                                                </div>
                                                <div class="col-2 t-head customHead align-self-center">
                                                    <p>Description</p>
                                                </div>
                                            </div>

                                            @foreach($supplierMaterial as $supp_material)
                                                <div class="row px-1">

                                                    <div class="col-md-2 col-12 t-c">
                                                        {{date('d M, Y',strtotime($supp_material->created_at))}}
                                                    </div>

                                                    <div class="col-md-2 col-12 t-c">
                                                        {{$supp_material->supplier->name ?? '---'}}
                                                    </div>

                                                    <div class="col-md-2 col-12 t-c">
                                                        {{number_format($supp_material->total_amount ?? 0,2)}} BDT
                                                    </div>

                                                    <div class="col-md-2 col-12 t-c">
                                                        {{number_format($supp_material->advanced_amount ?? 0,2)}} BDT
                                                    </div>

                                                    <div class="col-md-2 col-12 t-c">
                                                        {{number_format($supp_material->due_amount ?? 0,2)}} BDT
                                                    </div>

                                                    <div class="col-md-2 col-12 t-c">
                                                        @php
                                                            echo html_entity_decode($supp_material->metarial_details);
                                                        @endphp
                                                    </div>

                                                </div>
                                            @endforeach

                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#customCheck0').click(function () {
                if ($(this).prop('checked') == true) {
                    $('.custom-control-input').prop('checked', true);
                } else if ($(this).prop('checked') == false) {
                    $('.custom-control-input').prop('checked', false);
                }
            });

            $('.pageCheck').click(function () {
                if ($('.pageCheck:checked').length == $('.pageCheck').length) {
                    $('.custom-control-input').prop('checked', true);
                } else {
                    $('#customCheck0').prop('checked', false);
                }
            });
        });

        function printDiv() {
            var printContents = document.getElementById("printarea").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
