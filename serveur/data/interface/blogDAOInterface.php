<?php

interface BlogDAOInterface {
    public function create(Blog $blog): bool;
    public function read(int $blogId): Blog;
    public function update(Blog $blog): bool;
    public function delete(int $blogId): bool;
    public function getAll(): array;
}

