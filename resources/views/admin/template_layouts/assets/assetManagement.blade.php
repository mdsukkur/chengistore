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
                                Add New Asset
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
                                        Add New Asset
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('assetManagement.store')}}" method="POST">
                                    @csrf

                                    <div class="modal-body">

                                        <div class="row">


                                            <div class="col-md-6 col-12">
                                                <label>Asset Name : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <input class="form-control" name="name" required
                                                           placeholder="Computer">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label>Quantity : </label>
                                                <div class="form-group">
                                                    <input type="number" class="form-control" name="quantity"
                                                           placeholder="3">
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <label>Description : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <textarea name="description" id="editor1"
                                                              class="form-control"></textarea>
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
                                    <h4 class="card-title text-left pl-2 ml-2">Asset Management</h4>
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
                                                <th>Name</th>
                                                <th>Quantity</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if($allAssets->isNotEmpty())
                                                @foreach($allAssets as $asset)

                                                    <tr>
                                                        <td>
                                                            {{date('d M, Y',strtotime($asset->created_at))}}
                                                        </td>
                                                        <td>
                                                            {{$asset->name ?? '----'}}
                                                        </td>
                                                        <td>
                                                        {{$asset->quantity ?? '---'}}
                                                        <td>
                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Supplier Note"
                                                                  aria-describedby="tooltip406983">
                                                                <a class="btn btn-primary btn-xs SupplierManagementModal ml-1"
                                                                   data-content="{{$asset->description}}">
                                                                    <i class="fa fa-info"></i>
                                                                </a>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Edit">
                                                                <a class="btn btn-warning btn-xs updateModal"
                                                                   data-action="{{$asset->id}}"
                                                                   data-content="{{$asset->name}}"
                                                                   data-end="{{$asset->quantity}}"
                                                                   data-col="{{$asset->description}}">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            </span>

                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Delete"
                                                                  aria-describedby="tooltip406983">
                                                                <a class="btn btn-danger btn-xs deleteModal"
                                                                   data-action="{{$asset->id}}">
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


                    <!--++++++++++++++++++++++++++++++++ Supplier Details Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="SupplierManagementModal" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="overflow: hidden">
                                <div class="modal-header">
                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">
                                        Description
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="px-2">
                                    <p class="SupplierManagementmetarial my-2"></p>
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

                                            <div class="col-md-6 col-12">
                                                <label>Asset Name : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <input class="form-control eName" name="name" required
                                                           placeholder="Computer">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label>Quantity : </label>
                                                <div class="form-group">
                                                    <input type="number" class="form-control eQuantity" name="quantity"
                                                           placeholder="3">
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <label>Description : <span class="danger"> *</span></label>
                                                <div class="form-group">
                                                    <textarea name="description" id="editMetarial"
                                                              class="form-control eDescription"></textarea>
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

                $('.SupplierManagementModal').click(function () {
                    $('.SupplierManagementmetarial').html($(this).attr('data-content')).text();
                    $('#SupplierManagementModal').modal('show');
                });


                $('.deleteModal').click(function () {

                    deleteUrl = '{{route("assetManagement.destroy",":id")}}';
                    deleteUrl = deleteUrl.replace(':id', $(this).attr('data-action'));

                    $('#deleteModal form').attr('action', deleteUrl);
                    $('#deleteModal').modal('show');
                });


                $('.updateModal').click(function () {

                    updateUrl = '{{route("assetManagement.update",":updateID")}}';
                    updateUrl = updateUrl.replace(':updateID', $(this).attr('data-action'));

                    Assetname = $(this).attr('data-content');
                    description = $(this).attr('data-col');
                    quantity = $(this).attr('data-end');

                    $('.eName').val(Assetname);
                    $('.eQuantity').val(quantity);
                    CKEDITOR.instances.editMetarial.setData(description);

                    $('#updateModal form').attr('action', updateUrl);
                    $('#updateModal').modal('show');
                });

            });
        })(jQuery);

    </script>
@endsection
