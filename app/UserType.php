<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    //Localization
    protected $table      = 'roles';
    protected $primaryKey = 'id';
}
