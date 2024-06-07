<?php

require_once '../data/interface/postDAOInterface.php';
require_once '../model/post.php';

require_once 'userDAO.php';
require_once '../model/user.php';

require_once 'topicDAO.php';
require_once '../model/topic.php';

require_once '../model/postVote.php';

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

    public function read(int $postId): Post {
        // Récupération des informations du post
        $sql = "SELECT * FROM Posts WHERE post_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$postId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($row) {
            $topicDAO = new TopicDAO();
            $userDAO = new UserDAO();
    
            $topic = $topicDAO->read($row['topic_id']);
            $user = $userDAO->read($row['user_id']);
            
            // Récupération des votes du post
            $postVotes = $this->getPostVotes($postId);
    
            // Retourner le post avec les informations et les votes
            return new Post(
                $row['post_id'],
                $row['post_content'],
                new DateTime($row['post_date']),
                $topic,
                $postVotes,
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
            
            // Récupération des votes du post
            $postVotes = $this->getPostVotes($row['post_id']);
            
            $posts[] = new Post(
                $row['post_id'],
                $row['post_content'],
                new DateTime($row['post_date']),
                $topic,
                $postVotes,
                $user
            );
        }
    
        return $posts;
    }

    public function getPostVotes(int $postId): array {
        $request = "SELECT * FROM post_votes WHERE post_id = ?";
        $stmt = $this->pdo->prepare($request);
        $stmt->execute([$postId]);
        $postVotes = [];
        $userDAO = new UserDAO();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $user = $userDAO->read($row['user_id']);
            $postVote = new PostVote(
                $row['post_Vote_id'],
                new DateTime($row['post_Vote_date']),
                $row['post_Vote'],
                $postId,
                $user
            );

            $postVotes[] = $postVote->toArray();
        }

        return $postVotes;
    }
}