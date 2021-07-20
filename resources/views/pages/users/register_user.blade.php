{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    {{-- Register User Accounts--}}
    <form method="POST" id="register-new-user-form" action="{{ route('userRegister') }}" enctype="multipart/form-data">
        @csrf
        <div id="kt_page_sticky_card" class="card card-custom card-sticky">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">User Creation
                    <span class="d-block text-muted pt-2 font-size-sm">User Creation to Sign in to the System</span></h3>
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
                        </span>Register User
                    </button>
                    <a href="{{ route('viewUserList') }}" class="btn btn-success ml-1">
                        <span class="svg-icon svg-icon-md">
                            <i class="far fa-list-alt"></i>
                        </span>
                        User List
                    </a>
                    <a href="{{ route('userRegisterView') }}" class="btn btn-light-danger ml-1"">
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
                        <div class="col-lg-7 col-md-6 col-sm-12 border-right">
                            <h5 class="font-weight-bold text-center">Basic Information</h5><br>
                            <div class="row">
                                <div class="col-lg-4 col-sm-12 form-group">
                                    <label class="form-label col-form-label">Department <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg dynamic mt-2 selectpicker @error('department_select') is-invalid @enderror" name="department_select" id="department_select" data-dependent="department_select" data-size="7" data-live-search="true">
                                        <option value="">Select a Department</option>
                                        @foreach ($data['departments'] as $department )
                                        <option value="{{ $department->depart_id }}">{{ $department->depart_code }} | {{ $department->depart_name }}</option>   
                                        @endforeach
                                    </select>
                                    @error('department_select')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-4 col-sm-12 form-group">
                                    <label class="form-label col-form-label">Designation <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg dynamic mt-2 selectpicker @error('designation_select') is-invalid @enderror" name="designation_select" id="designation_select" data-size="7" data-live-search="true">
                                        <option value="">Select a Designation</option>
                                        {{-- @foreach ($data['designations'] as $designation )
                                        <option value="{{ $designation->designation_id }}">{{ $designation->designation_code }} | {{ $designation->designation_name }}</option>   
                                        @endforeach --}}
                                    </select>
                                    @error('designation_select')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>  
                                
                                <div class="col-lg-4 col-sm-12 form-group">
                                    <label class="form-label col-form-label">User Type <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg dynamic mt-2 selectpicker @error('user_type_select') is-invalid @enderror" name="user_type_select" id="user_type_select" data-size="7" data-live-search="true">
                                        <option value="">Select a User Type</option>
                                        @foreach ($data['userTypes'] as $userType )
                                        <option value="{{ $userType->id }}">{{ $userType->name }}</option>   
                                        @endforeach
                                    </select>
                                    @error('user_type_select')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-sm-2 form-group">
                                    <label class="form-label col-form-label">Title <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg dynamic selectpicker @error('user_title_select') is-invalid @enderror" name="user_title_select" id="user_title_select" data-dependent="user_title_select" data-size="7">
                                        <option value="">Title</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Mrs">Mrs</option>
                                    </select>
                                    @error('user_title_select')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                                <div class="col-lg-5 col-sm-6 form-group">
                                    <label class="form-label col-form-label">First Name <span class="text-danger">*</span></label>
                                    <input id="user_first_name" type="text" class="form-control @error('user_first_name') is-invalid @enderror" placeholder="Enter First Name" name="user_first_name" />
                                    @error('user_first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                                <div class="col-lg-5 col-sm-6 form-group">
                                    <label class="form-label col-form-label">Last Name <span class="text-danger">*</span></label>
                                    <input id="user_last_name" type="text" class="form-control @error('user_last_name') is-invalid @enderror" placeholder="Enter Last Name" name="user_last_name" />
                                    @error('user_last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                            </div>
                            <div class="row d-flex justify-content-start">
                                <div class="col-lg-6 form-group">
                                    <label class="form-label col-form-label">NIC<span class="text-danger">*</span></label>
                                    <input id="user_nic" type="text" class="form-control @error('user_nic') is-invalid @enderror" placeholder="Enter NIC" name="user_nic" />
                                    @error('user_nic')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label class="col-xl-12 col-lg-12 col-form-label">Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('user_address') is-invalid @enderror " type="text" name="user_address" rows="5"></textarea>
                                    @error('user_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label class="form-label col-form-label">Telephone Number <span class="text-danger">*</span></label>
                                    <input id="user_telephone" type="text" class="form-control form-control @error('user_telephone') is-invalid @enderror" placeholder="Enter Telephone Number" name="user_telephone" />
                                    @error('user_telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-6 form-group">
                                    <label class="form-label col-form-label">Activate User </label>
                                    <br>
                                    <span class="switch">
                                        <label>
                                            <input type="checkbox" checked="checked" name="user_status" id="user_status" value="1" />
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                                
                            </div>
                        </div>  
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <h5 class="font-weight-bold text-center">User Information</h5><br>
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-6 col-sm-10">
                                    <div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url(); 
                                    width:300px; height:300px;">
                                        <div class="image-input-wrapper" style="background-image: url(); width:300px !important; height:300px 
                                        !important;"></div>
                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" 
                                        data-toggle="tooltip" title="" data-original-title="Add User Profile Picture">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="user_profile_image" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="profile_avatar_remove" />
                                        </label>
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" 
                                        data-toggle="tooltip" title="Cancel avatar">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove Profile Image">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    </div>
                                    <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                    @error('user_profile_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center mt-3">
                                <div class="col-lg-8 col-sm-10 form-group">
                                    <label class="form-label col-form-label">User Name</label>
                                    <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" placeholder="Enter User Name" name="user_name" />
                                    @error('user_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8 col-sm-10 form-group">
                                    <label class="form-label col-form-label">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email Address" name="email" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8 col-sm-10 form-group">
                                    <label class="form-label col-form-label">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password" name="password" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8 col-sm-10 form-group">
                                    <label class="form-label col-form-label">Confirm Password</label>
                                    <input id="password_confirmation" type="password" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" placeholder="Enter Confirm Password" name="password_confirmation" />
                                    @error('password_confirmation')
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
        document.getElementById('register-new-user-form'), {
                fields: {
                    department_select: {
                        validators: {
                            notEmpty: {
                                message: 'Please Select the Department'
                            },

                        }
                    },
                    designation_select: {
                        validators: {
                            notEmpty: {
                                message: 'Designation is required'
                            },

                        }
                    },
                    user_type_select: {
                        validators: {
                            notEmpty: {
                                message: 'Please select a User type'
                            },

                        }
                    },
                    user_title_select: {
                        validators: {
                            notEmpty: {
                                message: 'Please Select a title'
                            },

                        }
                    },
                    user_first_name: {
                        validators: {
                            notEmpty: {
                                message: 'First Name is required'
                            },

                        }
                    },
                    user_last_name: {
                        validators: {
                            notEmpty: {
                                message: 'Last Name is required'
                            },

                        }
                    },
                    user_nic: {
                        validators: {
                            notEmpty: {
                                message: 'NIC number is required'
                            },
                            regexp: {
                                regexp: /^([0-9]{9}[x|X|v|V]|[0-9]{12})$/m,
                                message: 'Please enter a valid NIC number'
                            }
                        }
                    },
                    user_address: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter the Address'
                            },

                        }
                    },
                    user_telephone: {
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
                    user_name: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter a Username'
                            },

                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Email address is required'
                            },
                            emailAddress: {
                                message: 'Please enter a valid Email address'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter the Password'
                            },

                        }
                    },
                    password_confirmation: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter the Password Confirmation'
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

        let userRegistrationEvent = <?php 
            if(session()->has('userRegistration')){
                echo json_encode(session()->get('userRegistration'));   
            }else{
                echo json_encode('');
            } 
            ?>;

        (userRegistrationEvent != '') ? loadToaster(userRegistrationEvent) : '' ;

        document.querySelector('#department_select').addEventListener('change', function() {
            let departmentId = this.value;
            fetchDesignationsOfDep(departmentId);
        });

        async function fetchDesignationsOfDep(departmentId){
            $.ajax({
            url: "{{ route('fetchDesignationsOfDep')}}",
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "departmentId": departmentId,
            },
            dataType: 'json',
            success: function(data) {
                console.log(data)
                $('#designation_select').empty();
                $('#designation_select').append('<option value="">Select a Designation</option>');
                if(data.exsits){
                    let newOptions = '';
                    for(let designation of data.designations){
                        newOptions += `<option value="${designation.designation_id}"> ${designation.designation_code} | ${designation.designation_name}</option>`
                    }
                    $('#designation_select').append(newOptions); 
                }
                else{
                    toastr.error('Please go to Designations Master to create designations for departments', 'No Designations Found')
                }
                $('#designation_select').selectpicker('refresh');

            }
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
