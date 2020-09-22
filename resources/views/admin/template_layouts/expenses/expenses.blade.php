@extends('admin.template_parts.master')

@section('css')
    <link rel="stylesheet" href="{{asset('admin/app-assets/vendors/css/forms/toggle/switchery.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/app-assets/css/plugins/forms/switch.css')}}">
@endsection

@section('content')

    <div style="min-height: 0 !important;" class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <section id="validation">

                    <!--============================== Project Summery ==============================-->
                    <div class="row">

                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body cleartfix">
                                        <div class="text-center">
                                            <h2 class="mr-2">
                                                {{number_format($todayExpense,2)}}
                                            </h2>
                                        </div>
                                        <div class="text-center">
                                            <span>Today Expense Amount</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body cleartfix">
                                        <div class="text-center">
                                            <h2 class="mr-2">
                                                {{number_format($crntMonthExpense,2)}}
                                            </h2>
                                        </div>
                                        <div class="text-center">
                                            <span>Current Month Expense</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body cleartfix">
                                        <div class="text-center">
                                            <h2 class="mr-2">
                                                {{number_format($lastMonthExpense,2)}}
                                            </h2>
                                        </div>
                                        <div class="text-center">
                                            <span>Last Month Expense</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--<div class="col-md-3 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body cleartfix">
                                        <div class="text-center">
                                            <h2 class="mr-2">
                                                {{number_format($allExpenses->sum('amount'),2)}}
                                            </h2>
                                        </div>
                                        <div class="text-center">
                                            <span>Total Expense</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>--}}

                    </div>


                    <div class="row">
                        <div class="col-md-9">
                            @include('error.validationError')
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#addNewExpense">
                                Add New Expense
                            </button>
                        </div>
                    </div>


                    <div class="clearfix"></div>


                    <!--++++++++++++++++++++++++++++++++ Add New Expense Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="addNewExpense" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">
                                        Add New Expense
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('expense.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="modal-body">

                                        <div class="row">

                                            <div class="col-md-3 col-12">
                                                <label>Expense type : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <select class="form-control expense_type" name="expense_type">

                                                        @foreach($expense_type as $key => $value)
                                                            <option value="{{$key}}">
                                                                {{$value}}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="otherInput" style="display: none">
                                                    <div class="form-group">
                                                        <input class="form-control" placeholder="Other Expense">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-3 col-12">
                                                <label>Amount : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <input class="form-control" name="amount" required
                                                           placeholder="Amount">
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <label>Payment Mathod : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <select name="payment_method" class="form-control">
                                                        @foreach(payment_method() as $key => $value)
                                                            <option value="{{$key}}">
                                                                {{$value}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <label>Date : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control" name="created_at" required>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <label>Purpose : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <textarea name="purpose" class="form-control" rows="5"
                                                              placeholder="Purpose" required></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <label>Document ( <span class="warning">If You Have</span> ) : </label>
                                                <div class="form-group">
                                                    <input type="file" id="documentImage" onchange="readURL(this)"
                                                           class="form-control" name="document">
                                                    <img class="img-fluid documentImage mt-1" style="display: none;"
                                                         width="100%">
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <label>Branch : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <select name="branch_id" class="form-control" required>

                                                        @foreach($allBranch as $value)
                                                            <option value="{{$value->id}}">
                                                                {{$value->branch_name}}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <label>Status : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <select name="status" class="form-control">

                                                        @foreach(status() as $key => $value)
                                                            <option value="{{$key}}">
                                                                {{$value}}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                                            Close
                                        </button>

                                        <button type="submit" class="btn btn-primary">
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!--============================== History ==============================-->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title text-left pl-2 ml-2">Expense Management</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">

                                        <table
                                            class="table table-striped table-bordered dataex-html5-selectors dataTable"
                                            style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th>Folder Name</th>
                                                <th>Total Expense Amount</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if($allExpenses->isNotEmpty())
                                                @foreach($allExpenses->sortByDesc('created_at') as $key => $expense)

                                                    <tr>
                                                        <td>
                                                            @php
                                                                $name = $allBranch->where('id',$key)->first()->branch_name ?? '----';
                                                            @endphp
                                                            {{$name}}
                                                        </td>
                                                        <td>
                                                            {{number_format($expense->sum('amount'))}} ট
                                                        </td>
                                                        <td>
                                                            <input type="checkbox"
                                                                   class="switchery single_percent_details"
                                                                   id="{{$key}}"
                                                                   title="{{"$name Salary Details"}}"/>
                                                        </td>
                                                    </tr>

                                                @endforeach
                                            @endif

                                            </tbody>
                                        </table>

                                        <!--############################ Salary Details ############################-->
                                        <div class="percent_details mt-5" style="display: none">

                                            <hr class="mb-3">

                                            <p class="primary text-center single_percen_date"
                                               style="font-size: 26px;font-weight: bold;">
                                            </p>

                                            <div class="row px-1">
                                                <div class="col-3 t-head align-self-center">
                                                    <p>Date</p>
                                                </div>
                                                <div class="col-3 t-head align-self-center">
                                                    <p>Method</p>
                                                </div>
                                                <div class="col-3 t-head align-self-center">
                                                    <p>Salary</p>
                                                </div>
                                                <div class="col-3 t-head align-self-center">
                                                    <p>Action</p>
                                                </div>
                                            </div>

                                            <div id="percent_full_details"></div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--++++++++++++++++++++++++++++++++ Purpose Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="purposeModal" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">
                                        Purpose
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="px-2">
                                    <p class="purposeModalContent text-center my-2"></p>
                                </div>

                            </div>
                        </div>
                    </div>


                    <!--++++++++++++++++++++++++++++++++ Update Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="updateModal" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">
                                        Are You Sure You Want To Update This Item
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form method="post" enctype="multipart/form-data">
                                    @method('PATCH')
                                    @csrf

                                    <div class="modal-body">

                                        <div class="row">

                                            <div class="col-md-3 col-12">
                                                <label>Expense type : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <select class="form-control expense_type updateExpensetype"
                                                            name="expense_type">

                                                        @foreach($expense_type as $key => $value)
                                                            <option value="{{$key}}">
                                                                {{$value}}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>


                                                <div class="updateOtherInput otherInput" style="display: none">
                                                    <div class="form-group">
                                                        <input class="form-control updateOtherexpense"
                                                               placeholder="Other Expense">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <label>Amount : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <input class="form-control updateAmount" name="amount" required
                                                           placeholder="Amount">
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <label>Payment Mathod : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <select name="payment_method" class="form-control updateMethod">
                                                        @foreach(payment_method() as $key => $value)
                                                            <option value="{{$key}}">
                                                                {{$value}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <label>Date : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control updateDate" name="created_at"
                                                           required>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <label>Purpose : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <textarea name="purpose" class="form-control updatePurpose" rows="5"
                                                              placeholder="Purpose" required></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <label>Document ( <span class="warning">If You Have</span> ) : </label>
                                                <div class="form-group">
                                                    <input type="file" id="documentImage" onchange="readURL(this)"
                                                           class="form-control" name="document">
                                                    <img src="" class="img-fluid documentImage updateDocument"
                                                         style="display: none;" width="100%"
                                                         height="250px">
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <label>Branch : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <select name="branch_id" class="form-control updateBranch" required>

                                                        @foreach($allBranch as $value)
                                                            <option value="{{$value->id}}">
                                                                {{$value->branch_name}}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <label>Status : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <select name="status" class="form-control updateStatus">

                                                        @foreach(status() as $key => $value)
                                                            <option value="{{$key}}">
                                                                {{$value}}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                                            No
                                        </button>

                                        <button type="submit" class="btn btn-primary">
                                            Yes
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>


                    <!--++++++++++++++++++++++++++++++++ Delete Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="deleteModal" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">
                                        Are You Sure You Want To Delete This Item
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form action="" method="post">
                                    @method('DELETE')
                                    @csrf

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                                            No
                                        </button>

                                        <button type="submit" class="btn btn-primary">
                                            Yes
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('admin/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/forms/toggle/switchery.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/forms/switch.js')}}"></script>

    <script>
        ;(function ($) {
            $(document).ready(function () {

                $(document).on('change', '.single_percent_details', function (e) {
                    e.preventDefault();

                    branch_id = $(this).attr('id');

                    title = $(this).attr('title');

                    $('.single_percen_date').text(title);

                    if ($(this).prop("checked") == true) {

                        $.ajax({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            url: '{{url('admin/showExpenseDetails')}}' + "/" + branch_id,
                            type: "GET",
                            success: function (response) {
                                $('#percent_full_details').html(response);
                                $('.percent_details').show();
                            },
                            error: function () {
                                $('.percent_details').hide();
                            }
                        });


                    } else {
                        $('.percent_details').hide();
                    }
                });

                $(document).on('change', '.expense_type', function () {
                    var expense_type = $(this).val();

                    if (expense_type == 'Others') {
                        $('.otherInput').show();
                        $('.otherInput input').attr('name', 'expense_type');
                        $('.otherInput input').prop('required', true);
                        $(this).removeAttr('name');
                    } else {
                        $('.otherInput').hide();
                        $(this).attr('name', 'expense_type');
                        $('.otherInput input').removeAttr('name');
                        $('.otherInput input').prop('required', false);
                    }

                });


                $("body").delegate('.purposeModal', 'click', function () {
                    console.log('dkkd')
                    $('.purposeModalContent').text($(this).attr('data-content'));
                    $('#purposeModal').modal('show');
                });


                $("body").delegate('.deleteModal', 'click', function () {

                    deleteUrl = '{{route("expense.destroy",":id")}}';
                    deleteUrl = deleteUrl.replace(':id', $(this).attr('data-action'));

                    $('#deleteModal form').attr('action', deleteUrl);
                    $('#deleteModal').modal('show');
                });


                $("body").delegate('.updateModal', 'click', function () {

                    updateUrl = '{{route("expense.update",":expense_id")}}';
                    updateUrl = updateUrl.replace(':expense_id', $(this).attr('data-action'));

                    updateExpenseType = $(this).attr('data-content');
                    updatePurpose = $(this).attr('data-col');
                    updateAmount = $(this).attr('data-end');
                    updateDocument = '{{asset('upload/expense')}}' + '/' + $(this).attr('data-animation');
                    updateStatus = $(this).attr('data-toggle');
                    updateMethod = $(this).attr('data-goto');
                    updateDate = $(this).attr('datatype');
                    updateBranch = $(this).attr('data-icon');

                    if ($(this).attr('data-animation') != '') {
                        $('.documentImage').show();
                    }

                    if (updateStatus == 1) {
                        $(".updateStatus option[value='1']").attr("selected", "selected");
                    } else if (updateStatus == 0) {
                        $(".updateStatus option[value='0']").attr("selected", "selected");
                    }

                    $(".updateMethod option[value='" + updateMethod + "']").attr("selected", "selected");

                    $(".updateBranch option[value='" + updateBranch + "']").attr("selected", "selected");
                    /*if (updateMethod == '1') {
                        $(".updateMethod option[value='1']").attr("selected", "selected");
                    } else if (updateMethod == '2') {
                        $(".updateMethod option[value='2']").attr("selected", "selected");
                    } else if (updateMethod == '3') {
                        $(".updateMethod option[value='3']").attr("selected", "selected");
                    }*/

                    if (updateExpenseType == 'Administration') {
                        $(".updateExpensetype option[value='Administration']").attr("selected", "selected");
                    } else if (updateExpenseType == 'Site') {
                        $(".updateExpensetype option[value='Site']").attr("selected", "selected");
                    } else {
                        $(".updateExpensetype option[value='Others']").attr("selected", "selected");

                        $('.updateExpensetype').removeAttr('name');
                        $('.updateOtherexpense').attr('name', 'expense_type');

                        $('.updateOtherexpense').val(updateExpenseType);
                        $('.updateOtherInput').show();
                    }

                    $('.updateExpenseType').val(updateExpenseType);
                    $('.updatePurpose').val(updatePurpose);
                    $('.updateAmount').val(updateAmount);
                    $('.updateDate').val(updateDate);
                    $('.updateDocument').attr('src', updateDocument);
                    $('.updateStatus').attr('src', updateStatus);

                    $('#updateModal form').attr('action', updateUrl);
                    $('#updateModal').modal('show');
                });

            });
        })(jQuery);

    </script>
@endsection
