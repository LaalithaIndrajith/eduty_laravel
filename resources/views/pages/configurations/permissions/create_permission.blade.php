{{-- Extends layout --}}
@extends('layout.default')

@section('content')
    
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label"> Permission Creation
                        <span class="d-block text-muted pt-2 font-size-sm">Permission creation for Access permissions</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                   
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-12 border-right">
                        <form method="POST" id="add-new-permission-form" action="{{ route('createPermission') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row d-flex justify-content-start">
                             <div class="col-lg-8 form-group">
                                 <label class="form-label col-form-label">Permission<span class="text-danger">*</span></label>
                                 <input id="permission_name" type="text" class="form-control @error('permission_name') is-invalid @enderror" placeholder="Enter a namer for User type" name="permission_name" />
                                 @error('user_type_name')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                             </div>
                            
                         </div>
                         <div class="row d-flex justify-content-start">
                            <div class="col-lg-8 form-group">
                                <!--begin::Button-->
                                <label class="form-label col-form-label"></label>
                                <button type="submit" class="btn btn-primary font-weight-bolder">
                                    <span class="svg-icon svg-icon-md">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g id="Stockholm-icons-/-General-/-Save" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon id="Shape" points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M17,4 L6,4 C4.79111111,4 4,4.7 4,6 L4,18 C4,19.3 4.79111111,20 6,20 L18,20 C19.2,20 20,19.3 20,18 L20,7.20710678 C20,7.07449854 19.9473216,6.94732158 19.8535534,6.85355339 L17,4 Z M17,11 L7,11 L7,4 L17,4 L17,11 Z" id="Shape" fill="#000000" fill-rule="nonzero"></path>
                                                <rect id="Rectangle-16" fill="#000000" opacity="0.3" x="12" y="4" width="3" height="5" rx="0.5"></rect>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>Create Permission
                                </button>
                                <!--end::Button-->
                             </div>
                         </div>
                        </form>
                    </div>
                    <div class="col-lg-7 col-12 pl-10">
                     <table class="table table-separate table-head-custom collapsed" id="permission_list_table">
                         <thead>
                             <tr>
                                 <th class="text-center">Permission</th>
                                 <th class="text-center">Created At</th>
                                 <th class="text-center">Last Modified</th>
                                 <th class="text-center">Action</th>
                             </tr>
                         </thead>
                         <tbody>
                            
                         </tbody>
                     </table>
                    </div>
                </div>

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
        FormValidation.formValidation(
        document.getElementById('add-new-permission-form'), {
                fields: {
                    permission_name: {
                        validators: {
                            notEmpty: {
                                message: 'Permission name is required'
                            },

                        }
                    },
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                    // Validate fields when clicking the Submit button
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    // Submit the form when all fields are valid
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    //Sri Lankan Phone Number

                }
            }
        );

        $(document).ready(function(){
            drawPermissionListTable()
        });

        let permissionCreationEvent = <?php 
            if(session()->has('permissionCreation')){
                echo json_encode(session()->get('permissionCreation'));   
            }else{
                echo json_encode('');
            } 
            ?>;

        let permissionEditEvent = <?php 
        if(session()->has('permissionEdit')){
            echo json_encode(session()->get('permissionEdit'));   
        }else{
            echo json_encode('');
        } 
        ?>;

        (permissionCreationEvent != '') ? loadToaster(permissionCreationEvent) : ''
        (permissionEditEvent != '') ? loadToaster(permissionEditEvent) : ''


        async function drawPermissionListTable(){
            let retrivedTblData = await $.ajax(
            {
                url:'{{ route('fetchPermissionsToDrawTbl')}}',
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

            initializePermissionsTbl(retrivedTblData);

        }

        function initializePermissionsTbl(retrivedTblData){
            $('#permission_list_table').DataTable({
                pageLength: 25,
                destroy: true,
                retrieve: false,
                order: [
                    [1, 'desc']
                ],
                data: retrivedTblData.data,
                columns: [
                    {data: 'permissionName',className: 'text-center'},
                    {data: 'createdAt',className: 'text-center'},
                    {data: 'updatedAt',className: 'text-center'},
                    {data: 'id',className: 'text-center'},
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
                            
                            output = `<div class="d-flex align-items-center">
                                <div class="ml-4">
                                    <div class="text-dark-65 font-weight-normal font-size-lg mb-0">${data}</div>
                                </div>
                            </div>`;
                        
                            return output;
                        },
                        
                    },
                    {
                        targets: 1,
                        render: function(data, type, full, meta) {
                            let createdDate = moment(data,'YYYY-MM-DDTHH:mm:ss').format('YYYY-MM-DD')
                            let createdTime = moment(data,'YYYY-MM-DDTHH:mm:ss').format('hh:mm A')
                            let output = '';
                            output += '<div class="font-weight-bolder text-primary mb-0">' + createdDate +' @ ' + createdTime + '</div>';
                            return output;
                        },
                    },
                    {
                        targets: 2,
                        render: function(data, type, full, meta) {
                            let updatedDate = moment(data,'YYYY-MM-DDTHH:mm:ss').format('YYYY-MM-DD')
                            let updatedTime = moment(data,'YYYY-MM-DDTHH:mm:ss').format('hh:mm A')
                            let output = '';
                            output += '<div class="font-weight-bolder text-info mb-0">' + updatedDate +' @ ' + updatedTime + '</div>';
                            return output;
                        },
                    },
                    {
                        // width: '100px',
                        targets: 3,
                        render: function(data, type, full, meta) {
                            return `<a href="/viewPermission/${data}/edit" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">
                                        <span class="svg-icon svg-icon-md">
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
                                    </a>`;
                        },
                    },
                ],

            }); 
        }

        function loadToaster(event){
            const { msg , status, title} = event
            if(msg != null && typeof(msg) == 'string'){
                switch (status) {
                case 1:
                    toastr.success(msg,title)
                    break;
                case 0:
                    toastr.error(msg,title)
                    break;
                default:
                    console.error(`Something is wrong during the toaster view`)
                }
            }
        }

    </script>
@endsection