<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SparePartIssueList extends Model
{
    public $timestamps      = false;
    protected $fillable     = ['working_order','operator','material','qty','storage_location','storage_bin'];

    protected $table        = "spare_part_issue_list";
//    protected $primaryKey   = 'id_user';
}
