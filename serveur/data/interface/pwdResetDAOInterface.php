<?php

interface PwdResetDAOInterface {
    public function create(PwdReset $pwdReset): bool;
    public function read(int $resetId): ?PwdReset;
    public function update(PwdReset $pwdReset): bool;
    public function delete(int $resetId): bool;
    public function getAll(): array;
}