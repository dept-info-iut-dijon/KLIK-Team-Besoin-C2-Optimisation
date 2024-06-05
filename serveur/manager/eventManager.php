<?php
require_once '../data/eventDAO.php';
require_once '../model/event.php';

class EventManager
{
    private EventDAO $eventDAO;

    public function __construct()
    {
        $this->eventDAO = new EventDAO();
    }

    public function createEvent(Event $event): bool
    {
        return $this->eventDAO->create($event);
    }

    public function getEventById(int $eventId): ?Event
    {
        return $this->eventDAO->read($eventId);
    }

    public function updateEvent(Event $event): bool
    {
        return $this->eventDAO->update($event);
    }

    public function deleteEvent(int $eventId): bool
    {
        return $this->eventDAO->delete($eventId);
    }

    public function getAllEvents(): array
    {
        return $this->eventDAO->getAll();
    }
}
