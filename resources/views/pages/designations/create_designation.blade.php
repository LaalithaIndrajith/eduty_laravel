{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    {{-- Create Designation--}}
    <form method="POST" id="create-new-designation-form" action="{{ route('createDesignation') }}" enctype="multipart/form-data">
        @csrf
        <div id="kt_page_sticky_card" class="card card-custom card-sticky">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">Designation Creation
                    <span class="d-block text-muted pt-2 font-size-sm">Create designations for the system </span></h3>
                </div> 
                <div class="card-toolbar">
                    <!-- <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Save</button> -->
                    <button type="submit" class="btn btn-primary">
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
                        </span>Create Designation
                    </button>
                    <a href="{{ route('viewDesignationList') }}" class="btn btn-success ml-1">
                        <span class="svg-icon svg-icon-md">
                            <i class="far fa-list-alt"></i>
                        </span>
                        Designation List
                    </a>
                    <a href="{{ route('designationCreationView') }}" class="btn btn-light-danger ml-1"">
                        <span class="svg-icon svg-icon-md">
                            <i class="fas fa-sync-alt"></i>
                        </span>
                        Reset Form
                    </a>
                </div> 
            </div>

            <div class="card-body">
                <div class="col-lg-12">
                    <div class="row d-flex justify-content-around"> 
                        <div class="col-lg-3 form-group">
                            <label class="form-label col-form-label">Department<span class="text-danger">*</span></label>
                            <select class="form-control form-control-lg dynamic mt-2 selectpicker @error('department_select') is-invalid @enderror" name="department_select" id="department_select" data-dependent="department_select" data-size="7" data-live-search="true">
                                <option value="">Select Department</option>
                                @foreach ($departments as $department )
                                <option value="{{ $department->depart_id }}">{{ $department->depart_code }} | {{ $department->depart_name }}</option>   
                                @endforeach
                            </select>
                            @error('department_select')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-3 form-group">
                            <label class="form-label col-form-label">Designation Code<span class="text-danger">*</span></label>
                            <input id="desig_code" type="text" class="form-control @error('desig_code') is-invalid @enderror" placeholder="Enter NIC" name="desig_code" />
                            @error('desig_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-3 form-group">
                            <label class="form-label col-form-label">Designation Name<span class="text-danger">*</span></label>
                            <input id="desig_name" type="text" class="form-control @error('desig_name') is-invalid @enderror" placeholder="Enter NIC" name="desig_name" />
                            @error('desig_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-3 form-group">
                            <label class="form-label col-form-label">Designation Status </label>
                            <br>
                            <span class="switch">
                                <label>
                                    <input type="checkbox" checked="checked" name="desig_status" id="desig_status" value="1" />
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>    
                </div>         
            </div>
        </div>
    </form>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/custom/profile/profile.js') }}" type="text/javascript"></script>
    <script>
        FormValidation.formValidation(
        document.getElementById('create-new-designation-form'), {
                fields: {
                    department_select: {
                        validators: {
                            notEmpty: {
                                message: 'Please select a Department'
                            },

                        }
                    },
                    desig_code: {
                        validators: {
                            notEmpty: {
                                message: 'Designation code is required'
                            },

                        }
                    },
                    desig_name: {
                        validators: {
                            notEmpty: {
                                message: 'Designation Name is required'
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

        let designationCreationEvent = <?php 
            if(session()->has('designationCreation')){
                echo json_encode(session()->get('designationCreation'));   
            }else{
                echo json_encode('');
            } 
            ?>;

        (designationCreationEvent != '') ? loadToaster(designationCreationEvent) : ''

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
