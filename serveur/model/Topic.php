<?php
class topic
{
    private int $topicId;
    private string $topicSubject;
    private DateTime $topicDate;
    private int $topicCategory;
    private User $topicUser;

    // Constructor
    public function __construct(
        int $topicId,
        string $topicSubject,
        DateTime $topicDate,
        int $topicCategory,
        User $topicUser
    ) {
        $this->topicId = $topicId;
        $this->topicSubject = $topicSubject;
        $this->topicDate = $topicDate;
        $this->topicCategory = $topicCategory;
        $this->topicUser = $topicUser;
    }

    // Getter and Setter for topicId
    public function getTopicId(): int {
        return $this->topicId;
    }

    public function setTopicId(int $topicId): void {
        $this->topicId = $topicId;
    }

    // Getter and Setter for topicSubject
    public function getTopicSubject(): string {
        return $this->topicSubject;
    }

    public function setTopicSubject(string $topicSubject): void {
        $this->topicSubject = $topicSubject;
    }

    // Getter and Setter for topicDate
    public function getTopicDate(): DateTime {
        return $this->topicDate;
    }

    public function setTopicDate(DateTime $topicDate): void {
        $this->topicDate = $topicDate;
    }

    // Getter and Setter for topicCategory
    public function getTopicCategory(): int {
        return $this->topicCategory;
    }

    public function setTopicCategory(int $topicCategory): void {
        $this->topicCategory = $topicCategory;
    }

    // Getter and Setter for topicUser
    public function getTopicUser(): User {
        return $this->topicUser;
    }

    public function setTopicUser(User $topicUser): void {
        $this->topicUser = $topicUser;
    }
}
