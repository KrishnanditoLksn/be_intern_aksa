<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Admin;

class AuthService 
{

    protected AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function loginService(array $data){
        return $this->authRepository->loginRepository($data);
    }

    public function logout(Admin $admin){
        return $this->authRepository->logout($admin);
    }
    
}
