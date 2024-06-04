<?php

class PollOption {
    private int $pollOptionId;
    private string $pollOptionName;
    private bool $pollOptionStatus;
    private Poll $poll;

    public function __construct(int $pollOptionId, string $pollOptionName, bool $pollOptionStatus, Poll $poll) {
        $this->pollOptionId = $pollOptionId;
        $this->pollOptionName = $pollOptionName;
        $this->pollOptionStatus = $pollOptionStatus;
        $this->poll = $poll;
    }

    // Getters
    public function getPollOptionId(): int {
        return $this->pollOptionId;
    }

    public function getPollOptionName(): string {
        return $this->pollOptionName;
    }

    public function getPollOptionStatus(): bool {
        return $this->pollOptionStatus;
    }

    public function getPoll(): Poll {
        return $this->poll;
    }

    // Setters
    public function setPollOptionId(int $pollOptionId): void {
        $this->pollOptionId = $pollOptionId;
    }

    public function setPollOptionName(string $pollOptionName): void {
        $this->pollOptionName = $pollOptionName;
    }

    public function setPollOptionStatus(bool $pollOptionStatus): void {
        $this->pollOptionStatus = $pollOptionStatus;
    }

    public function setPoll(Poll $poll): void {
        $this->poll = $poll;
    }
}
