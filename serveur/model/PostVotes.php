<?php
class PostVotes
{
    private int $id;
    private DateTime $date;
    private int $vote;
    private Post $post;
    private User $user;

    // Constructor
    public function __construct(
        int $id,
        DateTime $date,
        int $vote,
        Post $post,
        User $user
    ) {
        $this->id = $id;
        $this->date = $date;
        $this->vote = $vote;
        $this->post = $post;
        $this->user = $user;
    }

    // Getter and Setter for id
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    // Getter and Setter for date
    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    // Getter and Setter for vote
    public function getVote(): int
    {
        return $this->vote;
    }

    public function setVote(int $vote): void
    {
        $this->vote = $vote;
    }

    // Getter and Setter for postId
    public function getPostId(): Post
    {
        return $this->post;
    }

    public function setPostId(Post $post): void
    {
        $this->post = $post;
    }

    // Getter and Setter for userId
    public function getUser(): User
    {
        return $this->user;
    }

    public function setUserI(User $user): void
    {
        $this->user = $user;
    }
}
