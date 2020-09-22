@extends('admin.template_parts.master')

@section('content')

    <div style="min-height: 0 !important;" class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <section id="validation">


                    <!--============================== Project Summery ==============================-->
                    <div class="row">

                        <div class="col-md-3 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body cleartfix">
                                        <div class="text-center">
                                            <h2 class="mr-2">
                                                {{number_format($allAccounts->where('type',2)->sum('amount'),2)}}
                                            </h2>
                                        </div>
                                        <div class="text-center">
                                            <span>Total Payble Amount</span>
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
                                                {{number_format($allAccounts->where('type',1)->sum('amount'),2)}}
                                            </h2>
                                        </div>
                                        <div class="text-center">
                                            <span>Total Recievable Amount</span>
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
                                                {{number_format($allAccounts->where('type','!=','1')->where('type','!=','2')->sum('amount'),2)}}
                                            </h2>
                                        </div>
                                        <div class="text-center">
                                            <span>Others Amount</span>
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
                                                {{number_format($allAccounts->sum('amount'))}}
                                            </h2>
                                        </div>
                                        <div class="text-center">
                                            <span>Total Amount</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-9">
                            @include('error.validationError')
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#addNewAccount">
                                Add New Account
                            </button>
                        </div>
                    </div>


                    <div class="clearfix"></div>


                    <!--++++++++++++++++++++++++++++++++ Add New Account Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="addNewAccount" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">
                                        Add New Account
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('account.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="modal-body">

                                        <div class="row">

                                            <input type="hidden" value="0" name="account_type">

                                            <div class="col-md-3 col-12">
                                                <label>Account type : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <select class="form-control type" name="type">

                                                        @foreach(accountType() as $key => $value)
                                                            <option value="{{$key}}">
                                                                {{$value}}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>


                                                <div class="otherInput" style="display: none">
                                                    <div class="form-group">
                                                        <input class="form-control" placeholder="Other Account">
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

                                            <div class="col-md-6 col-12">
                                                <label>Note : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <textarea name="purpose" class="form-control" rows="2"
                                                              placeholder="Purpose" required></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <label>Document ( <span class="warning">If You Have</span> ) : </label>
                                                <div class="form-group">
                                                    <input type="file" id="documentImage" onchange="readURL(this)"
                                                           class="form-control" name="document">
                                                    <img class="img-fluid documentImage" style="display: none;"
                                                         width="100%"
                                                         height="250px">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <label>Date : <span class="danger"> *</span> </label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control" name="created_at" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
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
                                    <h4 class="card-title text-left pl-2 ml-2">Account Management</h4>
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

                                        <form>
                                            <div class="row">

                                                <div class="col-md-2">
                                                    <h4 class="primary text-center">Filter By : </h4>
                                                </div>

                                                <div class="col-md-2">
                                                    <select name="account_type" class="form-control">
                                                        <option value="">Select One</option>

                                                        @foreach(accountType() as $key => $value)
                                                            <option value="{{$key}}">
                                                                {{$value}}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="col-md-3">
                                                    <input type="date" class="form-control" name="date">
                                                </div>

                                                <div class="col-md-2">
                                                    <select name="status" class="form-control">
                                                        <option value="">Select One</option>

                                                        @foreach(status() as $key => $value)
                                                            <option value="{{$key}}">
                                                                {{$value}}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="col-md-3">
                                                    <button class="btn btn-danger">Search</button>
                                                    <a href="{{route('account.index')}}"
                                                       class="btn btn-primary">
                                                        All History
                                                    </a>
                                                </div>

                                            </div>
                                        </form>

                                        <table
                                            class="table table-striped table-bordered customTable dataTable no-footer"
                                            style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Submit By</th>
                                                <th>Type</th>
                                                <th>Amount</th>
                                                <th>Document</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if($allAccounts->isNotEmpty())
                                                @foreach($allAccounts->sortByDesc('created_at') as $Account)

                                                    <tr>
                                                        <td>
                                                            {{date('d M, Y',strtotime($Account->created_at))}}
                                                        </td>
                                                        <td>
                                                            {{$Account->user->name ?? '----'}}
                                                        </td>
                                                        <td>
                                                            @if($Account->type == 1)
                                                                {{'Receivable'}}
                                                            @elseif($Account->type == 2)
                                                                {{'Payble'}}
                                                            @else
                                                                {{$Account->type ?? '---'}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{number_format($Account->amount,2)}} BDT

                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Account Note">
                                                                <a class="btn btn-warning btn-xs ml-1 purposeModal"
                                                                   data-content="{{$Account->purpose}}">
                                                                    <i class="fa fa-info"></i>
                                                                </a>
                                                            </span>

                                                        </td>
                                                        <td>
                                                            @if(($Account->document ?? null) != null)

                                                                <a href="{{asset('upload/account/'.($Account->document ?? null))}}"
                                                                   target="_blank" data-placement="top"
                                                                   data-toggle="tooltip"
                                                                   data-original-title="Document Zooming">
                                                                    <img class="img-fluid" width="120px" height="120px"
                                                                         src="{{asset('upload/account/'.($Account->document ?? null))}}">
                                                                </a>

                                                            @else

                                                                ----

                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($Account->status == 1)
                                                                <span class="badge badge-primary badge-pill">
                                                                    Active
                                                                </span>
                                                            @elseif($Account->status == 0)
                                                                <span class="badge badge-danger badge-pill">
                                                                    Deactive
                                                                </span>
                                                            @else
                                                                -----
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Edit">
                                                                <a class="btn btn-warning btn-xs updateModal"
                                                                   data-action="{{$Account->id}}"
                                                                   data-content="{{$Account->type}}"
                                                                   data-col="{{$Account->purpose}}"
                                                                   data-end="{{$Account->amount}}"
                                                                   data-animation="{{$Account->document}}"
                                                                   data-toggle="{{$Account->status}}"
                                                                   data-goto="{{date('Y-m-d',strtotime($Account->created_at))}}">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            </span>

                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Delete"
                                                                  aria-describedby="tooltip406983">
                                                                <a class="btn btn-danger btn-xs deleteModal"
                                                                   data-action="{{$Account->id}}">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </span>
                                                        </td>
                                                    </tr>

                                                @endforeach
                                            @endif

                                            </tbody>
                                        </table>

                                        {{$allAccounts->appends(\Illuminate\Support\Facades\Request::all())->render()}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--++++++++++++++++++++++++++++++++ Note Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="purposeModal" role="dialog">
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
                                                <label>Account type : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <select class="form-control type updateAccounttype" name="type">

                                                        @foreach(accountType() as $key => $value)
                                                            <option value="{{$key}}">
                                                                {{$value}}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>


                                                <div class="updateOtherInput otherInput" style="display: none">
                                                    <div class="form-group">
                                                        <input class="form-control updateOtherAccount"
                                                               placeholder="Other Account">
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

                                            <div class="col-md-6 col-12">
                                                <label>Note : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <textarea name="purpose" class="form-control updatePurpose" rows="5"
                                                              placeholder="Note" required></textarea>
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

                                            <div class="col-md-4 col-12">
                                                <label>Date : <span class="danger"> *</span> </label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control updateDate" name="created_at"
                                                           required>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
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
    <script>
        ;(function ($) {
            $(document).ready(function () {

                $('.type').on('change', function () {
                    var type = $(this).val();

                    if (type == '3') {
                        $('.otherInput').show();
                        $('.otherInput input').attr('name', 'type');
                        $('.otherInput input').prop('required', true);
                        $(this).removeAttr('name');
                    } else {
                        $('.otherInput').hide();
                        $(this).attr('name', 'type');
                        $('.otherInput input').removeAttr('name');
                        $('.otherInput input').prop('required', false);
                    }

                });


                $('.purposeModal').click(function () {
                    $('.purposeModalContent').text($(this).attr('data-content'));
                    $('#purposeModal').modal('show');
                });


                $('.deleteModal').click(function () {

                    deleteUrl = '{{route("account.destroy",":id")}}';
                    deleteUrl = deleteUrl.replace(':id', $(this).attr('data-action'));

                    $('#deleteModal form').attr('action', deleteUrl);
                    $('#deleteModal').modal('show');
                });


                $('.updateModal').click(function () {

                    updateUrl = '{{route("account.update",":Account_id")}}';
                    updateUrl = updateUrl.replace(':Account_id', $(this).attr('data-action'));

                    updateAccountType = $(this).attr('data-content');
                    updatePurpose = $(this).attr('data-col');
                    updateAmount = $(this).attr('data-end');
                    updateDocument = '{{asset('upload/account')}}' + '/' + $(this).attr('data-animation');
                    updateStatus = $(this).attr('data-toggle');
                    updateDate = $(this).attr('data-goto');

                    if ($(this).attr('data-animation') != '') {
                        $('.documentImage').show();
                    }

                    if (updateStatus == 1) {
                        $(".updateStatus option[value='1']").attr("selected", "selected");
                    } else if (updateStatus == 0) {
                        $(".updateStatus option[value='0']").attr("selected", "selected");
                    }

                    if (updateAccountType == '1') {
                        $(".updateAccounttype option[value='1']").attr("selected", "selected");
                    } else if (updateAccountType == '2') {
                        $(".updateAccounttype option[value='2']").attr("selected", "selected");
                    } else {
                        $(".updateAccounttype option[value='3']").attr("selected", "selected");

                        $('.updateOtherAccount').attr('name', 'type');
                        $('.updateAccounttype').removeAttr('name');

                        $('.updateOtherAccount').val(updateAccountType);
                        $('.updateOtherInput').show();
                    }

                    $('.updateAccountType').val(updateAccountType);
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
