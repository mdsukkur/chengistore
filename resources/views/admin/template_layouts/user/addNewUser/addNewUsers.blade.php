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
                            <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#addNewUser">
                                Add New User
                            </button>
                        </div>
                    </div>


                    <div class="clearfix"></div>


                    <!--++++++++++++++++++++++++++++++++ Add New User Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="addNewUser" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">
                                        Add New User
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('userManagement.store')}}" method="POST">
                                    @csrf

                                    <div class="modal-body">
                                        <label>Full Name : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control" name="name" required
                                                   placeholder="Full Name">
                                        </div>


                                        <label>Email : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control" name="email" required
                                                   placeholder="Email" type="email">
                                        </div>


                                        <label>Phone Number : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control" name="mobile" required
                                                   placeholder="Phone Number Without Country Code">
                                        </div>


                                        <label>Password : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control" name="password" required
                                                   placeholder="Password">
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
                                    <h4 class="card-title text-left pl-2 ml-2">User Management</h4>
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

                                        <table class="table table-striped table-bordered dataex-html5-selectors dataTable"
                                               style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if($allUser->isNotEmpty())
                                                @foreach($allUser->sortByDesc('id') as $User)

                                                    <tr>
                                                        <td>
                                                            {{date('d M, Y',strtotime($User->created_at))}}
                                                        </td>
                                                        <td>
                                                            {{$User->name ?? '----'}}
                                                        </td>
                                                        <td>
                                                            {{$User->mobile ?? '----'}}
                                                        </td>
                                                        <td>
                                                            {{$User->email ?? '----'}}
                                                        </td>
                                                        <td>
                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Edit">
                                                                <a class="btn btn-warning btn-xs updateModal"
                                                                   data-action="{{$User->id}}"
                                                                   data-content="{{$User->name}}"
                                                                   data-col="{{$User->email}}"
                                                                   data-end="{{$User->mobile}}">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            </span>

                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Delete"
                                                                  aria-describedby="tooltip406983">
                                                                <a class="btn btn-danger btn-xs deleteModal"
                                                                   data-action="{{$User->id}}">
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
                                        <label>Full Name : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control userName" name="name" required
                                                   placeholder="Full Name">
                                        </div>


                                        <label>Email : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control userEmail" name="email" required
                                                   placeholder="Email" type="email">
                                        </div>


                                        <label>Phone Number : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control userMobile" name="mobile" required
                                                   placeholder="Phone Number">
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

                    deleteUrl = '{{route("userManagement.destroy",":userID")}}';
                    deleteUrl = deleteUrl.replace(':userID', $(this).attr('data-action'));

                    $('#deleteModal form').attr('action', deleteUrl);
                    $('#deleteModal').modal('show');
                });


                $('.updateModal').click(function () {

                    updateUrl = '{{route("userManagement.update",":userID")}}';
                    updateUrl = updateUrl.replace(':userID', $(this).attr('data-action'));

                    userName = $(this).attr('data-content');
                    userEmail = $(this).attr('data-col');
                    userMobile = $(this).attr('data-end');

                    $('.userName').val(userName);
                    $('.userEmail').val(userEmail);
                    $('.userMobile').val(userMobile);

                    $('#updateModal form').attr('action', updateUrl);
                    $('#updateModal').modal('show');
                });

            });
        })(jQuery);

    </script>
@endsection
