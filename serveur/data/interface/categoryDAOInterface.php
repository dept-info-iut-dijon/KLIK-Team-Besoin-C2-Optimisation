<?php

interface CategoryDAOInterface {
    public function create(Category $category): bool;
    public function read(int $catId): ?Category;
    public function update(Category $category): bool;
    public function delete(int $catId): bool;
    public function getAll(): array;
}