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
                            <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#addNewBranch">
                                Add New Branch
                            </button>
                        </div>
                    </div>


                    <div class="clearfix"></div>


                    <!--++++++++++++++++++++++++++++++++ Add New Branch Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="addNewBranch" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">
                                        Add New Branch
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('branchManagement.store')}}" method="POST">
                                    @csrf

                                    <div class="modal-body">

                                        <label>Branch Name : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control" name="branch_name" required
                                                   placeholder="Branch Name">
                                        </div>

                                        <label>Note :</label>
                                        <div class="form-group">
                                            <textarea name="note" class="form-control" rows="4"
                                                      placeholder="Write a message"></textarea>
                                        </div>

                                        <label>Status : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <select name="status" class="form-control">
                                                @foreach($status as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
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
                                    <h4 class="card-title text-left pl-2 ml-2">Branch Management</h4>
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
                                                <th>Name</th>
                                                <th>Note</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if($allBranch->isNotEmpty())
                                                @foreach($allBranch as $branch)

                                                    <tr>
                                                        <td>
                                                            {{$branch->branch_name ?? '----'}}
                                                        </td>
                                                        <td>
                                                            {{$branch->note ?? '----'}}
                                                        </td>
                                                        <td>
                                                            @if ($branch->status == 0)
                                                                <span class="badge badge-warning">De-active</span>
                                                            @elseif ($branch->status == 1)
                                                                <span class="badge badge-success">Active</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Edit">
                                                                <a class="btn btn-warning btn-xs updateModal"
                                                                   data-action="{{$branch->id}}"
                                                                   data-content="{{$branch->branch_name}}"
                                                                   data-col="{{$branch->note ?? ''}}"
                                                                   data-end="{{$branch->status}}">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            </span>

                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Delete"
                                                                  aria-describedby="tooltip406983">
                                                                <a class="btn btn-danger btn-xs deleteModal"
                                                                   data-action="{{$branch->id}}">
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

                                        <label>Branch Name : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control branch_name" name="branch_name" required
                                                   placeholder="Branch Name">
                                        </div>

                                        <label>Note :</label>
                                        <div class="form-group">
                                            <textarea name="note" class="form-control branch_note" rows="4"
                                                      placeholder="Write a message"></textarea>
                                        </div>

                                        <label>Status : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <select name="status" class="form-control branch_status">
                                                @foreach($status as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
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

                    deleteUrl = '{{route("branchManagement.destroy",":branchID")}}';
                    deleteUrl = deleteUrl.replace(':branchID', $(this).attr('data-action'));

                    $('#deleteModal form').attr('action', deleteUrl);
                    $('#deleteModal').modal('show');
                });


                $('.updateModal').click(function () {

                    updateUrl = '{{route("branchManagement.update",":branchID")}}';
                    updateUrl = updateUrl.replace(':branchID', $(this).attr('data-action'));

                    branch_name = $(this).attr('data-content');
                    branch_note = $(this).attr('data-col');
                    branch_status = $(this).attr('data-end');

                    $('.branch_name').val(branch_name);
                    $('.branch_note').val(branch_note);
                    $(`.branch_status option[${branch_status}]`).attr('selected', 'selected');

                    $('#updateModal form').attr('action', updateUrl);
                    $('#updateModal').modal('show');
                });

            });
        })(jQuery);

    </script>
@endsection
