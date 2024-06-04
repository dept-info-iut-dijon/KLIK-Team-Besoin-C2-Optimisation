<?php

class User {
    private int $userId;
    private int $userLevel;
    private string $userFirstName;
    private string $userLastName;
    private string $username;
    private string $userEmail;
    private string $userPassword;
    private string $userGender;
    private string $userHeadline;
    private string $userBio;
    private string $userImg;

    // Constructor
    public function __construct(
        int $userId,
        int $userLevel,
        string $userFirstName,
        string $userLastName,
        string $username,
        string $userEmail,
        string $userPassword,
        string $userGender,
        string $userHeadline,
        string $userBio,
        string $userImg
    ) {
        $this->userId = $userId;
        $this->userLevel = $userLevel;
        $this->userFirstName = $userFirstName;
        $this->userLastName = $userLastName;
        $this->username = $username;
        $this->userEmail = $userEmail;
        $this->userPassword = $userPassword;
        $this->userGender = $userGender;
        $this->userHeadline = $userHeadline;
        $this->userBio = $userBio;
        $this->userImg = $userImg;
    }

    // Getter and Setter for userId
    public function getUserId(): int {
        return $this->userId;
    }

    public function setUserId(int $userId): void {
        $this->userId = $userId;
    }

    // Getter and Setter for userLevel
    public function getUserLevel(): int {
        return $this->userLevel;
    }

    public function setUserLevel(int $userLevel): void {
        $this->userLevel = $userLevel;
    }

    // Getter and Setter for userFirstName
    public function getUserFirstName(): string {
        return $this->userFirstName;
    }

    public function setUserFirstName(string $userFirstName): void {
        $this->userFirstName = $userFirstName;
    }

    // Getter and Setter for userLastName
    public function getUserLastName(): string {
        return $this->userLastName;
    }

    public function setUserLastName(string $userLastName): void {
        $this->userLastName = $userLastName;
    }

    // Getter and Setter for username
    public function getUsername(): string {
        return $this->username;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    // Getter and Setter for userEmail
    public function getUserEmail(): string {
        return $this->userEmail;
    }

    public function setUserEmail(string $userEmail): void {
        $this->userEmail = $userEmail;
    }

    // Getter and Setter for userPassword
    public function getUserPassword(): string {
        return $this->userPassword;
    }

    public function setUserPassword(string $userPassword): void {
        $this->userPassword = $userPassword;
    }

    // Getter and Setter for userGender
    public function getUserGender(): string {
        return $this->userGender;
    }

    public function setUserGender(string $userGender): void {
        $this->userGender = $userGender;
    }

    // Getter and Setter for userHeadline
    public function getUserHeadline(): string {
        return $this->userHeadline;
    }

    public function setUserHeadline(string $userHeadline): void {
        $this->userHeadline = $userHeadline;
    }

    // Getter and Setter for userBio
    public function getUserBio(): string {
        return $this->userBio;
    }

    public function setUserBio(string $userBio): void {
        $this->userBio = $userBio;
    }

    // Getter and Setter for userImg
    public function getUserImg(): string {
        return $this->userImg;
    }

    public function setUserImg(string $userImg): void {
        $this->userImg = $userImg;
    }
}

?>