{{-- Extends layout --}}
@extends('layout.default')

@section('content')
    
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label"> Monthly Report - Job Tickets Overview
                        <span class="d-block text-muted pt-2 font-size-sm">Dsipalys Overall Overview of the Job Tickets for the Selected Month</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                   
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-12 border-right">
                        <form method="POST" id="add-new-user-type-form" action="{{ route('createUserType') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row d-flex justify-content-start">
                             <div class="col-lg-8 form-group">
                                 <label class="form-label col-form-label">Select Month<span class="text-danger">*</span></label>
                                 <div class="input-group date" id="report_month_select" data-target-input="nearest">
                                    <input type="text" name="report_month_select" class="form-control datetimepicker-input" placeholder="Select Month" 
                                    data-target="#report_month_select"/>
                                    <div class="input-group-append" data-target="#report_month_select" data-toggle="datetimepicker">
                                        <span class="input-group-text">
                                            <i class="ki ki-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                             </div>
                            
                         </div>
                         <div class="row d-flex justify-content-start">
                            <div class="col-lg-8 form-group text-center">
                                <!--begin::Button-->
                                <label class="form-label col-form-label"></label>
                                <button type="button" class="btn btn-primary font-weight-bolder" onclick="generateMonthlyOverviewJobTickets()">
                                    <span class="svg-icon svg-icon-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>Generate Report
                                </button>
                                <!--end::Button-->
                             </div>
                         </div>
                        </form>
                    </div>
                    <div class="col-lg-8 col-12 pl-10">
                        <div class="row d-flex justify-content-around align-items-center">
                            <div class="col-lg-4">
                                <div class="row mb-3">
                                    <div class="col-lg-12">
                                        <div class="d-flex align-items-center justify-content-around mr-10">
                                            <div class="mr-6">
                                                <div class="font-weight-bold mb-2">Start Date</div>
                                                <span class="btn btn-sm btn-text btn-light-primary text-uppercase font-weight-bold">07 May, 2020</span>
                                            </div>
                                            <div class="">
                                                <div class="font-weight-bold mb-2">End Date</div>
                                                <span class="btn btn-sm btn-text btn-light-danger text-uppercase font-weight-bold">10 June, 2021</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                        <a href="#" class="text-dark font-weight-bolder text-center font-size-h5">Total Job Tickets Issued
                                        </a>
                                        <div class="text-primary text-center">
                                            <h1 class="display-2 font-weight-bolder" id="total-activated-users">3</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <span class="svg-icon svg-icon-3x svg-icon-success">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M12,21 C7.581722,21 4,17.418278 4,13 C4,8.581722 7.581722,5 12,5 C16.418278,5 20,8.581722 20,13 C20,17.418278 16.418278,21 12,21 Z" fill="#000000" opacity="0.3"/>
                                                    <path d="M13,5.06189375 C12.6724058,5.02104333 12.3386603,5 12,5 C11.6613397,5 11.3275942,5.02104333 11,5.06189375 L11,4 L10,4 C9.44771525,4 9,3.55228475 9,3 C9,2.44771525 9.44771525,2 10,2 L14,2 C14.5522847,2 15,2.44771525 15,3 C15,3.55228475 14.5522847,4 14,4 L13,4 L13,5.06189375 Z" fill="#000000"/>
                                                    <path d="M16.7099142,6.53272645 L17.5355339,5.70710678 C17.9260582,5.31658249 18.5592232,5.31658249 18.9497475,5.70710678 C19.3402718,6.09763107 19.3402718,6.73079605 18.9497475,7.12132034 L18.1671361,7.90393167 C17.7407802,7.38854954 17.251061,6.92750259 16.7099142,6.53272645 Z" fill="#000000"/>
                                                    <path d="M11.9630156,7.5 L12.0369844,7.5 C12.2982526,7.5 12.5154733,7.70115317 12.5355117,7.96165175 L12.9585886,13.4616518 C12.9797677,13.7369807 12.7737386,13.9773481 12.4984096,13.9985272 C12.4856504,13.9995087 12.4728582,14 12.4600614,14 L11.5399386,14 C11.2637963,14 11.0399386,13.7761424 11.0399386,13.5 C11.0399386,13.4872031 11.0404299,13.4744109 11.0414114,13.4616518 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" fill="#000000"/>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <div class="text-dark font-weight-bolder font-size-h2 mt-3">234</div>
                                        <a href="#" class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">Job Tickets</a>
                                    </div>
                                    <div class="col-lg-8">
                                        <span class="font-weight-bold">Ahead Of Scheduled</span>
                                        <div class="progress progress-xs mt-2 mb-2">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 63%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="font-weight-bolder text-dark">78%</span>
                                    </div>
                                    <div class="flex-grow-1 flex-shrink-0 w-150px w-xl-300px mt-4 mt-sm-0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <span class="svg-icon svg-icon-3x svg-icon-danger">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M12,21 C7.581722,21 4,17.418278 4,13 C4,8.581722 7.581722,5 12,5 C16.418278,5 20,8.581722 20,13 C20,17.418278 16.418278,21 12,21 Z" fill="#000000" opacity="0.3"/>
                                                    <path d="M13,5.06189375 C12.6724058,5.02104333 12.3386603,5 12,5 C11.6613397,5 11.3275942,5.02104333 11,5.06189375 L11,4 L10,4 C9.44771525,4 9,3.55228475 9,3 C9,2.44771525 9.44771525,2 10,2 L14,2 C14.5522847,2 15,2.44771525 15,3 C15,3.55228475 14.5522847,4 14,4 L13,4 L13,5.06189375 Z" fill="#000000"/>
                                                    <path d="M16.7099142,6.53272645 L17.5355339,5.70710678 C17.9260582,5.31658249 18.5592232,5.31658249 18.9497475,5.70710678 C19.3402718,6.09763107 19.3402718,6.73079605 18.9497475,7.12132034 L18.1671361,7.90393167 C17.7407802,7.38854954 17.251061,6.92750259 16.7099142,6.53272645 Z" fill="#000000"/>
                                                    <path d="M11.9630156,7.5 L12.0369844,7.5 C12.2982526,7.5 12.5154733,7.70115317 12.5355117,7.96165175 L12.9585886,13.4616518 C12.9797677,13.7369807 12.7737386,13.9773481 12.4984096,13.9985272 C12.4856504,13.9995087 12.4728582,14 12.4600614,14 L11.5399386,14 C11.2637963,14 11.0399386,13.7761424 11.0399386,13.5 C11.0399386,13.4872031 11.0404299,13.4744109 11.0414114,13.4616518 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" fill="#000000"/>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <div class="text-dark font-weight-bolder font-size-h2 mt-3">234</div>
                                        <a href="#" class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">Job Tickets</a>
                                    </div>
                                    <div class="col-lg-10">
                                        <span class="font-weight-bold">Behind Scheduled</span>
                                        <div class="progress progress-xs mt-2 mb-2">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 37%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="font-weight-bolder text-dark">37%</span>
                                    </div>
                                    <div class="flex-grow-1 flex-shrink-0 w-150px w-xl-300px mt-4 mt-sm-0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-custom mt-8">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label"> Details 
                        <span class="d-block text-muted pt-2 font-size-sm">Dsipalys Overall Stats of Branches</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                   
                </div>
            </div>
            
            <div class="car-body py-10">
                <table class="table table-separate table-head-custom collapsed" id="overall-dep-details">
                    <thead>
                        <tr>
                            <th class="text-center">Department</th>
                            <th class="text-center">Total Job Tickets</th>
                            <th class="text-center">Ahead of Scheduled</th>
                            <th class="text-center">Behind Scheduled</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                </table>
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

        $(document).ready(function(){
            // drawUserTypeListTable()
            $('#report_month_select').datetimepicker({
                format: 'YYYY-MMMM',
            });
        });

        // $('#report_month_select').timepicker().on('hide.timepicker', function(e) {
        //     resetOnAppointTime();
        //     let appointTime = moment(e.time.value,'HH:mm A').format('HH:mm:00');
        //     let appointDate = $('#appoint_date').find('input').val();
        //     fetchAvailableStaff(appointDate,appointTime,appointDura)
        // });


        // let appointTime = moment(e.time.value,'HH:mm A').format('HH:mm:00');
        function generateMonthlyOverviewJobTickets(){
            let selectedMonth = $("#report_month_select").data("datetimepicker")._datesFormatted[0]
            let startOfMonth = moment(selectedMonth, 'YYYY-MM-DD');
            let endOfMonth = startOfMonth.endOf('month').format('YYYY-MM-DD');
             
            console.log(selectedMonth,startOfMonth,endOfMonth);
        }

        async function drawUserTypeListTable(){
            let retrivedTblData = await $.ajax(
            {
                url:'{{ route('fetchUserTypesToDrawTbl')}}',
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

            initializeUserTypesTbl(retrivedTblData);

        }

    </script>
@endsection