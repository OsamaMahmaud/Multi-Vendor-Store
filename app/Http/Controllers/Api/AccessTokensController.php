<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccessTokensController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'nullable|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            $device_name = $request->post('device_name', $request->userAgent());

            $token = $user->createToken($device_name)->plainTextToken;

            return response()->json([
                'code'=>100,
                'access_token' => $token,
                'user'=>$user,
            ],201);
        }
        return response()->json([
            'code'=>101,
            'message'=>'Invalid credentials',
        ],401);
    }


   public function destroy($token =null)
   {
    
      //1-get user 2-get toke (hash)
      $user = Auth::guard('sanctum')->user();

      if (null === $token) {
        $user->currentAccessToken()->delete();
        return;
    }

       // Revoke all tokens...
      //  $user->tokens()->delete();

     // ...or revoke a single token by ID...
     $user->tokens()->where('id', $token)->delete();
   }
}