<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    //Localization
    protected $table      = 'tasks';
    protected $primaryKey = 'task_id';

    const CREATED_AT = 'task_created_at';
    const UPDATED_AT = 'task_updated_at';

    //Relationships
    public function taskFlow()
    {
        return $this->belongsTo( TaskFlow::class, 'taskflow_id', 'taskflow_id');
    }
    
    public function designation()
    {
        return $this->belongsTo( Designation::class, 'designation_id', 'designation_id');
    }
}
