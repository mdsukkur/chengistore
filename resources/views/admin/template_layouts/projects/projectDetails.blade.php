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
                            <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#addNewProject">
                                Add New Project
                            </button>
                        </div>
                    </div>


                    <div class="clearfix"></div>


                    <!--++++++++++++++++++++++++++++++++ Add New Project Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="addNewProject" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">
                                        Add New Project
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('projectDetails.store')}}" method="POST">
                                    @csrf

                                    <div class="modal-body">
                                        <label>Project Name : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control" name="project_name" required
                                                   placeholder="Project Name">
                                        </div>


                                        <label>Project Budget Amount : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control" name="project_budget" required
                                                   placeholder="Project Budget Amount">
                                        </div>


                                        <label>Project Details : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <textarea name="project_details" class="form-control" rows="5"
                                                      placeholder="Project Details"></textarea>
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
                                    <h4 class="card-title text-left pl-2 ml-2">Project Management</h4>
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
                                                    <input class="form-control" name="name" placeholder="Project Name">
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
                                                    <a href="{{route('projectDetails.index')}}" class="btn btn-primary">
                                                        All History
                                                    </a>
                                                </div>

                                            </div>
                                        </form>

                                        <table class="table table-striped table-bordered customTable dataTable"
                                               style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th style="width: 20% !important;">Project Name</th>
                                                <th>Project Budget</th>
                                                <th>Project Cost</th>
                                                <th>Profit</th>
                                                <th>Partner Desc</th>
                                                <th>Profit Ratio</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if($allProject->isNotEmpty())
                                                @foreach($allProject->sortByDesc('id') as $project)
                                                    @php
                                                        $budget = $project->project_budget ?? 0;
                                                        $totalCost = $project->cost->sum('amount') ?? 0;
                                                        $profit = $budget - $totalCost;
                                                        $profit_percentage = (($budget - $totalCost) * 100) / $budget;
                                                        $totalPartner = $project->partner->count();
                                                    @endphp

                                                    <tr>
                                                        <td>
                                                            {{$project->project_name ?? '-----'}}

                                                            @if(!is_null($project->project_details))

                                                                <span data-placement="top" data-toggle="tooltip"
                                                                      data-original-title="Project Details"
                                                                      aria-describedby="tooltip406983">
                                                                    <a class="btn btn-primary btn-xs projectDetailsModal ml-1"
                                                                       data-content="{{$project->project_details}}">
                                                                        <i class="fa fa-info"></i>
                                                                    </a>
                                                                </span>

                                                            @endif
                                                        </td>
                                                        <td>{{number_format($budget,2)}} BDT</td>
                                                        <td>{{number_format($totalCost,2)}} BDT</td>
                                                        <td>{{number_format($profit,2)}} BDT</td>
                                                        <td>
                                                            Total Partner : {{$totalPartner}}
                                                            <hr>
                                                            @if ($totalPartner > 0)
                                                                Per Partner Profit
                                                                : {{number_format($profit / $totalPartner ,2)}} BDT
                                                            @else
                                                                Per Partner Profit : {{number_format($profit,2)}} BDT
                                                            @endif
                                                        </td>
                                                        <td class="text-center font-small-2">
                                                            @if ($profit_percentage > 0)
                                                                {{round($profit_percentage,0)}}%
                                                                <div class="progress progress-sm mt-1 mb-0">
                                                                    <div class="progress-bar bg-success"
                                                                         role="progressbar"
                                                                         style="width: {{round($profit_percentage,0)}}%"
                                                                         aria-valuenow="50" aria-valuemin="0"
                                                                         aria-valuemax="100"></div>
                                                                </div>

                                                            @else
                                                                <span class="badge badge-danger">Loss Project</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($project->status == 1)
                                                                <span class="badge badge-primary badge-pill">
                                                                    Active
                                                                </span>
                                                            @elseif($project->status == 0)
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
                                                                   href="{{route('projectDetails.show',$project->id)}}">
                                                                    <i class="fa fa-database"></i>
                                                                </a>
                                                            </span>

                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Edit">
                                                                <a class="btn btn-warning btn-xs updateModal"
                                                                   data-action="{{$project->id}}"
                                                                   data-content="{{$project->project_name}}"
                                                                   data-col="{{$project->project_details}}"
                                                                   data-end="{{$project->project_budget}}"
                                                                   data-goto="{{$project->status}}">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            </span>

                                                            <span data-placement="top" data-toggle="tooltip"
                                                                  data-original-title="Delete"
                                                                  aria-describedby="tooltip406983">
                                                                <a class="btn btn-danger btn-xs deleteModal"
                                                                   data-action="{{$project->id}}">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </span>
                                                        </td>
                                                    </tr>

                                                @endforeach
                                            @endif

                                            </tbody>
                                        </table>

                                        {{$allProject->appends(\Illuminate\Support\Facades\Request::all())->render()}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--++++++++++++++++++++++++++++++++ Project Details Modal ++++++++++++++++++++++++++++++++-->
                    <div class="modal fade text-left" id="projectDetailsModal" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">
                                        Project Details
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="px-2">
                                    <p class="projectDetailsModalContent text-center my-2"></p>
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
                                        <label>Project Name : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control projectName" name="project_name" required
                                                   placeholder="Project Name">
                                        </div>


                                        <label>Project Budget Amount : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <input class="form-control projectBudget" name="project_budget" required
                                                   placeholder="Project Budget Amount">
                                        </div>


                                        <label>Project Details : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <textarea name="project_details" class="form-control projectDetails"
                                                      rows="5"
                                                      placeholder="Project Details"></textarea>
                                        </div>


                                        <label>Status : <span class="danger"> *</span></label>
                                        <div class="form-group">
                                            <select name="status" class="form-control projectStatus">

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

                $('.projectDetailsModal').click(function () {
                    $('.projectDetailsModalContent').text($(this).attr('data-content'));
                    $('#projectDetailsModal').modal('show');
                });


                $('.deleteModal').click(function () {

                    deleteUrl = '{{route("projectDetails.destroy",":id")}}';
                    deleteUrl = deleteUrl.replace(':id', $(this).attr('data-action'));

                    $('#deleteModal form').attr('action', deleteUrl);
                    $('#deleteModal').modal('show');
                });


                $('.updateModal').click(function () {

                    updateUrl = '{{route("projectDetails.update",":Project_id")}}';
                    updateUrl = updateUrl.replace(':Project_id', $(this).attr('data-action'));

                    project_name = $(this).attr('data-content');
                    project_details = $(this).attr('data-col');
                    project_budget = $(this).attr('data-end');
                    projectStatus = $(this).attr('data-goto');

                    $('.projectName').val(project_name);
                    $('.projectDetails').val(project_details);
                    $('.projectBudget').val(project_budget);

                    if (projectStatus == 1) {
                        $('.projectStatus option[value=1]').attr('selected', 'selected');
                    } else if (projectStatus == 0) {
                        $('.projectStatus option[value=0]').attr('selected', 'selected');
                    }

                    $('#updateModal form').attr('action', updateUrl);
                    $('#updateModal').modal('show');
                });

            });
        })(jQuery);

    </script>
@endsection
