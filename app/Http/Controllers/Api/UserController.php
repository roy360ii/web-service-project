<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(UserServiceInterface $userService)
    {
        return response()->json($userService->getAllUsersWithAddresses());
    }

    public function store(Request $request, UserServiceInterface $userService)
    {
        $userData = $request->only(['name', 'email', 'password', 'phone', 'cpf']);
        $addressData = $request->only(['address', 'number', 'complement', 'neighborhood', 'zipcode']);

        $user = $userService->createUserWithAddress($userData, $addressData);

        return response()->json($user, 201);
    }

    public function show($id, UserServiceInterface $userService)
    {
        $user = $userService->getUserByIdWithAddresses($id);

        if (!$user) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        return response()->json($user, 200);
    }

    public function update(Request $request, $id, UserServiceInterface $userService)
    {
        $userData = $request->only(['name', 'email', 'password', 'phone', 'cpf']);
        $addressData = $request->only(['address', 'number', 'complement', 'neighborhood', 'zipcode']);

        $user = $userService->updateUserWithAddress($id, $userData, $addressData);

        if (!$user) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        return response()->json($user, 200);
    }

    public function destroy($id, UserServiceInterface $userService)
    {
        $userService->deleteUser($id);

        return response()->json(['message' => 'Record deleted'], 204);
    }
}
