<?php

require_once '../data/interface/pwdResetDAOInterface.php';
require_once '../model/pwdReset.php';

class PwdResetDAO implements PwdResetDAOInterface {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * @throws Exception
     */
    public function create(PwdReset $pwdReset): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                $pwdReset->getResetEmail(),
                $pwdReset->getResetSelector(),
                $pwdReset->getResetToken(),
                $pwdReset->getResetExpires()
            ];
            $sql = "INSERT INTO Pwd_Reset (reset_email, reset_selector, reset_token, reset_expires) VALUES (?, ?, ?, ?)";

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
    public function read(int $resetId): ?PwdReset {
        $result = $this->db->query("SELECT * FROM Pwd_Reset WHERE reset_id = ?", [$resetId]);

        if(count($result) === 0)
            throw new Exception("PasswordReset not found");

        return PwdReset::createFromDb($result[0]);
    }

    /**
     * @throws Exception
     */
    public function update(PwdReset $pwdReset): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                $pwdReset->getResetEmail(),
                $pwdReset->getResetSelector(),
                $pwdReset->getResetToken(),
                $pwdReset->getResetExpires(),
                $pwdReset->getResetId()
            ];
            $sql = "UPDATE Pwd_Reset SET reset_email = ?, reset_selector = ?, reset_token = ?, reset_expires = ? WHERE reset_id = ?";

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
    public function delete(int $resetId): bool {
        $this->db->beginTransaction();
        try
        {
            $this->db->query("DELETE FROM Pwd_Reset WHERE reset_id = ?", [$resetId]);
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
        $pwdResets = $this->db->query("SELECT * FROM Pwd_Reset");

        return array_map(function($item) { return Post::createFromDb($item); }, $pwdResets);
    }
}