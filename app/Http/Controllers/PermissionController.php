<?php

namespace App\Http\Controllers;

use App\PermissionModel;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index(){
        $page_breadcrumbs = [
            'main_module' =>  [   
                'title' => 'Configurations',
                'page' => '#',
            ],
            'sub_module' =>  [   
                'title' => 'Access & Permissions',
                'page' => '#',
            ],
        ];

        $page_title = 'Create Permission';

        return view('pages.configurations.permissions.create_permission', compact('page_title','page_breadcrumbs'));
    }
    
    public function viewPermissionForEdit($id){
        $permission = Permission::findById($id);
        $page_breadcrumbs = [
            'main_module' =>  [   
                'title' => 'Configurations',
                'page' => '#',
            ],
            'sub_module' =>  [   
                'title' => 'Access & Permissions',
                'page' => '#',
            ],
        ];

        $page_title = 'Edit Permission';

        return view('pages.configurations.permissions.edit_permission', compact('page_title','page_breadcrumbs','permission'));
    }

    public function createPermission(Request $request){
        try{
            Permission::create(['name' =>  $request->permission_name]);
            $permissionCreation = [
                'msg' =>  'Permission Created Successfully',
                'title' => 'Permission Creation',
                'status' =>  1,
            ];

            $request->session()->flash('permissionCreation', $permissionCreation);

        }catch(Exception $e){
            $permissionCreation = [
                'msg' =>  $e->getMessage(),
                'title' => 'Permission Creation is unsuccessful',
                'status' =>  0,
            ];

            $request->session()->flash('permissionCreation', $permissionCreation);
        }
        return redirect()->route('PermissionCreationView');
    }

    public function editPermission(Request $request, $id){
        try{
            $permission = PermissionModel::find($id);
            $permission->name = $request->permission_name;
            $permission->save();
            $permissionEdit = [
                'msg' =>  'Permission updated Successfully',
                'title' => 'Permission Creation',
                'status' =>  1,
            ];

            $request->session()->flash('permissionEdit', $permissionEdit);

        }catch(Exception $e){
            $permissionEdit = [
                'msg' =>  $e->getMessage(),
                'title' => 'Permission update is unsuccessful',
                'status' =>  0,
            ];

            $request->session()->flash('permissionEdit', $permissionEdit);
        }
        return redirect()->route('PermissionCreationView');
    }

    public function fetchPermissionsToDrawTbl(){
        $permissions = DB::table('permissions')->get();
        $data = array();
        foreach($permissions as $permission){
            $d = array();
            $d['permissionName'] = $permission->name;
            $d['createdAt']    = $permission->created_at;
            $d['updatedAt']    = $permission->updated_at;
            $d['id']           = $permission->id;
            array_push($data, $d);
        }

        return ['data' => $data];
      
    }
}
