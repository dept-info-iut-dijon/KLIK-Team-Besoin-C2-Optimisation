<?php

require_once 'pollVote.php';

class PollOption {
    private int $pollOptionId;
    private string $pollOptionName;
    private bool $pollOptionStatus;
    private int $pollId;
    private array $pollVotes;

    public function __construct() {
        $this->pollOptionId = 0;
        $this->pollOptionName = "";
        $this->pollOptionStatus = false;
        $this->pollId = 0;
        $this->pollVotes = array();
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

    public function getPollId(): int {
        return $this->pollId;
    }

    public function getPollVotes(): array {
        return $this->pollVotes;
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

    public function setPoll(int $pollId): void {
        $this->pollId = $pollId;
    }

    public function setPollVotes(array $pollVotes): void {
        $this->pollVotes = $pollVotes;
    }

    public function toArray(): array {
        return [
            'pollOptionId' => $this->pollOptionId,
            'pollOptionName' => $this->pollOptionName,
            'pollOptionStatus' => $this->pollOptionStatus,
            'pollId' => $this->pollId,
            'pollVotes' => array_map(function($pollVote) { return $pollVote->toArray(); }, $this->pollVotes)
        ];
    }

    public static function createFromObject($obj): PollOption {
        $pollOption = new PollOption();

        $pollOption->setPollOptionId($obj->pollOptionId);
        $pollOption->setPollOptionName($obj->pollOptionName);
        $pollOption->setPollOptionStatus($obj->pollOptionStatus);
        $pollOption->setPoll($obj->pollId);
        $pollOption->setPollVotes(array_map(function($pollVote) {
            return PollVote::createFromObject($pollVote);
        }, $obj->pollVotes));

        return $pollOption;
    }

    public static function createFromDb($array): PollOption {
        $pollOption = new PollOption();

        $pollOption->setPollOptionId($array["poll_Option_id"]);
        $pollOption->setPollOptionName($array["poll_Option_name"]);
        $pollOption->setPollOptionStatus($array["poll_Option_status"]);
        $pollOption->setPoll($array["poll_id"]);

        return $pollOption;
    }
}
