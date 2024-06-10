<?php

require_once 'user.php';
require_once 'pollOption.php';

class PollVote {
    private int $pollVoteId;
    private User $pollVoteUser;
    private int $pollOptionId;

    public function __construct() {
        $this->pollVoteId = 0;
        $this->pollVoteUser = new User();
        $this->pollOptionId = 0;
    }

    // Getters
    public function getPollVoteId(): int {
        return $this->pollVoteId;
    }

    public function getPollVoteUser(): User {
        return $this->pollVoteUser;
    }

    public function getPollOptionId(): int {
        return $this->pollOptionId;
    }

    // Setters
    public function setPollVoteId(int $pollVoteId): void {
        $this->pollVoteId = $pollVoteId;
    }

    public function setPollVoteUser(User $user): void {
        $this->pollVoteUser = $user;
    }

    public function setPollOptionId(int $pollOptionId): void {
        $this->pollOptionId = $pollOptionId;
    }

    public function toArray(): array {
        return [
            'pollVoteId' => $this->pollVoteId,
            'pollVoteUser' => $this->pollVoteUser->toArray(),
            'pollOptionId' => $this->pollOptionId,
        ];
    }

    public static function createFromObject($obj): PollVote {
        $pollVote = new PollVote();

        $pollVote->setPollVoteId($obj->pollVoteId);
        $pollVote->setPollVoteUser(User::createFromObject($obj->pollVoteUser));
        $pollVote->setPollOptionId($obj->pollOptionId);

        return $pollVote;
    }

    public static function createFromDb($array): PollVote {
        $pollVote = new PollVote();

        $pollVote->setPollVoteId($array["poll_Vote_id"]);
        $pollVote->setPollOptionId($array["poll_Option_id"]);

        return $pollVote;
    }
}
