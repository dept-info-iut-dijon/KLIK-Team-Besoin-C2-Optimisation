<?php

interface PostDAOInterface {
    public function create(Post $post): bool;
    public function read(int $postId): ?Post;
    public function update(Post $post): bool;
    public function delete(int $postId): bool;
    public function getAll(): array;
}