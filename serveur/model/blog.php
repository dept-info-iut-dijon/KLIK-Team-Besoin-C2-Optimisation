<?php

require_once 'user.php';

class Blog {
    private int $blogId;
    private string $blogTitle;
    private string $blogImg;
    private DateTime $blogDate;
    private string $blogContent;
    private User $user;

    public function __construct(int $blogId, string $blogTitle, string $blogImg, DateTime $blogDate, string $blogContent, User $user) {
        $this->blogId = $blogId;
        $this->blogTitle = $blogTitle;
        $this->blogImg = $blogImg;
        $this->blogDate = $blogDate;
        $this->blogContent = $blogContent;
        $this->user = $user;
    }

    // Getters
    public function getBlogId(): int {
        return $this->blogId;
    }

    public function getBlogTitle(): string {
        return $this->blogTitle;
    }

    public function getBlogImg(): string {
        return $this->blogImg;
    }

    public function getBlogDate(): DateTime {
        return $this->blogDate;
    }

    public function getBlogContent(): string {
        return $this->blogContent;
    }

    public function getUser(): User {
        return $this->user;
    }

    // Setters
    public function setBlogId(int $blogId): void {
        $this->blogId = $blogId;
    }

    public function setBlogTitle(string $blogTitle): void {
        $this->blogTitle = $blogTitle;
    }

    public function setBlogImg(string $blogImg): void {
        $this->blogImg = $blogImg;
    }

    public function setBlogDate(DateTime $blogDate): void {
        $this->blogDate = $blogDate;
    }

    public function setBlogContent(string $blogContent): void {
        $this->blogContent = $blogContent;
    }

    public function setUser(User $user): void {
        $this->user = $user;
    }

    public function toArray(): array {
        return [
            'blogId' => $this->blogId,
            'blogTitle' => $this->blogTitle,
            'blogImg' => $this->blogImg,
            'blogDate' => $this->blogDate->format('Y-m-d H:i:s'), 
            'blogContent' => $this->blogContent,
            'user' => $this->user->toArray() 
        ];
    }
}
