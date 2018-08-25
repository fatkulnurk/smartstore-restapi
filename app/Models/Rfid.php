<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rfid extends Model
{
    public $timestamps      = false;
    protected $fillable     = ['code','materialid','storagebin'];

    protected $table        = "rfid";
//    protected $primaryKey   = 'id_user';
}
