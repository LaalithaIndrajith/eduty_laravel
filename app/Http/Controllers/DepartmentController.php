<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use App\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index(){
        $page_breadcrumbs = [
            'main_module' =>  [   
                'title' => 'Masters',
                'page' => '#',
            ],
            'sub_module' =>  [   
                'title' => 'Departments',
                'page' => '#',
            ],
        ];

        $page_title = 'Create Department';
        $page_description = 'Create a Department';

        return view('pages.departments.create_department', compact('page_title','page_breadcrumbs',));
    }

    public function viewDepartmentForEdit($departId){
        $department = Department::find($departId);
        $page_breadcrumbs = [
            'main_module' =>  [   
                'title' => 'Masters',
                'page' => '#',
            ],
            'sub_module' =>  [   
                'title' => 'Departments',
                'page' => '#',
            ],
        ];

        $page_title = 'Edit Department';

        return view('pages.departments.edit_department', compact('page_title','page_breadcrumbs','department'));
    }

    public function viewDepartmentList(){
        $page_breadcrumbs = [
            'main_module' =>  [   
                'title' => 'Masters',
                'page' => '#',
            ],
            'sub_module' =>  [   
                'title' => 'Departments',
                'page' => '#',
            ],
        ];

        $page_title       = 'Department Details';
        $page_description = 'Infromations of all the Departments';

        return view('pages.departments.department_list', compact('page_title','page_breadcrumbs',));
    }

    public function createDepartment(Request $request){
        try{
            $this->validateDepartmentForm($request);
            $department = new Department;
            $this->storeDepartmentDetails($request, $department);
            $department->department_created_by = auth()->user()->id;
            $department->department_updated_by = auth()->user()->id;
            $department->save();
            $departmentCreation = [
                'msg' =>  'Department Created Successfully',
                'title' => 'Department Creation',
                'status' =>  1,
            ];

            $request->session()->flash('departmentCreation', $departmentCreation);    
        }catch(Exception $e){
            $departmentCreation = [
                'msg' =>  'Department Creation is unsuccessful',
                'title' => 'Department Creation',
                'status' =>  0,
            ];

            $request->session()->flash('departmentCreation', $departmentCreation); 
        }
        return redirect()->route('departmentCreationView');
    }

    public function editDepartment(Request $request, $departId){
        try{
            $this->validateDepartmentForm($request);
            $department = Department::find($departId);
            $this->storeDepartmentDetails($request, $department);
            $department->department_updated_by = auth()->user()->id;
            $department->save();
            $departmentEdit = [
                'msg' =>  'Department details updated successfully',
                'title' => 'Department Details Update',
                'status' =>  1,
            ];

            $request->session()->flash('departmentEdit', $departmentEdit);    
        }catch(Exception $e){
            $departmentEdit = [
                'msg' =>  'Department details update is unsuccessful',
                'title' => 'Department Details Update',
                'status' =>  0,
            ];

            $request->session()->flash('departmentEdit', $departmentEdit); 
        }
        return redirect()->route('departmentEditView', $departId);
    }

    private function validateDepartmentForm(Request $request){
        
        $request->validate([
            'dep_code'    => 'required|max:50',
            'dep_name'     => 'required|max:100',
            'dep_address'       => 'required|max:255',
            'dep_telephone'     => 'required',
            'dep_mail'              => 'required|email',
        ]);
    }

    private function storeDepartmentDetails(Request $request, $department){
        $department->depart_code        = Str::upper($request->dep_code);
        $department->depart_name        = Str::upper($request->dep_name);
        $department->department_address = Str::upper($request->dep_address);
        $department->department_hotline = $request->dep_telephone;
        $department->department_fax     = $request->dep_fax;
        $department->department_email   = Str::lower($request->dep_mail);
        $department->department_status  = isset($request->dep_status) ? 1 : 0;
    }

    public function fetchDepartmentsToDrawTbl(){
        $departments = DB::table('departments')->get();
        $data = array();
        foreach($departments as $department){
            $d = array();
            $d['depDetails'] = array(
                'depCode' => $department->depart_code,
                'depName'   => $department->depart_name,
            );
            $d['contactDetails'] = array(
                'hotline' => $department->department_hotline,
                'email'   => $department->department_email,
            );
            $d['createdDetails'] =  array(
                'createdAt' => $department->department_created_at,
                'createdBy' => User::getUsername($department->department_created_by),
            );
            $d['lastModifiesDetails'] =  array(
                'updatedAt' => $department->department_updated_at,
                'updatedBy' => User::getUsername($department->department_updated_by),
            );
            $d['status'] = $department->department_status;
            $d['departId']     = $department->depart_id;
            array_push($data, $d);
        }

        return ['data' => $data];
    }
}
