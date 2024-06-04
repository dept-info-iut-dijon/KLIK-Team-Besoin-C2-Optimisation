<?php
class Topic{
    private int $id;
    private string $subject;
    private DateTime $date;
    private int $catId;
    private User $user;


    // Constructor
    public function __construct(
        int $id,
        string $subject,
        DateTime $date,
        int $catId,
        User $user
    ) {
        $this->id = $id;
        $this->subject = $subject;
        $this->date = $date;
        $this->catId = $catId;
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

    // Getter and Setter for date
    public function getDate(): DateTime {
        return $this->date;
    }

    public function setDate(DateTime $date): void {
        $this->date = $date;
    }

    // Getter and Setter for catId
    public function getCatId(): int {
        return $this->catId;
    }

    public function setCatId(int $catId): void {
        $this->catId = $catId;
    }

    // Getter and Setter for userId
    public function getUser(): User {
        return $this->user;
    }

    public function setUser(User $user): void {
        $this->user = $user;
    }
}
?>