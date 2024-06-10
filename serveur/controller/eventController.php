<?php
require_once '../manager/eventManager.php'; 
require_once '../model/event.php';
require_once '../data/userDAO.php';

class EventController {
    private EventManager $eventManager;

    public function __construct() {
        $this->eventManager = new EventManager();
    }

    /**
     * @throws Exception
     */
    public function createEvent(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['event'])) {
                $event = Event::createFromObject($data['event']);

                $result = $this->eventManager->createEvent($event);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Event created successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to create event']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid event data']);
            }
        }
    }

    /**
     * @throws Exception
     */
    public function getEventById($eventId): void
    {
        $event = $this->eventManager->getEventById($eventId);

        if ($event) {
            echo json_encode($event->toArray());
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Event not found']);
        }
    }

    /**
     * @throws Exception
     */
    public function updateEvent(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['event'])) {
                $event = Event::createFromObject($data['event']);

                $result = $this->eventManager->updateEvent($event);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Event updated successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update event']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid event data']);
            }
        }
    }

    /**
     * @throws Exception
     */
    public function deleteEvent($eventId): void
    {
        $result = $this->eventManager->deleteEvent($eventId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Event deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete event']);
        }
    }

    /**
     * @throws Exception
     */
    public function getAllEvents(): void
    {
        $events = $this->eventManager->getAllEvents();

        echo json_encode(array_map(function($event) { return $event->toArray(); }, $events));
    }
}

if (isset($_GET['action'])) {
    $controller = new EventController();
    $action = $_GET['action'];

    try
    {
        switch ($action) {
            case 'create':
                $controller->createEvent();
                break;
            case 'read':
                if (isset($_GET['eventId'])) {
                    $controller->getEventById(intval($_GET['eventId']));
                }
                break;
            case 'update':
                $controller->updateEvent();
                break;
            case 'delete':
                if (isset($_GET['eventId'])) {
                    $controller->deleteEvent(intval($_GET['eventId']));
                }
                break;
            case 'all':
                $controller->getAllEvents();
                break;
            default:
                echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
                break;
        }
    }
    catch (Exception $e)
    {
        echo json_encode(['status' => 'error', 'message' => 'Error has occurred']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No action specified']);
}
