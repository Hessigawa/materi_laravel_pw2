<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ]);
        // encrypt password(bcrypt)
        $validate['password'] = bcrypt($request->password);

        // simpan data user ke tabel users
        $user = User::create($validate);
        if($user) {
            $data['success'] = true;
            $data['message'] = 'User berhasil disimpan';
            $data['token'] = $user->name; // nama user
            $data['data'] = $user->createToken('MDPApp')->plainTextToken;
            return response()->json($data, Response::HTTP_CREATED); //201
        } else {
            $data['success'] = false;
            $data['message'] = 'User gagal disimpan';
            return response()->json($data, Response::HTTP_BAD_REQUEST);
        }
    }

    public function login(Request $request){
        if(Auth::attempt([
            'email' => $request->email, 
            'password' => $request->password
        ])) {
                // ambil data user
                $user = Auth::user();
                $data['succes'] = true;
                $data['message'] = 'Login Berhasil';
                $data['token'] = $user->createToken ('MDPApp')->plainTextToken;
                $data['data'] = $user;
                return response()->json($data, Response::HTTP_OK); // 200
            } else {
                $data['success'] = false;
                $data['message'] = 'Email atau password salah!';
                return response()->json($data, Response::HTTP_UNAUTHORIZED); // 400
            }
    }
}
