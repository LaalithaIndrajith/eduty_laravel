{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    {{-- Create Designation--}}
    <form method="POST" id="create-new-taskflow-form" action="{{ route('createTaskFlow') }}" enctype="multipart/form-data">
        @csrf
        <div id="kt_page_sticky_card" class="card card-custom card-sticky">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">Taskflow Creation
                    <span class="d-block text-muted pt-2 font-size-sm">Create Taskflows for Departments </span></h3>
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
                        </span>Create TaskFlow
                    </button>
                    <a href="{{ route('viewTaskFlowList') }}" class="btn btn-success ml-1">
                        <span class="svg-icon svg-icon-md">
                            <i class="far fa-list-alt"></i>
                        </span>
                        Designation List
                    </a>
                    <a href="{{ route('taskflowCreationView') }}" class="btn btn-light-danger ml-1"">
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
                            <label class="form-label col-form-label">TaskFlow Code<span class="text-danger">*</span></label>
                            <input id="taskflow_code" type="text" class="form-control @error('taskflow_code') is-invalid @enderror" name="taskflow_code" />
                            @error('taskflow_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-3 form-group">
                            <label class="form-label col-form-label">TaskFlow Name<span class="text-danger">*</span></label>
                            <input id="taskflow_name" type="text" class="form-control @error('taskflow_name') is-invalid @enderror" name="taskflow_name" />
                            @error('taskflow_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-3 form-group">
                            <label class="form-label col-form-label">TaskFlow Status </label>
                            <br>
                            <span class="switch">
                                <label>
                                    <input type="checkbox" checked="checked" name="taskflow_status" id="taskflow_status" value="1" />
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div> 
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-10">
                            <label>Tasks</label>
                            <table class="table table-bordered" id="add-task-tbl">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" scope="col" style="width:5%;">#</th>
                                        <th class="text-center" scope="col" style="width:15%;">Task Name</th>
                                        <th class="text-center" scope="col" style="width:15%;">Responsible Designation</th>
                                        <th class="text-center" scope="col" colspan="2" style="width:25%;">Milestone Time</th>
                                        <th class="text-center" scope="col" style="width:10%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <tr>
                                        <td colspan="2" style="width:20%;">
                                            <input class="form-control" type="text" id="task_name" name="task_name" />
                                        </td>
                                        <td style="width:15%;">
                                            <select class="form-control form-control-lg  @error('designation_select') is-invalid 
                                            @enderror" name="designation_select" id="designation_select">
                                            </select>
                                        </td>
                                        <td style="width:10%;">
                                            <select class="form-control form-control-lg  @error('milestone_time_type_select') is-invalid 
                                            @enderror" name="milestone_time_type_select" id="milestone_time_type_select">
                                            @foreach ($timeTypes as $timeType )
                                            <option value="{{ $timeType }}">{{ $timeType}}</option>   
                                            @endforeach
                                            </select>
                                        </td>
                                        <td style="width:10%;">
                                            <input class="form-control text-right" type="text" id="milestone_time_value" name="milestone_time_value" />
                                        </td>
                                        <td style="width:10%;">
                                            <button type="button" class="btn btn-success btn-block mr-2 form-control"
                                             id="add_task_btn">Add Task</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="text-center bg-primary-o-50 font-weight-bold"> Tasks details</td>
                                    </tr>
                                </tbody>
                            </table>
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
        
        $(document).ready(function(){
            $('#department_select').selectpicker();
            $('#designation_select').selectpicker();
            $('#milestone_time_type_select').selectpicker();
        });

        FormValidation.formValidation(
        document.getElementById('create-new-taskflow-form'), {
                fields: {
                    department_select: {
                        validators: {
                            notEmpty: {
                                message: 'Please select a Department'
                            },

                        }
                    },
                    taskflow_code: {
                        validators: {
                            notEmpty: {
                                message: 'Taskflow code is required'
                            },

                        }
                    },
                    taskflow_name: {
                        validators: {
                            notEmpty: {
                                message: 'Taskflow Name is required'
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

        document.querySelector('#department_select').addEventListener('change', function() {
            let departmentId = this.value;
            fetchDesignationsOfDep(departmentId);
        })

        // Add rows to VTable
        document.querySelector('#add_task_btn').addEventListener('click', function() {
            addTaskRow()
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

        let rowNumber = 1;
        let tblRowArray = [];
        function addTaskRow(){

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

            let designation       = document.getElementById('designation_select');
            let designationVal    = $('#designation_select option:selected').val();
            let designationText   = $('#designation_select option:selected').text();
            let taskName          = document.getElementById('task_name');
            let milestoneType     = document.getElementById('milestone_time_type_select');
            let milestoneTypeText = $('#milestone_time_type_select option:selected').text();
            let milestoneVal      = document.getElementById('milestone_time_value');

            let newTblrow = `
                <tr id="${rowNumber}" class="apendedRows">
                    <td colspan="2" style="width:20%;">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-40 symbol-light-${state} flex-shrink-0">
                                <span class="symbol-label font-size-h4 font-weight-bold" class="rowNumber">
                                    <i class="fas fa-clipboard-check icon-md"></i> 
                                </span>
                            </div>
                            <div class="ml-4">
                                <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">${taskName.value}</div>
                                <a href="#" class="text-muted font-weight-bold text-hover-primary">Task Name</a>
                            </div>
                        </div>
                    </td>
                    <td colspan="2">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-40 symbol-light-${state} flex-shrink-0">
                                <span class="symbol-label font-size-h4 font-weight-bold"><i class="fas fa-user-alt icon-md"></i></span>
                            </div>
                            <div class="ml-4">
                                <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">${designationText}</div>
                                <a href="#" class="text-muted font-weight-bold text-hover-primary">Responsible Designation</a>
                            </div>
                        </div>
                    </td>
                    <td style="width:20%;">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-40 symbol-light-${state} flex-shrink-0">
                                <span class="symbol-label font-size-h4 font-weight-bold"><i class="fas fa-hourglass-end icon-md"></i></span>
                            </div>
                            <div class="ml-4">
                                <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">${milestoneVal.value} ${milestoneTypeText}</div>
                                <a href="#" class="text-muted font-weight-bold text-hover-primary">Milestone Time</a>
                            </div>
                        </div>
                    </td>
                    <td colspan="2" style="width:20%;" hidden="true">
                        <input class="form-control" type="text" name="task_name[]" value="${taskName.value}" readonly="readonly"/>
                    </td>
                    <td style="width:15%;" hidden="true">
                        <input class="form-control" type="text" name="desig_name[]" value="${designationText}" readonly="readonly"/>
                    </td>
                    <td style="width:10%;" hidden="true">
                        <input class="form-control" type="text" name="milestone_type[]" value="${milestoneTypeText}" readonly="readonly"/>
                    </td>
                    <td style="width:10%;" hidden="true">
                        <input class="form-control" type="text" name="milestone_time_value[]" value="${milestoneVal.value}" readonly="readonly"/>
                    </td>
                    <td colspan="2" name="designation_select[]" hidden="true">
                        <input class="form-control" type="text" id="designation_select" readonly="readonly" name="designation_select[]" value="${designationVal}" />
                    </td>
                    <td colspan="2" name="milestone_time_type_select[]" hidden="true">
                        <input class="form-control" type="text" id="milestone_time_type_select" readonly="readonly" name="milestone_time_type_select[]" value="${milestoneType.value}" />
                    </td>
                    <td>
                        <button class="btn btn-danger btn-block mr-2 form-control dltTaskEntryRow" value="${rowNumber}" onclick="deleteRow(${rowNumber})">Remove</button>
                    </td>
                </tr>`;

                // <td class="row-index" hidden="true">
                //         Row ${rowNumber}
                //     </td> 
        
            $("#add-task-tbl tbody").append(newTblrow);
            let tblRowObj = {
                rowNum : rowNumber,
                obj : newTblrow
            };
            tblRowArray.push(tblRowObj);
            rowNumber++;

            taskName.value     = "";
            designation.value  = "";
            milestoneVal.value = "";
            $('#designation_select').val('');
            $('#designation_select').selectpicker('refresh');
            $('#milestone_time_type_select').val('');
            $('#milestone_time_type_select').selectpicker('refresh');
            
        }

        function deleteRow(rowId){
            let deletedValue = rowId;
            $('#'+deletedValue).remove();
            (rowNumber == 1) ? '' : rowNumber--;

        }

        // $('#tbody').on('click', '.dltTaskEntryRow', function () {
        //     let child = $(this).closest('tr').nextAll();

        //     child.each(function () {
        //         let id = $(this).attr('id');
        //         let idx = $(this).children('.row-index').children('button');
        //         let dig = parseInt(id.substring(1));
        //         idx.html(`Row ${dig - 1}`);
        //         $(this).attr('id', `R${dig - 1}`);
        //         console.log( id);
        //     });

        //     $(this).closest('tr').remove();
        //     rowNumber--;
        // });

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
