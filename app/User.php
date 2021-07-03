<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $table      = 'users';
    protected $primaryKey = 'id';

    const CREATED_AT = 'user_created_at';
    const UPDATED_AT = 'user_updated_at';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relationships
    public function designation()
    {
        return $this->belongsTo( Designation::class, 'designation_id', 'designation_id');
    }
    
    //Relationships
    public function department()
    {
        return $this->belongsTo( Department::class, 'depart_id', 'depart_id');
    }

    public static function fecthUsersToDataTbl(){
        
        $users = User::with(['department','designation'])->get();
        return $users;
    }
 
}
