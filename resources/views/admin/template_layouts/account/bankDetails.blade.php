@extends('admin.template_parts.master')

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
                            <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#addNewBank">
                                Add New Bank
                            </button>
                        </div>
                    </div>


                    <div class="clearfix"></div>


                    <!--++++++++++++++++++++++++++++++++ Add New Bank Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="addNewBank" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">
                                        Add New Bank
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('BankManagement.store')}}" method="POST">
                                    @csrf

                                    <div class="modal-body">

                                        <label>Bank Name : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control" name="bank_name" required
                                                   placeholder="Bank Name">
                                        </div>

                                        <label>Account Number : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control" name="account_number" required
                                                   placeholder="Account Number">
                                        </div>

                                        <label>Branch Name : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control" name="branch_name" required
                                                   placeholder="Branch Name">
                                        </div>

                                        <label>Account Holder Name : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control" name="account_holder_name" required
                                                   placeholder="Account Holder Name">
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
                                    <h4 class="card-title text-left pl-2 ml-2">Bank Management</h4>
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
                                                <th>Date</th>
                                                <th>Bank Name</th>
                                                <th>Account Number</th>
                                                <th>Branch Name</th>
                                                <th>AC Holder Name</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if($allBankDetails->isNotEmpty())
                                                @foreach($allBankDetails->sortByDesc('id') as $Bank)

                                                    <tr>
                                                        <td>
                                                            {{date('d M, Y',strtotime($Bank->created_at))}}
                                                        </td>
                                                        <td>
                                                            {{$Bank->bank_name ?? '----'}}
                                                        </td>
                                                        <td>
                                                            {{$Bank->account_number ?? '----'}}
                                                        </td>
                                                        <td>
                                                            {{$Bank->branch_name ?? '----'}}
                                                        </td>
                                                        <td>
                                                            {{$Bank->account_holder_name ?? '----'}}
                                                        </td>
                                                        <td>
                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Edit">
                                                                <a class="btn btn-warning btn-xs updateModal"
                                                                   data-action="{{$Bank->id}}"
                                                                   data-content="{{$Bank->bank_name}}"
                                                                   data-col="{{$Bank->account_number}}"
                                                                   data-end="{{$Bank->branch_name}}"
                                                                   data-animation="{{$Bank->account_holder_name}}">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            </span>

                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Delete"
                                                                  aria-describedby="tooltip406983">
                                                                <a class="btn btn-danger btn-xs deleteModal"
                                                                   data-action="{{$Bank->id}}">
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
                    </div>


                    <!--++++++++++++++++++++++++++++++++ Update Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="updateModal" role="dialog">
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

                                        <label>Bank Name : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control bank_name" name="bank_name" required
                                                   placeholder="Bank Name">
                                        </div>

                                        <label>Account Number : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control account_number" name="account_number" required
                                                   placeholder="Account Number">
                                        </div>

                                        <label>Branch Name : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control branch_name" name="branch_name" required
                                                   placeholder="Branch Name">
                                        </div>

                                        <label>Account Holder Name : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control ac_holder_name" name="account_holder_name" required
                                                   placeholder="Account Holder Name">
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


                $('.deleteModal').click(function () {

                    deleteUrl = '{{route("BankManagement.destroy",":BankID")}}';
                    deleteUrl = deleteUrl.replace(':BankID', $(this).attr('data-action'));

                    $('#deleteModal form').attr('action', deleteUrl);
                    $('#deleteModal').modal('show');
                });


                $('.updateModal').click(function () {

                    updateUrl = '{{route("BankManagement.update",":BankID")}}';
                    updateUrl = updateUrl.replace(':BankID', $(this).attr('data-action'));

                    bank_name = $(this).attr('data-content');
                    account_number = $(this).attr('data-col');
                    branch_name = $(this).attr('data-end');
                    ac_holder_name = $(this).attr('data-animation');

                    $('.bank_name').val(bank_name);
                    $('.account_number').val(account_number);
                    $('.branch_name').val(branch_name);
                    $('.ac_holder_name').val(ac_holder_name);

                    $('#updateModal form').attr('action', updateUrl);
                    $('#updateModal').modal('show');
                });

            });
        })(jQuery);

    </script>
@endsection
