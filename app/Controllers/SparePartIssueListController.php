<?php
/*
 * MaterialController only for controller sample
 */

namespace App\Controllers;

use App\Models\SparePartIssueList;
use \Firebase\JWT\JWT;

class SparePartIssueListController extends BaseController
{
    // Menampilkan Semua Data
    public function index($request, $response)
    {
        return $response->withJson(SparePartIssueList::all());
    }

    // Menampilkan Detail Spare Part Issue List Berdasarkan ID
    public function show($request,$response,$args){
        $id = $args['id'];
        return $response->withJson(SparePartIssueList::find($id));
    }

    // Menampilkan Detail Spare Part Issue List berdasarkan working_order
    public function showByWorkingOrder($request,$response,$args){
        $id = $args['working_order'];
        $result = SparePartIssueList::where('working_order',$id)->get();
        return $response->withJson($result);
    }

    // menambahkan Spare Part Issue List baru
    public function create($request,$response){
        $result = SparePartIssueList::create([
            'working_order' => $request->getParsedBody()['working_order'],
            'operator' => $request->getParsedBody()['operator'],
            'material' => $request->getParsedBody()['material'],
            'qty' => $request->getParsedBody()['qty'],
            'storage_location' => $request->getParsedBody()['storage_location'],
            'storage_bin' => $request->getParsedBody()['storage_bin']
        ]);

        return $response->withJson([
            'success' => true,
            'message' => 'data inserted successfull',
            'data' => $result
        ],200);
    }

    // delete berdasarkan id
    public function delete($request,$response, $args){

        $result = SparePartIssueList::find($args['id'])->delete();

        return $response->withJson([
            'success' => true,
            'message' => 'data Delete succesfull',
            'data' => $result
        ]);
    }

    // delete berdasarkan working_order
    public function deleteByWorkingOrder($request,$response, $args){
        $id = $args['working_order'];
        $result = SparePartIssueList::where('working_order',$id)->delete();

        return $response->withJson([
            'success' => true,
            'message' => 'data Delete succesfull',
            'data' => $result
        ]);
    }

    public function update($request, $response, $args){

        $result = SparePartIssueList::find($args['id'])->update([
            'working_order' => $request->getParsedBody()['working_order'],
            'operator' => $request->getParsedBody()['operator'],
            'material' => $request->getParsedBody()['material'],
            'qty' => $request->getParsedBody()['qty'],
            'storage_location' => $request->getParsedBody()['storage_location'],
            'storage_bin' => $request->getParsedBody()['storage_bin']
        ]);

        return $response->withJson([
            'success' => true,
            'message' => 'data Update succesfull',
            'data' => $result
        ]);

    }

}
