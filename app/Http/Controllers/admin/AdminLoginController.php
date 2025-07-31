<?php declare(strict_types=1);

namespace App\Http\Controllers\admin; 

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin; // Admin モデルを必ず import

use Illuminate\Http\JsonResponse;
use App\Repositories\AdminRepositoryInterface as AdminRepository;

class AdminLoginController extends Controller
{

    /**
     * @param AuthManager $auth
     */
    

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws AuthenticationException
     */
    /*
    public function login(LoginRequest $request,AdminRepository $adminRepository)
    {
        $credentials = $request->only('email', 'password');
        $user = $adminRepository->attemptLogin($credentials);
        if ($user) {
            return response()->json([
                'user' => $user,
                'token' => $user->createToken('authToken')->plainTextToken,
            ]);
        }
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    */
     public function login(LoginRequest $request, AdminRepository $adminRepository)
    {
        $credentials = $request->only('email', 'password');

        $admin = $adminRepository->attemptLogin($credentials);

        if (!$admin) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json([
            'user' => $admin,
            'token' => $admin->createToken('authToken')->plainTextToken,
        ]);
    }
}