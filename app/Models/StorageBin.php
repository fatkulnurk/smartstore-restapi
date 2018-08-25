<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorageBin extends Model
{
    public $timestamps      = false;
    protected $fillable     = ['code_company','code_rack','code_box'];

    protected $table        = "storage_bin";
//    protected $primaryKey   = 'id_user';
}
