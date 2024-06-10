<?php
require_once '../data/interface/eventDAOInterface.php';
require_once '../model/event.php';

require_once 'userDAO.php';
require_once '../model/user.php';


class EventDAO implements EventDAOInterface {
    private Database $db;
    private UserDAO $userDAO;

    public function __construct() {
        $this->db = new Database();
        $this->userDAO = new UserDAO();
    }

    /**
     * @throws Exception
     */
    public function create(Event $event): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                $event->getEventTitle(),
                $event->getEventDateCreated()->format('Y-m-d'),
                $event->getEventDate()->format('Y-m-d'),
                $event->getEventImg(),
                $event->getEventHeadline(),
                $event->getEventDescription(),
                $event->getUser()->getUserId()
            ];
            $sql = "INSERT INTO Events (event_title, event_date_created, event_date, event_img, event_headline, event_description, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";

            $this->db->execute($sql, $params);
            $this->db->commit();
        }
        catch (Exception $e)
        {
            $this->db->rollBack();
            throw $e;
        }

        return true;
    }

    /**
     * @throws Exception
     */
    public function read(int $eventId): ?Event {
        $result = $this->db->query("SELECT * FROM Events WHERE event_id = ?", [$eventId]);

        if(count($result) === 0)
            throw new Exception("Event not found");

        $user = $this->userDAO->read($result[0]["user_id"]);

        $event = Event::createFromDb($result[0]);
        $event->setEventUser($user);

        return $event;
    }

    /**
     * @throws Exception
     */
    public function update(Event $event): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                $event->getEventTitle(),
                $event->getEventDateCreated()->format('Y-m-d'),
                $event->getEventDate()->format('Y-m-d'),
                $event->getEventImg(),
                $event->getEventHeadline(),
                $event->getEventDescription(),
                $event->getEventUser()->getUserId(),
                $event->getEventId()
            ];
            $sql = "UPDATE Events SET event_title = ?, event_date_created = ?, event_date = ?, event_img = ?, event_headline = ?, event_description = ?, user_id = ? WHERE event_id = ?";

            $this->db->execute($sql, $params);
            $this->db->commit();
        }
        catch (Exception $e)
        {
            $this->db->rollBack();
            throw $e;
        }

        return true;
    }

    /**
     * @throws Exception
     */
    public function delete(int $eventId): bool {
        $this->db->beginTransaction();
        try
        {
            $this->db->query("DELETE FROM Events WHERE event_id = ?", [$eventId]);
            $this->db->commit();
        }
        catch (Exception $e)
        {
            $this->db->rollBack();
            throw $e;
        }

        return true;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getAll(): array {
        $events = $this->db->query("SELECT * FROM Events");

        return array_map(function($item) {
            $user = $this->userDAO->read($item["user_id"]);

            $event = Event::createFromDb($item);
            $event->setEventUser($user);

            return $event;
        }, $events);
    }
}