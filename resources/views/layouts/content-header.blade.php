<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ $name. ' '. $key }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">{{ $name }}</a></li>
                    <li class="breadcrumb-item active"><a href="#">{{ $key }}</a></li>
                </ol>
            </div>
            @if(session()->has('success'))
            <div class="alert alert-success col-md-12" role="alert">
                {{ session()->get('success') }}
            </div>
            @elseif(session()->has('danger'))
                <div class="alert alert-danger col-md-12" role="alert">
                    {{ session()->get('danger') }}
                </div>
            @endif
        </div>
    </div>
</div>
