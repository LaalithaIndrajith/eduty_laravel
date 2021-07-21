{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    {{-- Dashboard System Admin--}}

    <div class="row">
        <div class="col-lg-3 order-1 order-xxl-1">
            <div class="card card-custom mb-8 mb-lg-0">
                <div class="card-body">
                    <div class="d-flex align-items-center p-5 justify-content-around">
                        <div class="mr-6">
                            <span class="svg-icon svg-icon-success svg-icon-4x">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                    </g>
                                </svg>
                            </span>
                        </div>
                        <div class="d-flex flex-column align-items-end">
                            <a href="{{ route('viewUserList') }}" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">
                            Total Users
                            </a>
                            <div class="text-success">
                                <h1 class="display-2 font-weight-bolder">13</h1>
                                {{-- <h6 class="font-size-sm text-success font-weight-bold">Activated</h6> --}}
                            </div>
                            <div class="text-success">
                                <h1 class="font-size-sm text-success font-weight-light">Activated</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 order-1 order-xxl-1">
            <div class="card card-custom mb-8 mb-lg-0">
                <div class="card-body">
                    <div class="d-flex align-items-center p-5 justify-content-around">
                        <div class="mr-6">
                            <span class="svg-icon svg-icon-warning svg-icon-4x">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                    </g>
                                </svg>
                            </span>
                        </div>
                        <div class="d-flex flex-column align-items-end">
                            <a href="{{ route('viewUserList') }}" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">
                            Total Users
                            </a>
                            <div class="text-warning">
                                <h1 class="display-2 font-weight-bolder">13</h1>
                                {{-- <h6 class="font-size-sm text-success font-weight-bold">Activated</h6> --}}
                            </div>
                            <div class="text-success">
                                <h1 class="font-size-sm text-warning font-weight-light">Activated</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 order-1 order-xxl-1">
            <div class="card card-custom mb-8 mb-lg-0">
                <div class="card-body">
                    <div class="d-flex align-items-center p-5 justify-content-around">
                        <div class="mr-6">
                            <span class="svg-icon svg-icon-success svg-icon-4x">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                    </g>
                                </svg>
                            </span>
                        </div>
                        <div class="d-flex flex-column align-items-end">
                            <a href="{{ route('viewUserList') }}" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">
                            Total Users
                            </a>
                            <div class="text-success">
                                <h1 class="display-2 font-weight-bolder">13</h1>
                                {{-- <h6 class="font-size-sm text-success font-weight-bold">Activated</h6> --}}
                            </div>
                            <div class="text-success">
                                <h1 class="font-size-sm text-success font-weight-light">Activated</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 order-1 order-xxl-1">
            <div class="card card-custom mb-8 mb-lg-0">
                <div class="card-body">
                    <div class="d-flex align-items-center p-5 justify-content-around">
                        <div class="mr-6">
                            <span class="svg-icon svg-icon-success svg-icon-4x">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                    </g>
                                </svg>
                            </span>
                        </div>
                        <div class="d-flex flex-column align-items-end">
                            <a href="{{ route('viewUserList') }}" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">
                            Total Users
                            </a>
                            <div class="text-success">
                                <h1 class="display-2 font-weight-bolder">13</h1>
                                {{-- <h6 class="font-size-sm text-success font-weight-bold">Activated</h6> --}}
                            </div>
                            <div class="text-success">
                                <h1 class="font-size-sm text-success font-weight-light">Activated</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection