<?php
/*
 * MaterialController only for controller sample
 */

namespace App\Controllers;

use App\Models\WorkCenter;
use \Firebase\JWT\JWT;

class WorkCenterController extends BaseController
{
    // Menampilkan Semua Data
    public function index($request, $response)
    {
        return $response->withJson(WorkCenter::all());
    }

    // Menampilkan Work Center Berdasarkan ID
    public function show($request,$response,$args){
        $id = $args['id'];
        return $response->withJson(WorkCenter::find($id));
    }

    // Menampilkan DetailWork Center berdasarkan id_work_center
    public function showByIdWorkCenter($request,$response,$args){
        $id = $args['id_work_center'];
        $result = WorkCenter::where('id_work_center',$id)->get();
        return $response->withJson($result);
    }

    // menambahkan Work Center baru
    public function create($request,$response){
        $result = WorkCenter::create([
            'id_work_center' => $request->getParsedBody()['id_work_center'],
            'nama_work_center' => $request->getParsedBody()['nama_work_center'],
            'num_of_people' => $request->getParsedBody()['num_of_people']
        ]);

        return $response->withJson([
            'success' => true,
            'message' => 'data inserted successfull',
            'data' => $result
        ],200);
    }

    // delete berdasarkan id
    public function delete($request,$response, $args){

        $result = WorkCenter::find($args['id'])->delete();

        return $response->withJson([
            'success' => true,
            'message' => 'data Delete succesfull',
            'data' => $result
        ]);
    }

    // delete berdasarkan id_work_center
    public function deleteByIdWorkCenter($request,$response, $args){
        $id = $args['id_work_center'];
        $result = WorkCenter::where('id_work_center',$id)->delete();

        return $response->withJson([
            'success' => true,
            'message' => 'data Delete succesfull',
            'data' => $result
        ]);
    }

    public function update($request, $response, $args){

        $result = WorkCenter::find($args['id'])->update([
            'id_work_center' => $request->getParsedBody()['id_work_center'],
            'nama_work_center' => $request->getParsedBody()['nama_work_center'],
            'num_of_people' => $request->getParsedBody()['num_of_people']
        ]);

        return $response->withJson([
            'success' => true,
            'message' => 'data Update succesfull',
            'data' => $result
        ]);

    }

}
