<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AccessController extends Controller
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

        $userTypes = Role::all();
        $permissions = DB::table('permissions')->get();

        $page_title = 'Manage Authorization';

        return view('pages.configurations.access_control.create_access_controller', compact('page_title','page_breadcrumbs','userTypes', 'permissions'));
    }

    public function grantPermission(Request $request){
        try{

            $userTypeId = $request->user_type_select;
            $permissionId = $request->permission_select;
            $role = Role::findById($userTypeId);
            $permission = Permission::findById($permissionId);
            if($this->checkRoleHasPermission($permissionId, $userTypeId)){
                return [
                    'msg' =>  'Permission is already granted for the seleted User Type',
                    'title' => 'Authorization',
                    'status' =>  false,];    
            }
    
            $role->givePermissionTo($permission);
            return [
                'msg' =>  'Permission Granted Successfully for the Selected User Type',
                'title' => 'Authorization',
                'status' =>  true,];

        }catch(Exception $e){
            return [
                'msg' =>  $e->getMessage(),
                'title' => 'Authorization',
                'status' =>  false,];
        }
    }

    private function checkRoleHasPermission($permissionId, $roleId){
        return DB::table('role_has_permissions')->where('permission_id', $permissionId)->where('role_id', $roleId)->exists();
    }

    public function fetchRolesPermissionsToDrawTbl(){
        $results = DB::table('role_has_permissions')
        ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
        ->select('role_has_permissions.role_id', 'role_has_permissions.permission_id','permissions.name')
        ->get();
        
        $data = array();
        foreach($results as $result){
            $d = array();
            $d['userTypeName']   = $this->getUserTypeName($result->role_id);
            $d['permissionName'] = $result->name;
            $d['deleteIds'] = array(
                'userTypeId' => $result->role_id,
                'permissionId' => $result->permission_id,
            );
            array_push($data, $d);
        }

        return ['data' => $data];
    }

    private function getUserTypeName($userTypeId){
        return DB::table('roles')->where('id',$userTypeId)->value('name');
    }

    public function revokePermission(Request $request){
        try{
            $userTypeId   = $_POST['userTypeId'];
            $permissionId = $_POST['permissionId'];
    
            $role = Role::findById($userTypeId);
            $permission = Permission::findById($permissionId);
    
            $role->revokePermissionTo($permission);

            return [
                'msg' =>  'Permission revoked successfully from the selected User type',
                'title' => 'Authorization',
                'status' =>  true,];

        }catch(Exception $e){
            return [
                'msg' =>  'Permission revoke is unsuccessful',
                'title' => 'Authorization',
                'status' =>  false,];
        }
    }
}
