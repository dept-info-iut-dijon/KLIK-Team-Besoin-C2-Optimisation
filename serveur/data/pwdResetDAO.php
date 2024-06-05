<?php

require_once '../data/interface/pwdResetDAOInterface.php';
require_once '../model/pwdReset.php';

class PwdResetDAO implements PwdResetDAOInterface {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function create(PwdReset $pwdReset): bool {
        $sql = "INSERT INTO Pwd_Reset (reset_email, reset_selector, reset_token, reset_expires) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $pwdReset->getResetEmail(),
            $pwdReset->getResetSelector(),
            $pwdReset->getResetToken(),
            $pwdReset->getResetExpires()
        ]);
    }

    public function read(int $resetId): ?PwdReset {
        $sql = "SELECT * FROM Pwd_Reset WHERE reset_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$resetId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new PwdReset(
                $row['reset_id'],
                $row['reset_email'],
                $row['reset_selector'],
                $row['reset_token'],
                $row['reset_expires']
            );
        }
        return null;
    }

    public function update(PwdReset $pwdReset): bool {
        $sql = "UPDATE Pwd_Reset SET reset_email = ?, reset_selector = ?, reset_token = ?, reset_expires = ? WHERE reset_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $pwdReset->getResetEmail(),
            $pwdReset->getResetSelector(),
            $pwdReset->getResetToken(),
            $pwdReset->getResetExpires(),
            $pwdReset->getResetId()
        ]);
    }

    public function delete(int $resetId): bool {
        $sql = "DELETE FROM Pwd_Reset WHERE reset_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$resetId]);
    }

    public function getAll(): array {
        $sql = "SELECT * FROM Pwd_Reset";
        $stmt = $this->pdo->query($sql);
        $pwdResets = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pwdResets[] = new PwdReset(
                $row['reset_id'],
                $row['reset_email'],
                $row['reset_selector'],
                $row['reset_token'],
                $row['reset_expires']
            );
        }
        return $pwdResets;
    }
}