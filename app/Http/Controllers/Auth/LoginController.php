<?php declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\Auth\LoginRequest;

use Illuminate\Http\JsonResponse;
use App\Repositories\MainRepositoryInterface as MainRepository;

class LoginController extends Controller
{

    /**
     * @param AuthManager $auth
     */
    

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws AuthenticationException
     */
    public function login(LoginRequest $request,MainRepository $mainRepository)
    {
        $credentials = $request->only('email', 'password');
        $user = $mainRepository->attemptLogin($credentials);
        if ($user) {
            return response()->json([
                'user' => $user,
                'token' => $user->createToken('authToken')->plainTextToken,
            ]);
        }
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}