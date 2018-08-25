<?php
/*
 * StorekeeperController only for controller sample
 */

namespace App\Controllers;

use App\Models\Storekeeper;
use \Firebase\JWT\JWT;

class StorekeeperController extends BaseController
{
    public function index($request, $response)
    {
        return $response->withJson(Storekeeper::all());
    }

    public function show($request,$response,$args){
        $id = $args['id_user'];
        // $storekeeper = Storekeeper::where('id_user',$id);
        return $response->withJson(Storekeeper::find($id));
    }

    public function create($request,$response){
        $storekeeper = Storekeeper::create([
            'email' => $request->getParsedBody()['email'],
            'password' => $request->getParsedBody()['password']
        ]);

        return $response->withJson([
            'success' => true,
            'message' => 'data inserted successfull',
            'data' => $storekeeper
        ],200);
    }

    public function delete($request,$response, $args){

        // delete user
        $storekeeper = Storekeeper::find($args['id_user'])->delete();

        return $response->withJson([
            'success' => true,
            'message' => 'data Delete succesfull',
            'data' => $storekeeper
        ]);
    }

    public function update($request, $response, $args){

        // update user
        $storekeeper = Storekeeper::find($args['id_user'])->update([
            'email' => $request->getParsedBody()['email'],
            'password' => $request->getParsedBody()['password']
        ]);

        return $response->withJson([
            'success' => true,
            'message' => 'data Update succesfull',
            'data' => $storekeeper
        ]);

    }

}
