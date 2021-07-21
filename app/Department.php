<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    
    //Localization
    protected $table      = 'departments';
    protected $primaryKey = 'depart_id';

    const CREATED_AT = 'department_created_at';
    const UPDATED_AT = 'department_updated_at';

    //Relationships
    public function user()
    {
        return $this->hasMany('App\User', 'depart_id', 'depart_id');
    }

    public static function fetchAllDepartments(){
        $departments = Department::all();

        return $departments;
    }

    public static function getDepName($depId){
        return DB::table('departments')->where('depart_id', $depId)->value('depart_name');
    }
}
