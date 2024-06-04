<?php

class Post {
    private int $postId;
    private string $postContent;
    private DateTime $postDate;
    private Topic $topic;
    private User $user;

    public function __construct(int $postId, string $postContent, DateTime $postDate, Topic $topic, User $user) {
        $this->postId = $postId;
        $this->postContent = $postContent;
        $this->postDate = $postDate;
        $this->topic = $topic;
        $this->user = $user;
    }

    // Getters
    public function getPostId(): int {
        return $this->postId;
    }

    public function getPostContent(): string {
        return $this->postContent;
    }

    public function getPostDate(): DateTime {
        return $this->postDate;
    }

    public function getTopic(): Topic {
        return $this->topic;
    }

    public function getUser(): User {
        return $this->user;
    }

    // Setters
    public function setPostId(int $postId): void {
        $this->postId = $postId;
    }

    public function setPostContent(string $postContent): void {
        $this->postContent = $postContent;
    }

    public function setPostDate(DateTime $postDate): void {
        $this->postDate = $postDate;
    }

    public function setTopic(Topic $topic): void {
        $this->topic = $topic;
    }

    public function setUser(User $user): void {
        $this->user = $user;
    }
}
