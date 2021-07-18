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

}
