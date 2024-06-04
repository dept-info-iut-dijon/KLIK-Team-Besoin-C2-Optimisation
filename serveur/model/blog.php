<?php
class Blog {
    private int $id;
    private string $title;
    private string $img;
    private DateTime $date;
    private string $content;
    private User $user;

      // Constructor
      public function __construct(
        int $id,
        string $title,
        string $img,
        DateTime $date,
        string $content,
        User $user
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->img = $img;
        $this->date = $date;
        $this->content = $content;
        $this->user = $user;
    }

    // Getter and Setter for id
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    // Getter and Setter for title
    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    // Getter and Setter for img
    public function getImg(): string {
        return $this->img;
    }

    public function setImg(string $img): void {
        $this->img = $img;
    }

    // Getter and Setter for date
    public function getDate(): DateTime {
        return $this->date;
    }

    public function setDate(DateTime $date): void {
        $this->date = $date;
    }

    // Getter and Setter for content
    public function getContent(): string {
        return $this->content;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }

    // Getter and Setter for userId
    public function getUser(): User {
        return $this->user;
    }

    public function setUser(User $user): void {
        $this->user = $user;
    }
}
?>