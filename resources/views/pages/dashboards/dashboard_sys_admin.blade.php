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

    {{-- Dashboard System Admin--}}

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
                                        <h1 class="font-size-sm text-success font-weight-light">Activated</h1>
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
                                        <h1 class="font-size-sm text-warning font-weight-light">Created</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-around mt-6">
                <div class="col-lg-12">
                    <div class="card card-custom mb-8 mb-lg-0">
                        <div class="card-header border-0 pt-6 mb-2">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bold font-size-h4 text-dark-75 mb-3">Overview</span>
                                <span class="text-muted font-weight-bold font-size-sm">Displaying Overall figures </span>
                            </h3>
                            <div class="card-toolbar">
                                <a href="#" class="btn btn-light-info btn-sm font-weight-bolder font-size-sm py-3 px-6">for Last 7 days</a>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-2">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <!--begin::Item-->
                                        <tr>
                                            <td class="w-40px align-middle pb-6 pl-0 pr-2">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-40 symbol-light-success">
                                                    <span class="symbol-label">
                                                        <span class="svg-icon svg-icon-lg svg-icon-success">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Cart3.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                    <path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                    <path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000" />
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                            </td>
                                            <td class="font-size-lg font-weight-bolder text-dark-75 align-middle w-150px pb-6">Most Number of Job Tickets issued for</td>
                                            <td class="font-weight-bold text-muted text-right align-middle pb-6" id="most-job-tickets-dep">
                                            </td>
                                            <td class="font-weight-bolder font-size-lg text-dark-75 text-right align-middle pb-6" id="most-job-tickets-num"></td>
                                        </tr>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <tr>
                                            <td class="w-40px pb-6 pl-0 pr-2">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-40 symbol-light-danger align-middle">
                                                    <span class="symbol-label">
                                                        <span class="svg-icon svg-icon-lg svg-icon-danger">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                            </td>
                                            <td class="font-size-lg font-weight-bolder text-dark-75 w-150px align-middle pb-6">Most issued Taskflow</td>
                                            <td class="font-weight-bold text-muted text-right align-middle pb-6" id="most-issued-taskflow">
                                            </td>
                                            <td class="font-weight-bolder font-size-lg text-dark-75 text-right align-middle pb-6" id="most-issued-taskflow-num"></td>
                                        </tr>
                                        <!--end::Item-->
                                    </tbody>
                                </table>
                            </div>
                            <!--end::Table-->
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
            setSystemAdminDashboardDetails()
            getSysAdminDoughnutChartData()
        });

        
        function drawAdminDoughnutChart(jobTicketArray){
            const primary = '#6993FF';
            const success = '#1BC5BD';
            const info = '#8950FC';
            const warning = '#FFA800';
            const danger = '#F64E60';

            var options = {
                series: jobTicketArray,
                labels: ['Pending', 'Ongoing', 'Rejected', 'Completed', ],
                chart: {
                    width: 485,
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

        async function setSystemAdminDashboardDetails(){
            let retrivedData = await $.ajax(
            {
                url:'{{ route('getSysAdminDashDetails')}}',
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
            arrangeAdminDashboardElements(retrivedData);

        }

        function arrangeAdminDashboardElements(dashDetails){
            let {totalActivatedUsers,totalActiveTaskflows,mostPopularDetails} = dashDetails;
            $('#total-activated-users').html(totalActivatedUsers)
            $('#total-taskflows').html(totalActiveTaskflows)
            arrangeMostPopularDetails(mostPopularDetails)
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

        async function getSysAdminDoughnutChartData(){
            let jobTicketCountArr = await $.ajax(
            {
                url:'{{ route('getSysAdminDoughnutChartData')}}',
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

            drawAdminDoughnutChart(jobTicketCountArr)
        }
    </script>
@endsection