<?php

class PollVote {
    private int $pollVoteId;
    private User $user;
    private PollOption $pollOption;

    public function __construct(int $pollVoteId, User $user, PollOption $pollOption) {
        $this->pollVoteId = $pollVoteId;
        $this->user = $user;
        $this->pollOption = $pollOption;
    }

    // Getters
    public function getPollVoteId(): int {
        return $this->pollVoteId;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function getPollOption(): PollOption {
        return $this->pollOption;
    }

    // Setters
    public function setPollVoteId(int $pollVoteId): void {
        $this->pollVoteId = $pollVoteId;
    }

    public function setUser(User $user): void {
        $this->user = $user;
    }

    public function setPollOption(PollOption $pollOption): void {
        $this->pollOption = $pollOption;
    }
}
