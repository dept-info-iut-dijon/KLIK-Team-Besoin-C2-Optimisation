<?php

class PostDAO implements PostDAOInterface {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function create(Post $post): bool {
        $sql = "INSERT INTO Posts (post_content, post_date, topic_id, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $post->getPostContent(),
            $post->getPostDate()->format('Y-m-d'),
            $post->getTopic()->getTopicId(),
            $post->getUser()->getUserId()
        ]);
    }

    public function read(int $postId): ?Post {
        $sql = "SELECT * FROM Posts WHERE post_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$postId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $topicDAO = new TopicDAO();
            $userDAO = new UserDAO();
            $topic = $topicDAO->read($row['topic_id']);
            $user = $userDAO->read($row['user_id']);
            return new Post(
                $row['post_id'],
                $row['post_content'],
                new DateTime($row['post_date']),
                $topic,
                $user
            );
        }
        return null;
    }

    public function update(Post $post): bool {
        $sql = "UPDATE Posts SET post_content = ?, post_date = ?, topic_id = ?, user_id = ? WHERE post_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $post->getPostContent(),
            $post->getPostDate()->format('Y-m-d'),
            $post->getTopic()->getTopicId(),
            $post->getUser()->getUserId(),
            $post->getPostId()
        ]);
    }

    public function delete(int $postId): bool {
        $sql = "DELETE FROM Posts WHERE post_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$postId]);
    }

    public function getAll(): array {
        $sql = "SELECT * FROM Posts";
        $stmt = $this->pdo->query($sql);
        $posts = [];
        $topicDAO = new TopicDAO();
        $userDAO = new UserDAO();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $topic = $topicDAO->read($row['topic_id']);
            $user = $userDAO->read($row['user_id']);
            $posts[] = new Post(
                $row['post_id'],
                $row['post_content'],
                new DateTime($row['post_date']),
                $topic,
                $user
            );
        }
        return $posts;
    }
}