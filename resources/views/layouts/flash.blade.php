@if (session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session()->has('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif

@if (session()->has('warning'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ session('warning') }}
    </div>
@endif

@if (session()->has('danger'))
    <div class="alert alert-danger">
        {{ session('danger') }}
    </div>
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endforeach
@endif