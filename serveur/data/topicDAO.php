<?php



class TopicDAO implements TopicDAOInterface {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function create(Topic $topic): bool {
        $sql = "INSERT INTO Topics (topic_subject, topic_date, cat_id, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $topic->getTopicSubject(),
            $topic->getTopicDate()->format('Y-m-d'),
            $topic->getCategory()->getCatId(),
            $topic->getUser()->getUserId()
        ]);
    }

    public function read(int $topicId): ?Topic {
        $sql = "SELECT * FROM Topics WHERE topic_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$topicId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $categoryDAO = new CategoryDAO();
            $userDAO = new UserDAO();
            $category = $categoryDAO->read($row['cat_id']);
            $user = $userDAO->read($row['user_id']);
            return new Topic(
                $row['topic_id'],
                $row['topic_subject'],
                new DateTime($row['topic_date']),
                $category,
                $user
            );
        }
        return null;
    }

    public function update(Topic $topic): bool {
        $sql = "UPDATE Topics SET topic_subject = ?, topic_date = ?, cat_id = ?, user_id = ? WHERE topic_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $topic->getTopicSubject(),
            $topic->getTopicDate()->format('Y-m-d'),
            $topic->getCategory()->getCatId(),
            $topic->getUser()->getUserId(),
            $topic->getTopicId()
        ]);
    }

    public function delete(int $topicId): bool {
        $sql = "DELETE FROM Topics WHERE topic_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$topicId]);
    }

    public function getAll(): array {
        $sql = "SELECT * FROM Topics";
        $stmt = $this->pdo->query($sql);
        $topics = [];
        $categoryDAO = new CategoryDAO();
        $userDAO = new UserDAO();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $category = $categoryDAO->read($row['cat_id']);
            $user = $userDAO->read($row['user_id']);
            $topics[] = new Topic(
                $row['topic_id'],
                $row['topic_subject'],
                new DateTime($row['topic_date']),
                $category,
                $user
            );
        }
        return $topics;
    }
}