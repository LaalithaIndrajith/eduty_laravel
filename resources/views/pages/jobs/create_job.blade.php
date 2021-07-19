{{-- Extends layout --}}
@extends('layout.default')

@section('content')
<form method="POST" id="new-job-ticket-form" enctype="multipart/form-data">
    @csrf
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label"> Issue Job Ticket Actions
                    <span class="d-block text-muted pt-2 font-size-sm">Issue job tickets to the system</span>
                </h3>
            </div>
            <div class="card-toolbar">
                <button type="button" class="btn btn-primary font-weight-bolder" onclick="issueJobTicket()">
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
                    </span>Issue Job Ticket
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row d-flex justify-content-start">
                <div class="col-lg-6 border-right pr-10">
                    <div class="row d-flex justify-content-start">
                        <div class="col-lg-6 form-group">
                            <label class="form-label col-form-label">Job Ticket Number</span></label>
                            <input id="job_allocation_no" type="text" class="form-control form-control-solid @error('client_nic') is-invalid @enderror" readonly name="job_allocation_no" value="{{ $jobNum }}" />
                        </div>
                    </div>
                    <div class="row d-flex justify-content-around">
                        <div class="col-lg-6 form-group">
                           <label class="form-label col-form-label">Customer<span class="text-danger">*</span></label>
                           <select class="form-control form-control-lg dynamic mt-2 selectpicker @error('customer_select') is-invalid @enderror" name="customer_select" id="customer_select" data-dependent="customer_select" data-size="7" data-live-search="true">
                               <option value="">Select a Customer</option>
                               @foreach ($data['customers'] as $customer )
                               <option value="{{ $customer->client_id }}">{{ $customer->client_nic }} | {{ $customer->client_fname }} {{ $customer->client_lname }}</option>   
                               @endforeach
                           </select>
                           @error('customer_select')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                        </div>
                        <div class="col-lg-6 form-group">
                            <label class="form-label col-form-label">Taskflow<span class="text-danger">*</span></label>
                            <select class="form-control form-control-lg dynamic mt-2 selectpicker @error('user_type_select') is-invalid @enderror" name="taskflow_select" id="taskflow_select" data-dependent="taskflow_select" data-size="7" data-live-search="true">
                               <option value="">Select a Taskflow</option>
                               @foreach ($data['taskflows'] as $taskflow)
                               <option value="{{ $taskflow->taskflow_id }}">{{ $taskflow->task_flow_name }}</option>   
                               @endforeach
                            </select>
                            @error('taskflow_select')
                                <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row bg-gray-300" id="taskflowDetails">
                        
                    </div> 
                </div>
                <div class="col-lg-6">
                    <div class="row d-flex justify-content-center">
                        <h5 class="font-weight-bold text-center">Customer Information</h5>
                    </div>
                    <div class="form-group row d-flex justify-content-center mt-10">
                        <label  class="col-4 col-form-label text-right">Customer Name :</label>
                        <div class="col-6">
                            <input class="form-control form-control-solid" readonly value="" id="customerName"/>
                        </div>
                    </div>
                    <div class="form-group row d-flex justify-content-center mt-5">
                        <label class="col-4 col-form-label text-right">NIC :</label>
                        <div class="col-6">
                            <input class="form-control form-control-solid" readonly value="" id="customerNic"/>
                        </div>
                    </div>
                    <div class="form-group row d-flex justify-content-center mt-5">
                        <label class="col-4 col-form-label text-right">Telephone :</label>
                        <div class="col-6">
                            <input class="form-control form-control-solid" readonly value="" id="customerTelephone"/>
                        </div>
                    </div>
                    <div class="form-group row d-flex justify-content-center mt-5">
                        <label class="col-4 col-form-label text-right">Email :</label>
                        <div class="col-6">
                            <input class="form-control form-control-solid" readonly value="" id="customerEmail"/>
                        </div>
                    </div>
                    <div class="form-group row d-flex justify-content-center mt-5">
                        <label class="col-4 col-form-label text-right">Address :</label>
                        <div class="col-6">
                            <textarea class="form-control form-control-solid" readonly type="text" id="customerAddress" rows="5"></textarea>
                        </div>
                    </div>
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
        // FormValidation.formValidation(
        // document.getElementById('new-grant-permission-form'), {
        //         fields: {
        //             customer_select: {
        //                 validators: {
        //                     notEmpty: {
        //                         message: 'Customer is required'
        //                     },

        //                 }
        //             },
        //             taskflow_select: {
        //                 validators: {
        //                     notEmpty: {
        //                         message: 'Pleas select a taskflow'
        //                     },

        //                 }
        //             },
        //         },

        //         plugins: {
        //             trigger: new FormValidation.plugins.Trigger(),
        //             // Bootstrap Framework Integration
        //             bootstrap: new FormValidation.plugins.Bootstrap(),
        //             // Validate fields when clicking the Submit button
        //             submitButton: new FormValidation.plugins.SubmitButton(),
        //             // Submit the form when all fields are valid
        //             defaultSubmit: new FormValidation.plugins.DefaultSubmit(),

        //         }
        //     }
        // ); 
        
        document.querySelector('#customer_select').addEventListener('change', function() {
            resetCustInfo()
            let customerId = this.value;
            (customerId != '') ? showCustomerDetails(customerId) : '' ;
            
        });
        
        document.querySelector('#taskflow_select').addEventListener('change', function() {
            $('#appendedTaskflow').remove();
            let taskflowId = this.value;
            (taskflowId != '') ? showTaskflowDetails(taskflowId) : '' ;
            
        });

        function issueJobTicket(){
            var formData = new FormData();

            let jobAllocationNo = $('#job_allocation_no').val()
            let taskflowId      = $('#taskflow_select').val()
            let customerId      = $('#customer_select').val()

            formData.append('job_allocation_no', jobAllocationNo);
            formData.append('taskflow_select', taskflowId);
            formData.append('customer_select', customerId);

            Swal.fire({
                title: "Do you want to issue the Job ticket?",
                text: "This action will issue job ticket for the system",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Issue Job Ticket!"
            }).then(function(result) {
                
                if (result.value) {
                    $.ajax(
                    {
                        url:"{{ route('issueJobTicket')}}", 
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
                                resetCustInfo();
                                location.reload();
                            }
                            else{
                                await toastr.error(data.msg,data.title);
                                location.reload();
                            }
                        }
                    }); 
                
                }
            });
        }

        async function showCustomerDetails(custId){

            let result = await $.ajax(
            {
                url:'{{ route('getCustomerDetails')}}',
                method:"POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "custId" : custId,
                },
                dataType:'json',
                success:function(data)
                {
                    return data;
                }
            });
            arrangeCustomerDeatils(result);
        }

        function arrangeCustomerDeatils(custObj){
            $('#customerName').val(`${custObj.client_fname} ${custObj.client_lname}`)
            $('#customerNic').val(custObj.client_nic)
            $('#customerTelephone').val(custObj.client_contact)
            $('#customerEmail').val(custObj.client_email)
            $('#customerAddress').val(custObj.client_address)
        }

        function resetCustInfo(){
            $('#customerName').val('')
            $('#customerNic').val('')
            $('#customerTelephone').val('')
            $('#customerEmail').val('')
            $('#customerAddress').val('')
        }

        function resetForm(){
            $('#taskflow_select').val('')
            $('#taskflow_select').selectpicker('refresh')
            $('#customer_select').val('')
            $('#customer_select').selectpicker('refresh')
        }

        async function showTaskflowDetails(taskflowId){

            let result = await $.ajax(
            {
                url:'{{ route('getTaskflowDetails')}}',
                method:"POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "taskflowId" : taskflowId,
                },
                dataType:'json',
                success:function(data)
                {
                    return data;
                }
            });
            renderTaskflowDetails(result.taskflow[0]);
        }

        function renderTaskflowDetails(taskflowObj){
            let output = '';

            output += `
                <div class="col-lg-12 pt-5" id="appendedTaskflow">
                    <div class="card card-custom mb-5">
                        <div class="card-body">
                            <h4 class="card-title text-muted font-weight-light">
                                Taskflow belongs to - <span class="font-weight-bolder text-dark-65"> &nbsp; ${taskflowObj.department.depart_name}</span> 
                            </h4>
                            <div class="row d-flex justify-content-around" id="taskflowDetails">
                                <div class="col-lg-4">
                                    <h6 class="font-weight-light text-muted">
                                        Taskflow Code
                                    </h6>
                                    <h6 class="font-weight-bolder text-dark-65" id="job-taskflow-code">
                                        ${taskflowObj.task_flow_code}
                                    </h6>
                                </div>
                                <div class="col-lg-6">
                                    <h6 class="font-weight-light text-muted">
                                        Taskflow Name
                                    </h6>
                                    <h6 class="font-weight-bolder text-dark-65" id="job-taskflow-name">
                                        ${taskflowObj.task_flow_name}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            $('#taskflowDetails').append(output)
        }

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "1500",
            "hideDuration": "800",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

            

    </script>
@endsection