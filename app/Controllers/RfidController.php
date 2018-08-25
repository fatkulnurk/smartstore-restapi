<?php

namespace App\Controllers;

use App\Models\Rfid;
use \Firebase\JWT\JWT;

class RfidController extends BaseController
{
    // Menampilkan Semua Data
    public function index($request, $response)
    {
        return $response->withJson(Rfid::all());
    }

    // Menampilkan Detail RFID Berdasarkan ID
    public function show($request,$response,$args){
        $id = $args['id'];
        return $response->withJson(Rfid::find($id));
    }

    // Menampilkan Detail RFID berdasarkan Code
    public function showByCode($request,$response,$args){
        $id = $args['code'];
        $result = Rfid::where('code',$id)->get();
        return $response->withJson($result);
    }

    // menambahkan RFID baru
    public function create($request,$response){
        $storekeeper = Rfid::create([
            'code' => $request->getParsedBody()['code'],
            'materialid' => $request->getParsedBody()['materialid'],
            'storagebin' => $request->getParsedBody()['storagebin']
        ]);

        return $response->withJson([
            'success' => true,
            'message' => 'data inserted successfull',
            'data' => $storekeeper
        ],200);
    }

    // delete berdasarkan id
    public function delete($request,$response, $args){

        $result = Rfid::find($args['id'])->delete();

        return $response->withJson([
            'success' => true,
            'message' => 'data Delete succesfull',
            'data' => $result
        ],200);
    }

    // delete berdasarkan code
    public function deleteByCode($request,$response, $args){
        $id = $args['code'];
        $result = Rfid::where('code',$id)->delete();

        return $response->withJson([
            'success' => true,
            'message' => 'data Delete succesfull',
            'data' => $result
        ],200);
    }

    public function update($request, $response, $args){

        $result = Material::find($args['id'])->update([
            'code' => $request->getParsedBody()['code'],
            'materialid' => $request->getParsedBody()['materialid'],
            'storagebin' => $request->getParsedBody()['storagebin'],
        ]);

        return $response->withJson([
            'success' => true,
            'message' => 'data Update succesfull',
            'data' => $result
        ],200);

    }

}
