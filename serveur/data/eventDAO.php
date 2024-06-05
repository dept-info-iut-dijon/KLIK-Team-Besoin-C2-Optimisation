<?php
require_once '../data/interface/eventDAOInterface.php';
require_once '../model/event.php';

require_once 'userDAO.php';
require_once '../model/user.php';


class EventDAO implements EventDAOInterface {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function create(Event $event): bool {
        $sql = "INSERT INTO Events (event_title, event_date_created, event_date, event_img, event_headline, event_description, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $event->getEventTitle(),
            $event->getEventDateCreated()->format('Y-m-d'),
            $event->getEventDate()->format('Y-m-d'),
            $event->getEventImg(),
            $event->getEventHeadline(),
            $event->getEventDescription(),
            $event->getUser()->getUserId()
        ]);
    }

    public function read(int $eventId): ?Event {
        $sql = "SELECT * FROM Events WHERE event_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$eventId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $userDAO = new UserDAO();
            $user = $userDAO->read($row['user_id']);
            return new Event(
                $row['event_id'],
                $row['event_title'],
                new DateTime($row['event_date_created']),
                new DateTime($row['event_date']),
                $row['event_img'],
                $row['event_headline'],
                $row['event_description'],
                $user
            );
        }
        return null;
    }

    public function update(Event $event): bool {
        $sql = "UPDATE Events SET event_title = ?, event_date_created = ?, event_date = ?, event_img = ?, event_headline = ?, event_description = ?, user_id = ? WHERE event_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $event->getEventTitle(),
            $event->getEventDateCreated()->format('Y-m-d'),
            $event->getEventDate()->format('Y-m-d'),
            $event->getEventImg(),
            $event->getEventHeadline(),
            $event->getEventDescription(),
            $event->getUser()->getUserId(),
            $event->getEventId()
        ]);
    }

    public function delete(int $eventId): bool {
        $sql = "DELETE FROM Events WHERE event_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$eventId]);
    }

    public function getAll(): array {
        $sql = "SELECT * FROM Events";
        $stmt = $this->pdo->query($sql);
        $events = [];
        $userDAO = new UserDAO();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user = $userDAO->read($row['user_id']);
            $events[] = new Event(
                $row['event_id'],
                $row['event_title'],
                new DateTime($row['event_date_created']),
                new DateTime($row['event_date']),
                $row['event_img'],
                $row['event_headline'],
                $row['event_description'],
                $user
            );
        }
        return $events;
    }
}