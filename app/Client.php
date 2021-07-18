<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    //Localization
    protected $table      = 'clients';
    protected $primaryKey = 'client_id';

    const CREATED_AT = 'client_created_at';
    const UPDATED_AT = 'client_updated_at';

    //many to many relationship with taskflow
    public function taskflow()
    {
        return $this->belongsToMany(TaskFlow::class, 'clients_has_taskflows', 'client_id', 'taskflow_id')->withPivot('job_allocation_id')->using('App\Clients_Has_Taskflows');
    }

    public static function getAllClients(){
        $clients = Client::where('client_status',1)->get();
        return $clients;
    }
}
