<?php

class PwdReset {
    private int $resetId;
    private string $resetEmail;
    private string $resetSelector;
    private string $resetToken;
    private string $resetExpires;

    public function __construct() {
        $this->resetId = 0;
        $this->resetEmail = "";
        $this->resetSelector = "";
        $this->resetToken = "";
        $this->resetExpires = "";
    }

    // Getters
    public function getResetId(): int {
        return $this->resetId;
    }

    public function getResetEmail(): string {
        return $this->resetEmail;
    }

    public function getResetSelector(): string {
        return $this->resetSelector;
    }

    public function getResetToken(): string {
        return $this->resetToken;
    }

    public function getResetExpires(): string {
        return $this->resetExpires;
    }

    // Setters
    public function setResetId(int $resetId): void {
        $this->resetId = $resetId;
    }

    public function setResetEmail(string $resetEmail): void {
        $this->resetEmail = $resetEmail;
    }

    public function setResetSelector(string $resetSelector): void {
        $this->resetSelector = $resetSelector;
    }

    public function setResetToken(string $resetToken): void {
        $this->resetToken = $resetToken;
    }

    public function setResetExpires(string $resetExpires): void {
        $this->resetExpires = $resetExpires;
    }

    public function toArray(): array {
        return [
            'resetId' => $this->resetId,
            'resetEmail' => $this->resetEmail,
            'resetSelector' => $this->resetSelector,
            'resetToken' => $this->resetToken,
            'resetExpires' => $this->resetExpires
        ];
    }

    public static function createFromObject($obj): PwdReset {
        $pwdReset = new PwdReset();

        $pwdReset->setResetId($obj->resetId);
        $pwdReset->setResetEmail($obj->resetEmail);
        $pwdReset->setResetSelector($obj->resetSelector);
        $pwdReset->setResetToken($obj->resetToken);
        $pwdReset->setResetExpires($obj->resetExpires);

        return $pwdReset;
    }

    public static function createFromDb($obj): PwdReset {
        $pwdReset = new PwdReset();

        $pwdReset->setResetId($obj["reset_id"]);
        $pwdReset->setResetEmail($obj["reset_email"]);
        $pwdReset->setResetSelector($obj["reset_selector"]);
        $pwdReset->setResetToken($obj["reset_token"]);
        $pwdReset->setResetExpires($obj["reset_expires"]);

        return $pwdReset;
    }
}
