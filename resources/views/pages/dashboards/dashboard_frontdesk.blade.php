{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    {{-- Dashboard Frontdesk --}}

    <div class="row">
        <div class="col-lg-6 border-right">
            <div class="row d-flex justify-content-around">
                <div class="col-lg-6">
                    <div class="card card-custom mb-8 mb-lg-0">
                        <div class="card-body padding-zero">
                            <div class="d-flex align-items-center p-5 justify-content-around">
                                <div class="mr-6">
                                    <span class="svg-icon svg-icon-primary svg-icon-4x">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M6,7 C7.1045695,7 8,6.1045695 8,5 C8,3.8954305 7.1045695,3 6,3 C4.8954305,3 4,3.8954305 4,5 C4,6.1045695 4.8954305,7 6,7 Z M6,9 C3.790861,9 2,7.209139 2,5 C2,2.790861 3.790861,1 6,1 C8.209139,1 10,2.790861 10,5 C10,7.209139 8.209139,9 6,9 Z" fill="#000000" fill-rule="nonzero"/>
                                                <path d="M7,11.4648712 L7,17 C7,18.1045695 7.8954305,19 9,19 L15,19 L15,21 L9,21 C6.790861,21 5,19.209139 5,17 L5,8 L5,7 L7,7 L7,8 C7,9.1045695 7.8954305,10 9,10 L15,10 L15,12 L9,12 C8.27142571,12 7.58834673,11.8052114 7,11.4648712 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                <path d="M18,22 C19.1045695,22 20,21.1045695 20,20 C20,18.8954305 19.1045695,18 18,18 C16.8954305,18 16,18.8954305 16,20 C16,21.1045695 16.8954305,22 18,22 Z M18,24 C15.790861,24 14,22.209139 14,20 C14,17.790861 15.790861,16 18,16 C20.209139,16 22,17.790861 22,20 C22,22.209139 20.209139,24 18,24 Z" fill="#000000" fill-rule="nonzero"/>
                                                <path d="M18,13 C19.1045695,13 20,12.1045695 20,11 C20,9.8954305 19.1045695,9 18,9 C16.8954305,9 16,9.8954305 16,11 C16,12.1045695 16.8954305,13 18,13 Z M18,15 C15.790861,15 14,13.209139 14,11 C14,8.790861 15.790861,7 18,7 C20.209139,7 22,8.790861 22,11 C22,13.209139 20.209139,15 18,15 Z" fill="#000000" fill-rule="nonzero"/>
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                                <div class="d-flex flex-column align-items-end">
                                    <a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">
                                    Job Tickets
                                    </a>
                                    <div class="text-primary">
                                        <h1 class="display-2 font-weight-bolder" id="total-issued-jobs-today"></h1>
                                        {{-- <h6 class="font-size-sm text-success font-weight-bold">Activated</h6> --}}
                                    </div>
                                    <div class="text-primary">
                                        <h1 class="font-size-sm text-primary font-weight-light">Issued Today</h1>
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
                                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                <path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 L7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.3"/>
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                                <div class="d-flex flex-column align-items-end">
                                    <a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">
                                    Total Customers
                                    </a>
                                    <div class="text-success">
                                        <h1 class="display-2 font-weight-bolder" id="total-registered-customers"></h1>
                                        {{-- <h6 class="font-size-sm text-success font-weight-bold">Activated</h6> --}}
                                    </div>
                                    <div class="text-success">
                                        <h1 class="font-size-sm text-success font-weight-light">Registered</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row d-flex justify-content-around">
                <div class="col-lg-12">
                    <div class="card card-custom">
                        <div class="card-body padding-zero">
                            <h4 class="text-center">Quick Access</h4>
                            <div class="d-flex align-items-center py-3 justify-content-around">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <a href="{{ route('clientRegisterView') }}">
                                            <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg">
                                                <div class="symbol symbol-40 symbol-success flex-shrink-0">
                                                    <span class="symbol-label font-size-h4 font-weight-bold">R</span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">Register Customer</div>
                                                    {{-- <a href="#" class="text-muted font-weight-bold text-hover-primary">${data.code}</a> --}}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="row mt-9">
                                        <a href="{{ route('viewClientList') }}">
                                            <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg">
                                                <div class="symbol symbol-40 symbol-warning flex-shrink-0">
                                                    <span class="symbol-label font-size-h4 font-weight-bold">C</span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">Customer List</div>
                                                    {{-- <a href="#" class="text-muted font-weight-bold text-hover-primary">${data.code}</a> --}}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <a href="{{ route('jobTicketCreationView') }}">
                                            <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg">
                                                <div class="symbol symbol-40 symbol-primary flex-shrink-0">
                                                    <span class="symbol-label font-size-h4 font-weight-bold">I</span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">Issue Job Ticket</div>
                                                    {{-- <a href="#" class="text-muted font-weight-bold text-hover-primary">${data.code}</a> --}}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="row mt-8">
                                        <a href="{{ route('viewJobTicketList') }}">
                                            <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg">
                                                <div class="symbol symbol-40 symbol-info flex-shrink-0">
                                                    <span class="symbol-label font-size-h4 font-weight-bold">J</span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">Job Ticket List</div>
                                                    {{-- <a href="#" class="text-muted font-weight-bold text-hover-primary">${data.code}</a> --}}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            setFrontDashboardDetails()
        });

        async function setFrontDashboardDetails(){
            let retrivedData = await $.ajax(
            {
                url:'{{ route('getFrontDeskDashDetails')}}',
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
            arrangeFrontDeskDashboardElements(retrivedData);

        }

        function arrangeFrontDeskDashboardElements(dashDetails){
            let {issuedJobTickets,totalRegCustomers} = dashDetails;
            $('#total-issued-jobs-today').html(issuedJobTickets)
            $('#total-registered-customers').html(totalRegCustomers)
            // arrangeMostPopularDetails(mostPopularDetails)
        }

    </script>
@endsection