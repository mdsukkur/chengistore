@extends('admin.template_parts.master')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 offset-2">

            @include('error.validationError')


            <!--============================== Edit Profile ==============================-->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-left pl-2 ml-2">{{Auth::user()->name ?? ''}} Profile
                                    Information</h4>
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

                                    <form method="POST" action="{{route('userManagement.update',Auth::id())}}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                                Name : <span class="danger"> *</span>
                                            </label>

                                            <div class="col-md-6">
                                                <input class="form-control" name="name"
                                                       value="{{Auth::user()->name ?? ''}}" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                                Mobile : <span class="danger"> *</span>
                                            </label>

                                            <div class="col-md-6">
                                                <input class="form-control" name="mobile"
                                                       value="{{Auth::user()->mobile ?? ''}}" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                                Email : <span class="danger"> *</span>
                                            </label>

                                            <div class="col-md-6">
                                                <input type="email" class="form-control" name="email"
                                                       value="{{Auth::user()->email ?? ''}}" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                                Profile Picture : <span class="danger"> *</span>
                                            </label>

                                            <div class="col-md-6">
                                                <input type="file" class="form-control" id="profilePicture"
                                                       name="picture" onchange="readURL(this)">

                                                @if(!is_null(Auth::user()->picture ?? null) && file_exists(public_path('upload/profile/'.(Auth::user()->picture ?? ''))))

                                                    @php
                                                        $none = 'block';
                                                    @endphp

                                                @else

                                                    @php
                                                        $none = 'none';
                                                    @endphp

                                                @endif

                                                <img class="img-fluid profilePicture mt-1"
                                                     style="display: {{$none}};height: 200px !important;"
                                                     alt="{{Auth::user()->name ?? ''}}"
                                                     src="{{asset('upload/profile/'.(Auth::user()->picture ?? ''))}}">

                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Update Profile
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
