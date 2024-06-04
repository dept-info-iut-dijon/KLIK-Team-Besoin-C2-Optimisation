<?php

class User {
    private int $id;
    private int $level;
    private string $first_name;
    private string $last_name;
    private string $username;
    private string $email;
    private string $passwordHash;
    private string $gender;
    private string $headline;
    private string $bio;
    private string $img;

     // Getter and Setter for id
     public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    // Getter and Setter for level
    public function getLevel(): int {
        return $this->level;
    }

    public function setLevel(int $level): void {
        $this->level = $level;
    }

    // Getter and Setter for first_name
    public function getFirstName(): string {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): void {
        $this->first_name = $first_name;
    }

    // Getter and Setter for last_name
    public function getLastName(): string {
        return $this->last_name;
    }

    public function setLastName(string $last_name): void {
        $this->last_name = $last_name;
    }

    // Getter and Setter for username
    public function getUsername(): string {
        return $this->username;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    // Getter and Setter for email
    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    // Getter and Setter for password_hash
    public function getPasswordHash(): string {
        return $this->passwordHash;
    }

    public function setPasswordHash(string $passwordHash): void {
        $this->passwordHash = $passwordHash;
    }

    // Getter and Setter for gender
    public function getGender(): string {
        return $this->gender;
    }

    public function setGender(string $gender): void {
        $this->gender = $gender;
    }

    // Getter and Setter for headline
    public function getHeadline(): string {
        return $this->headline;
    }

    public function setHeadline(string $headline): void {
        $this->headline = $headline;
    }

    // Getter and Setter for bio
    public function getBio(): string {
        return $this->bio;
    }

    public function setBio(string $bio): void {
        $this->bio = $bio;
    }

    // Getter and Setter for img
    public function getImg(): string {
        return $this->img;
    }

    public function setImg(string $img): void {
        $this->img = $img;
    }

     // Constructor
     public function __construct(
        int $id,
        int $level,
        string $first_name,
        string $last_name,
        string $username,
        string $email,
        string $passwordHash,
        string $gender,
        string $headline,
        string $bio,
        string $img
    ) {
        $this->id = $id;
        $this->level = $level;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->username = $username;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->gender = $gender;
        $this->headline = $headline;
        $this->bio = $bio;
        $this->img = $img;
    }
}

?>