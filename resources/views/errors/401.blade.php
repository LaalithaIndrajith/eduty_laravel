{{-- Extends layout --}}
@extends('layout.default')

@section('content')
<div class="col-lg-12">
	<div class="card card-custom gutter-b">
        <div class = "row">
            <div class = "card-body" style="width:100%">
                <div class="d-flex flex-column flex-root">
                    <div class="error error-5 d-flex flex-row-fluid bgi-size-cover bgi-position-center" style="background-image: url({{ asset('media/error/401.jpg') }}); background-size: contain; background-repeat: no-repeat; ">
                        <!--begin::Content-->
                        <div class="container d-flex flex-row-fluid flex-column justify-content-md-center p-12">
                            <p class="font-weight-boldest display-4">Sorry!!!</p>
                            <p class="font-size-h3">You are not authorized to access this page</p>
                        </div>
                        <!--end::Content-->
                    </div>
                </div>
            </div>
        </div>
    </div>	
</div>	
    
@endsection