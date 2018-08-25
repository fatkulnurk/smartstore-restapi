<?php
/**
 * Created by PhpStorm.
 * User: rudi
 * Date: 8/7/2018
 * Time: 4:06 PM
 */

namespace App\Middleware;

use \Firebase\JWT\JWT;

class JWTMiddleware{

    public function __invoke($request, $response, $next){

/*    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Credentials: true");
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');*/


//        $jwt = $request->getHeader('Authorization')[0];

        // cek jika Header Authorization tidak di isi
        if(!isset($request->getHeader('Authorization')[0])){
            return $response->withJson([
               'success' => false,
               'message' => 'Authorization Not Found'
            ],401);
        }else{
            $jwt = $request->getHeader('Authorization')[0];
        }

        try{
            // decode token, kalau dihapus akan eror sebab JWT tidak akan berjalan
            $decoded = JWT::decode($jwt,getenv('API_KEY'),array('HS256'));

            // jalankan middleware selanjutnya
            return $next($request,$response);

        } catch (\Exception $e){

            return $response->withJson([
                'success' => false,
                'message' => 'Authorization Failed'
            ],401);

        }
    }

}
