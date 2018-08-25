<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Storekeeper extends Model
{
    public $timestamps      = false;
    protected $fillable     = ['email','password'];

    protected $table        = "storekeeper";
    protected $primaryKey   = 'id_user';
}
