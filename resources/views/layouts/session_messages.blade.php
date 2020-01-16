@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible mb-0" id="error-alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <i class="fas fa-exclamation-triangle fa-lg"></i> {{ Session::get('error') }}
        {{--  <i class="fas fa-check-circle fa-lg"></i></i> {{ Session::get('error') }}  --}}

    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible mb-0" id="error-alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <i class="fas fa-check fa-lg"></i> {{ Session::get('error') }} {{ Session::get('success') }}
    </div>
@endif