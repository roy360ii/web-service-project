<?php

namespace App\Services;

use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    public function getAllUsersWithAddresses()
    {
        return User::with('addresses')->get();
    }

    public function createUserWithAddress(array $userData, array $addressData)
    {
        $userData['password'] = Hash::make($userData['password']);

        $user = User::create($userData);

        $user->addresses()->create($addressData);

        return $user;
    }

    public function getUserByIdWithAddresses($id)
    {
        return User::with('addresses')->find($id);
    }

    public function updateUserWithAddress($id, array $userData, array $addressData)
    {
        $user = User::find($id);

        if ($user) {
            $user->fill($userData);
            $user->save();

            $user->addresses()->update($addressData);
        }

        return $user;
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->addresses()->delete();

            $user->delete();
        }
    }
}
