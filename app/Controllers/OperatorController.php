<?php
/*
 * MaterialController only for controller sample
 */

namespace App\Controllers;

use App\Models\Operator;
use \Firebase\JWT\JWT;

class OperatorController extends BaseController
{
    // Menampilkan Semua Data
    public function index($request, $response)
    {
        return $response->withJson(Operator::all());
    }

    // Menampilkan Detail Operator Berdasarkan ID
    public function show($request,$response,$args){
        $id = $args['id'];
        return $response->withJson(Operator::find($id));
    }

    // Menampilkan Detail Operator berdasarkan op_nb
    public function showByOpNb($request,$response,$args){
        $id = $args['op_nb'];
        $result = Operator::where('op_nb',$id)->get();
        return $response->withJson($result);
    }

    // menambahkan Operator baru
    public function create($request,$response){
        $result = Operator::create([
            'op_nb' => $request->getParsedBody()['op_nb'],
            'work_center' => $request->getParsedBody()['work_center']
        ]);

        return $response->withJson([
            'success' => true,
            'message' => 'data inserted successfull',
            'data' => $result
        ],200);
    }

    // delete berdasarkan id
    public function delete($request,$response, $args){

        $result = Operator::find($args['id'])->delete();

        return $response->withJson([
            'success' => true,
            'message' => 'data Delete succesfull',
            'data' => $result
        ]);
    }

    // delete berdasarkan op_nb
    public function deleteByOpNb($request,$response, $args){
        $id = $args['op_nb'];
        $result = Operator::where('op_nb',$id)->delete();

        return $response->withJson([
            'success' => true,
            'message' => 'data Delete succesfull',
            'data' => $result
        ]);
    }

    public function update($request, $response, $args){

        $result = Operator::find($args['id'])->update([
            'op_nb' => $request->getParsedBody()['op_nb'],
            'work_center' => $request->getParsedBody()['work_center']
        ]);

        return $response->withJson([
            'success' => true,
            'message' => 'data Update succesfull',
            'data' => $result
        ]);

    }

}
