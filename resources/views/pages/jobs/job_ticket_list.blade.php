{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- User List--}}

        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Job Ticket List
                        <span class="d-block text-muted pt-2 font-size-sm">Details of Job Tickets issued</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline mr-2">
                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                        <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>Export</button>
                        <!--begin::Dropdown Menu-->
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi flex-column navi-hover py-2">
                                <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-print"></i>
                                        </span>
                                        <span class="navi-text">Print</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-copy"></i>
                                        </span>
                                        <span class="navi-text">Copy</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-file-excel-o"></i>
                                        </span>
                                        <span class="navi-text">Excel</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-file-text-o"></i>
                                        </span>
                                        <span class="navi-text">CSV</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-file-pdf-o"></i>
                                        </span>
                                        <span class="navi-text">PDF</span>
                                    </a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                        <!--end::Dropdown Menu-->
                    </div>
                    <!--end::Dropdown-->
                    <!--begin::Button-->
                    <a href="{{ route('jobTicketCreationView') }}" class="btn btn-primary font-weight-bolder">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <circle fill="#000000" cx="9" cy="15" r="6" />
                                    <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>Issue Job Ticket</a>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom collapsed" id="job_ticket_list_table">
                    <thead>
                        <tr>
                            <th class="text-center">Job Number</th>
                            <th class="text-center">Customer</th>
                            <th class="text-center">Taskflow</th>
                            <th class="text-center">Progress</th>
                            <th class="text-center">Issued Details</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                </table>
                <!--end: Datatable-->

            </div>
        </div>
        <!--end::Card-->

        {{-- Task Job Ticket Details Modal --}}
        <div class="modal inmodal fade" id="jobTicktDetailsModal">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content text-center ribbon ribbon-top mb-5">
                    <div class="ribbon-target bg-success h4" style="top: -2px; right: 20px;" id="job-ticket-status">Ongoing</div>
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center">Job Ticket Details</h5>
                    </div>
                    <div class="modal-body bg-gray-200">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card card-custom mb-5">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-around align-items-center">
                                            <h6 class="font-weight-light font-size-sm text-muted text-left">
                                                Job Ticket Number
                                            </h6>
                                            <h6 class="font-weight-bolder font-size-sm text-dark-65 text-right" id="job-allocation-code">
                                                JOB-20210720-01
                                            </h6>
                                        </div>
                                        <div class="row d-flex justify-content-around align-items-center">
                                            <h6 class="font-weight-light font-size-sm text-muted text-left">
                                                Issued by
                                            </h6>
                                            <h6 class="font-weight-bolder font-size-sm text-dark-65 text-right" id="job-allocation-issued-by">
                                                YOUTH/CSR/010
                                            </h6>
                                        </div>
                                        <div class="row d-flex justify-content-around align-items-center">
                                            <h6 class="font-weight-light font-size-sm text-muted text-left">
                                                Issued at
                                            </h6>
                                            <h6 class="font-weight-bolder font-size-sm text-dark-65 text-right" id="job-allocation-issued-at">
                                                YOUTH/CSR/010
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-custom mb-5 bg-light-warning">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-around align-items-center">
                                            <h6 class="font-weight-light font-size-sm text-warning text-left">
                                                Started at
                                            </h6>
                                            <h6 class="font-weight-bolder font-size-sm text-warning text-right" id="job-allocation-started-at">
                                                YOUTH/CSR/010
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-custom mb-5 bg-light-success">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-around align-items-center">
                                            <h6 class="font-weight-light font-size-sm text-success text-left">
                                                Completed at
                                            </h6>
                                            <h6 class="font-weight-bolder font-size-sm text-success text-right"  id="job-allocation-completed-at">
                                                YOUTH/CSR/010
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-custom mb-5 bg-light-danger">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-around align-items-center">
                                            <h6 class="font-weight-light font-size-sm text-danger text-left">
                                                Rejected at
                                            </h6>
                                            <h6 class="font-weight-bolder font-size-sm text-danger text-right"  id="job-allocation-rejected-at">
                                                YOUTH/CSR/010
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card card-custom mb-5">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-center align-items-center">
                                            <div class="col-lg-5">
                                                <h6 class="font-weight-light font-size-sm text-muted text-right">
                                                    Taskflow belongs to
                                                </h6>
                                            </div>
                                            <div class="col-lg-7">
                                                <h6 class="font-weight-bolder font-size-sm text-dark-65 text-left" id="job-taskflow-dep">
                                                    Youth Services Department
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center align-items-center">
                                            <div class="col-lg-5">
                                                <h6 class="font-weight-light font-size-sm text-muted text-right">
                                                    Taskflow Code
                                                </h6>
                                            </div>
                                            <div class="col-lg-7">
                                                <h6 class="font-weight-bolder font-size-sm text-dark-65 text-left" id="job-taskflow-code">
                                                    YOUTH/CSR/010
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center align-items-center">
                                            <div class="col-lg-5">
                                                <h6 class="font-weight-light font-size-sm text-muted text-right">
                                                    Taskflow Name
                                                </h6>
                                            </div>
                                            <div class="col-lg-7">
                                                <h6 class="font-weight-bolder font-size-sm text-dark-65 text-left" id="job-taskflow-name">
                                                    Providing Volleyball Nets
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-custom mb-5">
                                    <div class="card-body" id="taskDetailsContainer">
                                        
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-2">
                                <div class="card card-custom mb-5">
                                    <div class="card-body" id="jobEffIndicator">
                                        <div class="row d-flex justify-content-center align-items-center" >
                                            <div class="symbol symbol-40 symbol-light-danger flex-shrink-0">
                                                <span class="symbol-label font-size-h4 font-weight-bold">
                                                    <i class="far fa-clock text-danger icon-md"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center align-items-center">
                                            <div class="ml-4">
                                                <div class="text-danger font-weight-bolder font-size-lg mb-2">Overdue</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="reject_task_btn" onclick="rejectTask()">
                            <i class="fas fa-external-link-alt"></i> Reject Task 
                        </button>
                        <button type="button" class="btn btn-light btn_close" data-dismiss="modal">
                            <i class="fa fa-times-circle"></i> Close 
                        </button>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('scripts')
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" defer></script>
<script>
    $(document).ready(function(){
        drawDepartmentListTable()
    });

    async function drawDepartmentListTable(){
        let retrivedTblData = await $.ajax(
        {
            url:'{{ route('fetchJobTicketsToDrawTbl')}}',
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
        initializeDepartmentsTbl(retrivedTblData);

    }

    function initializeDepartmentsTbl(retrivedTblData){
        $('#job_ticket_list_table').DataTable({
            pageLength: 10,
            destroy: true,
            retrieve: false,
            order: [
                [0, 'asc']
            ],
            data: retrivedTblData.data,
            columns: [
				{data: 'jobNumDetails',className: 'text-center'},
				{data: 'customerDetails',className: 'text-center'},
				{data: 'taskflowDetails',className: 'text-center'},
				{data: 'progress',className: 'text-center'},
				{data: 'issuedDetails',className: 'text-center'},
				{data: 'status',className: 'text-center'},
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
                        let output = '';

                        output += `<div class="btn btn-icon w-auto px-5 btn-clean font-weight-bold font-size-lg text-dark-65 mb-0" onclick="showJobTicketDetailsModal(${data.id})"> ${data.num}</div>`;
                        
                        return output;
                    },
                },
                {
                    targets: 1,
                    render: function(data, type, full, meta) {
                        let output = '';

                        output += `<div class="font-weight-bold font-size-lg text-primary mb-0"> ${data.name}</div>`;
                        output += `<div class="font-weight-normal text-dark-50"><i class="fas fa-phone-alt icon-nm"></i></i> ${data.contact}</div>`;
                        
                        return output;
                    },
                },
                {
                    targets: 2,
                    render: function(data, type, full, meta) {
                        let output = '';
                        
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
                            <div class="symbol symbol-40 symbol-light-${state} flex-shrink-0">
                                <span class="symbol-label font-size-h4 font-weight-bold">${data.name.substring(0, 1)}</span>
                            </div>
                            <div class="ml-4">
                                <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">${data.name}</div>
                                <a href="#" class="text-muted font-weight-bold text-hover-primary">${data.code}</a>
                            </div>
                        </div>`;
                       
                        return output;
                    },
                    
                },
                {
                    targets: 2,
                    render: function(data, type, full, meta) {
                        let createdDate = moment(data.createdAt,'YYYY-MM-DDTHH:mm:ss').format('YYYY-MM-DD')
                        let createdTime = moment(data.createdAt,'YYYY-MM-DDTHH:mm:ss').format('hh:mm A')
                        let output = '';
                        output += '<div class="font-weight-bolder text-primary mb-0">' + createdDate +' @ ' + createdTime + '</div>';
                        output += '<div class="text-muted"> Created by - ' + data.createdBy + '</div>';
                        
                        return output;
                    },
                },
                {
                    targets: 3,
                    render: function(data, type, full, meta) {
                        let output = '';

                        let progress = Number.parseFloat(data.progress).toFixed(0);
                        let state = getProgressColor(progress);
                        output += `
                        <div class="h6">${data.completed}/${data.total}</div>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar  bg-${state}" role="progressbar" style="width: ${progress}%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                ${progress}%
                            </div>
                        </div>`;
                        
                        return output;
                    },
                },
                {
                    targets: 4,
                    render: function(data, type, full, meta) {
                        let updated = moment(data.issuedAt).zone("+05:30");
                        let issuedDate = updated.format('YYYY-MM-DD')
                        let issuedTime = updated.format('hh:mm A')
                        let output = '';
                        output += '<div class="font-weight-bolder text-info mb-0">' + issuedDate +' @ ' + issuedTime + '</div>';
                        output += '<div class="text-muted"> Updated by - ' + data.issuedBy + '</div>';
                        
                        return output;
                    },
                },
                {
                    targets: 5,
                    render: function(data, type, full, meta) {
                        var status = {
                            'ISSUED': {
                                'title': 'Issued',
                                'state': 'warning',
                                
                            },
                            'ONG': {
                                'title': 'Ongoing',
                                'state': 'primary',
                               
                            },
                            'COMP': {
                                'title': 'Completed',
                                'state': 'success',
                               
                            },
                            'REJECT': {
                                'title': 'Rejected',
                                'state': 'danger',
                               
                            },
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="label label-' + status[data].state + ' label-dot mr-2"></span>' +
                            '<span class="font-weight-bold text-' + status[data].state + '">' + status[data].title + '</span>';
                    },
                },
                
            ],

        });
    }

    async function showJobTicketDetailsModal(jobTicketId){
        $('.appendedTaskkDetails').remove();
        var formData = new FormData();
        formData.append('jobTicketId', jobTicketId);

        let jobTicketDetails = await $.ajax(
        {
            url:"{{ route('fetchJobTicketDetails')}}", 
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
        let {jobDetails,issuedByName,departName,taskDetials} = jobTicketDetails;
        arrangeJobIssueDetails(jobDetails,issuedByName,departName);
        // console.log(taskDetials);
        renderTaskDetails(taskDetials.data);
        $('#jobTicktDetailsModal').modal('show')
    }


    function arrangeJobIssueDetails(jobTicketObj,issuedByName,departName){
        renderStatus(jobTicketObj.job_ticket_status);

        $('#job-allocation-code').html(jobTicketObj.job_allocation_no)
        $('#job-allocation-issued-by').html(issuedByName)
        $('#job-allocation-issued-at').html(arrangeTimesForView(jobTicketObj.job_allocation_created_at))

        if(jobTicketObj.job_ticket_started_at == null){
            $('#job-allocation-started-at').html('Not Started Yet')
        }else{
            $('#job-allocation-started-at').html(arrangeTimesForView(jobTicketObj.job_ticket_started_at))
        }
        
        if(jobTicketObj.job_ticket_completed_at == null){
            $('#job-allocation-completed-at').html('Not Completed Yet')
        }else{
            $('#job-allocation-completed-at').html(arrangeTimesForView(jobTicketObj.job_ticket_completed_at))
        }
        
        if(jobTicketObj.job_ticket_rejected_at == null){
            $('#job-allocation-rejected-at').html('Not rejected')
        }else{
            $('#job-allocation-rejected-at').html(arrangeTimesForView(jobTicketObj.job_ticket_rejected_at))
        }

        $('#job-taskflow-dep').html(departName)
        $('#job-taskflow-code').html(jobTicketObj.task_flow_code)
        $('#job-taskflow-name').html(jobTicketObj.task_flow_name)

    }

    function arrangeTimesForView(timeVal){
        
        let arranged = moment(timeVal).zone("+05:30");
        let viewingDate = arranged.format('YYYY-MM-DD')
        let viewingTime = arranged.format('hh:mm A')
        let viewingString = `on ${viewingDate} at ${viewingTime}`;
        return viewingString;
    }

    function renderStatus(statusVal){
        switch (statusVal) {
            case "ISSUED":
                $('#job-ticket-status').html('PENDING')
                $('#job-ticket-status').addClass('bg-warning')
                $('#job-ticket-status').removeClass('bg-success bg-danger bg-primary')
                break;
            case "ONG":
                $('#job-ticket-status').html('ONGOING')
                $('#job-ticket-status').addClass('bg-primary')
                $('#job-ticket-status').removeClass('bg-success bg-danger bg-warning')
                break;
            case "COMP":
                $('#job-ticket-status').html('COMPLETED')
                $('#job-ticket-status').addClass('bg-success')
                $('#job-ticket-status').removeClass('bg-primary bg-danger bg-warning')
                break;
            case "REJECT":
                $('#job-ticket-status').html('REJECTED')
                $('#job-ticket-status').addClass('bg-danger')
                $('#job-ticket-status').removeClass('bg-primary bg-success bg-warning')
                break;
        
            default:
                break;
        }
    }

    function getTaskStatusColor(status){

        switch (status) {
            case 'COMP':
                return {
                    color :'success',
                    wording :'Completed',
                }
                break;
            case 'AVAI':
                return {
                    color :'warning',
                    wording :'Available',
                }
                break;
            case 'ONG':
                return {
                    color :'primary',
                    wording :'Ongoing',
                }
                break;
            case 'ABN':
                return {
                    color :'dark',
                    wording :'Abandoned',
                }
                break;
            case 'REJECT':
                return {
                    color :'danger',
                    wording :'Rejected',
                }
                break;
            case 'PND':
                return {
                    color :'info',
                    wording :'Pending',
                }
                break;
        
            default:
                break;
        }
    }

    function renderTaskDuration(taskTimeObj,status){

        let output = '';
        if(status != 'COMP'){
            output = taskTimeObj;
            return output;
        }else{
            output += (taskTimeObj.days != 0) ? `${taskTimeObj.days} days` : '';
            output += (taskTimeObj.hours != 0) ? ` ${taskTimeObj.hours} hours` : '';
            output += (taskTimeObj.mins != 0) ? ` ${taskTimeObj.mins} mins` : '';

            return output;

        }

    }

    function renderTaskDetails(taskArr){
        for(let task of  taskArr){
            // console.log(task);
            renderSingleTask(task);
        }
    }

    function renderSingleTask(task){

        let statusObj = getTaskStatusColor(task.status);

        let output = '';

        
        output += `  
        <div class="accordion accordion-toggle-arrow appendedTaskkDetails mt-4" id="accordionExample${task.taskId}">
            <div class="card">`

        //heade of accordian

        output += `
                <div class="card-header">
                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse${task.taskId}">
                        <div class="symbol symbol-dark symbol-30 mr-3">
                            <span class="symbol-label font-size-h5">${task.taskStep}</span>
                        </div>
                        ${task.taskName}  
                        <span class="label label-light-${statusObj.color} label-lg label-inline ml-5 mr-5"> ${statusObj.wording}</span>
                        <span class="label label-${statusObj.color} label-lg label-inline mr-5">${statusObj.wording}</span>
                    </div>
                </div>`

        //accoridan body
        output += `
                <div id="collapse${task.taskId}" class="collapse" data-parent="#accordionExample${task.taskId}">
                    <div class="card-body"> `

        let taskDurationString = renderTaskDuration(task.timeTaken,task.status);
        //1st row
        output += `
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-6 border-right">
                                <div class="row d-flex justify-content-around align-items-center">
                                    <h6 class="font-weight-normal font-size-sm text-muted text-right">
                                        Alllocated Time
                                    </h6>
                                    <h6 class="font-weight-bolder font-size-sm text-dark-65 text-left">
                                       ${task.taskAllocatedTime.value} ${task.taskAllocatedTime.type}
                                    </h6>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row d-flex justify-content-around align-items-center">
                                    <h6 class="font-weight-light font-size-sm text-muted text-right">
                                        Task Duration 
                                    </h6>
                                    <h6 class="font-weight-bolder font-size-sm text-dark-65 text-left">
                                        ${taskDurationString}
                                    </h6>
                                </div>
                            </div>
                        </div>`

        let tasktaken = (task.taskTakenBy == null) ? 'No One' : task.taskTakenBy;
        output += `
                        <div class="row d-flex justify-content-center mt-5">
                            <div class="col-lg-6 border-right">
                                <div class="row d-flex justify-content-around align-items-center">
                                    <h6 class="font-weight-normal font-size-sm text-muted text-center">
                                        Responsible Designation
                                    </h6>
                                </div>
                                <div class="row d-flex justify-content-around align-items-center mt-3">
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">${task.taskAssignee}</div>
                                            <a href="#" class="text-muted font-weight-bold text-hover-primary">${task.designationCode}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row d-flex justify-content-around align-items-center">
                                    <h6 class="font-weight-normal font-size-sm text-muted text-center">
                                        Task taken by
                                    </h6>
                                </div>
                                <div class="row d-flex justify-content-around align-items-center mt-3">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40 symbol-light-success flex-shrink-0">
                                            <span class="symbol-label font-size-h4 font-weight-bold">${tasktaken.substring(0, 1)}</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">${tasktaken}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`

        let available = (task.avilableAt == null) ? '' : arrangeTimesForView(task.avilableAt);
        let taken     = (task.takenAt == null) ? '' : arrangeTimesForView(task.takenAt);
        let completed = (task.completedAt == null) ? '' : arrangeTimesForView(task.completedAt);
        let rejected  = (task.rejectedAt == null) ? '' : arrangeTimesForView(task.rejectedAt);

        output += `
                        <div class="row d-flex justify-content-around mt-5">
                            <div class="col-lg-8">
                                <div class="row d-flex justify-content-around align-items-center">
                                    <div class="col-lg-6">
                                        <h6 class="font-weight-normal font-size-sm text-dark-50 text-right">
                                            Task available at 
                                        </h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <h6 class="font-weight-bolder font-size-sm text-dark-65 text-left">
                                            ${available}
                                        </h6>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-around align-items-center">
                                    <div class="col-lg-6">
                                        <h6 class="font-weight-normal font-size-sm text-dark-50 text-right">
                                            Task taken at 
                                        </h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <h6 class="font-weight-bolder font-size-sm text-dark-65 text-left">
                                            ${taken}
                                        </h6>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-around align-items-center">
                                    <div class="col-lg-6">
                                        <h6 class="font-weight-normal font-size-sm text-dark-50 text-right">
                                            Task completed at 
                                        </h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <h6 class="font-weight-bolder font-size-sm text-dark-65 text-left">
                                            ${completed}
                                        </h6>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-around align-items-center">
                                    <div class="col-lg-6">
                                        <h6 class="font-weight-normal font-size-sm text-dark-50 text-right">
                                            Task rejected at 
                                        </h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <h6 class="font-weight-bolder font-size-sm text-dark-65 text-left">
                                            ${rejected}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>`
        
        output += `
                    </div>
                </div>
            </div>
        </div>`;
        
        $('#taskDetailsContainer').append(output);
        

    }

    function getProgressColor(progressValue){
        if(progressValue <= 30){
            return 'danger'
        }else if(progressValue < 50){
            return 'warning'
        }else if(progressValue < 85){
            return 'primary'
        }else{
            return 'success'
        }
    }

</script>
@endsection