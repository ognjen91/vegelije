<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

    public function products(){
      return $this->hasMany(Product::class);
    }

    public function productGroups(){
      return $this->hasMany(ProductGroup::class);
    }


    public function roles(){
      return $this->belongsToMany(Role::class); //preko user_role pivot-a
    }

    // provjerava za array ili string uloga, da li ih user ima

        public function hasAnyRole($roles){
          if (is_array($roles)){ //unesen je array
            foreach ($roles as $role) {
              if ($this->hasRole($role)) return true;
            }
          } else { //unesen je string
              if ($this->hasRole($roles)) return true;
          }
          return false;
        }


    //pomocna fja za hasAnyRole, refaktorizacijom
        public function hasRole($role){
          if ($this->roles()->where('name', $role)->first()) return true;
          return false;
        }
}
