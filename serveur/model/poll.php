<?php

class Poll {
    private int $pollId;
    private string $pollSubject;
    private DateTime $pollCreated;
    private DateTime $pollModified;
    private bool $pollStatus;
    private string $pollDescription;
    private bool $pollLocked;
    private User $user;

    public function __construct(int $pollId, string $pollSubject, DateTime $pollCreated, DateTime $pollModified, bool $pollStatus, string $pollDescription, bool $pollLocked, User $user) {
        $this->pollId = $pollId;
        $this->pollSubject = $pollSubject;
        $this->pollCreated = $pollCreated;
        $this->pollModified = $pollModified;
        $this->pollStatus = $pollStatus;
        $this->pollDescription = $pollDescription;
        $this->pollLocked = $pollLocked;
        $this->user = $user;
    }

    // Getters
    public function getPollId(): int {
        return $this->pollId;
    }

    public function getPollSubject(): string {
        return $this->pollSubject;
    }

    public function getPollCreated(): DateTime {
        return $this->pollCreated;
    }

    public function getPollModified(): DateTime {
        return $this->pollModified;
    }

    public function getPollStatus(): bool {
        return $this->pollStatus;
    }

    public function getPollDescription(): string {
        return $this->pollDescription;
    }

    public function getPollLocked(): bool {
        return $this->pollLocked;
    }

    public function getUser(): User {
        return $this->user;
    }

    // Setters
    public function setPollId(int $pollId): void {
        $this->pollId = $pollId;
    }

    public function setPollSubject(string $pollSubject): void {
        $this->pollSubject = $pollSubject;
    }

    public function setPollCreated(DateTime $pollCreated): void {
        $this->pollCreated = $pollCreated;
    }

    public function setPollModified(DateTime $pollModified): void {
        $this->pollModified = $pollModified;
    }

    public function setPollStatus(bool $pollStatus): void {
        $this->pollStatus = $pollStatus;
    }

    public function setPollDescription(string $pollDescription): void {
        $this->pollDescription = $pollDescription;
    }

    public function setPollLocked(bool $pollLocked): void {
        $this->pollLocked = $pollLocked;
    }

    public function setUser(User $user): void {
        $this->user = $user;
    }
}
