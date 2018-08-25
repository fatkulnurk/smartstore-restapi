<?php
/*
 * MaterialController only for controller sample
 */

namespace App\Controllers;

use App\Models\WorkingOrder;
use \Firebase\JWT\JWT;

class WorkingOrderController extends BaseController
{
    // Menampilkan Semua Data
    public function index($request, $response)
    {
        return $response->withJson(WorkingOrder::all());
    }

    // Menampilkan Working Order Berdasarkan ID
    public function show($request,$response,$args){
        $id = $args['id'];
        return $response->withJson(WorkingOrder::find($id));
    }

    // Menampilkan Detail Working Order berdasarkan working_order_nb
    public function showByWorkingOrderNb($request,$response,$args){
        $id     = $args['working_order_nb'];
        $result = WorkingOrder::where('working_order_nb',$id)->get();
        return $response->withJson($result);
    }

    // menambahkan Work Order baru
    public function create($request,$response){
        $result = WorkingOrder::create([
            'working_order_nb'              => $request->getParsedBody()['working_order_nb'],
            'pm_activity_type'              => $request->getParsedBody()['pm_activity_type'],
            'maintenance_plan_number'       => $request->getParsedBody()['maintenance_plan_number'],
            'maintenance_task_list_number'  => $request->getParsedBody()['maintenance_task_lisk_number'],
            'notification_number'           => $request->getParsedBody()['notification_number'],
            'reserved_nb'                   => $request->getParsedBody()['reserved_nb'],
            'start_date'                    => $request->getParsedBody()['start_date'],
            'end_date'                      => $request->getParsedBody()['end_date'],
            'creation_on'                   => $request->getParsedBody()['creation_on'],
            'created_by'                    => $request->getParsedBody()['created_by'],
            'changed_by'                    => $request->getParsedBody()['changed_by']
        ]);

        return $response->withJson([
            'success' => true,
            'message' => 'data inserted successfull',
            'data' => $result
        ],200);
    }

    // delete berdasarkan id
    public function delete($request,$response, $args){

        $result = WorkingOrder::find($args['id'])->delete();

        return $response->withJson([
            'success' => true,
            'message' => 'data Delete succesfull',
            'data' => $result
        ]);
    }

    // delete berdasarkan id_work_center
    public function deleteByWorkingOrderNb($request,$response, $args){
        $id     = $args['working_order_nb'];
        $result = WorkingOrder::where('working_order_nb',$id)->delete();

        return $response->withJson([
            'success' => true,
            'message' => 'data Delete succesfull',
            'data' => $result
        ]);
    }

    public function update($request, $response, $args){

        $result = WorkingOrder::find($args['id'])->update([
            'working_order_nb'              => $request->getParsedBody()['working_order_nb'],
            'pm_activity_type'              => $request->getParsedBody()['pm_activity_type'],
            'maintenance_plan_number'       => $request->getParsedBody()['maintenance_plan_number'],
            'maintenance_task_list_number'  => $request->getParsedBody()['maintenance_task_lisk_number'],
            'notification_number'           => $request->getParsedBody()['notification_number'],
            'reserved_nb'                   => $request->getParsedBody()['reserved_nb'],
            'start_date'                    => $request->getParsedBody()['start_date'],
            'end_date'                      => $request->getParsedBody()['end_date'],
            'creation_on'                   => $request->getParsedBody()['creation_on'],
            'created_by'                    => $request->getParsedBody()['created_by'],
            'changed_by'                    => $request->getParsedBody()['changed_by']
        ]);

        return $response->withJson([
            'success' => true,
            'message' => 'data Update succesfull',
            'data' => $result
        ]);

    }

}
