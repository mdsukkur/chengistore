@extends('admin.template_parts.master')

@section('title','Slider')

@section('css')
    <style>
        .updateAll {
            position: absolute;
            left: 70%;
            margin: -19px 0;
        }
    </style>
@endsection

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">Slider Management</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Slider Management</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                <button class="btn btn-danger float-right mt-2 mb-5 mr-1" type="button" data-toggle="modal"
                        data-target="#slider">
                    Add New Slider
                </button>

                <div class="clearfix"></div>


                <!-- Add New Slider Start From Here -->

                <div class="modal fade" id="slider">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    Add New Slider
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>

                            <form action="{{route('slider.store')}}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="modal-body">

                                    <div class="form-group">
                                        <label>
                                            Slider Title :
                                            <span class="danger"> *</span>
                                        </label>
                                        <input class="form-control" name="title" required placeholder="Slider Title">
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            Slider Short Description :
                                        </label>
                                        <textarea name="details" rows="10" class="form-control"
                                                  placeholder="Short Description"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            Slider Image :
                                        </label>
                                        <input type="file"
                                               name="image"
                                               class="form-control"
                                               onchange="AdminavaliableScreenshot(this)"
                                               required>
                                        <img src="#"
                                             alt="Bank Transition Slip"
                                             class="img-fluid mt-1 sliderImage"
                                             style="height: 200px;display: none">
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            Status :
                                            <span class="danger"> *</span>
                                        </label>
                                        <select name="status" class="form-control">

                                            @foreach($status as $key => $value)

                                                <option value="{{$key}}">
                                                    {{$value}}
                                                </option>

                                            @endforeach

                                        </select>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close
                                    </button>
                                    <button type="submit" class="btn btn-danger save_changes">Submit</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

                <!-- Add New Slider End Here -->


                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="primary">All Slider Lists</h4>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">

                                        <table class="table table-striped table-bordered dataex-html5-selectors dataTable">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Image</th>
                                                <th style="width: 600px !important;">Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if($sliders->isNotEmpty())
                                                @foreach($sliders as $id => $slider)

                                                    <tr>
                                                        <td>{{$id + 1}}</td>
                                                        <td>
                                                            {{$slider->title ?? '--'}}
                                                        </td>
                                                        <td>
                                                            <img src="{{asset("slider/$slider->image")}}"
                                                                 class="img-fluid" width="150">
                                                        </td>
                                                        <td>
                                                            {{$slider->details ?? '--'}}
                                                        </td>
                                                        <td>
                                                            @if($slider->status == 0)
                                                                <span class="badge badge-danger">
                                                                    Inactive
                                                                </span>
                                                            @elseif($slider->status == 1)
                                                                <span class="badge badge-primary">
                                                                    Active
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Edit">
                                                                    <a data-toggle="modal" data-backdrop="false"
                                                                       data-target="#edit{{$slider->id}}"
                                                                       class="btn btn-warning btn-xs">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                </span>

                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Delete">
                                                                    <a data-toggle="modal" data-backdrop="false"
                                                                       data-target="#delete{{$slider->id}}"
                                                                       class="btn btn-danger btn-xs">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                </span>
                                                        </td>
                                                    </tr>




                                                    <!-- Edit Modal Start From Here -->

                                                    <div class="modal fade" id="edit{{$slider->id}}">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">
                                                                        Update Slider
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>

                                                                <form action="{{route('slider.update',$slider->id)}}"
                                                                      method="post" enctype="multipart/form-data">

                                                                    @method('PATCH')
                                                                    @csrf

                                                                    <div class="modal-body">

                                                                        <div class="form-group">
                                                                            <label>
                                                                                Slider Title :
                                                                                <span class="danger"> *</span>
                                                                            </label>
                                                                            <input class="form-control" name="title"
                                                                                   required placeholder="Slider Title"
                                                                                   value="{{$slider->title ?? ''}}">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>
                                                                                Slider Short Description :
                                                                            </label>
                                                                            <textarea name="details" rows="10"
                                                                                      class="form-control"
                                                                                      placeholder="Short Description">{{$slider->details ?? ''}}</textarea>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>
                                                                                Slider Image :
                                                                            </label>
                                                                            <input type="file"
                                                                                   name="image"
                                                                                   class="form-control"
                                                                                   onchange="AdminavaliableScreenshot(this)"
                                                                            >
                                                                            <img src="{{asset("slider/$slider->image")}}"
                                                                                 alt="Bank Transition Slip"
                                                                                 class="img-fluid mt-1 sliderImage"
                                                                                 style="height: 200px;">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>
                                                                                Status :
                                                                                <span class="danger"> *</span>
                                                                            </label>
                                                                            <select name="status" class="form-control">

                                                                                @foreach($status as $key => $value)
                                                                                    @if($slider->status == $key)

                                                                                        @php
                                                                                            $selected = 'selected';
                                                                                        @endphp

                                                                                    @else

                                                                                        @php
                                                                                            $selected = '';
                                                                                        @endphp

                                                                                    @endif


                                                                                    <option {{$selected}} value="{{$key}}">
                                                                                        {{$value}}
                                                                                    </option>

                                                                                @endforeach

                                                                            </select>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                                class="btn btn-warning"
                                                                                data-dismiss="modal">Close
                                                                        </button>
                                                                        <button type="submit"
                                                                                class="btn btn-danger save_changes">
                                                                            Save
                                                                            changes
                                                                        </button>
                                                                    </div>

                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Edit Modal End Here -->



                                                    <!-- Delete Modal Start From Here -->

                                                    <div class="modal fade" id="delete{{$slider->id}}">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">
                                                                        Are you sure you want to
                                                                        Delete this Slider
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>

                                                                <form action="{{route('slider.destroy',$slider->id)}}"
                                                                      method="post">

                                                                    @method('DELETE')
                                                                    @csrf


                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                                class="btn btn-warning"
                                                                                data-dismiss="modal">No
                                                                        </button>
                                                                        <button type="submit"
                                                                                class="btn btn-danger save_changes">
                                                                            Yes
                                                                        </button>
                                                                    </div>

                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Delete Modal End Here -->



                                                @endforeach
                                            @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
        $(document).ready(function () {

        });

        function AdminavaliableScreenshot(input) {
            if (input.files && input.files[0]) {
                $('.sliderImage').show();

                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.sliderImage')
                        .attr('src', e.target.result)

                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
