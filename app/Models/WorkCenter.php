<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkCenter extends Model
{
    public $timestamps      = false;
    protected $fillable     = ['id_work_center','nama_work_center','num_of_people'];

    protected $table        = "work_center";
//    protected $primaryKey   = 'id_user';
}
