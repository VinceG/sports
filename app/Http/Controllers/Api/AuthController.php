<?php
namespace App\Http\Controllers\Api;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{ 
    /**
     * Authenticate user and create token
     *
     */
    public function login(AuthRequest $request)
    {
        if (!Auth::attempt(request(['email', 'password']))) {
            return response()->json(['message' => 'Invalid Credentials'], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('AuthToken');
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addDays(3);
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ]);
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Successfully logged out']);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}