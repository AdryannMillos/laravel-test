<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Modules\Users\Entities\User;
use Illuminate\Http\Request;
use Modules\Users\Http\Requests\LoginRequest;
use Modules\Users\Services\UserLoginService;

class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(
        UserLoginService $user_login_service
    ) {
        $this->middleware('apiJwt:api', ['except' => ['login']]);
        $this->user_login_service = $user_login_service;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        try {
            $validated = $request->validated();

            $token = $this->user_login_service->execute($validated);
            return response()->json($token, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
