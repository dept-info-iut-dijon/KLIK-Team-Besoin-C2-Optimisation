<?php

class BlogVotes
{
    private int $blogVoteId;
    private DateTime $blogVoteDate;
    private int $blogVote;
    private User $blogVoteUser;
    private Blog $blogVoteBlog;

    // Constructor
    public function __construct(
        int $blogVoteId,
        DateTime $blogVoteDate,
        int $blogVote,
        User $blogVoteUser,
        Blog $blogVoteBlog
    ) {
        $this->blogVoteId = $blogVoteId;
        $this->blogVoteDate = $blogVoteDate;
        $this->blogVote = $blogVote;
        $this->blogVoteUser = $blogVoteUser;
        $this->blogVoteBlog = $blogVoteBlog;
    }

    // Getter and Setter for blogVoteId
    public function getBlogVoteId(): int
    {
        return $this->blogVoteId;
    }

    public function setBlogVoteId(int $blogVoteId): void
    {
        $this->blogVoteId = $blogVoteId;
    }

    // Getter and Setter for blogVoteDate
    public function getBlogVoteDate(): DateTime
    {
        return $this->blogVoteDate;
    }

    public function setBlogVoteDate(DateTime $blogVoteDate): void
    {
        $this->blogVoteDate = $blogVoteDate;
    }

    // Getter and Setter for blogVote
    public function getBlogVote(): int
    {
        return $this->blogVote;
    }

    public function setBlogVote(int $blogVote): void
    {
        $this->blogVote = $blogVote;
    }

    // Getter and Setter for blogVoteUser
    public function getBlogVoteUser(): User
    {
        return $this->blogVoteUser;
    }

    public function setBlogVoteUser(User $blogVoteUser): void
    {
        $this->blogVoteUser = $blogVoteUser;
    }

    // Getter and Setter for blogVoteBlog
    public function getBlogVoteBlog(): Blog
    {
        return $this->blogVoteBlog;
    }

    public function setBlogVoteBlog(Blog $blogVoteBlog): void
    {
        $this->blogVoteBlog = $blogVoteBlog;
    }
}
