<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkingOrder extends Model
{
    public $timestamps      = false;
    protected $fillable     = [
        'working_order_nb',
        'pm_activity_type',
        'maintenance_plan_number',
        'maintenance_task_list_number',
        'notification_number',
        'reserved_nb',
        'start_date',
        'end_date',
        'creation_on',
        'created_by',
        'changed_by'
    ];

    protected $table        = "working_order";
//    protected $primaryKey   = 'id_user';
}
