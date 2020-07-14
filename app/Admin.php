<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password'
    ];
    /**
 * The attributes that should be hidden for arrays.
 *
 * @var array
*/
protected $hidden = [
    'password', 'remember_token',
];

}
