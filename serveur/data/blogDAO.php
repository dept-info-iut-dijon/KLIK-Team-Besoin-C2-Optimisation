<?php

class BlogDAO implements BlogDAOInterface {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function create(Blog $blog): bool {
        $sql = "INSERT INTO Blogs (blog_title, blog_img, blog_date, blog_content, user_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $blog->getBlogTitle(),
            $blog->getBlogImg(),
            $blog->getBlogDate()->format('Y-m-d'),
            $blog->getBlogContent(),
            $blog->getUser()->getUserId()
        ]);
    }

    public function read(int $blogId): ?Blog {
        $sql = "SELECT * FROM Blogs WHERE blog_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$blogId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $userDAO = new UserDAO();
            $user = $userDAO->read($row['user_id']);
            return new Blog(
                $row['blog_id'],
                $row['blog_title'],
                $row['blog_img'],
                new DateTime($row['blog_date']),
                $row['blog_content'],
                $user
            );
        }
        return null;
    }

    public function update(Blog $blog): bool {
        $sql = "UPDATE Blogs SET blog_title = ?, blog_img = ?, blog_date = ?, blog_content = ?, user_id = ? WHERE blog_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $blog->getBlogTitle(),
            $blog->getBlogImg(),
            $blog->getBlogDate()->format('Y-m-d'),
            $blog->getBlogContent(),
            $blog->getUser()->getUserId(),
            $blog->getBlogId()
        ]);
    }

    public function delete(int $blogId): bool {
        $sql = "DELETE FROM Blogs WHERE blog_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$blogId]);
    }

    public function getAll(): array {
        $sql = "SELECT * FROM Blogs";
        $stmt = $this->pdo->query($sql);
        $blogs = [];
        $userDAO = new UserDAO();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user = $userDAO->read($row['user_id']);
            $blogs[] = new Blog(
                $row['blog_id'],
                $row['blog_title'],
                $row['blog_img'],
                new DateTime($row['blog_date']),
                $row['blog_content'],
                $user
            );
        }
        return $blogs;
    }
}