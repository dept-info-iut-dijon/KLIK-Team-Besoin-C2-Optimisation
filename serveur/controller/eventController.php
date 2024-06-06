<?php
require_once '../manager/eventManager.php'; 
require_once '../model/event.php';
require_once '../data/userDAO.php';

class EventController {
    private EventManager $eventManager;

    public function __construct() {
        $this->eventManager = new EventManager();
    }

    public function createEvent() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['event'])) {
                $eventArray = $data['event'];
                $event = new Event(
                    0, 
                    $eventArray['eventTitle'],
                    new DateTime($eventArray['eventDateCreated']),
                    new DateTime($eventArray['eventDate']),
                    $eventArray['eventImg'],
                    $eventArray['eventHeadline'],
                    $eventArray['eventDescription'],
                    (new UserDAO())->read($eventArray['userId'])
                );

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

    public function getEventById($eventId) {
        $event = $this->eventManager->getEventById($eventId);
        if ($event) {
            echo json_encode($event);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Event not found']);
        }
    }

    public function updateEvent() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data && isset($data['event'])) {
                $eventArray = $data['event'];
                $event = new Event(
                    $eventArray['eventId'],
                    $eventArray['eventTitle'],
                    new DateTime($eventArray['eventDateCreated']),
                    new DateTime($eventArray['eventDate']),
                    $eventArray['eventImg'],
                    $eventArray['eventHeadline'],
                    $eventArray['eventDescription'],
                    (new UserDAO())->read($eventArray['userId'])
                );

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

    public function deleteEvent($eventId) {
        $result = $this->eventManager->deleteEvent($eventId);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Event deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete event']);
        }
    }

    public function getAllEvents() {
        $events = $this->eventManager->getAllEvents();
        echo json_encode($events);
    }
}

if (isset($_GET['action'])) {
    $controller = new EventController();
    $action = $_GET['action'];

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
} else {
    echo json_encode(['status' => 'error', 'message' => 'No action specified']);
}

?>
