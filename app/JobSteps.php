<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSteps extends Model
{
    use HasFactory;

    protected $table = 'job_task_steps';
    protected $primaryKey = 'job_task_step_id';
    const CREATED_AT  = 'email_entry_created_at';
    const UPDATED_AT = 'email_entry_updated_at';

    //Relationships
    public function job()
    {
        return $this->belongsTo(Clients_Has_Taskflows::class, 'job_allocation_id', 'job_task_step_id');
    }
}
