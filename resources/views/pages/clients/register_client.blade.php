{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    {{-- Register User Accounts--}}
    <form method="POST" id="register-new-client-form" action="{{ route('clientRegister') }}" enctype="multipart/form-data">
        @csrf
        <div id="kt_page_sticky_card" class="card card-custom card-sticky">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">Client Registration
                    <span class="d-block text-muted pt-2 font-size-sm">Client registration for Issue Job Tcikets in the System</span></h3>
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
                        </span>Register Client
                    </button>
                    <a href="{{ route('viewClientList') }}" class="btn btn-success ml-1">
                        <span class="svg-icon svg-icon-md">
                            <i class="far fa-list-alt"></i>
                        </span>
                        Client List
                    </a>
                    <a href="{{ route('clientRegisterView') }}" class="btn btn-light-danger ml-1"">
                        <span class="svg-icon svg-icon-md">
                            <i class="fas fa-sync-alt"></i>
                        </span>
                        Reload Page
                    </a>
                </div> 
            </div>

            <div class="card-body">
                <div class="col-lg-12">
                    <div class="row d-flex justify-content-around"> 
                        <div class="col-lg-7 col-md-6 col-sm-12 border-right">
                            <h5 class="font-weight-bold text-center">Basic Information</h5><br>
                            <div class="row">
                                <div class="col-lg-2 col-sm-2 form-group">
                                    <label class="form-label col-form-label">Title <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg dynamic selectpicker @error('client_title_select') is-invalid @enderror" name="client_title_select" id="client_title_select" data-dependent="client_title_select" data-size="7">
                                        <option value="">Title</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Mrs">Mrs</option>
                                    </select>
                                    @error('client_title_select')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                                <div class="col-lg-5 col-sm-6 form-group">
                                    <label class="form-label col-form-label">First Name <span class="text-danger">*</span></label>
                                    <input id="client_fname" type="text" class="form-control @error('client_fname') is-invalid @enderror" placeholder="Enter First Name" name="client_fname" />
                                    @error('client_fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                                <div class="col-lg-5 col-sm-6 form-group">
                                    <label class="form-label col-form-label">Last Name <span class="text-danger">*</span></label>
                                    <input id="client_lname" type="text" class="form-control @error('client_lname') is-invalid @enderror" placeholder="Enter Last Name" name="client_lname" />
                                    @error('client_lname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                            </div>
                            <div class="row d-flex justify-content-start">
                                <div class="col-lg-6 form-group">
                                    <label class="form-label col-form-label">NIC<span class="text-danger">*</span></label>
                                    <input id="client_nic" type="text" class="form-control @error('client_nic') is-invalid @enderror" placeholder="Enter NIC" name="client_nic" />
                                    @error('client_nic')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label class="col-xl-12 col-lg-12 col-form-label">Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('client_address') is-invalid @enderror " type="text" name="client_address" rows="5"></textarea>
                                    @error('client_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>  
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <h5 class="font-weight-bold text-center">Contact Information</h5><br>
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8 col-sm-10 form-group">
                                    <label class="form-label col-form-label">Telephone Number <span class="text-danger">*</span></label>
                                    <input id="client_telephone" type="text" class="form-control form-control @error('client_telephone') is-invalid @enderror" placeholder="Enter Telephone Number" name="client_telephone" />
                                    @error('client_telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8 col-sm-10 form-group">
                                    <label class="form-label col-form-label">Email</label>
                                    <input id="client_email" type="client_email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email Address" name="client_email" />
                                    @error('client_email')
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
        document.getElementById('register-new-client-form'), {
                fields: {
                    client_title_select: {
                        validators: {
                            notEmpty: {
                                message: 'Please Select a title'
                            },

                        }
                    },
                    client_fname: {
                        validators: {
                            notEmpty: {
                                message: 'First Name is required'
                            },

                        }
                    },
                    client_lname: {
                        validators: {
                            notEmpty: {
                                message: 'Last Name is required'
                            },

                        }
                    },
                    client_nic: {
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
                    client_address: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter the Address'
                            },

                        }
                    },
                    client_telephone: {
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
                    client_email: {
                        validators: {
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

        let clientRegistrationEvent = <?php 
            if(session()->has('clientRegistration')){
                echo json_encode(session()->get('clientRegistration'));   
            }else{
                echo json_encode('');
            } 
            ?>;

        (clientRegistrationEvent != '') ? loadToaster(clientRegistrationEvent) : '' ;

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
