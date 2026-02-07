<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Request;

class AuthRepository
{
    public function loginRepository(array $data)
    {
        $username = $data['username'];
        $password = $data['password'];

        $foundAdmin  = $this->findByUsername($username);

        if (!$foundAdmin || !Hash::check($password, $foundAdmin->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect'],
            ]);
        }

        $token = $foundAdmin->createToken('token')->plainTextToken;

        return [
            "token" => $token,
            "admin" => [
                "id" => $foundAdmin->id,
                "name" => $foundAdmin->name,
                "username" => $foundAdmin->username,
                "phone" => $foundAdmin->phone,
                "email" => $foundAdmin->email
            ]
        ];
    }

    public function logout(Admin $admin): void
    {
        $admin->tokens()->delete();
    }
    
    public function findByUsername(string $username)
    {
        return Admin::where('username', $username)->first();
    }
}
