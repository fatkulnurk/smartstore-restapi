<?php
/*
 * MaterialController only for controller sample
 */

namespace App\Controllers;

use App\Models\Material;
use \Firebase\JWT\JWT;

class MaterialController extends BaseController
{
    // Menampilkan Semua Data
    public function index($request, $response)
    {
        return $response->withJson(Material::all());
    }

    // Menampilkan Detail Material Berdasarkan ID
    public function show($request,$response,$args){
        $id = $args['id'];
        return $response->withJson(Material::find($id));
    }

    // Menampilkan Detail Material berdasarkan Material Id
    public function showByMaterialId($request,$response,$args){
        $id = $args['material_id'];
        $result = Material::where('material_id',$id)->get();
        return $response->withJson($result);
    }

    // menambahkan material baru
    public function create($request,$response){
        $storekeeper = Material::create([
            'material_id' => $request->getParsedBody()['material_id'],
            'material_name' => $request->getParsedBody()['material_name'],
            'qty' => $request->getParsedBody()['qty']
        ]);

        return $response->withJson([
            'success' => true,
            'message' => 'data inserted successfull',
            'data' => $storekeeper
        ],200);
    }

    // delete berdasarkan id
    public function delete($request,$response, $args){

        $result = Material::find($args['id'])->delete();

        return $response->withJson([
            'success' => true,
            'message' => 'data Delete succesfull',
            'data' => $result
        ],200);
    }

    // delete berdasarkan material_id
    public function deleteByMaterialId($request,$response, $args){
        $id = $args['material_id'];
        $result = Material::where('material_id',$id)->delete();

        return $response->withJson([
            'success' => true,
            'message' => 'data Delete succesfull',
            'data' => $result
        ],200);
    }

    public function update($request, $response, $args){

        $result = Material::find($args['id'])->update([
            'email' => $request->getParsedBody()['email'],
            'password' => $request->getParsedBody()['password']
        ]);

        return $response->withJson([
            'success' => true,
            'message' => 'data Update succesfull',
            'data' => $result
        ],200);

    }

}
