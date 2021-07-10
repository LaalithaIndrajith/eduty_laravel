{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    {{-- Create Department--}}
    <form method="POST" id="edit-department-form" action="{{ route('editDepartment',$department->depart_id) }}" enctype="multipart/form-data">
        @csrf
        <div id="kt_page_sticky_card" class="card card-custom card-sticky">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">Edit Department 
                    <span class="d-block text-muted pt-2 font-size-sm">Edit the Department details </span></h3>
                </div> 
                <div class="card-toolbar">
                    <!-- <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Save</button> -->
                    <button type="submit" class="btn btn-info">
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
                        </span>Update Department
                    </button>
                    <a href="{{ route('viewDepartmentList') }}" class="btn btn-success ml-1">
                        <span class="svg-icon svg-icon-md">
                            <i class="far fa-list-alt"></i>
                        </span>
                        Department List
                    </a>
                </div> 
            </div>

            <div class="card-body">
                <div class="col-lg-12">
                    <div class="row d-flex justify-content-around"> 
                        <div class="col-lg-7 col-md-6 col-sm-12 border-right">
                            <div class="row d-flex justify-content-start">
                                <div class="col-lg-6 form-group">
                                    <label class="form-label col-form-label">Department Code<span class="text-danger">*</span></label>
                                    <input id="dep_code" type="text" class="form-control @error('dep_code') is-invalid @enderror"  name="dep_code" value="{{ $department->depart_code }}"/>
                                    @error('dep_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label class="form-label col-form-label">Department Name<span class="text-danger">*</span></label>
                                    <input id="dep_name" type="text" class="form-control @error('dep_name') is-invalid @enderror" name="dep_name" value="{{ $department->depart_name }}" />
                                    @error('dep_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label class="col-xl-12 col-lg-12 col-form-label">Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('dep_address') is-invalid @enderror " type="text" name="dep_address" rows="5">
                                    {{ $department->department_address }}</textarea>
                                    @error('dep_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label class="form-label col-form-label">Department Status </label>
                                    <br>
                                    <span class="switch">
                                        <label>
                                            <input type="checkbox" name="dep_status" id="dep_status" value="1" {{(($department->department_status) == 0) ? "" : "checked = 'checked'" }}  />
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                                
                            </div>
                        </div>  
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <h5 class="font-weight-bold text-center">Contact Information</h5><br>
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8 col-sm-10 form-group">
                                    <label class="form-label col-form-label">Email <span class="text-danger">*</span></label>
                                    <input id="dep_mail" type="dep_mail" class="form-control @error('dep_mail') is-invalid @enderror" name="dep_mail" value="{{ $department->department_email }}"/>
                                    @error('dep_mail')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="row d-flex justify-content-center mt-3">
                                <div class="col-lg-8 col-sm-10 form-group">
                                    <label class="form-label col-form-label">Hotline <span class="text-danger">*</span></label>
                                    <input id="dep_telephone" type="text" class="form-control form-control @error('dep_telephone') is-invalid @enderror" placeholder="Enter Telephone Number" name="dep_telephone" value="{{ $department->department_hotline }}" />
                                    @error('dep_telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="row d-flex justify-content-center mt-3">
                                <div class="col-lg-8 col-sm-10 form-group">
                                    <label class="form-label col-form-label">Fax</label>
                                    <input id="dep_fax" type="text" class="form-control form-control @error('dep_fax') is-invalid @enderror" placeholder="Enter Telephone Number" name="dep_fax" value="{{ $department->department_fax }}"/>
                                    @error('dep_fax')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
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
        document.getElementById('edit-department-form'), {
                fields: {
                    dep_code: {
                        validators: {
                            notEmpty: {
                                message: 'Department code is required'
                            },

                        }
                    },
                    dep_name: {
                        validators: {
                            notEmpty: {
                                message: 'Department Name is required'
                            },

                        }
                    },
                    dep_address: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter the Address'
                            },

                        }
                    },
                    dep_telephone: {
                        validators: {
                            notEmpty: {
                                message: 'Contact number is rquired'
                            },
                            regexp: {
                                regexp: /^(?:0|94|\+94)?(?:(11|21|23|24|25|26|27|31|32|33|34|35|36|37|38|41|45|47|51|52|54|55|57|63|65|66|67|81|912)(0|2|3|4|5|7|9)|7(0|1|2|5|6|7|8)\d)\d{6}$/,
                                message: 'Please enter a valid phone number'
                            }
                        }
                    },
                    dep_fax: {
                        validators: {
                            regexp: {
                                regexp: /^(?:0|94|\+94)?(?:(11|21|23|24|25|26|27|31|32|33|34|35|36|37|38|41|45|47|51|52|54|55|57|63|65|66|67|81|912)(0|2|3|4|5|7|9)|7(0|1|2|5|6|7|8)\d)\d{6}$/,
                                message: 'Please enter a valid phone number'
                            }
                        }
                    },
                    dep_mail: {
                        validators: {
                            notEmpty: {
                                message: 'Email address is required'
                            },
                            emailAddress: {
                                message: 'Please enter a valid Email address'
                            }
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

        let departmentEditEvent = <?php 
            if(session()->has('departmentEdit')){
                echo json_encode(session()->get('departmentEdit'));   
            }else{
                echo json_encode('');
            } 
            ?>;

        (departmentEditEvent != '') ? loadToaster(departmentEditEvent) : ''

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
