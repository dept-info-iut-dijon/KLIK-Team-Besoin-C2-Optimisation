<?php
class PostVote
{
    private int $postVoteId;
    private DateTime $postVoteDate;
    private int $postVote;
    private Post $postVotePost;
    private User $postVoteUser;

  
  // Constructor
  public function __construct(
    int $postVoteId,
    DateTime $postVoteDate,
    int $postVote,
    Post $postVotePost,
    User $postVoteUser
) {
    $this->postVoteId = $postVoteId;
    $this->postVoteDate = $postVoteDate;
    $this->postVote = $postVote;
    $this->postVotePost = $postVotePost;
    $this->postVoteUser = $postVoteUser;
}

// Getter and Setter for postVoteId
public function getPostVoteId(): int {
    return $this->postVoteId;
}

public function setPostVoteId(int $postVoteId): void {
    $this->postVoteId = $postVoteId;
}

// Getter and Setter for postVoteDate
public function getPostVoteDate(): DateTime {
    return $this->postVoteDate;
}

public function setPostVoteDate(DateTime $postVoteDate): void {
    $this->postVoteDate = $postVoteDate;
}

// Getter and Setter for postVote
public function getPostVote(): int {
    return $this->postVote;
}

public function setPostVote(int $postVote): void {
    $this->postVote = $postVote;
}

// Getter and Setter for postVotePost
public function getPostVotePost(): Post {
    return $this->postVotePost;
}

public function setPostVotePost(Post $postVotePost): void {
    $this->postVotePost = $postVotePost;
}

// Getter and Setter for postVoteUser
public function getPostVoteUser(): User {
    return $this->postVoteUser;
}

public function setPostVoteUser(User $postVoteUser): void {
    $this->postVoteUser = $postVoteUser;
}
}
