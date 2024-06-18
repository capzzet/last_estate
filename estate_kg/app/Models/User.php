<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use TCG\Voyager\Contracts\User as VoyagerUser;
use TCG\Voyager\Traits\VoyagerUser as VoyagerUserTrait;

class User extends \TCG\Voyager\Models\User implements VoyagerUser
{
    use Notifiable, VoyagerUserTrait;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('TCG\Voyager\Models\Role');
    }

    public function hasPermission($permission)
    {
        return $this->role && $this->role->permissions->contains('key', $permission);
    }

    public function hasRole($role)
    {
        return $this->role && $this->role->name == $role;
    }

    public function setRole($role)
    {
        $this->role()->associate($role);
        return $this;
    }
}
