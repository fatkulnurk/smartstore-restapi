<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public $timestamps      = false;
    protected $fillable     = ['material_id','material_name','qty'];

    protected $table        = "material";
//    protected $primaryKey   = 'id_user';
}
