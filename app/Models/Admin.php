<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable implements LaratrustUser
{
    use  HasFactory, Notifiable,HasRolesAndPermissions;

    protected $fillable=['first_name','last_name', 'email', 'username', 'password', 'phone_number', 'super_admin', 'status'];
}
