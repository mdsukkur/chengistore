<script src="{{asset('admin/app-assets/vendors/js/vendors.min.js')}}"></script>
{{--<script src="{{asset('admin/app-assets/vendors/js/extensions/jquery.knob.min.js?v='.time())}}"></script>--}}
{{--<link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/fonts/simple-line-icons/style.min.css?v='.time())}}">--}}
<script src="{{asset('admin/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('admin/app-assets/js/core/app.js')}}"></script>


<script src="{{asset('admin/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
{{--<script src="{{asset('admin/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js?v='.time())}}"></script>--}}
{{--<script--}}
{{--        src="{{asset('admin/app-assets/js/scripts/tables/datatables-extensions/datatable-responsive.js?v='.time())}}"></script>--}}

<script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert.min.js')}}"></script>


{{--<script src="{{asset('admin/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>--}}
<script src="{{asset('admin/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/app-assets/js/scripts/tables/datatables-extensions/datatable-button/datatable-html5.js')}}"></script>


<script>

    $(document).ready(function () {
        $('.customTable').DataTable({
            paging: false,
            ordering: false,
            info: false,
            searching: false
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    @if(Session::has('success'))

    swal({
        title: "{{Session::get('success')}}",
        icon: "success",
        timer: 5000
    });

    @elseif(Session::has('warning'))

    swal({
        title: "{{Session::get('warning')}}",
        icon: "warning",
        timer: 5000
    });

    @endif


    function readURL(input) {
        if (input.files && input.files[0]) {
            $('.' + input.id).show();
            console.log(input.id);

            var reader = new FileReader();

            reader.onload = function (e) {
                $('.' + input.id)
                    .attr('src', e.target.result)

            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
