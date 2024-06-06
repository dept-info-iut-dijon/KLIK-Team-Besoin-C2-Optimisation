<?php

require_once '../data/interface/userDAOInterface.php';
require_once '../model/user.php';
require_once '../database.php';
class UserDAO implements UserDAOInterface {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function create(User $user): bool {
        $sql = "INSERT INTO Users (user_level, user_first_name, user_last_name, username, user_email, user_password_hash, user_gender, user_headline, user_bio, user_img) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $user->getUserLevel(),
            $user->getUserFirstName(),
            $user->getUserLastName(),
            $user->getUsername(),
            $user->getUserEmail(),
            $user->getUserPasswordHash(),
            $user->getUserGender(),
            $user->getUserHeadline(),
            $user->getUserBio(),
            $user->getUserImage()
        ]);
    }

    public function read(int $userId): ?User {
        $sql = "SELECT * FROM Users WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new User(
                $row['user_id'],
                $row['user_level'],
                $row['user_first_name'],
                $row['user_last_name'],
                $row['username'],
                $row['user_email'],
                $row['user_password_hash'],
                $row['user_gender'],
                $row['user_headline'],
                $row['user_bio'],
                $row['user_img']
            );
        }
        return null;
    }

    public function update(User $user): bool {
        $sql = "UPDATE Users SET user_level = ?, user_first_name = ?, user_last_name = ?, username = ?, user_email = ?, user_password_hash = ?, user_gender = ?, user_headline = ?, user_bio = ?, user_img = ? WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $user->getUserLevel(),
            $user->getUserFirstName(),
            $user->getUserLastName(),
            $user->getUsername(),
            $user->getUserEmail(),
            $user->getUserPasswordHash(),
            $user->getUserGender(),
            $user->getUserHeadline(),
            $user->getUserBio(),
            $user->getUserImage(),
            $user->getUserId()
        ]);
    }

    public function delete(int $userId): bool {
        $sql = "DELETE FROM Users WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$userId]);
    }

    public function getAll(): array {
        $sql = "SELECT * FROM Users";
        $stmt = $this->pdo->query($sql);
        $users = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user = new User(
                $row['user_id'],
                $row['user_level'],
                $row['user_first_name'],
                $row['user_last_name'],
                $row['username'],
                $row['user_email'],
                $row['user_password_hash'],
                $row['user_gender'],
                $row['user_headline'],
                $row['user_bio'],
                $row['user_img']
            );
            $users[] = $user;

        }


        return $users;
    }
}
