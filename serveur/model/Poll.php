<?php
class Poll{
    private int $id;
    private string $subject;
    private DateTime $created;
    private DateTime $modified;
    private bool $status;
    private string $description;
    private bool $locked;
    private User $user;

      // Constructor
      public function __construct(
        int $id,
        string $subject,
        DateTime $created,
        DateTime $modified,
        int $status,
        string $description,
        int $locked,
        User $user
    ) {
        $this->id = $id;
        $this->subject = $subject;
        $this->created = $created;
        $this->modified = $modified;
        $this->status = $status;
        $this->description = $description;
        $this->locked = $locked;
        $this->user = $user;
    }

    // Getter and Setter for id
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    // Getter and Setter for subject
    public function getSubject(): string {
        return $this->subject;
    }

    public function setSubject(string $subject): void {
        $this->subject = $subject;
    }

    // Getter and Setter for created
    public function getCreated(): DateTime {
        return $this->created;
    }

    public function setCreated(DateTime $created): void {
        $this->created = $created;
    }

    // Getter and Setter for modified
    public function getModified(): DateTime {
        return $this->modified;
    }

    public function setModified(DateTime $modified): void {
        $this->modified = $modified;
    }

    // Getter and Setter for status
    public function getStatus(): int {
        return $this->status;
    }

    public function setStatus(int $status): void {
        $this->status = $status;
    }

    // Getter and Setter for description
    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    // Getter and Setter for locked
    public function getLocked(): int {
        return $this->locked;
    }

    public function setLocked(int $locked): void {
        $this->locked = $locked;
    }

    // Getter and Setter for userId
    public function getUser(): User {
        return $this->user;
    }

    public function setUserId(User $user): void {
        $this->user = $user;
    }
}
?>