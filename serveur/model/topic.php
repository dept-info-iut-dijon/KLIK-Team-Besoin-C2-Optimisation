<?php

require_once 'category.php';
require_once 'user.php';

class Topic {
    private int $topicId;
    private string $topicSubject;
    private DateTime $topicDate;
    private Category $topicCategory;
    private User $topicUser;

    public function __construct(int $topicId, string $topicSubject, DateTime $topicDate, Category $category, User $user) {
        $this->topicId = $topicId;
        $this->topicSubject = $topicSubject;
        $this->topicDate = $topicDate;
        $this->topicCategory = $category;
        $this->topicUser = $user;
    }

    // Getters
    public function getTopicId(): int {
        return $this->topicId;
    }

    public function getTopicSubject(): string {
        return $this->topicSubject;
    }

    public function getTopicDate(): DateTime {
        return $this->topicDate;
    }

    public function getCategory(): Category {
        return $this->topicCategory;
    }

    public function getUser(): User {
        return $this->topicUser;
    }

    // Setters
    public function setTopicId(int $topicId): void {
        $this->topicId = $topicId;
    }

    public function setTopicSubject(string $topicSubject): void {
        $this->topicSubject = $topicSubject;
    }

    public function setTopicDate(DateTime $topicDate): void {
        $this->topicDate = $topicDate;
    }

    public function setCategory(Category $category): void {
        $this->topicCategory = $category;
    }

    public function setUser(User $user): void {
        $this->topicUser = $user;
    }

        // Ajouter la méthode toArray pour convertir l'objet en tableau associatif
        public function toArray(): array {
            return [
                'topicId' => $this->topicId,
                'subject' => $this->topicSubject,
                'date' => $this->topicDate->format('Y-m-d H:i:s'), // Formatage de la date
                'category' => $this->topicCategory->toArray(), // Appel de toArray sur l'objet Category
                'user' => $this->topicUser->toArray() // Appel de toArray sur l'objet User
            ];
        }
}
