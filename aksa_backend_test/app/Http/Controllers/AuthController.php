<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    use Authenticatable;

    protected AuthService $authService;
    public function __construct(AuthService $auth)
    {
        $this->authService = $auth;
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        try {

            $res = $this->authService->loginService([
                "username" => $request->username,
                "password" => $request->password
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Login berhasil',
                'data' => $res
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 401);
        }
    }

    public function health()
    {
        return response()->json([
            'status' => 'Success',
            'message' => "API IS ONLINE BRO"
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        try {
            $admin = $request->user();

            $this->authService->logout($admin);

            return response()->json([
                'message' => 'Logout successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 401);
        }
    }
}
