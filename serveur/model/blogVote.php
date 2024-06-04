<?php

class BlogVote {
    private int $blogVoteId;
    private DateTime $blogVoteDate;
    private int $blogVote;
    private User $user;
    private Blog $blog;

    public function __construct(int $blogVoteId, DateTime $blogVoteDate, int $blogVote, User $user, Blog $blog) {
        $this->blogVoteId = $blogVoteId;
        $this->blogVoteDate = $blogVoteDate;
        $this->blogVote = $blogVote;
        $this->user = $user;
        $this->blog = $blog;
    }

    // Getters
    public function getBlogVoteId(): int {
        return $this->blogVoteId;
    }

    public function getBlogVoteDate(): DateTime {
        return $this->blogVoteDate;
    }

    public function getBlogVote(): int {
        return $this->blogVote;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function getBlog(): Blog {
        return $this->blog;
    }

    // Setters
    public function setBlogVoteId(int $blogVoteId): void {
        $this->blogVoteId = $blogVoteId;
    }

    public function setBlogVoteDate(DateTime $blogVoteDate): void {
        $this->blogVoteDate = $blogVoteDate;
    }

    public function setBlogVote(int $blogVote): void {
        $this->blogVote = $blogVote;
    }

    public function setUser(User $user): void {
        $this->user = $user;
    }

    public function setBlog(Blog $blog): void {
        $this->blog = $blog;
    }
}
