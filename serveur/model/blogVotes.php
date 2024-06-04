<?php

class BlogVotes {
    private int $id;
    private DateTime $date;
    private int $vote;
    private User $user;
    private Blog $blog;

    // Constructor
    public function __construct(int $id, DateTime $date, int $vote, User $user, Blog $blog) {
        $this->id = $id;
        $this->date = $date;
        $this->vote = $vote;
        $this->user = $user;
        $this->blog = $blog;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getDate(): DateTime {
        return $this->date;
    }

    public function getVote(): int {
        return $this->vote;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function getBlog(): Blog {
        return $this->blog;
    }

    // Setters
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setDate(DateTime $date): void {
        $this->date = $date;
    }

    public function setVote(int $vote): void {
        $this->vote = $vote;
    }

    public function setUser(User $user): void {
        $this->user = $user;
    }

    public function setBlog(Blog $blog): void {
        $this->blog = $blog;
    }
}
