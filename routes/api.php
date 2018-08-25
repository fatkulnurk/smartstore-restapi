<?php
/**
 * Created by PhpStorm.
 * User: rudi
 * Date: 8/5/2018
 * Time: 5:21 PM
 */

use App\Middleware\JWTMiddleware;
//use App\Middleware\CorsMiddleware;

//$app->add('CorsMiddleware');

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});


$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Credentials', 'true')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization, token, authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});


$app->group('/api',function (){

    // Halaman Awal
    $this->get('','\App\Controllers\HomeController:indexApi');

    // Login untuk dapat JWT token
    $this->post('/login','\App\Controllers\HomeController:login');

    // Info JWT
    $this->get('/logincheck','\App\Controllers\HomeController:loginCheck');


    /*************************************************************************
     * Group For Material
     * - Table ModeL --> Material
     * - Controller --> MaterialController
     ************************************************************************/
    $this->group('/material',function (){

        // mendapatkan semua material
        $this->get('','\App\Controllers\MaterialController:index')->add(new JWTMiddleware());

        // mendapatkan detail material berdasarkan id
        $this->get('/{id}','\App\Controllers\MaterialController:show')->add(new JWTMiddleware());

        // mendapatkan detail material berdasarkan material_id
        $this->get('/materialid/{material_id}','\App\Controllers\MaterialController:showByMaterialId')->add(new JWTMiddleware());

        // menambahkan material material
        $this->post('/create','\App\Controllers\MaterialController:create')->add(new JWTMiddleware());

        // melakukan update material
        $this->put('/update/{id}','\App\Controllers\MaterialController:update')->add(new JWTMiddleware());

        // melakukan hapus material berdasarkan id
        $this->delete('/delete/{id}','\App\Controllers\MaterialController:delete')->add(new JWTMiddleware());

        // melakukan hapus material berdasarkan material id
        $this->delete('/delete/materialid/{id}','\App\Controllers\MaterialController:deleteByMaterialId')->add(new JWTMiddleware());

    });


    /*************************************************************************
     * Group for Operator
     * - Table ModeL --> Operator
     * - Controller --> OperatorController
     ************************************************************************/
    $this->group('/operator',function (){

        // mendapatkan semua Operator
        $this->get('','\App\Controllers\OperatorController:index')->add(new JWTMiddleware());

        // mendapatkan detail Operator berdasarkan id
        $this->get('/{id}','\App\Controllers\OperatorController:show')->add(new JWTMiddleware());

        // mendapatkan detail Operator berdasarkan op_nb
        $this->get('/opnb/{op_nb}','\App\Controllers\OperatorController:showByOpNb')->add(new JWTMiddleware());

        // menambahkan Operator
        $this->post('/create','\App\Controllers\OperatorController:create')->add(new JWTMiddleware());

        // melakukan update Operator berdasarkan id
        $this->put('/update/{id}','\App\Controllers\OperatorController:update')->add(new JWTMiddleware());

        // melakukan hapus Operator berdasarkan id
        $this->delete('/delete/{id}','\App\Controllers\OperatorController:delete')->add(new JWTMiddleware());

        // melakukan hapus Operator berdasarkan op_nb
        $this->delete('/delete/opnb/{op_nb}','\App\Controllers\OperatorController:deleteByOpNb')->add(new JWTMiddleware());

    });


    /*************************************************************************
     * Group For RFID
     * - Table ModeL --> Rfid
     * - Controller --> RfidController
     ************************************************************************/
    $this->group('/rfid',function (){

        // mendapatkan semua material
        $this->get('','\App\Controllers\RfidController:index')->add(new JWTMiddleware());

        // mendapatkan detail material berdasarkan id
        $this->get('/{id}','\App\Controllers\RfidController:show')->add(new JWTMiddleware());

        // mendapatkan detail material berdasarkan material_id
        $this->get('/code/{code}','\App\Controllers\RfidController:showByCode')->add(new JWTMiddleware());

        // menambahkan material material
        $this->post('/create','\App\Controllers\RfidController:create')->add(new JWTMiddleware());

        // melakukan update material
        $this->put('/update/{id}','\App\Controllers\RfidController:update')->add(new JWTMiddleware());

        // melakukan hapus material berdasarkan id
        $this->delete('/delete/{id}','\App\Controllers\RfidController:delete')->add(new JWTMiddleware());

        // melakukan hapus material berdasarkan material id
        $this->delete('/delete/code/{code}','\App\Controllers\MaterialController:deleteByCode')->add(new JWTMiddleware());

    });



    /*************************************************************************
     * Group for Spare Part Issue List
     * - Table ModeL --> SparePartIssueList
     * - Controller --> SparePartIssueListController
     ************************************************************************/
    $this->group('/sparepartissuelist',function (){

        // mendapatkan semua Spare Part Issue List
        $this->get('','\App\Controllers\SparePartIssueListController:index')->add(new JWTMiddleware());

        // mendapatkan detail Spare Part Issue List berdasarkan id
        $this->get('/{id}','\App\Controllers\SparePartIssueListController:show')->add(new JWTMiddleware());

        // mendapatkan detail Spare Part Issue List berdasarkan working_order
        $this->get('/workingorder/{working_order}','\App\Controllers\SparePartIssueListController:showByWorkingOrder')->add(new JWTMiddleware());

        // menambahkan Spare Part Issue List
        $this->post('/create','\App\Controllers\SparePartIssueListController:create')->add(new JWTMiddleware());

        // melakukan update Spare Part Issue List berdasarkan id
        $this->put('/update/{id}','\App\Controllers\SparePartIssueListController:update')->add(new JWTMiddleware());

        // melakukan hapus Spare Part Issue List berdasarkan id
        $this->delete('/delete/{id}','\App\Controllers\SparePartIssueListController:delete')->add(new JWTMiddleware());

        // melakukan hapus Spare Part Issue List berdasarkan working_order
        $this->delete('/delete/workingorder/{working_order}','\App\Controllers\SparePartIssueListController:deleteByWorkingOrder')->add(new JWTMiddleware());

    });


    /*************************************************************************
     * Group for Storage Bin
     * - Table ModeL --> StorageBin
     * - Controller --> StorageBinController
     ************************************************************************/
    $this->group('/storagebin',function (){

        // mendapatkan semua Storage Bin
        $this->get('','\App\Controllers\StorageBinController:index')->add(new JWTMiddleware());

        // mendapatkan detail Storage Bin berdasarkan id
        $this->get('/{id}','\App\Controllers\StorageBinController:show')->add(new JWTMiddleware());

        // menambahkan Storage Bin
        $this->post('/create','\App\Controllers\StorageBinController:create')->add(new JWTMiddleware());

        // melakukan update Storage Bin berdasarkan id
        $this->put('/update/{id}','\App\Controllers\StorageBinController:update')->add(new JWTMiddleware());

        // melakukan hapus Storage Bin berdasarkan id
        $this->delete('/delete/{id}','\App\Controllers\StorageBinController:delete')->add(new JWTMiddleware());

    });


    /*************************************************************************
     * Group for Storage Location
     * - Table ModeL --> StorageLocation
     * - Controller --> StorageLocationController
     ************************************************************************/
    $this->group('/storagelocation',function (){

        // mendapatkan semua Storage Location
        $this->get('','\App\Controllers\StorageLocationController:index')->add(new JWTMiddleware());

        // mendapatkan detail Storage Location berdasarkan id
        $this->get('/{id}','\App\Controllers\StorageLocationController:show')->add(new JWTMiddleware());

        // mendapatkan detail Storage Location berdasarkan location_id
        $this->get('/locationid/{location_id}','\App\Controllers\StorageLocationController:showByLocationId')->add(new JWTMiddleware());

        // menambahkan Storage Location
        $this->post('/create','\App\Controllers\StorageLocationController:create')->add(new JWTMiddleware());

        // melakukan update Storage Location berdasarkan id
        $this->put('/update/{id}','\App\Controllers\StorageLocationController:update')->add(new JWTMiddleware());

        // melakukan hapus Storage Location berdasarkan id
        $this->delete('/delete/{id}','\App\Controllers\StorageLocationController:delete')->add(new JWTMiddleware());

        // melakukan hapus Storage Location berdasarkan location_id
        $this->delete('/delete/locationid/{location_id}','\App\Controllers\StorageLocationController:deleteByLocationId')->add(new JWTMiddleware());

    });


    /*************************************************************************
     * Group For Storekeeper
     * - Table ModeL --> Storekeeper
     * - Controller --> StorekeeperController
     ************************************************************************/
    $this->group('/storekeeper',function (){

        // mendapatkan semua storekeeper
        $this->get('','\App\Controllers\StorekeeperController:index')->add(new JWTMiddleware());

        // mendapatkan informasi berdasarkan id
        $this->get('/{id_user}','\App\Controllers\StorekeeperController:show')->add(new JWTMiddleware());

        // menambah user baru
        $this->post('/create','\App\Controllers\StorekeeperController:create')->add(new JWTMiddleware());

        // mengupdate data berdasarkan id user
        $this->put('/update/{id_user}','\App\Controllers\StorekeeperController:update')->add(new JWTMiddleware());

        // menghapus user berdasarkan id user
        $this->delete('/delete/{id_user}','\App\Controllers\StorekeeperController:delete')->add(new JWTMiddleware());

    });


    /*************************************************************************
     * Group for Work Center
     * - Table ModeL --> WorkCenter
     * - Controller --> WorkCenterLocation
     ************************************************************************/
    $this->group('/workcenter',function (){

        // mendapatkan semua Work Center
        $this->get('','\App\Controllers\WorkCenterController:index')->add(new JWTMiddleware());

        // mendapatkan Work Center berdasarkan id
        $this->get('/{id}','\App\Controllers\WorkCenterController:show')->add(new JWTMiddleware());

        // mendapatkan Work Center berdasarkan id_work_center
        $this->get('/idworkcenter/{id_work_center}','\App\Controllers\WorkCenterController:showByIdWorkCenter')->add(new JWTMiddleware());

        // menambahkan Work Center
        $this->post('/create','\App\Controllers\WorkCenterController:create')->add(new JWTMiddleware());

        // melakukan update Work Center berdasarkan id
        $this->put('/update/{id}','\App\Controllers\WorkCenterController:update')->add(new JWTMiddleware());

        // melakukan hapus Work Center berdasarkan id
        $this->delete('/delete/{id}','\App\Controllers\WorkCenterController:delete')->add(new JWTMiddleware());

        // melakukan hapus Work Center berdasarkan id_work_center
        $this->delete('/delete/idworkcenter/{id_work_center}','\App\Controllers\WorkCenterController:deleteByIdWorkCenter')->add(new JWTMiddleware());

    });


    /*************************************************************************
     * Group for Working Order
     * - Table ModeL --> WorkingOrder
     * - Controller --> WorkingOrderController
     ************************************************************************/
    $this->group('/workingorder',function (){

        // mendapatkan semua Working Order
        $this->get('','\App\Controllers\WorkingOrderController:index')->add(new JWTMiddleware());

        // mendapatkan Working Order berdasarkan id
        $this->get('/{id}','\App\Controllers\WorkingOrderController:show')->add(new JWTMiddleware());

        // mendapatkan Working Order berdasarkan id_work_center
        $this->get('/workingordernb/{working_order_nb}','\App\Controllers\WorkingOrderController:showByWorkingOrderNb')->add(new JWTMiddleware());

        // menambahkan Working Order
        $this->post('/create','\App\Controllers\WorkingOrderController:create')->add(new JWTMiddleware());

        // melakukan update Working Order berdasarkan id
        $this->put('/update/{id}','\App\Controllers\WorkingOrderController:update')->add(new JWTMiddleware());

        // melakukan hapus Working Order berdasarkan id
        $this->delete('/delete/{id}','\App\Controllers\WorkingOrderController:delete')->add(new JWTMiddleware());

        // melakukan hapus Working Order berdasarkan id_work_center
        $this->delete('/delete/workingordernb/{working_order_nb}','\App\Controllers\WorkingOrderController:deleteByWorkingOrderNb')->add(new JWTMiddleware());

    });



});

$app->get('/', '\App\Controllers\HomeController:index');
