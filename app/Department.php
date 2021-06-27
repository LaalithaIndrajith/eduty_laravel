<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
