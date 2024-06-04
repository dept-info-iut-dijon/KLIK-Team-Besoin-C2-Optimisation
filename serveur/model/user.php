<?php

class User {
    private int $userId;
    private int $userLevel;
    private string $userFirstName;
    private string $userLastName;
    private string $username;
    private string $userEmail;
    private string $userPasswordHash;
    private string $userGender;
    private string $userHeadline;
    private string $userBio;
    private string $userImg;

    public function __construct(int $userId, int $userLevel, string $userFirstName, string $userLastName, string $username, string $userEmail, string $userPasswordHash, string $userGender, string $userHeadline, string $userBio, string $userImg) {
        $this->userId = $userId;
        $this->userLevel = $userLevel;
        $this->userFirstName = $userFirstName;
        $this->userLastName = $userLastName;
        $this->username = $username;
        $this->userEmail = $userEmail;
        $this->userPasswordHash = $userPasswordHash;
        $this->userGender = $userGender;
        $this->userHeadline = $userHeadline;
        $this->userBio = $userBio;
        $this->userImg = $userImg;
    }

    // Getters
    public function getUserId(): int {
        return $this->userId;
    }

    public function getUserLevel(): int {
        return $this->userLevel;
    }

    public function getUserFirstName(): string {
        return $this->userFirstName;
    }

    public function getUserLastName(): string {
        return $this->userLastName;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getUserEmail(): string {
        return $this->userEmail;
    }

    public function getUserPasswordHash(): string {
        return $this->userPasswordHash;
    }

    public function getUserGender(): string {
        return $this->userGender;
    }

    public function getUserHeadline(): string {
        return $this->userHeadline;
    }

    public function getUserBio(): string {
        return $this->userBio;
    }

    public function getUserImg(): string {
        return $this->userImg;
    }

    // Setters
    public function setUserId(int $userId): void {
        $this->userId = $userId;
    }

    public function setUserLevel(int $userLevel): void {
        $this->userLevel = $userLevel;
    }

    public function setUserFirstName(string $userFirstName): void {
        $this->userFirstName = $userFirstName;
    }

    public function setUserLastName(string $userLastName): void {
        $this->userLastName = $userLastName;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function setUserEmail(string $userEmail): void {
        $this->userEmail = $userEmail;
    }

    public function setUserPasswordHash(string $userPasswordHash): void {
        $this->userPasswordHash = $userPasswordHash;
    }

    public function setUserGender(string $userGender): void {
        $this->userGender = $userGender;
    }

    public function setUserHeadline(string $userHeadline): void {
        $this->userHeadline = $userHeadline;
    }

    public function setUserBio(string $userBio): void {
        $this->userBio = $userBio;
    }

    public function setUserImg(string $userImg): void {
        $this->userImg = $userImg;
    }
}
