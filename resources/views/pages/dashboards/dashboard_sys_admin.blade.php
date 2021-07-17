{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    {{-- Dashboard System Admin--}}

    <div class="row">
        <div class="col-lg-6 col-xxl-4 order-1 order-xxl-1">
            <div class="card card-custom wave wave-animate-slow wave-primary mb-8 mb-lg-0">
                <div class="card-body">
                    <div class="d-flex align-items-center p-5">
                        <div class="mr-6">
                            <span class="svg-icon svg-icon-success svg-icon-4x">
                                <svg>
                    
                                </svg>
                            </span>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">
                            Total Users
                            </a>
                            <div class="text-dark-75">
                                ...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-xxl-4 order-1 order-xxl-1">
            @include('pages.widgets._widget-5', ['class' => 'card-stretch gutter-b'])
        </div>

        <div class="col-xxl-8 order-2 order-xxl-1">
            @include('pages.widgets._widget-6', ['class' => 'card-stretch gutter-b'])
        </div>

        <div class="col-lg-6 col-xxl-4 order-1 order-xxl-2">
            @include('pages.widgets._widget-7', ['class' => 'card-stretch gutter-b'])
        </div>

        <div class="col-lg-6 col-xxl-4 order-1 order-xxl-2">
            @include('pages.widgets._widget-8', ['class' => 'card-stretch gutter-b'])
        </div>

        <div class="col-lg-12 col-xxl-4 order-1 order-xxl-2">
            @include('pages.widgets._widget-9', ['class' => 'card-stretch gutter-b'])
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection