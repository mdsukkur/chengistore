@if ($errors->any())
    <div class="bs-callout-warning callout-bordered my-2">
        <div class="media align-items-stretch">
            <div class="media-body p-1">
                @foreach ($errors->all() as $error)
                    <p class="danger">{{ $error }}</p>
                @endforeach
            </div>
            <div class="d-flex align-items-center bg-warning p-2">
                <i class="fa fa-warning white font-medium-5"></i>
            </div>
        </div>
    </div>
@endif
