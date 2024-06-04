<?php
class Post{
    private int $id;
    private string $content;
    private DateTime $date;
    private int $topicId;
    private User $user;

     // Constructor
     public function __construct(
        int $id,
        string $content,
        DateTime $date,
        int $topicId,
        User $user
    ) {
        $this->id = $id;
        $this->content = $content;
        $this->date = $date;
        $this->topicId = $topicId;
        $this->user = $user;
    }

    // Getter and Setter for id
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    // Getter and Setter for content
    public function getContent(): string {
        return $this->content;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }

    // Getter and Setter for date
    public function getDate(): DateTime {
        return $this->date;
    }

    public function setDate(DateTime $date): void {
        $this->date = $date;
    }

    // Getter and Setter for topicId
    public function getTopicId(): int {
        return $this->topicId;
    }

    public function setTopicId(int $topicId): void {
        $this->topicId = $topicId;
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