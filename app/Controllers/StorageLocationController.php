<?php
/*
 * MaterialController only for controller sample
 */

namespace App\Controllers;

use App\Models\StorageLocation;
use \Firebase\JWT\JWT;

class StorageLocationController extends BaseController
{
    // Menampilkan Semua Data
    public function index($request, $response)
    {
        return $response->withJson(StorageLocation::all());
    }

    // Menampilkan Detail Storage Location Berdasarkan ID
    public function show($request,$response,$args){
        $id = $args['id'];
        return $response->withJson(StorageLocation::find($id));
    }

    // Menampilkan Detail Storage Location berdasarkan location_id
    public function showByLocationId($request,$response,$args){
        $id = $args['location_id'];
        $result = StorageLocation::where('location_id',$id)->get();
        return $response->withJson($result);
    }

    // menambahkan Storage Bin baru
    public function create($request,$response){
        $result = StorageLocation::create([
            'location_id' => $request->getParsedBody()['location_id']
        ]);

        return $response->withJson([
            'success' => true,
            'message' => 'data inserted successfull',
            'data' => $result
        ],200);
    }

    // delete berdasarkan id
    public function delete($request,$response, $args){

        $result = StorageLocation::find($args['id'])->delete();

        return $response->withJson([
            'success' => true,
            'message' => 'data Delete succesfull',
            'data' => $result
        ]);
    }

    // delete berdasarkan location_id
    public function deleteByLocationId($request,$response, $args){
        $id = $args['location_id'];
        $result = StorageLocation::where('location_id',$id)->delete();

        return $response->withJson([
            'success' => true,
            'message' => 'data Delete succesfull',
            'data' => $result
        ]);
    }

    public function update($request, $response, $args){

        $result = StorageLocation::find($args['id'])->update([
            'location_id' => $request->getParsedBody()['location_id']
        ]);

        return $response->withJson([
            'success' => true,
            'message' => 'data Update succesfull',
            'data' => $result
        ]);

    }

}
