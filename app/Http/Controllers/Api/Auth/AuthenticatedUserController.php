<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\DestroyLoginRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthenticatedUserController extends Controller
{
    public function authenticate(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        if (!Auth::attempt(array('email' => $data['email'], 'password' => $data['password']))) {
            return response()->json([
                'status' => false,
                'message' => 'Email & Password does not match with our record.',
            ], 401);
        }

        $user = User::where('email', $data['email'])->first();

        if ($user->tokens()->where('tokenable_id', $user->id)->exists()) {
            $user->tokens()->delete();
        }

        return response()->json([
            'status' => true,
            'message' => 'you logged In',
            'token_type' => 'Bearer',
            'token' => $user->createToken("API Login Token")->plainTextToken,
            'data' => new UserResource($user)
        ], 200);
    }

    public function destroy(DestroyLoginRequest $request): \Illuminate\Http\JsonResponse
    {
        try {

            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status' => true,
                'message' => 'you logged out',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
