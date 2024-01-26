<?php

namespace App\Services;

interface UserServiceInterface
{
    public function getAllUsersWithAddresses();
    public function createUserWithAddress(array $userData, array $addressData);
    public function getUserByIdWithAddresses($id);
    public function updateUserWithAddress($id, array $userData, array $addressData);
    public function deleteUser($id);
}
