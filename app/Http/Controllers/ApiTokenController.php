<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\GeneralSetting;
use App\Http\Controllers\Controller;
use App\UserWallet;
use App\WithdrawMethod;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class ApiTokenController extends Controller
{
     /**
     * Update the authenticated user's API token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function update(Request $request)
    {
        $token = Str::random(80);

        $request->user()->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();

        return ['token' => $token];
    }


    public function registration(Request $request){
        $data = $request->validate([
            'firstname' => 'required|string|max:60',
            'lastname' => 'required|string|max:60',
            'country' => 'required|string|max:80',
            'email' => 'required|string|email|max:160|unique:users',
            'mobile' => 'required|string|max:30|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'username' => 'required|string|alpha_num|unique:users|min:6',
        ]);

        // return $data['firstname'];

        $gnl = GeneralSetting::first();

        if(isset($data['referBy'])){
            $referUser = User::where('username',$data['referBy'])->first();
        }


        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => trim(strtolower($data['email'])),
            'password' => Hash::make($data['password']),
            'username' => $data['username'],
            'refer' =>  isset($data['referBy']) ?  $referUser->id : null,
            'mobile' => $data['mobile'],
            'address' => [
                'address' => null,
                'state' => null,
                'zip' => null,
                'country' => $data['country'],
                'city' => null,
            ],
            'status' => 1,
            'ev' =>  $gnl->ev ? 0 : 1,
            'sv' =>  $gnl->sv ? 0 : 1,
            'ts' => 0,
            'tv' => 1
        ]);


        UserWallet::create([
            'user_id' => $user->id,
            'balance' => 0,
            'type' => 'deposit_wallet',
        ]);

        UserWallet::create([
            'user_id' => $user->id,
            'balance' => 0,
            'type' => 'interest_wallet',
        ]);


        // return $user;

        // $token = $user->createToken('AuthToken')->plainTextToken;
        $token = $user->createToken('appToken')->accessToken;

        $response = [
          'user' => $user,
          'token' => $token,
        ];

        return response($response, 201);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'Invalid credential',
            ], 401);
        }

        $user->tokens()->delete();
        // $token = $user->createToken('AuthToken')->plainTextToken;
        $token = $user->createToken('appToken')->accessToken;
        $response = [
          'user' => $user,
          'token' => $token,
        ];

        return response($response, 201);
    }

    public function logout(){
        $user = Auth::user();

        $user->tokens()->delete();

        $response = [
            'message' => 'Successfully Logout',
        ];

        return response($response, 201);
    }


    public function walletBalance(){
        // $user = Auth::user();
        $user = User::find(1)->wallets;



        $response = [
            'wallet_balance' => $user,
        ];

        return response($response, 201);
    }


}
