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

                        output += `<div class="font-weight-bold font-size-lg text-dark-65 mb-0"> ${data.num}</div>`;
                        
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