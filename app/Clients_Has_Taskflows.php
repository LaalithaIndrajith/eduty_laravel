<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Clients_Has_Taskflows extends Pivot
{
    use HasFactory;

    public $incrementing = true;
    protected $table = 'clients_has_taskflows';
    protected $primaryKey = 'job_allocation_id';

    public function steps()
    {
        return $this->hasMany(JobSteps::class, 'job_allocation_id', 'job_allocation_id');
    }
}
