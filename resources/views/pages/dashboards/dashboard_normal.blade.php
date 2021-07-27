{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    {{-- Dashboard Normal --}}

    <div class="row">
        <div class="col-lg-6">
            <div class="row d-flex justify-content-around">
                <div class="col-lg-6">
                    <div class="card card-custom mb-8 mb-lg-0">
                        <div class="card-body padding-zero">
                            <div class="d-flex align-items-center p-5 justify-content-around">
                                <div class="mr-6">
                                    <span class="svg-icon svg-icon-warning svg-icon-4x">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"/>
                                                <path d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z" fill="#000000" fill-rule="nonzero"/>
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                                <div class="d-flex flex-column align-items-end">
                                    <a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">
                                    Available Tasks
                                    </a>
                                    <div class="text-warning">
                                        <h1 class="display-2 font-weight-bolder" id="total-allocated-jobs-today"></h1>
                                        {{-- <h6 class="font-size-sm text-success font-weight-bold">Activated</h6> --}}
                                    </div>
                                    <div class="text-success">
                                        <h1 class="font-size-sm text-warning font-weight-light">Today</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-custom mb-8 mb-lg-0">
                        <div class="card-body padding-zero">
                            <div class="d-flex align-items-center p-5 justify-content-around">
                                <div class="mr-6">
                                    <span class="svg-icon svg-icon-success svg-icon-4x">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                <path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" fill="#000000"/>
                                                <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                                <div class="d-flex flex-column align-items-end">
                                    <a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">
                                    Total Tasks
                                    </a>
                                    <div class="text-success">
                                        <h1 class="display-2 font-weight-bolder" id="total-task-completed"></h1>
                                        {{-- <h6 class="font-size-sm text-success font-weight-bold">Activated</h6> --}}
                                    </div>
                                    <div class="text-success">
                                        <h1 class="font-size-sm text-success font-weight-light">Completed</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-lg-6">
            
        </div>
    </div>
    <div class="row mt-8">
        <div class="col-lg-12">
            <div class="card card-custom bgi-no-repeat bgi-no-repeat bgi-size-cover gutter-b" style="height: 360px; background-image: url({{ asset('media/bg/bg-9.jpg') }})">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <span class="text-dark-75 text-hover-primary font-weight-bolder font-size-h1 display-2">Welcome to eDuty </span>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script>
         $(document).ready(function(){
            setNormalDashboardDetails()
        });


        async function setNormalDashboardDetails(){
            let retrivedData = await $.ajax(
            {
                url:'{{ route('getNormalDashDetails')}}',
                method:"POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                dataType:'json',
                success:function(data)
                {
                    return data;
                }
            });
            arrangeNormalElements(retrivedData);

        }

        function arrangeNormalElements(dashDetails){
            let {todayTotalAllocated,completedTasks} = dashDetails;
            $('#total-allocated-jobs-today').html(todayTotalAllocated)
            $('#total-task-completed').html(completedTasks)
        }

    </script>
@endsection