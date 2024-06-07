<?php

require_once 'user.php';
require_once 'post.php';

class PostVote {
    private int $postVoteId;
    private DateTime $postVoteDate;
    private int $postVote;
    private int $postId;
    private User $user;

    public function __construct(int $postVoteId, DateTime $postVoteDate, int $postVote, int $postId, User $user) {
        $this->postVoteId = $postVoteId;
        $this->postVoteDate = $postVoteDate;
        $this->postVote = $postVote;
        $this->postId = $postId;
        $this->user = $user;
    }

    // Getters
    public function getPostVoteId(): int {
        return $this->postVoteId;
    }

    public function getPostVoteDate(): DateTime {
        return $this->postVoteDate;
    }

    public function getPostVote(): int {
        return $this->postVote;
    }

    public function getPostId(): int {
        return $this->postId;
    }

    public function getUser(): User {
        return $this->user;
    }

    // Setters
    public function setPostVoteId(int $postVoteId): void {
        $this->postVoteId = $postVoteId;
    }

    public function setPostVoteDate(DateTime $postVoteDate): void {
        $this->postVoteDate = $postVoteDate;
    }

    public function setPostVote(int $postVote): void {
        $this->postVote = $postVote;
    }

    public function setPostId(int $post): void {
        $this->postId = $post;
    }

    public function setUser(User $user): void {
        $this->user = $user;
    }

    public function toArray(): array {
        return [
            'postVoteId' => $this->postVoteId,
            'postVoteDate' => $this->postVoteDate->format('Y-m-d H:i:s'),
            'postVote' => $this->postVote,
            'postId' => $this->postId,
            'user' => $this->user->toArray()
        ];
    }
}
