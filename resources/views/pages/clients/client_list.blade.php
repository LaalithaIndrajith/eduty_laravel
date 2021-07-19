{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- User List--}}

        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Customers List
                        <span class="d-block text-muted pt-2 font-size-sm">Details of Customers</span>
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
                    <a href="{{ route('clientRegisterView') }}" class="btn btn-primary font-weight-bolder">
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
                        </span>Register Customer</a>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom collapsed" id="department_list_table">
                    <thead>
                        <tr>
                            <th class="text-center">Customer</th>
                            <th class="text-center">Contact</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Last Modified</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
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
        drawClientListTable()
    });

    async function drawClientListTable(){
        let retrivedTblData = await $.ajax(
        {
            url:'{{ route('fetchClientsToDrawTbl')}}',
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
        initializeClientsTbl(retrivedTblData);

    }

    function initializeClientsTbl(retrivedTblData){
        $('#department_list_table').DataTable({
            pageLength: 10,
            destroy: true,
            retrieve: false,
            order: [
                [0, 'asc']
            ],
            data: retrivedTblData.data,
            columns: [
				{data: 'clientDetails',className: 'text-center'},
				{data: 'contactDetails',className: 'text-center'},
				{data: 'createdDetails',className: 'text-center'},
				{data: 'lastModifiesDetails',className: 'text-center'},
				{data: 'status',className: 'text-center'},
				{data: 'clientId',className: 'text-center'},
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
            columnDefs: [{
                    targets: 0,
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
                                <a href="#" class="text-muted font-weight-bold text-hover-primary">${data.nic}</a>
                            </div>
                        </div>`;
                       
                        return output;
                    },
                    
                },
                {
                    targets: 1,
                    render: function(data, type, full, meta) {
                        let output = '';
                        if(data.email == ''){
                            output += `<div class="font-weight-normal text-primary mb-0"> <i class="far fa-envelope icon-nm"></i> Not provided </div>`;
                        }else{
                            output += `<div class="font-weight-normal text-primary mb-0"> <i class="far fa-envelope icon-nm"></i> ${data.email}</div>`; 
                        }
                        output += `<div class="font-weight-normal text-dark-50"><i class="fas fa-phone-alt icon-nm"></i></i> ${data.telephone}</div>`;
                        
                        return output;
                    },
                },
                {
                    targets: 2,
                    render: function(data, type, full, meta) {
                        let updated = moment(data.createdAt).zone("+05:30");
                        let createdDate = updated.format('YYYY-MM-DD')
                        let createdTime = updated.format('hh:mm A')
                        // let createdDate = moment(data.createdAt,'YYYY-MM-DDTHH:mm:ss').format('YYYY-MM-DD')
                        // let createdTime = moment(data.createdAt,'YYYY-MM-DDTHH:mm:ss').format('hh:mm A')
                        let output = '';
                        output += '<div class="font-weight-bolder text-primary mb-0">' + createdDate +' @ ' + createdTime + '</div>';
                        output += '<div class="text-muted"> Created by - ' + data.createdBy + '</div>';
                        
                        return output;
                    },
                },
                {
                    targets: 3,
                    render: function(data, type, full, meta) {
                        let updated = moment(data.updatedAt).zone("+05:30");
                        let updatedDate = updated.format('YYYY-MM-DD')
                        let updatedTime = updated.format('hh:mm A')
                        // let updatedDate = moment(data.updatedAt,'YYYY-MM-DDTHH:mm:ss').format('YYYY-MM-DD')
                        // let updatedTime = moment(data.updatedAt,'YYYY-MM-DDTHH:mm:ss').format('hh:mm A')
                        let output = '';
                        output += '<div class="font-weight-bolder text-info mb-0">' + updatedDate +' @ ' + updatedTime + '</div>';
                        output += '<div class="text-muted"> Updated by - ' + data.updatedBy + '</div>';
                        
                        return output;
                    },
                },
                {
                    targets: 4,
                    render: function(data, type, full, meta) {
                        var status = {
                            0: {
                                'title': 'Deleted',
                                'state': 'warning',
                                
                            },
                            1: {
                                'title': 'Active',
                                'state': 'success',
                               
                            },
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="label label-' + status[data].state + ' label-dot mr-2"></span>' +
                            '<span class="font-weight-bold text-' + status[data].state + '">' + status[data].title + '</span>';
                    },
                },
                {
                    // width: '100px',
                    targets: 5,
                    render: function(data, type, full, meta) {

                        if(full.status == '0'){
                          return `
                                <a class="btn btn-sm btn-light-danger" disabled="disabled">
                                    Deleted form the System
                                </a>
                          `  ;
                        }else{
                            return `<a href="/viewClient/${data}/edit" class="btn btn-sm btn-default btn-icon mr-2 btn-hover-info" title="Edit details">
                                        <span class="svg-icon svg-icon-info svg-icon-2x">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" 
                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 
                                                    L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,
                                                    4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,
                                                    19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" 
                                                    fill="#000000" fill-rule="nonzero" \ transform="translate(12.000000, 10.707409) rotate(-135.000000) 
                                                    translate(-12.000000, -10.707409) " />
                                                    <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1" />
                                                </g>
                                            </svg>
                                        </span>
                                    </a>
                                    <a onclick="deleteClient(${data})" class="btn btn-sm btn-default btn-text-primary btn-hover-danger btn-icon" title="Delete">
                                        <span class="svg-icon svg-icon-danger svg-icon-2x">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>
                                                    <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
                                                </g>
                                            </svg>
                                        </span>
                                    </a>
                                    `;

                        }
                    },
                },
            ],

        });
    }

    async function deleteClient(clientId){
        var formData = new FormData();
        formData.append('clientId', clientId);
        Swal.fire({
                title: "Do you want to delete this Customer?",
                text: "This action will delete the selected Customer permanantly from the system",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Delete!"
            }).then(function(result) {
                
                if (result.value) {
                    $.ajax(
                    {
                        url:"{{ route('deleteClient')}}", 
                        method:"POST",
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', },
                        data:formData,
                        cache : false,
                        processData: false,
                        contentType: false,
                        dataType:'json',
                        success:async function(data)
                        {
                            if(data.status ){
                                await toastr.success(data.msg,data.title);
                                drawClientListTable();
                            }
                            else{
                                toastr.error(data.msg,data.title);
                            }
                        }
                    }); 
                
                }
            });
    }
</script>
@endsection