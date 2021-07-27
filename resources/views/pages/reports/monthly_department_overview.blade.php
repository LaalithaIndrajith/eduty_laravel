{{-- Extends layout --}}
@extends('layout.default')

@section('content')
    
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label"> Monthly Report - Department Overview
                        <span class="d-block text-muted pt-2 font-size-sm">Displays Overview of the Job Tickets issued for the Department</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                   
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-12 border-right">
                        <form method="POST" id="monthly-dep-overview-report-form" action="" enctype="multipart/form-data">
                            @csrf
                            <div class="row d-flex justify-content-start">
                                <div class="col-lg-8 form-group">
                                    <label class="form-label col-form-label">Select Department<span class="text-danger">*</span></label>
                                    <div class="input-group date" id="department_select" data-target-input="nearest">
                                        <select class="form-control form-control-lg dynamic mt-2 selectpicker @error('department_select') is-invalid @enderror" name="department_select" id="department_select" data-dependent="department_select" data-size="7" data-live-search="true">
                                            <option value="">Select a Department</option>
                                            @foreach ($departments as $department )
                                            <option value="{{ $department->depart_id }}">{{ $department->depart_code }} | {{ $department->depart_name }}</option>   
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            
                            </div>
                            <div class="row d-flex justify-content-start">
                                <div class="col-lg-8 form-group">
                                    <label class="form-label col-form-label">Select Month<span class="text-danger">*</span></label>
                                    <div class="input-group date" id="report_month_select" data-target-input="nearest">
                                        <input type="text" name="report_month_select" class="form-control datetimepicker-input" placeholder="Select Month" 
                                        data-target="#report_month_select"/>
                                        <div class="input-group-append" data-target="#report_month_select" data-toggle="datetimepicker">
                                            <span class="input-group-text">
                                                <i class="ki ki-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                         <div class="row d-flex justify-content-start">
                            <div class="col-lg-8 form-group text-center">
                                <!--begin::Button-->
                                <label class="form-label col-form-label"></label>
                                <button type="button" class="btn btn-primary font-weight-bolder" onclick="generateMonthlyOverviewDepartment()">
                                    <span class="svg-icon svg-icon-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>Generate Report
                                </button>
                                <!--end::Button-->
                             </div>
                         </div>
                        </form>
                    </div>
                    <div class="col-lg-8 col-12 pl-10">
                        <section id="no-records-found-container" class="d-none">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8">
                                    <div role="alert" class="alert alert-custom alert-light-danger text-center alert-outline-danger bg-light-danger">
                                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                        <h6 class="font-weight-sm text-danger font-weight-bold">No records found for the selected month to Generate the report</h6>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section id="report-overview-container" class="d-none">
                            <div class="row d-flex justify-content-around align-items-center">
                                <div class="col-lg-4">
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <div class="d-flex align-items-center justify-content-around mr-10">
                                                <div class="mr-6">
                                                    <div class="font-weight-bold mb-2">Start Date</div>
                                                    <span class="btn btn-sm btn-text btn-light-primary text-uppercase font-weight-bold" id="report-overview-start-date"></span>
                                                </div>
                                                <div class="">
                                                    <div class="font-weight-bold mb-2">End Date</div>
                                                    <span class="btn btn-sm btn-text btn-light-danger text-uppercase font-weight-bold" id="report-overview-end-date"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                            <a href="#" class="text-dark font-weight-bolder text-center font-size-h5">Total Job Tickets Issued
                                            </a>
                                            <div class="text-primary text-center">
                                                <h1 class="display-2 font-weight-bolder" id="total-issued-job-tickets"></h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-dark font-weight-bolder font-size-h2 mt-3" id="total-time-ahead-job-tickets"></div>
                                            <a href="#" class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">Job Tickets</a>
                                        </div>
                                        <div class="col-lg-10">
                                            <span class="font-weight-bold">Ahead Of Scheduled</span>
                                            <div class="progress progress-xs mt-2 mb-2" id="total-time-ahead-percentage">
                                                {{-- <div class="progress-bar bg-success" role="progressbar" style="width: 63%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div> --}}
                                            </div>
                                            <span class="font-weight-bolder text-dark" id="time-ahead-percentage"></span>
                                        </div>
                                        <div class="flex-grow-1 flex-shrink-0 w-150px w-xl-300px mt-4 mt-sm-0">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-dark font-weight-bolder font-size-h2 mt-3" id="total-overdue-job-tickets"></div>
                                            <a href="#" class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">Job Tickets</a>
                                        </div>
                                        <div class="col-lg-10">
                                            <span class="font-weight-bold">Behind Scheduled</span>
                                            <div class="progress progress-xs mt-2 mb-2" id="total-overdue-percentage">
                                                {{-- <div class="progress-bar bg-danger" role="progressbar" style="width: 37.55%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div> --}}
                                            </div>
                                            <span class="font-weight-bolder text-dark" id="time-overdue-percentage"></span>
                                        </div>
                                        <div class="flex-grow-1 flex-shrink-0 w-150px w-xl-300px mt-4 mt-sm-0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-custom mt-8">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label"> Details 
                        <span class="d-block text-muted pt-2 font-size-sm">Dsipalys Overall Stats of Departments</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                   
                </div>
            </div>
            
            <div class="card-body py-10">
                <section id="department-overview" class="d-none">
                    <div class="row d-flex justify-content-around">
                        <div class="col-lg-6 border-right" id="doughnutChartContainer">
                            <div id="departOverview" class="d-flex justify-content-center">

                            </div>
                        </div>
                        <div class="col-lg-6">
                            {{-- Pending Row --}}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center mr-2">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-45 symbol-light-warning mr-4 flex-shrink-0">
                                            <div class="symbol-label font-size-h4 font-weight-bold">
                                                P
                                            </div>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div>
                                            <div class="font-size-h4 text-dark-75 font-weight-bolder" id="total-pending"></div>
                                            <div class="font-size-sm text-muted font-weight-bold mt-1">Pending</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="d-flex align-items-center mr-2">
                                        <div>
                                            <div class="font-size-h4 text-dark-75 font-weight-bolder" id="overdue-pending"></div>
                                            <div class="font-size-sm text-danger font-weight-bold mt-1">Overdue</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="d-flex align-items-center mr-2">
                                        <div>
                                            <div class="font-size-h4 text-dark-75 font-weight-bolder" id="intime-pending"></div>
                                            <div class="font-size-sm text-success font-weight-bold mt-1">In Time</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Ongoing Row --}}
                            <div class="row mt-3">
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center mr-2">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-45 symbol-light-primary mr-4 flex-shrink-0">
                                            <div class="symbol-label font-size-h4 font-weight-bold">
                                                O
                                            </div>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div>
                                            <div class="font-size-h4 text-dark-75 font-weight-bolder" id="total-ongoing"></div>
                                            <div class="font-size-sm text-muted font-weight-bold mt-1">Ongoing</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="d-flex align-items-center mr-2">
                                        <div>
                                            <div class="font-size-h4 text-dark-75 font-weight-bolder" id="overdue-ongoing"></div>
                                            <div class="font-size-sm text-danger font-weight-bold mt-1">Overdue</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="d-flex align-items-center mr-2">
                                        <div>
                                            <div class="font-size-h4 text-dark-75 font-weight-bolder" id="intime-ongoing"></div>
                                            <div class="font-size-sm text-success font-weight-bold mt-1">In Time</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Completed Row --}}
                            <div class="row mt-3">
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center mr-2">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-45 symbol-light-success mr-4 flex-shrink-0">
                                            <div class="symbol-label font-size-h4 font-weight-bold">
                                                S
                                            </div>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div>
                                            <div class="font-size-h4 text-dark-75 font-weight-bolder" id="total-completed"></div>
                                            <div class="font-size-sm text-muted font-weight-bold mt-1">Completed</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="d-flex align-items-center mr-2">
                                        <div>
                                            <div class="font-size-h4 text-dark-75 font-weight-bolder" id="overdue-completed"></div>
                                            <div class="font-size-sm text-danger font-weight-bold mt-1">Overdue</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="d-flex align-items-center mr-2">
                                        <div>
                                            <div class="font-size-h4 text-dark-75 font-weight-bolder" id="intime-completed"></div>
                                            <div class="font-size-sm text-success font-weight-bold mt-1">In Time</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Rejected Row --}}
                            <div class="row mt-3">
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center mr-2">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-45 symbol-light-danger mr-4 flex-shrink-0">
                                            <div class="symbol-label font-size-h4 font-weight-bold">
                                                R
                                            </div>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div>
                                            <div class="font-size-h4 text-dark-75 font-weight-bolder" id="total-rejected"></div>
                                            <div class="font-size-sm text-muted font-weight-bold mt-1">Rejected</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="d-flex align-items-center mr-2">
                                        <div>
                                            <div class="font-size-h4 text-dark-75 font-weight-bolder" id="overdue-rejected"></div>
                                            <div class="font-size-sm text-danger font-weight-bold mt-1">Overdue</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="d-flex align-items-center mr-2">
                                        <div>
                                            <div class="font-size-h4 text-dark-75 font-weight-bolder" id="intime-rejected"></div>
                                            <div class="font-size-sm text-success font-weight-bold mt-1">In Time</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
@endsection

@section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/custom/profile/profile.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" defer></script>
    <script>

        $(document).ready(function(){
            $('#report_month_select').datetimepicker({
                format: 'YYYY-MMMM',
            });
            $('#department_select').selectpicker();

            $('#report-overview-container').addClass('d-none');
            $('#department-overview').addClass('d-none');
            $('#no-records-found-container').addClass('d-none');
        });

        async function generateMonthlyOverviewDepartment(){

            $('#report-overview-container').addClass('d-none');
            $('.appendedProgress').remove();
            
            let selectedMonth = $("#report_month_select").data("datetimepicker")._datesFormatted[0]
            let startOfMonth = moment(selectedMonth, 'YYYY-MM-DD');
            let firstDayOfMonth = startOfMonth.startOf('month').format('YYYY-MM-DD')
            let endOfMonth = startOfMonth.endOf('month').format('YYYY-MM-DD');

            let dateObj = {
                'startDate' : moment(firstDayOfMonth,'YYYY-MM-DD').format('DD MMMM, YYYY'),
                'endDate' : moment(endOfMonth,'YYYY-MM-DD').format('DD MMMM, YYYY'),
            }

            var formData = new FormData();
            formData.append('startOfMonth', firstDayOfMonth);
            formData.append('endOfMonth', endOfMonth);
            formData.append('depId', $('#department_select option:selected').val());

            let retrivedData = await  $.ajax(
            {
                url:"{{ route('getMonthlyOverviewDepartment')}}", 
                method:"POST",
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                data: formData,
                cache : false,
                processData: false,
                contentType: false,
                dataType:'json',
                success:function(data)
                {
                    return data;
                }
            }); 

            if(retrivedData.foundJobTickets){

                let {pendingDetails,ongoingDetails,completeDetails,rejectDetails} = retrivedData;
                
                $('#department-overview').removeClass('d-none');
                $('#no-records-found-container').addClass('d-none');

                arrangeReportOverview(retrivedData,dateObj) 
                drawDoughnutChart(retrivedData.doughnutData)
                
                renderInDepthData(pendingDetails,'pending')
                renderInDepthData(ongoingDetails,'ongoing')
                renderInDepthData(completeDetails,'completed')
                renderInDepthData(rejectDetails,'rejected')

            } else{
                $('#department-overview').addClass('d-none');
                $('#no-records-found-container').removeClass('d-none');

            }
             
        }

        function arrangeReportOverview(detailObj,dateObj){

            $('#report-overview-container').removeClass('d-none');

            let {issuedJobTicketCount, overdueDetails, aheadTimeDetails} = detailObj;

            $('#report-overview-start-date').text(dateObj.startDate)
            $('#report-overview-end-date').text(dateObj.endDate)

            $('#total-issued-job-tickets').html(issuedJobTicketCount)

            $('#total-time-ahead-job-tickets').text(aheadTimeDetails.count)
            let aheadPercentage = Number.parseFloat(aheadTimeDetails.percentage).toFixed(2);
            $('#time-ahead-percentage').text(aheadPercentage + '%')
            renderPercentage(aheadPercentage,false,'#total-time-ahead-percentage')

            $('#total-overdue-job-tickets').text(overdueDetails.count)
            let overduePercentage = Number.parseFloat(overdueDetails.percentage).toFixed(2);
            $('#time-overdue-percentage').text(overduePercentage + '%')
            renderPercentage(overduePercentage,true,'#total-overdue-percentage')

        }

        function renderPercentage(percentage,isOverdue, outputContainerId){
            let state = (isOverdue) ? 'danger' : 'success';
            let output = ''
            output = `
                <div class="progress-bar bg-${state} appendedProgress" role="progressbar" style="width: ${percentage}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                </div>`

            $(outputContainerId).append(output);

        }

        //Doughnut Chart
        function drawDoughnutChart(doughnutdata){
            removeChartContainer()
            renderChartContainer()
            const primary = '#6993FF';
            const success = '#1BC5BD';
            const info = '#8950FC';
            const warning = '#FFA800';
            const danger = '#F64E60';

            var options = {
                series: doughnutdata,
                labels: ['Pending', 'Ongoing', 'Completed', 'Rejected',],
                chart: {
                    width: 480,
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
                colors: [warning, primary, success, danger,]
            };
            var chart = new ApexCharts(document.querySelector('#departOverview'), options);
            chart.render();
        }

        function removeChartContainer(){
            $('#departOverview').remove();
        }

        function renderChartContainer(){
            let output = '';

            output = `<div id="departOverview" class="d-flex justify-content-center"></div>`

            $('#doughnutChartContainer').append(output);
        }
        
        //Indepth Details
        function renderInDepthData(Obj,idType){
            $(`#total-${idType}`).html(`${Obj.total} <span class="font-weight-light font-sized-h6">Job tickets </span>`);
            $(`#overdue-${idType}`).html(`${Obj.overdue} <span class="font-weight-light font-sized-h6">Job tickets </span>`);
            $(`#intime-${idType}`).html(`${Obj.ahead} <span class="font-weight-light font-sized-h6">Job tickets </span>`);
        }

    </script>
@endsection