<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class VrUsers extends Authenticatable
{

    use Notifiable;

    use SoftDeletes;

    public $incrementing = false;
    /**
     * $table name DataBases
     */
    protected $table = 'vr_users';

    /**
     * $fillable is table 'vr_users' fields
     */

    protected $fillable = ['id', 'name', 'email', 'password', 'phone', 'remember_token'];

}
