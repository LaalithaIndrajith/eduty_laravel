{{-- Extends layout --}}
@extends('layout.default')

<Style>
    .padding-zero {
        padding-bottom: 0rem !important;
        padding-top: 0rem !important;
    }
</Style>

{{-- Content --}}
@section('content')

    {{-- Dashboard Admin--}}

    <div class="row">
        <div class="col-lg-6">
            <div class="row d-flex justify-content-around">
                <div class="col-lg-6">
                    <div class="card card-custom mb-8 mb-lg-0">
                        <div class="card-body padding-zero">
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
                                        <h1 class="display-2 font-weight-bolder" id="total-activated-users"></h1>
                                        {{-- <h6 class="font-size-sm text-success font-weight-bold">Activated</h6> --}}
                                    </div>
                                    <div class="text-success">
                                        <h1 class="font-size-sm text-success font-weight-light">In the Department</h1>
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
                                    <span class="svg-icon svg-icon-warning svg-icon-4x">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M10,4 L21,4 C21.5522847,4 22,4.44771525 22,5 L22,7 C22,7.55228475 21.5522847,8 21,8 L10,8 C9.44771525,8 9,7.55228475 9,7 L9,5 C9,4.44771525 9.44771525,4 10,4 Z M10,10 L21,10 C21.5522847,10 22,10.4477153 22,11 L22,13 C22,13.5522847 21.5522847,14 21,14 L10,14 C9.44771525,14 9,13.5522847 9,13 L9,11 C9,10.4477153 9.44771525,10 10,10 Z M10,16 L21,16 C21.5522847,16 22,16.4477153 22,17 L22,19 C22,19.5522847 21.5522847,20 21,20 L10,20 C9.44771525,20 9,19.5522847 9,19 L9,17 C9,16.4477153 9.44771525,16 10,16 Z" fill="#000000"/>
                                                <rect fill="#000000" opacity="0.3" x="2" y="4" width="5" height="16" rx="1"/>
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                                <div class="d-flex flex-column align-items-end">
                                    <a href="{{ route('viewTaskFlowList') }}" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">
                                    Total Taskflows
                                    </a>
                                    <div class="text-warning">
                                        <h1 class="display-2 font-weight-bolder" id="total-taskflows"></h1>
                                        {{-- <h6 class="font-size-sm text-success font-weight-bold">Activated</h6> --}}
                                    </div>
                                    <div class="text-success">
                                        <h1 class="font-size-sm text-warning font-weight-light">Belongs to Department</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-around mt-6">
                <div class="col-lg-12">
                    <div class="card card-custom bgi-no-repeat bgi-no-repeat bgi-size-cover gutter-b" style="height: 360px; background-image: url({{ asset('media/bg/bg-9.jpg') }})">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <span class="text-dark-75 text-hover-primary font-weight-bolder font-size-h1 display-2">Welcome to eDuty </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row d-flex justify-content-around">
                <div class="col-lg-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Overall Job Tickets 
                                    <span class="label label-light-danger label-lg label-inline ml-5 mr-5">for last 7 days</span>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin::Chart-->
                            <div id="jobTicketLast7days" class="d-flex justify-content-center"></div>
                            <!--end::Chart-->
                        </div>
                    </div>
                    <!--end::Card-->
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
            setDepAdminDashboardDetails()
            getDepAdminDoughnutChartData()
        });

        
        function drawDepAdminDoughnutChart(jobTicketArray){
            const primary = '#6993FF';
            const success = '#1BC5BD';
            const info = '#8950FC';
            const warning = '#FFA800';
            const danger = '#F64E60';

            var options = {
                series: jobTicketArray,
                labels: ['Pending', 'Ongoing', 'Rejected', 'Completed', ],
                chart: {
                    width: 580,
                    type: 'donut',
                },
                responsive: [{
                    breakpoint: 420,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }],
                colors: [warning, primary, danger, success,]
            };

            var chart = new ApexCharts(document.querySelector('#jobTicketLast7days'), options);
            chart.render();

        }

        async function setDepAdminDashboardDetails(){
            let retrivedData = await $.ajax(
            {
                url:'{{ route('getDepAdminDashDetails')}}',
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
            arrangeDepAdminDashboardElements(retrivedData);

        }

        function arrangeDepAdminDashboardElements(dashDetails){
            let {totalActivatedUsers,totalActiveTaskflows,mostPopularDetails} = dashDetails;
            $('#total-activated-users').html(totalActivatedUsers)
            $('#total-taskflows').html(totalActiveTaskflows)
            // arrangeMostPopularDetails(mostPopularDetails)
        }

        function arrangeMostPopularDetails(popularObj){

            let {mostPopularDep, mostPopularDTaskflow} = popularObj;

            renderMostPopularDep(mostPopularDep);
            renderMostPopularTaskflow(mostPopularDTaskflow);
        }

        function renderMostPopularDep(mostPopularDep){
            let output = '';
            output = (mostPopularDep.depName.length == 1) ? `${mostPopularDep.depName[0]}` :`${mostPopularDep.depName[0]} & ${mostPopularDep.depName.length - 1} others...`

            $('#most-job-tickets-dep').html(output);
            $('#most-job-tickets-num').html(mostPopularDep.total);
        }
        
        function renderMostPopularTaskflow(mostPopularDTaskflow){
            let output = '';
            output = (mostPopularDTaskflow.taskflowArr.length == 1) ? `${mostPopularDTaskflow.taskflowArr[0]}` :`${mostPopularDTaskflow.taskflowArr[0]} & ${mostPopularDTaskflow.taskflowArr.length - 1} others...`

            $('#most-issued-taskflow').html(output);
            $('#most-issued-taskflow-num').html(mostPopularDTaskflow.total);
        }

        async function getDepAdminDoughnutChartData(){
            let jobTicketCountArr = await $.ajax(
            {
                url:'{{ route('getDepAdminDoughnutChartData')}}',
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

            drawDepAdminDoughnutChart(jobTicketCountArr)
        }
    </script>
@endsection