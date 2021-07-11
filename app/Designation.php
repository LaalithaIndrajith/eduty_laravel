<?php

namespace App;

use App\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Designation extends Model
{
    use HasFactory;

    //Localization
    protected $table      = 'designations';
    protected $primaryKey = 'designation_id';

    const CREATED_AT = 'designation_created_at';
    const UPDATED_AT = 'designation_updated_at';

    //Relationships
    public function user()
    {
        return $this->hasMany('App\User', 'designation_id', 'designation_id');
    }
    
    public function department()
    {
        return $this->belongsTo( Department::class, 'depart_id', 'depart_id');
    }

    public static function fetchAllDesignations(){
        $departments = Designation::all();

        return $departments;
    }
}
