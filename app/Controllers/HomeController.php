<?php
/*
 * HomeController only for controller sample
 */

namespace App\Controllers;

use App\Models\Storekeeper;
use \Firebase\JWT\JWT;

class HomeController extends BaseController
{
    public function index($request, $response)
    {
        echo '<html><head><title>Homepage</title></head><body>';
        echo '<h1>Selamat Datang</h1>';
        echo 'Ini adalah halaman untuk Rest Api. <br>';
        echo 'Gunakan header <b>Authorization</b> yang berisi token login.';
        echo '</body></html>';
    }

    public function indexApi($request, $response){
        echo '<h1>Pergi ke {{/login}} untuk login.</h1>';
    }

    public function login($request, $response){
        // mendapatkan data dari POST
        $email      = $request->getParsedBody()['email'];
        $password   = $request->getParsedBody()['password'];

        // proses cek login
        $user = Storekeeper::where('email',$email)->where('password',$password)->first();

        // respon kalau login gagal
        if(empty($user)){
            return $response->withJson([
                'success' => false,
                'message' => 'email or password wrong'
            ],401);
        }

        // waktu expired
        // https://daveismyname.blog/quick-way-to-add-hours-and-minutes-with-php
        // https://stackoverflow.com/questions/5213528/convert-timestamp-to-readable-date-time-php
        $time = time() + 60 * 60;

        // generate token
        $token = [
            // Penerbit Issuer
            // "iss"   =>  "storekeeperadmin",

            // Kapan Issuer dibuat
            "iat"   =>  time(),

            // Kapan Issuer Berakhir --> waktu sekarang di tambah 60 detik (1 menit) * 60 menit * 24 jam * 365 hari * 10 tahun
            "exp"   =>  time() + 60 * 60 * 24 * 365 * 10,

            // Data dikirim di jwt
             //"data"  =>  [
              //  "user_id" => $user->id_user,
              //  "expired" => date('m/d/Y H:i:s',$time)
                /* ,
                "email" => $user->email,
                "password" => $user->password,
                "password_hash" => md5($user->password)
                */
            // ]
        ];

        // encode ke dala JWT
        $jwt = JWT::encode($token,getenv('API_KEY'));

        // respon kalau berhasil
        return $response->withJson([
            'success' => true,
            'message' => 'login successfull',
            'jwt' => $jwt
        ],200);
    }

    public function loginCheck($request, $response){
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
            return $response->withJson([
                'success' => true,
                'iat' => $decoded->iat,
                'exp' => $decoded->exp,
                'time_iat' => date('m/d/Y H:i:s',$decoded->iat),
                'time_exp' => date('m/d/Y H:i:s',$decoded->exp),
            ],200);
        } catch (\Exception $e){
            return $response->withJson([
                'success' => false,
                'message' => 'Token Failed or Expired.'
            ],401);

        }

    }
}
