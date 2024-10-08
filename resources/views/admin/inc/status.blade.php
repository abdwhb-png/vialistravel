@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $k => $er)
                <li class="text-white">{{ $k . ' : ' . $er }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

{{-- Fail --}}
@session('fail')
    <status-comp type="fail" v-bind:status="{{ json_encode(session('fail')) }}"></status-comp>
@endsession

{{-- Success --}}
@session('success')
    <status-comp type="success" v-bind:status="{{ json_encode(session('success')) }}"></status-comp>
@endsession
