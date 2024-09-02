<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function fetch(Request $request)
    {
        return response()->json([
           'data' => $request->user(),
           'message' => 'Data profile user berhasil diambil'
        ], 200);
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ],'Authentication Failed', 500);
            }

            $user = User::where('email', $request->email)->first();
            if ( ! Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Invalid Credentials');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'data' => [
                    'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                    'user' => $user,
                    'status' => 'Autheticated'
                ],
                'meta' => [
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Authenticated'
                ]
            ], 200);
            
            // return ResponseFormatter::success([
            //     'access_token' => $tokenResult,
            //     'token_type' => 'Bearer',
            //     'user' => $user
            // ],'Authenticated');
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
                'status' => 'Authentication Failed',
                'code' => 500,
            ], 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'alamat' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:255'],
                'gmap' => ['string', 'max:255'],
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'phone' => $request->phone,
                'gmap' => $request->gmap,
                'password' => Hash::make($request->password),
            ]);

            $user = User::where('email', $request->email)->first();

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user,
                'status' => 'User Registered',
            ], 200);

            // return ResponseFormatter::success([
            //     'access_token' => $tokenResult,
            //     'token_type' => 'Bearer',
            //     'user' => $user
            // ],'User Registered');
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
                'status' => 'Authentication Failed',
                'code' => 500
            ], 500);

            // return ResponseFormatter::error([
            //     'message' => 'Something went wrong',
            //     'error' => $error,
            // ],'Authentication Failed', 500);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success($token,'Token Revoked, Berhasil Logout');
    }

    public function detail(){
        $user = User::where('id', Auth::user()->id)->first();
        $tokenResult = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
            'user' => $user,
            'message' => 'success',
        ], 200);
        // return ResponseFormatter::success([
        //     'access_token' => $tokenResult,
        //     'token_type' => 'Bearer',
        //     'user' => $user,
        //     'Success'
        // ]);
    }
}
