{{-- Extends layout --}}
@extends('layout.default')

@section('content')
<form method="POST" id="new-grant-permission-form" action="{{ route('grantPermission') }}" enctype="multipart/form-data">
    @csrf
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label"> Authorize Actions
                    <span class="d-block text-muted pt-2 font-size-sm">Authorize different User Types by giving permissions</span>
                </h3>
            </div>
            <div class="card-toolbar">
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
                    </span>Grant Permission
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row d-flex justify-content-start">
                <div class="col-lg-3 form-group">
                    <label class="form-label col-form-label">User Type<span class="text-danger">*</span></label>
                    <select class="form-control form-control-lg dynamic mt-2 selectpicker @error('user_type_select') is-invalid @enderror" name="user_type_select" id="user_type_select" data-dependent="user_type_select" data-size="7" data-live-search="true">
                        <option value="">Select a User type</option>
                        @foreach ($userTypes as $userType )
                        <option value="{{ $userType->id }}">{{ $userType->name }}</option>   
                        @endforeach
                    </select>
                    @error('user_type_select')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-lg-3 form-group">
                    <label class="form-label col-form-label">Permission<span class="text-danger">*</span></label>
                    <select class="form-control form-control-lg dynamic mt-2 selectpicker @error('user_type_select') is-invalid @enderror" name="permission_select" id="permission_select" data-dependent="permission_select" data-size="7" data-live-search="true">
                        <option value="">Select a Permission</option>
                        @foreach ($permissions as $permission )
                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>   
                        @endforeach
                    </select>
                    @error('permission_select')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-lg-6">
                    <table class="table table-separate table-head-custom collapsed" id="roles_permissions_list_table">
                        <thead>
                            <tr>
                                <th class="text-center">User Type</th>
                                <th class="text-center">Permission</th>
                                <th class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>
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
        document.getElementById('new-grant-permission-form'), {
                fields: {
                    user_type_select: {
                        validators: {
                            notEmpty: {
                                message: 'Please select a User Type'
                            },

                        }
                    },
                    permission_select: {
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
                    // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    //Sri Lankan Phone Number

                }
            }
        ).on('core.form.valid', function(){
            let formData = new FormData();

            formData.append('user_type_select', user_type_select);
            formData.append('permission_select',permission_select );

            $.ajax(
            {
                url:"{{ route('grantPermission')}}",
                method:"POST",
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                data: formData,
                cache : false,
                processData: false,
                contentType: false,
                dataType:'json',
                success:function(data)
                {
                    $('#user_type_select').val('');
                    $('#user_type_select').selectpicker('refresh');
                    $('#permission_select').val('');
                    $('#permission_select').selectpicker('refresh');
                    if (!$.isEmptyObject(data)) 
                    {
                        if(data.status){
                            toastr.success(data.msg, data.title);
                        }else{
                            toastr.error(data.msg, data.title);
                        }
                    }
                    drawRolesPermissionsListTable()
                }
            });  
            

        });

        $(document).ready(function(){
            $('#user_type_select, #permission_select').selectpicker();
            drawRolesPermissionsListTable()
        });

        async function drawRolesPermissionsListTable(){
            let retrivedTblData = await $.ajax(
            {
                url:'{{ route('fetchRolesPermissionsToDrawTbl')}}',
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

            initializeRolesPermissionsTbl(retrivedTblData);

        }

        function initializeRolesPermissionsTbl(retrivedTblData){
            $('#roles_permissions_list_table').DataTable({
                pageLength: 25,
                destroy: true,
                retrieve: false,
                order: [
                    [0, 'desc']
                ],
                data: retrivedTblData.data,
                drawCallback: function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;

                    api.column(0, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<tr class="group"><td colspan="3" class="font-weight-bolder text-primary text-center">' + group + '</td></tr>',
                            );
                            last = group;
                        }
                    });
                },
                columns: [
                    {data: 'userTypeName',className: 'text-center'},
                    {data: 'permissionName',className: 'text-center'},
                    {data: 'deleteIds',className: 'text-center'},
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
                        visible: false,
                    },
                    {
                    
                        targets: 1,
                        // width: '25px',
                        render: function(data, type, full, meta) {
                            let output = '';
                            
                            output = `<div class="d-flex align-items-center justify-content-center">
                                <div class="ml-4">
                                    <div class="text-dark-65 font-weight-normal font-size-lg mb-0">${data}</div>
                                </div>
                            </div>`;
                        
                            return output;
                        },
                        
                    },
                    {
                        // width: '100px',
                        targets: 2,
                        render: function(data, type, full, meta) {

                           let userTypeId = data.userTypeId ;
                           let permissionId = data.permissionId ;

                            return `<a type="button"  onclick="revokePermission(${userTypeId}, ${permissionId})" class="btn btn-sm btn-clean btn-icon mr-2" >
                                        <span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>
                                                    <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
                                                </g>
                                            </svg><!--end::Svg Icon-->
                                        </span>
                                    </a>`;
                        },
                    },
                ],

            }); 
        }

        function revokePermission(userTypeId,permissionId){
            let formData = new FormData();

            formData.append('userTypeId', userTypeId);
            formData.append('permissionId',permissionId );

            Swal.fire({
                title: "Do you want to Revoke the permission?",
                text: "This will affect to the Access & Permissions of all the users of selected User type",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes!"
            }).then(function(result) {
                
                if (result.value) {
                    $.ajax(
                    {
                        url:"{{ route('revokePermission')}}", 
                        method:"POST",
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        data: formData,
                        cache : false,
                        processData: false,
                        contentType: false,
                        dataType:'json',
                        success:function(data)
                        {
                            if(data.status){
                                toastr.success(data.msg, data.title);
                            }
                            else{
                                toastr.error( data.msg,data.title);
                            }
                            
                            drawRolesPermissionsListTable();
                        }
                    }); 
                    
                }
            });
        }

    </script>
@endsection