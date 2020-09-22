@extends('admin.template_parts.master')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-12 offset-md-2">

            @include('error.validationError')


            <!--============================== Change Password ==============================-->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-left pl-2 ml-2">Change Password</h4>
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

                                    <form method="POST" action="{{ route('change.password') }}">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                                Current Password : <span class="danger"> *</span>
                                            </label>

                                            <div class="col-md-6">
                                                <input id="password" autofocus type="password" class="form-control"
                                                       name="current_password"
                                                       autocomplete="current-password" placeholder="Current Password" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                                New Password : <span class="danger"> *</span>
                                            </label>

                                            <div class="col-md-6">
                                                <input id="new_password" type="password" class="form-control" name="new_password"
                                                       autocomplete="current-password" placeholder="New Password" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                                New Confirm Password : <span class="danger"> *</span>
                                            </label>

                                            <div class="col-md-6">
                                                <input id="new_confirm_password" type="password" class="form-control"
                                                       name="new_confirm_password" autocomplete="current-password"
                                                       placeholder="New Confirm Password" required>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Update Password
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
