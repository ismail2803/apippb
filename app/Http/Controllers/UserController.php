<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $register = DB::table('users')->insert([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => $request->password, 
        ]);

        if($register) {
            $result["success"] = "1";
            $result["message"] = "success";
            echo json_encode($result);
        } else {
            $result["success"] = "0";
            $result["message"] = "error";
            echo json_encode($result);
        }
    }

    public function login(Request $request)
    {
        $logins = DB::table('users')
            ->where('email', $request->email)
            ->where('password', $request->password)
            ->get();

        if(count($logins) > 0)
        {
            foreach ($logins as $login) {
                $result["success"] = "1";
                $result["message"] = "success";
                $result["id"] = $login->id;
                $result["name"] = $login->name;
                $result["email"] = $login->email;
            }
            echo json_encode($result);
        } else {
            $result["success"] = "1";
            $result["message"] = "success";
            echo json_encode($result);
        }
    }
}
