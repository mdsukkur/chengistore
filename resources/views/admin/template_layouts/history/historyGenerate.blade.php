@extends('admin.template_parts.master')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 offset-md-2">

            @include('error.validationError')


            <!--============================== Generate History ==============================-->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-left pl-2 ml-2">
                                    Generate Report
                                </h4>
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

                                    <form method="get" action="{{route('admin.generateHistory')}}">

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                                Report Days : <span class="danger"> *</span>
                                            </label>

                                            <div class="col-md-6">
                                                <select name="date" class="form-control">
                                                    <option value="1">Today</option>
                                                    <option value="2">Last 7 Days</option>
                                                    <option value="3">Last 15 Days</option>
                                                    <option value="4">{{date('M, Y')}} Report</option>
                                                    <option value="5">
                                                        {{date('M, Y',strtotime('-1month'))}}Report
                                                    </option>
                                                    <option value="6">{{date('Y')}} Report</option>
                                                    <option value="7">{{date('Y',strtotime('-1year'))}} Report</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                                Page Name : <span class="danger"> *</span>
                                            </label>

                                            <div class="col-md-6">
                                                <fieldset>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="customCheck0">
                                                        <label class="custom-control-label"
                                                               for="customCheck0">Select All</label>
                                                    </div>
                                                </fieldset>

                                                @foreach($pageName as $key => $value)
                                                    <fieldset>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox"
                                                                   class="custom-control-input pageCheck"
                                                                   value="{{$key}}" name="page_name[]"
                                                                   id="customCheck{{$key}}">
                                                            <label class="custom-control-label"
                                                                   for="customCheck{{$key}}">{{$value}}</label>
                                                        </div>
                                                    </fieldset>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Generate Report
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

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#customCheck0').click(function () {
                if ($(this).prop('checked') == true) {
                    $('.custom-control-input').prop('checked', true);
                } else if ($(this).prop('checked') == false) {
                    $('.custom-control-input').prop('checked', false);
                }
            });

            $('.pageCheck').click(function () {
                if ($('.pageCheck:checked').length == $('.pageCheck').length) {
                    $('.custom-control-input').prop('checked', true);
                } else {
                    $('#customCheck0').prop('checked', false);
                }
            });
        });
    </script>
@endsection
