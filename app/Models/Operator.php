<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    public $timestamps      = false;
    protected $fillable     = ['op_nb','work_center'];

    protected $table        = "operator";
//    protected $primaryKey   = 'id_user';
}
