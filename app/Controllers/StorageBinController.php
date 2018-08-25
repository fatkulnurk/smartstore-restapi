<?php
/*
 * MaterialController only for controller sample
 */

namespace App\Controllers;

use App\Models\StorageBin;
use \Firebase\JWT\JWT;

class StorageBinController extends BaseController
{
    // Menampilkan Semua Data
    public function index($request, $response)
    {
        return $response->withJson(StorageBin::all());
    }

    // Menampilkan Detail Storage Bin Berdasarkan ID
    public function show($request,$response,$args){
        $id = $args['id'];
        $result = StorageBin::find($id);

//        echo $result['code_rack']." <hr>";
//        echo $result['code_box']." <hr>";

        return $response->withJson([
            'id' => $result['id'],
            'code_company' => $result['code_company'],
            'code_rack' => $result['code_rack'],
            'code_box' => $result['code_box'],
            'code' => $result['code_company'].".".$result['code_rack'].$result['code_box']
        ],200);
        
        //return $response->withJson(StorageBin::find($id));
    }

    // menambahkan Storage Bin baru
    public function create($request,$response){
        $result = StorageBin::create([
            'code_company' => $request->getParsedBody()['code_company'],
            'code_rack' => $request->getParsedBody()['code_rack'],
            'code_box' => $request->getParsedBody()['code_box']
        ]);

        return $response->withJson([
            'success' => true,
            'message' => 'data inserted successfull',
            'data' => $result
        ],200);
    }

    // delete berdasarkan id
    public function delete($request,$response, $args){

        $result = StorageBin::find($args['id'])->delete();

        return $response->withJson([
            'success' => true,
            'message' => 'data Delete succesfull',
            'data' => $result
        ],200);
    }

    public function update($request, $response, $args){

        $result = StorageBin::find($args['id'])->update([
            'code_company' => $request->getParsedBody()['code_company'],
            'code_rack' => $request->getParsedBody()['code_rack'],
            'code_box' => $request->getParsedBody()['code_box']
        ]);

        return $response->withJson([
            'success' => true,
            'message' => 'data Update succesfull',
            'data' => $result
        ]);

    }

}
