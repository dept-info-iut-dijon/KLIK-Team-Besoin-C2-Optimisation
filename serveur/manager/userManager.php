<?php
require_once '../data/userDAO.php';
require_once '../model/user.php';

class UserManager
{
    private UserDAO $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }

    public function createUser(User $user): bool
    {
        return $this->userDAO->create($user);
    }

    public function getUserById(int $userId): ?User
    {
        return $this->userDAO->read($userId);
    }

    public function updateUser(User $user): bool
    {
        return $this->userDAO->update($user);
    }

    public function deleteUser(int $userId): bool
    {
        return $this->userDAO->delete($userId);
    }

    public function getAllUsers(): array
    {
        return $this->userDAO->getAll();
    }
}
