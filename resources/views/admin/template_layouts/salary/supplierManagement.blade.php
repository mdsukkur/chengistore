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
                            <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#addNewSupplier">
                                Add New Supplier
                            </button>
                        </div>
                    </div>


                    <div class="clearfix"></div>


                    <!--++++++++++++++++++++++++++++++++ Add New Supplier Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="addNewSupplier" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">
                                        Add New Supplier
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('SupplierManagement.store')}}" method="POST">
                                    @csrf

                                    <div class="modal-body">
                                        <label>Supplier Name : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control" name="name" required
                                                   placeholder="Supplier Name">
                                        </div>


                                        <label>Supplier Mobile Number :</label>
                                        <div class="form-group">
                                            <input class="form-control" name="mobile"
                                                   placeholder="Supplier Mobile Number">
                                        </div>


                                        <label>Note : </label>
                                        <div class="form-group">
                                            <textarea name="note" class="form-control" rows="3"
                                                      placeholder="Note"></textarea>
                                        </div>


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
                                    <h4 class="card-title text-left pl-2 ml-2">Supplier Management</h4>
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

                                        <form class="mb-1">
                                            <div class="row">

                                                <div class="col-md-1 col-12">
                                                    <h4 class="primary text-center">Filter By :</h4>
                                                </div>

                                                <div class="col-md-3 col-12">
                                                    <input class="form-control" name="name" placeholder="Supplier Name">
                                                </div>

                                                <div class="col-md-3 col-12">
                                                    <input class="form-control" name="mobile" placeholder="Supplier Mobile Number">
                                                </div>

                                                <div class="col-md-2 col-12">
                                                    <select name="status" class="form-control">
                                                        <option value="">Select One</option>

                                                        @foreach(status() as $key => $value)
                                                            <option value="{{$key}}">
                                                                {{$value}}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="col-md-3 col-12">
                                                    <button class="btn btn-danger">Search</button>
                                                    <a href="{{route('SupplierManagement.index')}}" class="btn btn-primary">
                                                        All History
                                                    </a>
                                                </div>

                                            </div>
                                        </form>

                                        <table class="table table-striped table-bordered customTable dataTable"
                                            style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>Created By</th>
                                                <th>Supplier Name</th>
                                                <th>Supplier Mobile</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if($allSupplier->isNotEmpty())
                                                @foreach($allSupplier->sortByDesc('id') as $Supplier)

                                                    <tr>
                                                        <td>
                                                            {{date('d M, Y h:i a',strtotime($Supplier->created_at))}}
                                                        </td>
                                                        <td>
                                                            {{$Supplier->user->name ?? '----'}}
                                                        </td>
                                                        <td>
                                                            {{$Supplier->name ?? '-----'}}

                                                            @if(!is_null($Supplier->note))

                                                                <span data-placement="top" data-toggle="tooltip"
                                                                      data-original-title="Supplier Note"
                                                                      aria-describedby="tooltip406983">
                                                                    <a class="btn btn-primary btn-xs SupplierManagementModal ml-1"
                                                                       data-content="{{$Supplier->note}}">
                                                                        <i class="fa fa-info"></i>
                                                                    </a>
                                                                </span>

                                                            @endif

                                                        </td>
                                                        <td>
                                                            {{$Supplier->mobile ?? '-----'}}
                                                        </td>
                                                        <td>
                                                            @if($Supplier->status == 1)
                                                                <span class="badge badge-primary badge-pill">
                                                                    Active
                                                                </span>
                                                            @elseif($Supplier->status == 0)
                                                                <span class="badge badge-danger badge-pill">
                                                                    Deactive
                                                                </span>
                                                            @else
                                                                -----
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Details">
                                                                <a class="btn btn-primary btn-xs"
                                                                   href="{{route('SupplierManagement.show',$Supplier->id)}}">
                                                                    <i class="fa fa-database"></i>
                                                                </a>
                                                            </span>

                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Edit">
                                                                <a class="btn btn-warning btn-xs updateModal"
                                                                   data-action="{{$Supplier->id}}"
                                                                   data-content="{{$Supplier->name}}"
                                                                   data-end="{{$Supplier->mobile}}"
                                                                   data-col="{{$Supplier->note}}"
                                                                   data-goto="{{$Supplier->status}}">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            </span>

                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Delete"
                                                                  aria-describedby="tooltip406983">
                                                                <a class="btn btn-danger btn-xs deleteModal"
                                                                   data-action="{{$Supplier->id}}">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </span>
                                                        </td>
                                                    </tr>

                                                @endforeach
                                            @endif

                                            </tbody>
                                        </table>

                                        {{$allSupplier->appends(\Illuminate\Support\Facades\Request::all())->render()}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--++++++++++++++++++++++++++++++++ Supplier Details Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="SupplierManagementModal" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">
                                        Supplier Note
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="px-2">
                                    <p class="SupplierManagementModalContent text-center my-2"></p>
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
                                        <label>Supplier Name : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control SupplierName" name="name" required
                                                   placeholder="Supplier Name">
                                        </div>


                                        <label>Supplier Mobile Number : </label>
                                        <div class="form-group">
                                            <input class="form-control SupplierBudget" name="mobile"
                                                   placeholder="Supplier Mobile Number">
                                        </div>


                                        <label>Note : </label>
                                        <div class="form-group">
                                            <textarea name="note" class="form-control SupplierDetails"
                                                      rows="3" placeholder="Supplier Details"></textarea>
                                        </div>


                                        <label>Status : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <select name="status" class="form-control SupplierStatus">

                                                @foreach(status() as $key => $value)
                                                    <option value="{{$key}}">
                                                        {{$value}}
                                                    </option>
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

                $('.SupplierManagementModal').click(function () {
                    $('.SupplierManagementModalContent').text($(this).attr('data-content'));
                    $('#SupplierManagementModal').modal('show');
                });


                $('.deleteModal').click(function () {

                    deleteUrl = '{{route("SupplierManagement.destroy",":id")}}';
                    deleteUrl = deleteUrl.replace(':id', $(this).attr('data-action'));

                    $('#deleteModal form').attr('action', deleteUrl);
                    $('#deleteModal').modal('show');
                });


                $('.updateModal').click(function () {

                    updateUrl = '{{route("SupplierManagement.update",":Supplier_id")}}';
                    updateUrl = updateUrl.replace(':Supplier_id', $(this).attr('data-action'));

                    Supplier_name = $(this).attr('data-content');
                    Supplier_details = $(this).attr('data-col');
                    Supplier_budget = $(this).attr('data-end');
                    SupplierStatus = $(this).attr('data-goto');

                    $('.SupplierName').val(Supplier_name);
                    $('.SupplierDetails').val(Supplier_details);
                    $('.SupplierBudget').val(Supplier_budget);

                    if (SupplierStatus == 1) {
                        $('.SupplierStatus option[value=1]').attr('selected', 'selected');
                    } else if (SupplierStatus == 0) {
                        $('.SupplierStatus option[value=0]').attr('selected', 'selected');
                    }

                    $('#updateModal form').attr('action', updateUrl);
                    $('#updateModal').modal('show');
                });

            });
        })(jQuery);

    </script>
@endsection
