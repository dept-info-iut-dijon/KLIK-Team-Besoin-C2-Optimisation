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
    private User $eventUser;

    public function __construct() {
        $this->eventId = 0;
        $this->eventTitle = "";
        $this->eventDateCreated = new DateTime();
        $this->eventDate = new DateTime();
        $this->eventImg = "";
        $this->eventHeadline = "";
        $this->eventDescription = "";
        $this->eventUser = new User();
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

    public function getEventUser(): User {
        return $this->eventUser;
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

    public function setEventUser(User $user): void {
        $this->eventUser = $user;
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
            'eventUser' => $this->eventUser->toArray() // Appel de la méthode toArray de l'objet complexe User
        ];
    }

    public static function createFromObject($obj): Event {
        $event = new Event();

        $event->setEventId($obj->eventId);
        $event->setEventTitle($obj->eventTitle);
        $event->setEventDateCreated(new DateTime($obj->eventDateCreated));
        $event->setEventDate(new DateTime($obj->eventDate));
        $event->setEventImg($obj->eventImage);
        $event->setEventHeadline($obj->eventHeadline);
        $event->setEventDescription($obj->eventDescription);
        $event->setEventUser(User::createFromObject($obj->eventUser));

        return $event;
    }

    public static function createFromDb($array): Event {
        $event = new Event();

        $event->setEventId($array["event_id"]);
        $event->setEventTitle($array["event_title"]);
        $event->setEventDateCreated(new DateTime($array["event_date_created"]));
        $event->setEventDate(new DateTime($array["event_date"]));
        $event->setEventImg($array["event_img"]);
        $event->setEventHeadline($array["event_headline"]);
        $event->setEventDescription($array["event_description"]);

        return $event;
    }
}
