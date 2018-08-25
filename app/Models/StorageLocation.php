<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorageLocation extends Model
{
    public $timestamps      = false;
    protected $fillable     = ['location_id'];

    protected $table        = "storage_location";
//    protected $primaryKey   = 'id_user';
}
