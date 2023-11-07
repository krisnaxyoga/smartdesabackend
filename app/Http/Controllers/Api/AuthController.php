<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Auth, DB, Hash;

use App\Agent;

class AuthController extends Controller
{
    /**
     * Login controller.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $user = Agent::where([
            'email' => $request->email,
            'status' => 'ACTIVE'
        ])->first();

        if ($user == null || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => true,
                'message' => 'Email atau Password salah.'
            ]);
        }

        if ($user->api_token == null) {
            $user->api_token = str_random(32);
            $user->save();
        }
 
        // Add Device ID
        // $count = Device::where([
        //     'device_id' => $request->header('DeviceID'),
        //     'user_id' => $user->id,
        //     'user_type' => 'AMBULANCE'
        // ])->count();

        // if ($count == 0) {
        //     Device::create([
        //         'device_id' => $request->header('DeviceID'),
        //         'user_id' => $user->id,
        //         'user_type' => 'AMBULANCE'
        //     ]);
        // }

        return response()->json($user);
    }

    /**
     * Register an ambulance.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return Response $response
     */
    public function register(Request $request)
    {
        $user = Agent::create([
            'name' => $request->name,
            'type' => $request->type,
            'legal_name' => $request->legal_name,
            'address' => $request->address,
            'photo' => $request->photo,
            'phone' => $request->phone,
            'email' => $request->email,
            'status' => $request->status ?: 'ACTIVE',
            'password' => bcrypt($request->password),
            'api_token' => str_random(32)
        ]);

        return response()->json($user);
    }

    /**
     * Logout customer.
     * 
     * @return Response $response
     */
    // public function logout(Request $request)
    // {
    //     $customer = Customer::find(auth()->guard('customer:api')->user()->id);

    //     if ($customer == null) {
    //         return response()->json([
    //             'error' => true,
    //             'message' => 'Anda belum login ke aplikasi.'
    //         ], 405);
    //     }

    //     return response()->json([
    //         'error' => false,
    //         'message' => 'Logout berhasil.'
    //     ]);
    // }
}
