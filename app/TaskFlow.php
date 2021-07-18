<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskFlow extends Model
{
    use HasFactory;

    //Localization
    protected $table      = 'taskflows';
    protected $primaryKey = 'taskflow_id';

    const CREATED_AT = 'taskflow_created_at';
    const UPDATED_AT = 'taskflow_updated_at';

    //Relationships
    public function tasks()
    {
        return $this->hasMany(Task::class, 'taskflow_id', 'taskflow_id');
    }
    
    public function department()
    {
        return $this->belongsTo( Department::class, 'depart_id', 'depart_id');
    }

    //many to many relationship with client
    public function client()
    {
        return $this->belongsToMany(Client::class, 'clients_has_taskflows', 'taskflow_id', 'client_id')->using('App\Clients_Has_Taskflows');
    }

    public static function getAllTaskflows(){
        $taskflows = TaskFlow::with(['department','tasks'])->where('taskflow_status', 1)->get();
        return $taskflows;
    }
}
