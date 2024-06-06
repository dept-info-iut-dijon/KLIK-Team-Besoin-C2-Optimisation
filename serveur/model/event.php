<?php

require_once 'user.php';

class Event {
    private int $eventId;
    private string $eventTitle;
    private DateTime $eventDateCreated;
    private DateTime $eventDate;
    private string $eventImg;
    private string $eventHeadline;
    private string $eventDescription;
    private User $user;

    public function __construct(int $eventId, string $eventTitle, DateTime $eventDateCreated, DateTime $eventDate, string $eventImg, string $eventHeadline, string $eventDescription, User $user) {
        $this->eventId = $eventId;
        $this->eventTitle = $eventTitle;
        $this->eventDateCreated = $eventDateCreated;
        $this->eventDate = $eventDate;
        $this->eventImg = $eventImg;
        $this->eventHeadline = $eventHeadline;
        $this->eventDescription = $eventDescription;
        $this->user = $user;
    }

    // Getters
    public function getEventId(): int {
        return $this->eventId;
    }

    public function getEventTitle(): string {
        return $this->eventTitle;
    }

    public function getEventDateCreated(): DateTime {
        return $this->eventDateCreated;
    }

    public function getEventDate(): DateTime {
        return $this->eventDate;
    }

    public function getEventImg(): string {
        return $this->eventImg;
    }

    public function getEventHeadline(): string {
        return $this->eventHeadline;
    }

    public function getEventDescription(): string {
        return $this->eventDescription;
    }

    public function getUser(): User {
        return $this->user;
    }

    // Setters
    public function setEventId(int $eventId): void {
        $this->eventId = $eventId;
    }

    public function setEventTitle(string $eventTitle): void {
        $this->eventTitle = $eventTitle;
    }

    public function setEventDateCreated(DateTime $eventDateCreated): void {
        $this->eventDateCreated = $eventDateCreated;
    }

    public function setEventDate(DateTime $eventDate): void {
        $this->eventDate = $eventDate;
    }

    public function setEventImg(string $eventImg): void {
        $this->eventImg = $eventImg;
    }

    public function setEventHeadline(string $eventHeadline): void {
        $this->eventHeadline = $eventHeadline;
    }

    public function setEventDescription(string $eventDescription): void {
        $this->eventDescription = $eventDescription;
    }

    public function setUser(User $user): void {
        $this->user = $user;
    }

    public function toArray(): array {
        return [
            'eventId' => $this->eventId,
            'eventTitle' => $this->eventTitle,
            'eventDateCreated' => $this->eventDateCreated->format('Y-m-d H:i:s'), // Formatage de la date en chaîne de caractères
            'eventDate' => $this->eventDate->format('Y-m-d H:i:s'), // Formatage de la date en chaîne de caractères
            'eventImg' => $this->eventImg,
            'eventHeadline' => $this->eventHeadline,
            'eventDescription' => $this->eventDescription,
            'user' => $this->user->toArray() // Appel de la méthode toArray de l'objet complexe User
        ];
    }
}
