<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AccountRequest extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'roles_id',
        'last_name',
        'birthdate',
        'address',
        'valid_id',
        'email',
        'phone_number',
        'password',
    ];

    public function setRolesID($roles)
    {
        return 1;
    }

}
