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


                    <div class="row">
                        <div class="col-md-9">
                            @include('error.validationError')
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#addNewSalary">
                                Add New Salary
                            </button>
                        </div>
                    </div>


                    <div class="clearfix"></div>


                    <!--++++++++++++++++++++++++++++++++ Add New Salary Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="addNewSalary" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">
                                        Add New Salary
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('SalaryManagement.store')}}" method="POST">
                                    @csrf

                                    <div class="modal-body">

                                        <div class="row">

                                            <div class="col-md-4 col-12">
                                                <label>Employee : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <select name="emp_id" class="form-control" required>

                                                        @foreach($allEmployees as $emp)
                                                            <option value="{{$emp->id}}">
                                                                {{$emp->name}}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <label>Payment Method : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <select name="payment_method" class="form-control" required>
                                                        <option value="Cash">Cash</option>
                                                        <option value="Bank">Bank</option>
                                                        <option value="Bkash">Bkash</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <label>Salary Month :</label>
                                                <div class="form-group">
                                                    <input class="form-control" value="{{date('Y-m')}}"
                                                           name="salary_month"
                                                           placeholder="Salary Month" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label>Salary : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <input class="form-control" name="amount" required
                                                           placeholder="Salary">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Date : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control" name="created_at" required>
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <label>Note : </label>
                                                <div class="form-group">
                                                    <textarea name="note" class="form-control" rows="2"
                                                              placeholder="Note"></textarea>
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
                                    <h4 class="card-title text-left pl-2 ml-2">Salary Management</h4>
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

                                        <table class="table table-striped table-bordered dataTable"
                                               style="width: 100%">
                                            <thead>
                                            <tr style="text-align: center">
                                                <th>Employee Name</th>
                                                <th>Total Salary</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if($allSalaries->isNotEmpty())
                                                @foreach($allSalaries as $key => $salary)

                                                    <tr>
                                                        <td>
                                                            @php
                                                                $name = $allEmployees->where('id',$key)->first()->name ?? '---';
                                                            @endphp

                                                            {{$name}}
                                                        </td>
                                                        <td>{{number_format($salary->sum('amount'),2)}} ট</td>
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

                                <form action="" method="post" enctype="multipart/form-data">
                                    @method('PATCH')
                                    @csrf

                                    <div class="modal-body">

                                        <div class="row">

                                            <div class="col-md-4 col-12">
                                                <label>Payment Method : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <select name="payment_method" class="form-control salary_payment"
                                                            required>
                                                        <option value="Cash">Cash</option>
                                                        <option value="Bank">Bank</option>
                                                        <option value="Bkash">Bkash</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <label>Salary Month :</label>
                                                <div class="form-group">
                                                    <input class="form-control salary_month" value="{{date('Y-m')}}"
                                                           name="salary_month"
                                                           placeholder="Salary Month" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label>Salary : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <input class="form-control salary_amount" name="amount" required
                                                           placeholder="Salary">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Date : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control salary_date"
                                                           name="created_at" required>
                                                </div>
                                            </div>

                                            <div class="col-md-9">
                                                <label>Note : </label>
                                                <div class="form-group">
                                                    <textarea name="note" class="form-control salary_note" rows="2"
                                                              placeholder="Note"></textarea>
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
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>

                    <!--++++++++++++++++++++++++++++++++ Delete Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="noteModal" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">
                                        Note
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <p class="bodyContent">

                                    </p>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                                        Close
                                    </button>
                                </div>

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

                $('.dataTable').DataTable();

                $(document).on('change', '.single_percent_details', function (e) {
                    e.preventDefault();

                    emp_id = $(this).attr('id');

                    title = $(this).attr('title');

                    $('.single_percen_date').text(title);

                    if ($(this).prop("checked") == true) {

                        $.ajax({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            url: '{{url('admin/showSalaryDetails')}}' + "/" + emp_id,
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


                $("body").delegate(".deleteModal", "click", function () {
                    deleteUrl = '{{route("SalaryManagement.destroy",":SalaryID")}}';
                    deleteUrl = deleteUrl.replace(':SalaryID', $(this).attr('data-action'));

                    $('#deleteModal form').attr('action', deleteUrl);
                    $('#deleteModal').modal('show');
                });

                $("body").delegate(".noteModal", "click", function () {
                    note = $(this).attr('data-action');
                    $('.bodyContent').text(note);
                    $('#noteModal').modal('show');
                });

                $("body").delegate(".updateModal", "click", function () {

                    updateUrl = '{{route("SalaryManagement.update",":SalaryID")}}';
                    updateUrl = updateUrl.replace(':SalaryID', $(this).attr('data-action'));

                    salary_payment = $(this).attr('data-col');
                    salary_month = $(this).attr('data-end');
                    salary_amount = $(this).attr('data-content');
                    salary_note = $(this).attr('data-goto');
                    salary_date = $(this).attr('datatype');

                    $(".salary_payment option[value='" + salary_payment + "']").attr('selected', 'selected');
                    /*if (salary_payment == 'Cash') {
                        $(".salary_payment option[value='Cash']").attr('selected', 'selected');
                    } else if (salary_payment == "Bank") {
                        $(".salary_payment option[value='Bank']").attr('selected', 'selected');
                    }*/

                    $('.salary_month').val(salary_month);
                    $('.salary_amount').val(salary_amount);
                    $('.salary_note').val(salary_note);
                    $('.salary_date').val(salary_date);

                    $('#updateModal form').attr('action', updateUrl);
                    $('#updateModal').modal('show');

                });


            });
        })(jQuery);


    </script>
@endsection
