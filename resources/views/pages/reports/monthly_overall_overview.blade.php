{{-- Extends layout --}}
@extends('layout.default')

@section('content')
    
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label"> Monthly Report - Job Tickets Overview
                        <span class="d-block text-muted pt-2 font-size-sm">Dsipalys Overall Overview of the Job Tickets for the Selected Month</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                   
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-12 border-right">
                        <form method="POST" id="add-new-user-type-form" action="{{ route('createUserType') }}" enctype="multipart/form-data">
                            @csrf
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
                                <button type="button" class="btn btn-primary font-weight-bolder" onclick="generateMonthlyOverviewJobTickets()">
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
                        <section id="no-records-found-container">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8">
                                    <div role="alert" class="alert alert-custom alert-light-danger text-center alert-outline-danger bg-light-danger">
                                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                        <h6 class="font-weight-sm text-danger font-weight-bold">No records found for the selected month to Generate the report</h6>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section id="report-overview-container">
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
                <section id="department-overview">
                    <table class="table table-separate table-head-custom collapsed" id="overall-dep-details-tbl">
                        <thead>
                            <tr>
                                <th class="text-center">Department</th>
                                <th class="text-center">Total Job Tickets</th>
                                <th class="text-center">Ahead of Scheduled</th>
                                <th class="text-center">Behind Scheduled</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
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
            // drawUserTypeListTable()
            $('#report_month_select').datetimepicker({
                format: 'YYYY-MMMM',
            });

            $('#report-overview-container').hide();
            $('#department-overview').hide();
            $('#no-records-found-container').hide();
        });

        // let appointTime = moment(e.time.value,'HH:mm A').format('HH:mm:00');
        async function generateMonthlyOverviewJobTickets(){
            $('#report-overview-container').hide();
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

            let retrivedData = await  $.ajax(
            {
                url:"{{ route('getMonthlyOverviewJobTickets')}}", 
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
                $('#department-overview').show();
                $('#no-records-found-container').hide();
                arrangeReportOverview(retrivedData,dateObj) 
                drawOverviewDepTbl(retrivedData.departmentOverviewData)
            } else{
                drawOverviewDepTbl(retrivedData.departmentOverviewData)
                $('#department-overview').hide();
                $('#no-records-found-container').show();

            }
             
        }

        function arrangeReportOverview(detailObj,dateObj){
            $('#report-overview-container').show();

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

        function drawOverviewDepTbl(retrivedTblData){
            $('#overall-dep-details-tbl').DataTable({
                pageLength: 10,
                destroy: true,
                retrieve: false,
                order: [
                    [0, 'desc']
                ],
                data: retrivedTblData.data,
                columns: [
                    {data: 'depName',className: 'text-center'},
                    {data: 'totalCountDetails',className: 'text-center'},
                    {data: 'timeAheadDetails',className: 'text-center'},
                    {data: 'overdueDetails',className: 'text-center'},
                ],
                responsive: true,
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                        }
                    }
                ],
                columnDefs: [
                    
                    {
                        targets: 0,
                        render: function(data, type, full, meta) {
                            let stateNo = KTUtil.getRandomInt(0, 7);
							let states = [
								'success',
								'primary',
								'danger',
								'success',
								'warning',
								'dark',
								'primary',
								'info'];
							let state = states[stateNo];

                            output = `<div class="d-flex align-items-center">
								<div class="symbol symbol-circle symbol-40 symbol-light-${state} flex-shrink-0">
									<span class="symbol-label font-size-h4 font-weight-bold">${data.substring(0, 1)}</span>
								</div>
								<div class="ml-4">
									<div class="text-dark-75 font-weight-bolder font-size-lg mb-0">${data}</div>
								</div>
							</div>`;

                            return output;
                        },
                    },
                    {
                        targets: 1,
                        render: function(data, type, full, meta) {
                            let output = '';

                            let percentage = Number.parseFloat(data.percentage).toFixed(0);
                            output += `
                            <div class='row'>
                                <div class='col-lg-4'>
                                    <div class="h2">
                                        ${data.count}/ 
                                        <span class="text-primary font-size-nm h5">${data.totalIssued}</span>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: ${percentage}%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <div class="font-size-sm mt-3"><span class="font-weight-bolder text-primary">${percentage}%</span> of total Issued Job Tickets</div>
                                </div>
                            </div>
                            `;
                            
                            return output;
                        },
                    },
                    {
                        targets: 2,
                        render: function(data, type, full, meta) {
                            let output = '';

                            let percentage = Number.parseFloat(data.percentage).toFixed(0);
                            output += `
                            <div class='row'>
                                <div class='col-lg-4'>
                                    <div class="h2">
                                        ${data.count}/ 
                                        <span class="text-success font-size-nm h5">${data.totalTimeAhead}</span>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: ${percentage}%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <div class="font-size-sm mt-3"><span class="font-weight-bolder text-success">${percentage}%</span> of total All In-Time Job Tickets</div>
                                </div>
                            </div>
                            `;
                            
                            return output;
                        },
                    },
                    {
                        targets: 3,
                        render: function(data, type, full, meta) {
                            let output = '';

                            let percentage = Number.parseFloat(data.percentage).toFixed(0);
                            output += `
                            <div class='row'>
                                <div class='col-lg-4'>
                                    <div class="h2">
                                        ${data.count}/ 
                                        <span class="text-danger font-size-nm h5">${data.totalOverDue}</span>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: ${percentage}%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <div class="font-size-sm mt-3"><span class="font-weight-bolder text-danger">${percentage}%</span> of total All Overdue Tickets</div>
                                </div>
                            </div>
                            `;
                            return output;
                        },
                    },
                    
                ],

            });
        }

        

    </script>
@endsection