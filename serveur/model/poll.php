<?php

require_once 'user.php';
require_once 'pollOption.php';

class Poll {
    private int $pollId;
    private string $pollSubject;
    private DateTime $pollCreated;
    private DateTime $pollModified;
    private bool $pollStatus;
    private string $pollDescription;
    private bool $pollLocked;
    private User $pollUser;
    private array $pollOptions;

    public function __construct() {
        $this->pollId = 0;
        $this->pollSubject = "";
        $this->pollCreated = new DateTime();
        $this->pollModified = new DateTime();
        $this->pollStatus = false;
        $this->pollDescription = "";
        $this->pollLocked = false;
        $this->pollUser = new User();
        $this->pollOptions = array();
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

    public function getPollUser(): User {
        return $this->pollUser;
    }

    public function getPollOptions(): array {
        return $this->pollOptions;
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

    public function setPollUser(User $user): void {
        $this->pollUser = $user;
    }

    public function setPollOptions(array $pollOptions): void {
        $this->pollOptions = $pollOptions;
    }

    public function toArray(): array {
        return [
            'pollId' => $this->pollId,
            'pollSubject' => $this->pollSubject,
            'pollCreated' => $this->pollCreated->format('Y-m-d H:i:s'),
            'pollModified' => $this->pollModified->format('Y-m-d H:i:s'),
            'pollStatus' => $this->pollStatus,
            'pollDescription' => $this->pollDescription,
            'pollLocked' => $this->pollLocked,
            'pollUser' => $this->pollUser->toArray(),
            'pollOptions' => array_map(function($pollOption) { return $pollOption->toArray(); }, $this->pollOptions)
        ];
    }

    public static function createFromObject($obj): Poll {
        $poll = new Poll();

        $poll->setPollId($obj->pollId);
        $poll->setPollSubject($obj->pollSubject);
        $poll->setPollCreated(new DateTime($obj->pollCreated));
        $poll->setPollModified(new DateTime($obj->pollModified));
        $poll->setPollStatus($obj->pollStatus);
        $poll->setPollDescription($obj->pollDescription);
        $poll->setPollLocked($obj->pollLocked);
        $poll->setPollUser(User::createFromObject($obj->pollUser));
        $poll->setPollOptions(array_map(function($pollOption) {
            return PollOption::createFromObject($pollOption);
        }, $obj->pollOptions));

        return $poll;
    }

    public static function createFromDb($array): Poll {
        $poll = new Poll();

        $poll->setPollId($array["poll_id"]);
        $poll->setPollSubject($array["poll_subject"]);
        $poll->setPollCreated(new DateTime($array["poll_created"]));
        $poll->setPollModified(new DateTime($array["poll_modified"]));
        $poll->setPollStatus($array["poll_status"]);
        $poll->setPollDescription($array["poll_description"]);
        $poll->setPollLocked($array["poll_locked"] == 1);

        return $poll;
    }
}
