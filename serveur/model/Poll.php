<?php
class Poll
{
    private int $pollId;
    private string $pollSubject;
    private DateTime $pollCreated;
    private DateTime $pollModified;
    private bool $pollStatus;
    private string $pollDescription;
    private bool $pollLocked;
    private User $pollUser;

    // Constructor
    public function __construct(
        int $pollId,
        string $pollSubject,
        DateTime $pollCreated,
        DateTime $pollModified,
        bool $pollStatus,
        string $pollDescription,
        bool $pollLocked,
        User $pollUser
    ) {
        $this->pollId = $pollId;
        $this->pollSubject = $pollSubject;
        $this->pollCreated = $pollCreated;
        $this->pollModified = $pollModified;
        $this->pollStatus = $pollStatus;
        $this->pollDescription = $pollDescription;
        $this->pollLocked = $pollLocked;
        $this->pollUser = $pollUser;
    }

    // Getter and Setter for pollId
    public function getPollId(): int
    {
        return $this->pollId;
    }

    public function setPollId(int $pollId): void
    {
        $this->pollId = $pollId;
    }

    // Getter and Setter for pollSubject
    public function getPollSubject(): string
    {
        return $this->pollSubject;
    }

    public function setPollSubject(string $pollSubject): void
    {
        $this->pollSubject = $pollSubject;
    }

    // Getter and Setter for pollCreated
    public function getPollCreated(): DateTime
    {
        return $this->pollCreated;
    }

    public function setPollCreated(DateTime $pollCreated): void
    {
        $this->pollCreated = $pollCreated;
    }

    // Getter and Setter for pollModified
    public function getPollModified(): DateTime
    {
        return $this->pollModified;
    }

    public function setPollModified(DateTime $pollModified): void
    {
        $this->pollModified = $pollModified;
    }

    // Getter and Setter for pollStatus
    public function isPollStatus(): bool
    {
        return $this->pollStatus;
    }

    public function setPollStatus(bool $pollStatus): void
    {
        $this->pollStatus = $pollStatus;
    }

    // Getter and Setter for pollDescription
    public function getPollDescription(): string
    {
        return $this->pollDescription;
    }

    public function setPollDescription(string $pollDescription): void
    {
        $this->pollDescription = $pollDescription;
    }

    // Getter and Setter for pollLocked
    public function isPollLocked(): bool
    {
        return $this->pollLocked;
    }

    public function setPollLocked(bool $pollLocked): void
    {
        $this->pollLocked = $pollLocked;
    }

    // Getter and Setter for pollUser
    public function getPollUser(): User
    {
        return $this->pollUser;
    }

    public function setPollUser(User $pollUser): void
    {
        $this->pollUser = $pollUser;
    }
}
