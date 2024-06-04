<?php

interface UserDAOInterface {
    public function create(User $user): bool;
    public function read(int $userId): ?User;
    public function update(User $user): bool;
    public function delete(int $userId): bool;
    public function getAll(): array;
}