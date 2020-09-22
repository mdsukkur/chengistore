@php
    $totalProfit = ($projectDetails->project_budget ?? 0) - ($projectDetails->cost->sum('amount') ?? 0);
@endphp

@extends('admin.template_parts.master')

@section('css')
    <link rel="stylesheet" href="{{asset('admin/app-assets/vendors/css/forms/toggle/switchery.min.css')}}">

    <style>
        .partnerCard .dataTables_filter {
            display: flex;
            justify-content: flex-end;
        }

        .summery .stats-amount {
            margin: 0 auto;
        }
    </style>

@endsection

@section('content')

    <div style="min-height: 0 !important;" class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <section id="validation">


                @include('error.validationError')


                <!--============================== Project Summery ==============================-->
                    <div class="row">

                        <div class="col-md-3 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body cleartfix">
                                        <div class="text-center">
                                            <h2 class="mr-2">
                                                {{number_format($projectDetails->project_budget ?? 0,2)}}
                                            </h2>
                                        </div>
                                        <div class="text-center">
                                            <span>Project Budget</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body cleartfix">
                                        <div class="text-center">
                                            <h2 class="mr-2">
                                                {{number_format($projectDetails->invest_amount->sum('amount') ?? 0,2)}}
                                            </h2>
                                        </div>
                                        <div class="text-center">
                                            <span>Total Invest Amount</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body cleartfix">
                                        <div class="text-center">
                                            <h2 class="mr-2">
                                                {{number_format($projectDetails->cost->sum('amount') ?? 0,2)}}
                                            </h2>
                                        </div>
                                        <div class="text-center">
                                            <span>Project Expense</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body cleartfix">
                                        <div class="text-center">
                                            <h2 class="mr-2">
                                                {{number_format($totalProfit,2)}}
                                            </h2>
                                        </div>
                                        <div class="text-center">
                                            <span>Total Profit</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <!--============================== Partner ==============================-->
                        <div class="col-md-5">

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title text-left pl-2 ml-2">Project Invest Amount</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard partnerCard">


                                        <form action="{{route('projectInvestAmount.store')}}" method="post"
                                              class="mb-5">
                                            @csrf

                                            <label>Amount : <span class="danger"> *</span></label>
                                            <input class="form-control mb-1" name="amount" placeholder="Amount"
                                                   required>

                                            <div class="row">

                                                <div class="col-md-6 col-12">
                                                    <label>Payment Method : <span class="danger"> *</span></label>
                                                    <select name="payment_method" class="form-control mb-1" required>

                                                        @foreach(payment_method() as $key => $value)
                                                            <option value="{{$key}}">{{$value}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <label>Payment Date : <span class="danger"> *</span></label>
                                                    <input type="date" class="form-control mb-1" name="created_at"
                                                           required>
                                                </div>

                                            </div>

                                            <label>Note :</label>
                                            <textarea name="note" class="form-control" rows="3"
                                                      placeholder="Write a message"></textarea>

                                            <input type="hidden" name="project_id"
                                                   value="{{$projectDetails->id ?? null}}">

                                            <div class="text-center mt-2">
                                                <button class="btn btn-danger">Submit</button>
                                            </div>

                                        </form>


                                        <table class="table table-striped table-bordered partnerDatable"
                                               style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Method</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if($projectDetails->invest_amount->isNotEmpty())
                                                @foreach($projectDetails->invest_amount->sortByDesc('created_at') as $invest)

                                                    <tr>

                                                        <td>
                                                            {{date('d M, Y',strtotime($invest->created_at))}}
                                                        </td>
                                                        <td>
                                                            {{number_format($invest->amount,2)}} BDT

                                                            @if ($invest->note != null)
                                                                <span data-placement="top" data-toggle="tooltip"
                                                                      data-original-title="Note">
                                                                    <a class="btn btn-primary btn-xs investNoteModal ml-1"
                                                                       data-goto="{{$invest->note ?? ''}}">
                                                                        <i class="fa fa-info"></i>
                                                                    </a>
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($invest->payment_method == 1)
                                                                {{'Cash'}}
                                                            @elseif ($invest->payment_method == 2)
                                                                {{'Bank'}}
                                                            @elseif ($invest->payment_method == 3)
                                                                {{'Bkash'}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Edit">
                                                                <a class="btn btn-warning btn-xs investUpdateModal"
                                                                   data-action="{{$invest->id}}"
                                                                   data-col="{{$invest->amount}}"
                                                                   data-end="{{$invest->payment_method}}"
                                                                   data-goto="{{$invest->note ?? ''}}"
                                                                   datatype="{{date("Y-m-d",strtotime($invest->created_at))}}">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            </span>

                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Delete"
                                                                  aria-describedby="tooltip406983">
                                                                <a class="btn btn-danger btn-xs investDeleteModal"
                                                                   data-action="{{$invest->id}}">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </span>
                                                        </td>
                                                    </tr>

                                                @endforeach
                                            @endif

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title text-left pl-2 ml-2">Project Partner</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard partnerCard">


                                        <form action="{{route('projectPartner.store')}}" method="post" class="mb-5">
                                            @csrf

                                            <label>Partner Name : <span class="danger"> *</span></label>
                                            <input class="form-control mb-1" name="name" placeholder="Partner Name"
                                                   required>


                                            <label>Partner Percentage : <span class="danger"> *</span></label>
                                            <input class="form-control" name="percent" placeholder="Partner Percent"
                                                   required type="number">

                                            <input type="hidden" name="project_id"
                                                   value="{{$projectDetails->id ?? null}}">

                                            <div class="text-center mt-2">
                                                <button class="btn btn-danger">Submit</button>
                                            </div>

                                        </form>


                                        <table class="table table-striped table-bordered partnerDatable"
                                               style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Percent</th>
                                                <th>Profit Percent</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if($projectDetails->partner->isNotEmpty())
                                                @foreach($projectDetails->partner->sortByDesc('id') as $partner)

                                                    <tr>

                                                        <td>
                                                            {{$partner->name ?? '----'}}
                                                        </td>
                                                        <td>
                                                            {{$partner->percent ?? 0}} %
                                                        </td>
                                                        <td>
                                                            {{number_format($totalProfit * ($partner->percent ?? 0) / 100,2)}}
                                                            BDT
                                                        </td>
                                                        <td>
                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Edit">
                                                                <a class="btn btn-warning btn-xs partnerUpdateModal"
                                                                   data-action="{{$partner->id}}"
                                                                   data-content="{{$partner->name}}"
                                                                   data-col="{{$partner->percent}}">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            </span>

                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Delete"
                                                                  aria-describedby="tooltip406983">
                                                                <a class="btn btn-danger btn-xs partnerDeleteModal"
                                                                   data-action="{{$partner->id}}">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </span>
                                                        </td>
                                                    </tr>

                                                @endforeach
                                            @endif

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>


                        <!--============================== Project Cost ==============================-->
                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title text-left pl-2 ml-2">Project Expense</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard partnerCard">


                                        <form action="{{route('projectCost.store')}}" method="post" class="mb-5">
                                            @csrf

                                            <div class="row">
                                                <div class="col-md-4">

                                                    <label>Expense Amount : <span
                                                            class="danger"> *</span></label>
                                                    <input class="form-control" name="amount"
                                                           placeholder="Expense Amount" required type="number">

                                                </div>

                                                <div class="col-md-4">

                                                    <label>Payment Date : <span
                                                            class="danger"> *</span></label>
                                                    <input class="form-control" name="payment_date"
                                                           placeholder="Payment Date" required type="date">

                                                </div>

                                                <div class="col-md-4">
                                                    <label>Payment Method : <span
                                                            class="danger"> *</span></label>
                                                    <select name="payment_method" class="form-control" required>
                                                        @foreach(payment_method() as $key => $value)
                                                            <option value="{{$key}}">
                                                                {{$value}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-12 mt-1">

                                                    <label>Expense Purpose : <span
                                                            class="danger"> *</span></label>
                                                    <textarea name="purpose" class="form-control mb-1" rows="3" required
                                                              placeholder="Purpose"></textarea>

                                                </div>
                                            </div>

                                            <input type="hidden" name="project_id"
                                                   value="{{$projectDetails->id ?? null}}">

                                            <div class="text-center mt-2">
                                                <button class="btn btn-danger">Submit</button>
                                            </div>

                                        </form>


                                        @php
                                            $allHistory = $projectDetails->cost()->orderBy('payment_date','DESC')->get();
                                        @endphp

                                        <table
                                            class="table table-striped table-bordered partnerDatable"
                                            style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th>Payment Date</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if($allHistory->count() > 0)
                                                @foreach($allHistory->unique('payment_date') as $cost)

                                                    <tr>
                                                        <td>
                                                            @if (($cost->payment_date ?? null) != null)
                                                                {{date('d M, Y',strtotime($cost->payment_date ?? null))}}
                                                            @else
                                                                {{date('d M, Y',strtotime($cost->created_at ?? null))}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{--{{number_format($cost->amount ?? 0,2)}} BDT--}}
                                                            {{number_format($allHistory->where('payment_date',$cost->payment_date)->sum('amount') ?? 0,2)}}
                                                            BDT
                                                        </td>
                                                        <td>

                                                            <input type="checkbox"
                                                                   class="switchery single_percent_details"
                                                                   id="{{date('Y-m-d',strtotime($cost->payment_date))}}"
                                                                   title="{{date('d M, Y',strtotime($cost->payment_date))}}"/>
                                                        </td>
                                                    </tr>

                                                @endforeach
                                            @endif

                                            </tbody>
                                        </table>


                                        <!--############################ Cost Details ############################-->
                                        <div class="percent_details mt-5" style="display: none">

                                            <hr class="mb-3">

                                            <p class="primary text-center single_percen_date"
                                               style="font-size: 26px;font-weight: bold;">
                                            </p>

                                            <div class="row px-1">
                                                <div class="col-4 t-head align-self-center">
                                                    <p>Purpose</p>
                                                </div>
                                                <div class="col-2 t-head align-self-center">
                                                    <p>Method</p>
                                                </div>
                                                <div class="col-4 t-head align-self-center">
                                                    <p>Amount</p>
                                                </div>
                                                <div class="col-2 t-head align-self-center">
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


                    <!--++++++++++++++++++++++++++++++++ Partner Update Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="partnerUpdateModal" role="dialog">
                        <div class="modal-dialog" role="document">
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

                                        <label>Partner Name : <span class="danger"> *</span></label>
                                        <input class="form-control mb-1 partnerName" name="name"
                                               placeholder="Partner Name"
                                               required>


                                        <label>Partner Percentage : <span class="danger"> *</span></label>
                                        <input class="form-control partnerPercent" name="percent"
                                               placeholder="Partner Percent" required type="number">

                                        <input type="hidden" name="project_id" value="{{$projectDetails->id ?? null}}">

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

                    <!--++++++++++++++++++++++++++++++++ Project Cost Update Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="costUpdateModal" role="dialog">
                        <div class="modal-dialog" role="document">
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

                                        <label>Expense Amount : <span
                                                class="danger"> *</span></label>
                                        <input class="form-control projectCostAmount mb-1" name="amount"
                                               placeholder="Expense Amount" required type="number">

                                        <label>Payment Date : <span
                                                class="danger"> *</span></label>
                                        <input class="form-control projectCostPaymentDate mb-1" name="payment_date"
                                               placeholder="Payment Date" required type="date">


                                        <label>Payment Method : <span
                                                class="danger"> *</span></label>
                                        <select name="payment_method" class="form-control projectCostMethod mb-1">
                                            @foreach(payment_method() as $key => $value)
                                                <option value="{{$key}}">
                                                    {{$value}}
                                                </option>
                                            @endforeach
                                        </select>


                                        <label>Expense Purpose : <span
                                                class="danger"> *</span></label>
                                        <textarea name="purpose" class="form-control projectCostPurpose" rows="3"
                                                  required placeholder="Purpose"></textarea>


                                        <input type="hidden" name="project_id"
                                               value="{{$projectDetails->id ?? null}}">

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

                    <!--++++++++++++++++++++++++++++++++ Project Invest Update Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="investUpdateModal" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">
                                        Are You Sure You Want To Update This Item
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form method="post" action="">
                                    @csrf
                                    @method('PATCH')

                                    <div class="modal-body">

                                        <label>Amount : <span class="danger"> *</span></label>
                                        <input class="form-control mb-1 invest_amount" name="amount" placeholder="Amount"
                                               required>

                                        <div class="row">

                                            <div class="col-md-6 col-12">
                                                <label>Payment Method : <span class="danger"> *</span></label>
                                                <select name="payment_method" class="form-control mb-1 invest_method" required>

                                                    @foreach(payment_method() as $key => $value)
                                                        <option value="{{$key}}">{{$value}}</option>
                                                    @endforeach

                                                </select>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label>Payment Date : <span class="danger"> *</span></label>
                                                <input type="date" class="form-control mb-1 invest_date" name="created_at"
                                                       required>
                                            </div>

                                        </div>

                                        <label>Note :</label>
                                        <textarea name="note" class="form-control invest_note" rows="3"
                                                  placeholder="Write a message"></textarea>

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

                    <!--++++++++++++++++++++++++++++++++ Project Invest Note Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="investNoteModal" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">
                                        Description
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">

                                    <p id="investNote" class="mx-1"></p>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                        Close
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!--++++++++++++++++++++++++++++++++ Project Cost Delete Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="costDeleteModal" role="dialog">
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

                    id = $(this).attr('id');
                    project_id = "{{$projectDetails->id}}";

                    title = $(this).attr('title');

                    $('.single_percen_date').text(title);

                    if ($(this).prop("checked") == true) {

                        $.ajax({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            url: '{{url('admin/showCostDateWise')}}' + "/" + id + "/" + project_id,
                            type: "GET",
                            success: function (response) {
                                console.log(response)
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

                $('.partnerDatable').DataTable({
                    ordering: false,
                    info: false,
                    lengthChange: false,
                });

                $(document).on('click', '.partnerDeleteModal', function () {

                    partnerDeleteUrl = '{{route("projectPartner.destroy",":partner_id")}}';
                    partnerDeleteUrl = partnerDeleteUrl.replace(':partner_id', $(this).attr('data-action'));

                    $('#costDeleteModal form').attr('action', partnerDeleteUrl);
                    $('#costDeleteModal').modal('show');
                });


                $('.partnerUpdateModal').click(function () {

                    partnerUpdateUrl = '{{route("projectPartner.update",":partner_id")}}';
                    partnerUpdateUrl = partnerUpdateUrl.replace(':partner_id', $(this).attr('data-action'));

                    partner_name = $(this).attr('data-content');
                    partner_percent = $(this).attr('data-col');

                    $('.partnerName').val(partner_name);
                    $('.partnerPercent').val(partner_percent);

                    $('#partnerUpdateModal form').attr('action', partnerUpdateUrl);
                    $('#partnerUpdateModal').modal('show');
                });

                <!--============================== End Partner ==============================-->


                <!--============================== Start Project Cost ==============================-->
                $(document).on('click', '.costDeleteModal', function () {

                    costDeleteUrl = '{{route("projectCost.destroy",":cost_id")}}';
                    costDeleteUrl = costDeleteUrl.replace(':cost_id', $(this).attr('data-action'));

                    $('#costDeleteModal form').attr('action', costDeleteUrl);
                    $('#costDeleteModal').modal('show');
                });


                $(document).on('click', '.costUpdateModal', function () {

                    costUpdateUrl = '{{route("projectCost.update",":cost_id")}}';
                    costUpdateUrl = costUpdateUrl.replace(':cost_id', $(this).attr('data-action'));

                    projectCostPurpose = $(this).attr('data-content');
                    projectCostAmount = $(this).attr('data-col');
                    projectCostPayment = $(this).attr('data-end');
                    projectCostPaymentDate = $(this).attr('data-toggle');

                    $(".projectCostMethod option[value='" + projectCostPayment + "']").attr("selected", "selected");
                    /*if (projectCostPayment == '1') {
                        $(".projectCostMethod option[value='1']").attr("selected", "selected");
                    } else if (projectCostPayment == '2') {
                        $(".projectCostMethod option[value='2']").attr("selected", "selected");
                    }*/

                    $('.projectCostAmount').val(projectCostAmount);
                    $('.projectCostPurpose').val(projectCostPurpose);
                    $('.projectCostPaymentDate').val(projectCostPaymentDate);

                    $('#costUpdateModal form').attr('action', costUpdateUrl);
                    $('#costUpdateModal').modal('show');
                });

                <!--============================== End Project Cost ==============================-->


                <!--============================== Stary Project Invest ==============================-->
                $(document).on('click', '.investDeleteModal', function () {

                    investDeleteUrl = '{{route("projectInvestAmount.destroy",":invest_id")}}';
                    investDeleteUrl = investDeleteUrl.replace(':invest_id', $(this).attr('data-action'));

                    $('#costDeleteModal form').attr('action', investDeleteUrl);
                    $('#costDeleteModal').modal('show');
                });

                $(document).on('click', '.investNoteModal', function () {
                    invest_note = $(this).attr('data-goto');

                    $('#investNote').text(invest_note);

                    $('#investNoteModal').modal('show');
                });

                $(document).on('click', '.investUpdateModal', function () {

                    investUpdateUrl = '{{route("projectInvestAmount.update",":invest_id")}}';
                    investUpdateUrl = investUpdateUrl.replace(':invest_id', $(this).attr('data-action'));

                    invest_amount = $(this).attr('data-col');
                    invest_method = $(this).attr('data-end');
                    invest_note = $(this).attr('data-goto');
                    invest_date = $(this).attr('datatype');

                    $(".invest_method option[value='" + invest_method + "']").attr("selected", "selected");
                    $('.invest_amount').val(invest_amount);
                    $('.invest_note').val(invest_note);
                    $('.invest_date').val(invest_date);


                    $('#investUpdateModal form').attr('action', investUpdateUrl);
                    $('#investUpdateModal').modal('show');
                });
                <!--============================== End Project Invest ==============================-->
            });
        })(jQuery);

    </script>
@endsection
