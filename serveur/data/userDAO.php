<?php

require_once '../data/interface/userDAOInterface.php';
require_once '../model/user.php';
require_once '../database.php';

class UserDAO implements UserDAOInterface {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * @throws Exception
     */
    public function create(User $user): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
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
            ];
            $sql = "INSERT INTO Users (user_level, user_first_name, user_last_name, username, user_email, user_password_hash, user_gender, user_headline, user_bio, user_img) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

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
    public function read(int $userId): User {
        $result = $this->db->query("SELECT * FROM Users WHERE user_id = :user_id", [":user_id" => $userId]);

        if(count($result) === 0)
            throw new Exception("User not found");

        return User::createFromDb($result[0]);
    }

    /**
     * @throws Exception
     */
    public function update(User $user): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
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
            ];
            $sql = "UPDATE Users SET user_level = ?, user_first_name = ?, user_last_name = ?, username = ?, user_email = ?, user_password_hash = ?, user_gender = ?, user_headline = ?, user_bio = ?, user_img = ? WHERE user_id = ?";

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
    public function delete(int $userId): bool {
        $this->db->beginTransaction();
        try
        {
            $this->db->query("DELETE FROM Users WHERE user_id = ?", [":user_id" => $userId]);
            $this->db->commit();
        }
        catch (Exception $e)
        {
            $this->db->rollBack();
            throw $e;
        }

        return true;
    }

    public function getAll(): array {
        $users = $this->db->query("SELECT * FROM Users");

        return array_map(function($item) { return User::createFromDb($item); }, $users);
    }
}
