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
                                Add New Supplier Metarial
                            </button>
                        </div>
                    </div>


                    <div class="clearfix"></div>


                    <!--++++++++++++++++++++++++++++++++ Add New Supplier Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="addNewSupplier" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">
                                        Add New Supplier Metarial
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('SupplierMetarialDetails.store')}}" method="POST">
                                    @csrf

                                    <div class="modal-body">

                                        <div class="row">

                                            <input type="hidden" name="supplier_id" value="{{$supplierInfo->id}}">

                                            <div class="col-md-4 col-12">
                                                <label>Total Amount : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <input class="form-control totalAmount" name="total_amount" required
                                                           placeholder="Total Amount">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <label>Advance Amount : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <input class="form-control advanceAmount" name="advance_amount"
                                                           required placeholder="Advance Amount">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <label>Due Amount : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <input class="form-control dueAmount" name="due_amount" readonly
                                                           required placeholder="Due Amount">
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <label>Metarial Details : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                     <textarea name="metarial_details" id="editor1" class="form-control"
                                                               placeholder="Metarial Details"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <label>Date : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <input type="date" name="created_at" required class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-9 col-12">
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
                                    <h4 class="card-title text-left pl-2 ml-2">Supplier Metarial Management</h4>
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

                                                <div class="col-md-2 col-12">
                                                    <h4 class="primary text-center">Filter By :</h4>
                                                </div>

                                                <div class="col-md-3 col-12">
                                                    <input class="form-control" name="date" type="date">
                                                </div>

                                                <div class="col-md-3 col-12">
                                                    <button class="btn btn-danger">Search</button>
                                                    <a href="{{route('SupplierManagement.show',$supplierInfo->id)}}"
                                                       class="btn btn-primary">
                                                        All History
                                                    </a>
                                                </div>

                                            </div>
                                        </form>

                                        <table class="table table-striped table-bordered customTable dataTable"
                                               style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Total Amount</th>
                                                <th>Advance Amount</th>
                                                <th>Due Amount</th>
                                                <th>Details</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if($metarialDetails->isNotEmpty())
                                                @foreach($metarialDetails as $metarial)

                                                    <tr>
                                                        <td>
                                                            {{date('d M, Y',strtotime($metarial->created_at))}}
                                                        </td>
                                                        <td>
                                                            {{number_format($metarial->total_amount ?? 0,2)}} BDT
                                                        </td>
                                                        <td>
                                                            {{number_format($metarial->advance_amount ?? 0,2)}} BDT
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-danger">
                                                                {{number_format($metarial->due_amount ?? 0,2)}} BDT
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Supplier Note"
                                                                  aria-describedby="tooltip406983">
                                                                <a class="btn btn-primary btn-xs SupplierManagementModal ml-1"
                                                                   data-content="{{$metarial->note}}"
                                                                   data-col="{{$metarial->metarial_details}}">
                                                                    <i class="fa fa-info"></i>
                                                                </a>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Edit">
                                                                <a class="btn btn-warning btn-xs updateModal"
                                                                   data-action="{{$metarial->id}}"
                                                                   data-content="{{$metarial->total_amount}}"
                                                                   data-end="{{$metarial->advance_amount}}"
                                                                   data-col="{{$metarial->due_amount}}"
                                                                   data-goto="{{$metarial->metarial_details}}"
                                                                   data-toggle="{{$metarial->note}}"
                                                                   datatype="{{date('Y-m-d',strtotime($metarial->created_at))}}">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            </span>

                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Delete"
                                                                  aria-describedby="tooltip406983">
                                                                <a class="btn btn-danger btn-xs deleteModal"
                                                                   data-action="{{$metarial->id}}">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </span>
                                                        </td>
                                                    </tr>

                                                @endforeach
                                            @endif

                                            </tbody>
                                        </table>

                                        {{$metarialDetails->appends(\Illuminate\Support\Facades\Request::all())->render()}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--++++++++++++++++++++++++++++++++ Supplier Details Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="SupplierManagementModal" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="overflow: hidden">
                                <div class="modal-header">
                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">
                                        Metarial Details
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="px-2">
                                    <p class="SupplierManagementmetarial my-2"></p>
                                </div>

                                <div id="note" style="display:none;">
                                    <div class="modal-header">
                                        <label class="modal-title text-text-bold-600" id="myModalLabel33">
                                            Note
                                        </label>
                                    </div>

                                    <div class="px-2">
                                        <p class="SupplierManagementModalContent text-center my-2"></p>
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

                                <form method="post" enctype="multipart/form-data">
                                    @method('PATCH')
                                    @csrf

                                    <div class="modal-body">

                                        <div class="row">

                                            <input type="hidden" name="supplier_id" value="{{$supplierInfo->id}}">

                                            <div class="col-md-4 col-12">
                                                <label>Total Amount : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <input class="form-control etotalAmount" name="total_amount" required
                                                           placeholder="Total Amount" id="editTotal">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <label>Advance Amount : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <input class="form-control eadvanceAmount" name="advance_amount"
                                                           required placeholder="Advance Amount" id="editAdvance">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <label>Due Amount : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <input class="form-control edueAmount" name="due_amount" readonly
                                                           required placeholder="Due Amount" id="editDue">
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <label>Metarial Details : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                     <textarea name="metarial_details" id="editMetarial"
                                                               class="form-control"
                                                               placeholder="Metarial Details"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <label>Date : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <input type="date" name="created_at" required class="form-control updateDate">
                                                </div>
                                            </div>

                                            <div class="col-md-9 col-12">
                                                <label>Note : </label>
                                                <div class="form-group">
                                                     <textarea name="note" class="form-control" rows="2"
                                                               placeholder="Note" id="editNote"></textarea>
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
    <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
    <script src="{{asset('editor/bootstrap3-wysihtml5.all.min.js')}}"></script>

    <script>
        ;(function ($) {
            $(document).ready(function () {

                CKEDITOR.replace('editor1');
                CKEDITOR.replace('editMetarial');
                $(".textarea").wysihtml5();

                $('.advanceAmount').on('input', function () {
                    totalAmount = $('.totalAmount').val();
                    advanceAmount = $('.advanceAmount').val();

                    $('.dueAmount').val(totalAmount - advanceAmount);
                });

                $('.totalAmount').on('input', function () {
                    totalAmount = $('.totalAmount').val();
                    advanceAmount = $('.advanceAmount').val();

                    $('.dueAmount').val(totalAmount - advanceAmount);
                });

                $('.eadvanceAmount').on('input', function () {
                    totalAmount = $('.etotalAmount').val();
                    advanceAmount = $('.eadvanceAmount').val();

                    $('.edueAmount').val(totalAmount - advanceAmount);
                });

                $('.etotalAmount').on('input', function () {
                    totalAmount = $('.etotalAmount').val();
                    advanceAmount = $('.eadvanceAmount').val();

                    $('.edueAmount').val(totalAmount - advanceAmount);
                });

                $('.SupplierManagementModal').click(function () {
                    note = $(this).attr('data-content');
                    if (note != '' && note != null) {
                        $('.SupplierManagementModalContent').text(note);
                        $('#note').show();
                    }

                    $('.SupplierManagementmetarial').html($(this).attr('data-col')).text();
                    $('#SupplierManagementModal').modal('show');
                });


                $('.deleteModal').click(function () {

                    deleteUrl = '{{route("SupplierMetarialDetails.destroy",":id")}}';
                    deleteUrl = deleteUrl.replace(':id', $(this).attr('data-action'));

                    $('#deleteModal form').attr('action', deleteUrl);
                    $('#deleteModal').modal('show');
                });


                $('.updateModal').click(function () {

                    updateUrl = '{{route("SupplierMetarialDetails.update",":SupplierMe_id")}}';
                    updateUrl = updateUrl.replace(':SupplierMe_id', $(this).attr('data-action'));

                    totalAmount = $(this).attr('data-content');
                    dueAmount = $(this).attr('data-col');
                    advanceAmount = $(this).attr('data-end');
                    metarialDetails = $(this).attr('data-goto');
                    note = $(this).attr('data-toggle');
                    date = $(this).attr('datatype');

                    $('#editTotal').val(totalAmount);
                    $('#editAdvance').val(advanceAmount);
                    $('#editDue').val(dueAmount);
                    CKEDITOR.instances.editMetarial.setData(metarialDetails);
                    $('#editNote').val(note);
                    $('.updateDate').val(date);

                    $('#updateModal form').attr('action', updateUrl);
                    $('#updateModal').modal('show');
                });

            });
        })(jQuery);

    </script>
@endsection
