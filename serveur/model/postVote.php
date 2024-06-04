<?php

class PostVote {
    private int $postVoteId;
    private DateTime $postVoteDate;
    private int $postVote;
    private Post $post;
    private User $user;

    public function __construct(int $postVoteId, DateTime $postVoteDate, int $postVote, Post $post, User $user) {
        $this->postVoteId = $postVoteId;
        $this->postVoteDate = $postVoteDate;
        $this->postVote = $postVote;
        $this->post = $post;
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

    public function getPost(): Post {
        return $this->post;
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

    public function setPost(Post $post): void {
        $this->post = $post;
    }

    public function setUser(User $user): void {
        $this->user = $user;
    }
}
