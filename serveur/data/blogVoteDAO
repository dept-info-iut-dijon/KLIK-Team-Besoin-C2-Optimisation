<?php

class BlogVoteDAO implements BlogVoteDAOInterface {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function create(BlogVote $blogVote): bool {
        $sql = "INSERT INTO Blog_Votes (blog_Vote_date, blog_Vote, user_id, blog_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $blogVote->getBlogVoteDate()->format('Y-m-d'),
            $blogVote->getBlogVote(),
            $blogVote->getUser()->getUserId(),
            $blogVote->getBlog()->getBlogId()
        ]);
    }

    public function read(int $blogVoteId): ?BlogVote {
        $sql = "SELECT * FROM Blog_Votes WHERE blog_Vote_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$blogVoteId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $userDAO = new UserDAO();
            $blogDAO = new BlogDAO();
            $user = $userDAO->read($row['user_id']);
            $blog = $blogDAO->read($row['blog_id']);
            return new BlogVote(
                $row['blog_Vote_id'],
                new DateTime($row['blog_Vote_date']),
                $row['blog_Vote'],
                $user,
                $blog
            );
        }
        return null;
    }

    public function update(BlogVote $blogVote): bool {
        $sql = "UPDATE Blog_Votes SET blog_Vote_date = ?, blog_Vote = ?, user_id = ?, blog_id = ? WHERE blog_Vote_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $blogVote->getBlogVoteDate()->format('Y-m-d'),
            $blogVote->getBlogVote(),
            $blogVote->getUser()->getUserId(),
            $blogVote->getBlog()->getBlogId(),
            $blogVote->getBlogVoteId()
        ]);
    }

    public function delete(int $blogVoteId): bool {
        $sql = "DELETE FROM Blog_Votes WHERE blog_Vote_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$blogVoteId]);
    }

    public function getAll(): array {
        $sql = "SELECT * FROM Blog_Votes";
        $stmt = $this->pdo->query($sql);
        $blogVotes = [];
        $userDAO = new UserDAO();
        $blogDAO = new BlogDAO();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user = $userDAO->read($row['user_id']);
            $blog = $blogDAO->read($row['blog_id']);
            $blogVotes[] = new BlogVote(
                $row['blog_Vote_id'],
                new DateTime($row['blog_Vote_date']),
                $row['blog_Vote'],
                $user,
                $blog
            );
        }
        return $blogVotes;
    }
}