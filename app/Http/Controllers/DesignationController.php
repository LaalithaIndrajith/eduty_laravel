<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use App\Department;
use App\Designation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DesignationController extends Controller
{
    public function index(){
        $departments = Department::fetchAllDepartments();
        $page_breadcrumbs = [
            'main_module' =>  [   
                'title' => 'Masters',
                'page' => '#',
            ],
            'sub_module' =>  [   
                'title' => 'Designations',
                'page' => '#',
            ],
        ];

        $page_title = 'Create Designation';
        $page_description = 'Create a Designation';

        return view('pages.designations.create_designation', compact('page_title','page_breadcrumbs','departments'));
    }

    public function viewDesignationForEdit($desigtId){
        $departments = Department::fetchAllDepartments();
        $designation = Designation::find($desigtId);
        $page_breadcrumbs = [
            'main_module' =>  [   
                'title' => 'Masters',
                'page' => '#',
            ],
            'sub_module' =>  [   
                'title' => 'Designations',
                'page' => '#',
            ],
        ];

        $page_title = 'Edit Designation';

        $designation = Designation::find($desigtId);
        return view('pages.designations.edit_designation', compact('page_title','page_breadcrumbs','departments','designation'));
    }

    public function viewDesignationList(){
        $page_breadcrumbs = [
            'main_module' =>  [   
                'title' => 'Masters',
                'page' => '#',
            ],
            'sub_module' =>  [   
                'title' => 'Designations',
                'page' => '#',
            ],
        ];

        $page_title       = 'Designation Details';
        $page_description = 'Infromations of all the Departments';

        return view('pages.designations.designations_list', compact('page_title','page_breadcrumbs',));
    }

    public function fetchDesignationsToDrawTbl(){
        $designations = Designation::with(['department'])->get();
        $data = array();
        foreach($designations as $designation){
            $d = array();
            $d['depName'] = $designation->department->depart_name;
            $d['desigDetails'] = array(
                'code' => $designation->designation_code,
                'name'   => $designation->designation_name,
            );
            $d['createdDetails'] =  array(
                'createdAt' => $designation->designation_created_at,
                'createdBy' => User::getUsername($designation->designation_created_by),
            );
            $d['lastModifiesDetails'] =  array(
                'updatedAt' => $designation->designation_updated_at,
                'updatedBy' => User::getUsername($designation->designation_updated_by),
            );
            $d['status'] = $designation->designation_status;
            $d['desigId']     = $designation->designation_id;
            array_push($data, $d);
        }

        return ['data' => $data];
    }

    public function createDesignation(Request $request){
        try{
            $this->validateDesignationForm($request);
            $designation = new Designation;
            $this->storeDesignationDetails($request, $designation);
            $designation->designation_created_by = auth()->user()->id;
            $designation->designation_updated_by = auth()->user()->id;
            $designation->save();
            $designationCreation = [
                'msg' =>  'Designation is created successfully',
                'title' => 'Designation Creation',
                'status' =>  1,
            ];

            $request->session()->flash('designationCreation', $designationCreation);    
        }catch(Exception $e){
            $designationCreation = [
                'msg' =>  'Designation creation is unsuccessful',
                'title' => 'Designation Creation',
                'status' =>  0,
            ];

            $request->session()->flash('designationCreation', $designationCreation); 
        }
        return redirect()->route('designationCreationView');
    }

    public function editDesignation(Request $request, $desigId){
        try{
            $this->validateDesignationForm($request);
            $designation = Designation::find($desigId);
            $this->storeDesignationDetails($request, $designation);
            $designation->designation_updated_by = auth()->user()->id;
            $designation->save();
            $designationEdit = [
                'msg' =>  'Designation details updated successfully',
                'title' => 'Designation Details Update',
                'status' =>  1,
            ];

            $request->session()->flash('designationEdit', $designationEdit);    
        }catch(Exception $e){
            $designationEdit = [
                'msg' =>  'Designation details update is unsuccessful',
                'title' => 'Designation Details Update',
                'status' =>  0,
            ];

            $request->session()->flash('designationEdit', $designationEdit); 
        }
        return redirect()->route('designationEditView', $desigId);
    }

    private function validateDesignationForm(Request $request){
        
        $request->validate([
            'department_select'     => 'required',
            'desig_code'    => 'required|max:50',
            'desig_name'     => 'required|max:100',
        ]);
    }

    private function storeDesignationDetails(Request $request, $designation){
        $designation->depart_id          = $request->department_select;
        $designation->designation_code   = Str::upper($request->desig_code);
        $designation->designation_name   = Str::upper($request->desig_name);
        $designation->designation_status = isset($request->desig_status) ? 1 : 0;
    }

    public function fetchDesignationsOfDep(){
        $departmentId = $_POST['departmentId'];
        $designations = Designation::fetchDesignations($departmentId);
        $data = array();
        if($designations->isEmpty()){
            $data = [
                'exsits' => false,
            ];
        }else{
            $data = [
                'exsits' => true,
                'designations' => $designations,
            ];
        }
        return $data;
    }
}
