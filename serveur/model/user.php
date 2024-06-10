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
    private string $userImage;

    public function __construct() {
        $this->userId = 0;
        $this->userLevel = 0;
        $this->userFirstName = "";
        $this->userLastName = "";
        $this->username = "";
        $this->userEmail = "";
        $this->userPassword = "";
        $this->userGender = "";
        $this->userHeadline = "";
        $this->userBio = "";
        $this->userImage = "";
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
        return $this->userPassword;
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

    public function getUserImage(): string {
        return $this->userImage;
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

    public function setUserPasswordHash(string $userPassword): void {
        $this->userPassword = $userPassword;
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

    public function setUserImage(string $userImage): void {
        $this->userImage = $userImage;
    }

        // Ajouter la méthode toArray pour convertir l'objet en tableau associatif
    public function toArray(): array {
        return [
            'userId' => $this->userId,
            'userLevel' => $this->userLevel,
            'userFirstName' => $this->userFirstName,
            'userLastName' => $this->userLastName,
            'username' => $this->username,
            'userEmail' => $this->userEmail,
            'userPasswordHash' => $this->userPassword,
            'userGender' => $this->userGender,
            'userHeadline' => $this->userHeadline,
            'userBio' => $this->userBio,
            'userImage' => $this->userImage
        ];
    }

    public static function createFromObject($obj): User {
        $user = new User();

        $user->setUserId($obj->userId);
        $user->setUserLevel($obj->userLevel);
        $user->setUserFirstName($obj->userFirstName);
        $user->setUserLastName($obj->userLastName);
        $user->setUsername($obj->username);
        $user->setUserEmail($obj->userEmail);
        $user->setUserPasswordHash($obj->userPassword);
        $user->setUserGender($obj->userGender);
        $user->setUserHeadline($obj->userHeadline);
        $user->setUserBio($obj->userBio);
        $user->setUserImage($obj->userImage);

        return $user;
    }

    public static function createFromDb($array): User {
        $user = new User();

        $user->setUserId($array["user_id"]);
        $user->setUserLevel($array["user_level"]);
        $user->setUserFirstName($array["user_first_name"]);
        $user->setUserLastName($array["user_last_name"]);
        $user->setUsername($array["username"]);
        $user->setUserEmail($array["user_email"]);
        $user->setUserPasswordHash($array["user_password_hash"]);
        $user->setUserGender($array["user_gender"]);
        $user->setUserHeadline($array["user_headline"]);
        $user->setUserBio($array["user_bio"]);
        $user->setUserImage($array["user_img"]);

        return $user;
    }
}
