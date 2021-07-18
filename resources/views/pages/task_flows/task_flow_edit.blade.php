{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    {{-- Edit Taskflow--}}
    <div id="kt_page_sticky_card" class="card card-custom card-sticky">
        <div class="card-header flex-wrap py-3">
            <div class="card-title">
                <h3 class="card-label">Taskflow Creation
                <span class="d-block text-muted pt-2 font-size-sm">Create Taskflows for Departments </span></h3>
            </div> 
            <div class="card-toolbar">
                <!-- <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Save</button> -->
                {{-- <button type="submit" class="btn btn-info">
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
                    </span>Edit TaskFlow
                </button> --}}
                <a href="{{ route('viewTaskFlowList') }}" class="btn btn-info ml-1">
                    <span class="svg-icon svg-icon-md">
                        <i class="far fa-list-alt"></i>
                    </span>
                    Taskflow List
                </a>
                <a href="{{ route('taskflowEditView',$taskflow[0]->taskflow_id) }}" class="btn btn-light-danger ml-1"">
                    <span class="svg-icon svg-icon-md">
                        <i class="fas fa-sync-alt"></i>
                    </span>
                    Reload Page
                </a>
            </div> 
        </div>

        <div class="card-body bg-gray-300">
            <div class="row d-flex justify-content-around">
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-custom mb-5">
                                <div class="card-header ribbon ribbon-top ribbon-ver">
                                    <div class="ribbon-target bg-success h4" style="top: -2px; right: 20px;" id="edit-taskflow-department"><span class="font-weight-light">Taskflow belongs to - </span> &nbsp;{{ $taskflow[0]->department->depart_name }}</div>
                                </div>
                                <div class="card-body">
                                    <div class="row d-flex justify-content-around">
                                        <div class="col-lg-4">
                                            <h6 class="font-weight-light text-muted">
                                                Taskflow Code
                                            </h6>
                                            <h6 class="font-weight-bolder text-dark-65" id="edit-taskflow-code">
                                                {{ $taskflow[0]->task_flow_code }}
                                            </h6>
                                        </div>
                                        <div class="col-lg-6">
                                            <h6 class="font-weight-light text-muted">
                                                Taskflow name
                                            </h6>
                                            <h6 class="font-weight-bolder text-dark-65" id="edit-taskflow-name">
                                                {{ $taskflow[0]->task_flow_name }}
                                            </h6>
                                        </div>
                                        <div class="col-lg-2">
                                            <h6 class="font-weight-light text-muted">
                                                Status
                                            </h6>
                                            @switch($taskflow[0]->taskflow_status)
                                            @case(0)
                                            <h6 class="font-weight-bolder text-warning" id="edit-taskflow-status">
                                                Inactive
                                            </h6>
                                            @break
                                            @case(1)
                                            <h6 class="font-weight-bolder text-success" id="edit-taskflow-status">
                                                Active
                                            </h6>
                                            @break
                                            @case(2)
                                            <h6 class="font-weight-bolder text-danger" id="edit-taskflow-status">
                                                Deleted
                                            </h6>
                                            @break
                                            @default
                                            <span></span>
                                            @endswitch
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <button type="button" class="btn btn-light-primary btn-pill" onclick="showEditTaskflow({{ $taskflow[0]->taskflow_id }})">
                                        <i class="far fa-edit"></i> Edit Taskflow Details 
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-end">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card card-custom bg-primary mb-5">
                                        <div class="card-header border-0">
                                            <div class="card-title">
                                                <h3 class="card-label text-white">
                                                    New Task to Task Flow
                                                </h3>
                                            </div>
                                            <div class="card-toolbar">
                                                <button type="button" class="btn btn-sm btn-white" onclick="showAddNewTaskModal({{ $taskflow[0]->taskflow_id }})">
                                                    <i class="flaticon2-add-1"></i> Add
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-lg-5" id="task-container">
                    @php $i = 1; @endphp
                    @foreach ($tasks as $task)
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-custom mb-5">
                                    <div class="card-body ribbon ribbon-top ribbon-ver pb-3">
                                        <div class="ribbon-target bg-danger font-weight-bolder h2" style="top: -2px; right: 20px;">{{ $i++ }}</div>
                                        <h4 class="card-title text-muted font-weight-light">
                                            Task name - <span class="font-weight-bolder text-dark-65" id="edit_task_name_{{$task->task_id  }}"> &nbsp; {{ $task->task_name }}</span> 
                                        </h4>
                                        <div class="row d-flex justify-content-around">
                                            <div class="col-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-40 symbol-light-warning flex-shrink-0">
                                                        <span class="symbol-label font-size-h4 font-weight-bold"><i class="fas fa-user-alt icon-md"></i></span>
                                                    </div>
                                                    <div class="ml-4">
                                                        <h2 class="text-dark-75 font-weight-bolder font-size-lg mb-0" id="edit_task_responsible_{{$task->task_id  }}">{{ $task->designation->designation_name }}</h2>
                                                        <a href="#" class="text-muted font-weight-bold text-hover-primary">Responsible Designation</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-40 symbol-light-success flex-shrink-0">
                                                        <span class="symbol-label font-size-h4 font-weight-bold"><i class="fas fa-hourglass-end icon-md"></i></span>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-dark-75 font-weight-bolder font-size-lg mb-0" id="edit_milestone_time_{{$task->task_id  }}"> {{ $task->task_milestone_time }} {{ $task->task_milestone_time_type }}</div>
                                                        <a href="#" class="text-muted font-weight-bold text-hover-primary">Milestone Time</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row d-flex mt-5 border-top pt-3">
                                            <button type="button" class="btn btn-light-primary btn-pill mx-2" onclick="showEditTaskModal({{ $task->task_id }})">
                                                <i class="far fa-edit"></i> Edit 
                                            </button>
                                            <button type="button" class="btn btn-light-danger btn-pill" onclick="deleteTask({{ $task->task_id }})">
                                                <i class="far fa-trash-alt"></i> Delete 
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div> 
            </div> 
        </div>
    </div>
  
    {{-- Edit TAskflow Details Modal --}}
    <div class="modal inmodal fade" id="editTaskFlowModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center">Edit Taskflow Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class ="form-horizontal" id ="edit_taskflow_modal_form" name="edit_taskflow_modal_form" method="post" 
                    enctype="multipart/form-data">
                        <div class="row d-flex justify-content-around mb-4">
                            <div class="col-lg-4">
                                <label>Department</label>
                                <input type="text" class="form-control form-control-solid font-weight-bold" readonly name="taskflowDepartment" 
                                id="taskflowDepartment" value="{{ $taskflow[0]->department->depart_name }}"/>
                            </div>
                            <div class="col-lg-3">
                                <label>Taskflow Code</label>
                                <input type="text" class="form-control font-weight-bold" name="taskflowCode" value="{{ $taskflow[0]->task_flow_code }}" 
                                id="taskflowCode"/>
                            </div>
                            <div class="col-lg-5">
                                <label>Taskflow Name</label>
                                <input type="text" class="form-control font-weight-bold" name="taskflowName" value="{{ $taskflow[0]->task_flow_name }}"
                                id="taskflowName"/>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start">
                            <div class="col-lg-3">
                                <label>Taskflow Status</label>
                                <span class="switch">
                                    <label>
                                        <input type="checkbox" name="taskflowStatus" id="taskflowStatus" value="1" {{ (($taskflow[0]->taskflow_status) == 0) ? "" : "checked = 'checked'" }}  />
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" id="edit_taskflow_btn" onclick="editTaskflowChanges({{ $taskflow[0]->taskflow_id }})"><i class ="far fa-save"></i> Save Changes </button>
                    <button type="button" class="btn btn-light btn_close" data-dismiss="modal">
                        <i class="fa fa-times-circle"></i> Close 
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Task Modal --}}
    <div class="modal inmodal fade" id="editTaskModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center">Edit Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class ="form-horizontal" id ="edit_task_modal_form" name="edit_task_modal_form" method="post" 
                    enctype="multipart/form-data">
                        <div class="row d-flex justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label>Task Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control font-weight-bold" name="taskName"
                                id="taskName"/>
                            </div>
                            <div class="col-lg-6">
                                <label>Responsible designation <span class="text-danger">*</span></label>
                                <select class="form-control form-control-lg dynamic selectpicker @error('department_select') is-invalid @enderror" name="designation_select" id="designation_select" data-dependent="designation_select" data-size="7" data-live-search="true">
                                    <option value="">Select Designation</option>
                                    @foreach ($designations as $designation )
                                    <option value="{{ $designation->designation_id }}">{{ $designation->designation_code }} | {{ $designation->designation_name }}</option>   
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start">
                            <div class="col-lg-3">
                                <label>Milestone Time Type <span class="text-danger">*</span></label>
                                <select class="form-control form-control-lg  @error('milestone_time_type_select') is-invalid @enderror" name="milestone_time_type_select" id="milestone_time_type_select">
                                @foreach ($timeTypes as $timeType )
                                <option value="{{ $timeType }}">{{ $timeType}}</option>   
                                @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label>Milestone Time Value <span class="text-danger">*</span></label>
                                <input type="text" class="form-control font-weight-bold" name="milestone_time_value" 
                                id="milestone_time_value"/>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" id="edit_task_btn" onclick="editTaskChanges()"><i class ="far fa-save"></i> Save Changes </button>
                    <button type="button" class="btn btn-light btn_close" data-dismiss="modal">
                        <i class="fa fa-times-circle"></i> Close 
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Add new Task Modal --}}
    <div class="modal inmodal fade" id="addNewTaskModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center">Edit Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class ="form-horizontal" id ="add_new_task_modal_form" name="add_new_task_modal_form" method="post" 
                    enctype="multipart/form-data">
                        <div class="row d-flex justify-content-around mb-4">
                            <div class="col-lg-6">
                                <label>Task Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control font-weight-bold" name="addNewTaskName"
                                id="addNewTaskName"/>
                            </div>
                            <div class="col-lg-6">
                                <label>Responsible designation <span class="text-danger">*</span></label>
                                <select class="form-control form-control-lg dynamic selectpicker @error('add_new_designation_select') is-invalid @enderror" name="add_new_designation_select" id="add_new_designation_select" data-dependent="add_new_designation_select" data-size="7" data-live-search="true">
                                    <option value="">Select Designation</option>
                                    @foreach ($designations as $designation )
                                    <option value="{{ $designation->designation_id }}">{{ $designation->designation_code }} | {{ $designation->designation_name }}</option>   
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start">
                            <div class="col-lg-3">
                                <label>Milestone Time Type <span class="text-danger">*</span></label>
                                <select class="form-control form-control-lg dynamic selectpicker @error('add_new_milestone_time_type_select') is-invalid @enderror" name="add_new_milestone_time_type_select" id="add_new_milestone_time_type_select">
                                @foreach ($timeTypes as $timeType )
                                <option value="{{ $timeType }}">{{ $timeType}}</option>   
                                @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label>Milestone Time Value <span class="text-danger">*</span></label>
                                <input type="text" class="form-control font-weight-bold" name="add_new_milestone_time_value" 
                                id="add_new_milestone_time_value"/>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" id="add_task_btn" onclick="addTask({{ $taskflow[0]->taskflow_id }})"><i class="flaticon2-add-1"></i> Add Task </button>
                    <button type="button" class="btn btn-light btn_close" data-dismiss="modal">
                        <i class="fa fa-times-circle"></i> Close 
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/custom/profile/profile.js') }}" type="text/javascript"></script>
    <script>
        let editTaskId  = 0;
        let newStepNum = 0;
        
        $(document).ready(function(){
            $('#designation_select').selectpicker();
            $('#milestone_time_type_select').selectpicker();
        });
        
        function showEditTaskflow(){
            $('#editTaskFlowModal').modal('show');
        }

        async function showAddNewTaskModal(taskFlowId){

            let result = await $.ajax(
            {
                url:'{{ route('getNewStepNum')}}',
                method:"POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "taskFlowId" : taskFlowId,
                },
                dataType:'json',
                success:function(data)
                {
                    return data;
                }
            });
            newStepNum = result;
            $('#addNewTaskModal').modal('show');
        }

        async function showEditTaskModal(taskId){
            editTaskId = 0;
            let details = await $.ajax(
            {
                url:'{{ route('fetchTaskDetailsOfTask')}}',
                method:"POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "taskId" : taskId,
                },
                dataType:'json',
                success:function(data)
                {
                    return data;
                }
            });
            editTaskId = details.task_id;
            arrangeTaskEditModal(details);
            $('#editTaskModal').modal('show');
        }

        function arrangeTaskEditModal(taskObj){
            $('#taskName').val(taskObj.task_name);
            $('#designation_select').val(taskObj.designation_id);
            $('#designation_select').selectpicker('refresh');
            $('#milestone_time_type_select').val(taskObj.task_milestone_time_type);
            $('#milestone_time_type_select').selectpicker('refresh');
            $('#milestone_time_value').val(taskObj.task_milestone_time);
        }

        function editTaskflowChanges(taskflowId){
            var formData = new FormData();

            let taskflowCode   = $('#taskflowCode').val();
            let taskflowName   = $('#taskflowName').val();
            let taskflowStatus = (document.getElementById('taskflowStatus').checked) ? 1 : 0;

            formData.append('taskflowId', taskflowId);
            formData.append('taskflowCode', taskflowCode);
            formData.append('taskflowName', taskflowName);
            formData.append('taskflowStatus', taskflowStatus);

            if(taskflowCode != '' && taskflowName != ''){

                Swal.fire({
                    title: "Do you want to save the changes?",
                    text: "This will update the Taskflow details",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes!"
                }).then(function(result) {
                    
                    if (result.value) {
                        $.ajax(
                        {
                            url:"{{ route('editTaskFlow')}}", 
                            method:"POST",
                            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                            data: formData,
                            cache : false,
                            processData: false,
                            contentType: false,
                            dataType:'json',
                            success:function(data)
                            {
                                if(data.status ){
                                    toastr.success(data.msg,data.title);
                                    renderEditedTaskflowDetails(data.taskflow)
                                    $('#editTaskFlowModal').modal('hide');
                                }
                                else{
                                    toastr.error(data.msg,data.title);
                                }
                            }
                        }); 
                    
                    }
                });
            }else{
                toastr.warning('Please fill both Taskflow Code & Taskflow Name to complete the proceedings', 'Attention')
            }
        }

        function editTaskChanges(){
            var formData = new FormData();

            let taskName        = $('#taskName').val();
            let taskResponsible = $('#designation_select').val();
            let taskTimeSelect  = $('#milestone_time_type_select').val();
            let taskTimeVal     = $('#milestone_time_value').val();

            formData.append('taskId', editTaskId);
            formData.append('taskName', taskName);
            formData.append('taskResponsible', taskResponsible);
            formData.append('taskTimeSelect', taskTimeSelect);
            formData.append('taskTimeVal', taskTimeVal);

            if(taskName != '' && taskResponsible != '' && taskTimeVal != ''){
                Swal.fire({
                    title: "Do you want to save the changes?",
                    text: "This will update the Task details",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes!"
                }).then(function(result) {
                    
                    if (result.value) {
                        $.ajax(
                        {
                            url:"{{ route('editTask')}}", 
                            method:"POST",
                            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                            data: formData,
                            cache : false,
                            processData: false,
                            contentType: false,
                            dataType:'json',
                            success:function(data)
                            {
                                if(data.status ){
                                    toastr.success(data.msg,data.title);
                                    let desigName = data.designationName[0].designation_name;
                                    renderEditedTaskDetails(data.task,desigName,editTaskId)
                                    $('#editTaskModal').modal('hide');
                                }
                                else{
                                    toastr.error(data.msg,data.title);
                                }
                            }
                        }); 
                    
                    }
                });
            }else{
                toastr.warning('Please fill all the required fields to complete the proceedings', 'Attention')
            }
            

        }

        function addTask(taskfId){
            var formData = new FormData();

            let setpNum         = newStepNum;
            let taskName        = $('#addNewTaskName').val();
            let taskResponsible = $('#add_new_designation_select').val();
            let taskTimeSelect  = $('#add_new_milestone_time_type_select').val();
            let taskTimeVal     = $('#add_new_milestone_time_value').val();

            formData.append('taskflowId', taskfId);
            formData.append('setpNum', setpNum);
            formData.append('taskName', taskName);
            formData.append('taskResponsible', taskResponsible);
            formData.append('taskTimeSelect', taskTimeSelect);
            formData.append('taskTimeVal', taskTimeVal);

            if(taskName != '' && taskResponsible != '' && taskTimeVal != ''){
                Swal.fire({
                    title: "Do you want to add a new task to the taskflow?",
                    text: "This action will add a new task to the taskflow",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes!"
                }).then(function(result) {
                    
                    if (result.value) {
                        $.ajax(
                        {
                            url:"{{ route('addNewTask')}}", 
                            method:"POST",
                            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                            data: formData,
                            cache : false,
                            processData: false,
                            contentType: false,
                            dataType:'json',
                            success:function(data)
                            {
                                if(data.status ){
                                    toastr.success(data.msg,data.title);
                                    renderNewlyAddedTask(data.task,data.viewingCount)
                                    $('#addNewTaskModal').modal('hide');
                                }
                                else{
                                    toastr.error(data.msg,data.title);
                                }
                            }
                        }); 
                    
                    }
                });
            }else{
                toastr.warning('Please fill all the required fields to complete the proceedings', 'Attention')
            }
        }

        function renderEditedTaskflowDetails(taskflowObj){
            document.querySelector('#edit-taskflow-code').innerHTML = taskflowObj.task_flow_code
            document.querySelector('#edit-taskflow-name').innerHTML = taskflowObj.task_flow_name
            let statusText = $('#edit-taskflow-status');

            switch ( taskflowObj.taskflow_status) {
            case '0':
                statusText.html('Inactive')
                statusText.removeClass('text-success text-danger').addClass('text-warning') 
                break;
            case '1':
                statusText.html('Active')
                statusText.removeClass('text-warning text-danger').addClass('text-success')  
                break;
            case '2':
                statusText.html('Deleted')
                statusText.removeClass('text-success text-warning').addClass('text-danger') 
                break;
            default:
            }
            
        }

        async function renderEditedTaskDetails(taskObj,designationName,editedTaskId){
            $('#edit_task_name_'+ editedTaskId).html(taskObj.task_name)
            $('#edit_task_responsible_'+ editedTaskId).html(designationName)
            console.log(taskObj.designationName)
            let editedTime = `${taskObj.task_milestone_time} ${taskObj.task_milestone_time_type}`
            $('#edit_milestone_time_'+ editedTaskId).html(editedTime)
            
        }

        function deleteTask(taskId){
            var formData = new FormData();
            formData.append('taskId', taskId);
            Swal.fire({
                    title: "Do you want to delete this task from the Taskflow?",
                    text: "This action will delete the selected task permanantly from the system",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, Delete Task!"
                }).then(function(result) {
                    
                    if (result.value) {
                        $.ajax(
                        {
                            url:"{{ route('deleteTask')}}", 
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
                                    location.reload();
                                }
                                else{
                                    toastr.error(data.msg,data.title);
                                }
                            }
                        }); 
                    
                    }
                });
        }

        function renderNewlyAddedTask(taskObj, viewingCount){
            let output = '';

            output += `
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-custom mb-5">
                        <div class="card-body ribbon ribbon-top ribbon-ver pb-3">
                            <div class="ribbon-target bg-danger font-weight-bolder h2" style="top: -2px; right: 20px;">${viewingCount}</div>
                            <h4 class="card-title text-muted font-weight-light">
                                Task name - <span class="font-weight-bolder text-dark-65" id="edit_task_name_${taskObj.task_id}"> &nbsp; ${taskObj.task_name}</span> 
                            </h4>
                            <div class="row d-flex justify-content-around">
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40 symbol-light-warning flex-shrink-0">
                                            <span class="symbol-label font-size-h4 font-weight-bold"><i class="fas fa-user-alt icon-md"></i></span>
                                        </div>
                                        <div class="ml-4">
                                            <h2 class="text-dark-75 font-weight-bolder font-size-lg mb-0" id="edit_task_responsible_${taskObj.task_id}">${taskObj.designation.designation_name}</h2>
                                            <a href="#" class="text-muted font-weight-bold text-hover-primary">Responsible Designation</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40 symbol-light-success flex-shrink-0">
                                            <span class="symbol-label font-size-h4 font-weight-bold"><i class="fas fa-hourglass-end icon-md"></i></span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-dark-75 font-weight-bolder font-size-lg mb-0" id="edit_milestone_time_${taskObj.task_id}"> ${taskObj.task_milestone_time} ${taskObj.task_milestone_time_type}</div>
                                            <a href="#" class="text-muted font-weight-bold text-hover-primary">Milestone Time</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex mt-5 border-top pt-3">
                                <button type="button" class="btn btn-light-primary btn-pill mx-2" onclick="showEditTaskModal(${taskObj.task_id})">
                                    <i class="far fa-edit"></i> Edit 
                                </button>
                                <button type="button" class="btn btn-light-danger btn-pill" onclick="deleteTask(${taskObj.task_id})">
                                    <i class="far fa-trash-alt"></i> Delete 
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            `;

            $('#task-container').append(output);

        }
        
    </script>
@endsection
