<?php
class Post{
    private int $postId;
    private string $postContent;
    private DateTime $postDate;
    private int $postTopic;
    private User $postUser;

    
    // Constructor
    public function __construct(
        int $postId,
        string $postContent,
        DateTime $postDate,
        int $postTopic,
        User $postUser
    ) {
        $this->postId = $postId;
        $this->postContent = $postContent;
        $this->postDate = $postDate;
        $this->postTopic = $postTopic;
        $this->postUser = $postUser;
    }

    // Getter and Setter for postId
    public function getPostId(): int {
        return $this->postId;
    }

    public function setPostId(int $postId): void {
        $this->postId = $postId;
    }

    // Getter and Setter for postContent
    public function getPostContent(): string {
        return $this->postContent;
    }

    public function setPostContent(string $postContent): void {
        $this->postContent = $postContent;
    }

    // Getter and Setter for postDate
    public function getPostDate(): DateTime {
        return $this->postDate;
    }

    public function setPostDate(DateTime $postDate): void {
        $this->postDate = $postDate;
    }

    // Getter and Setter for postTopic
    public function getPostTopic(): int {
        return $this->postTopic;
    }

    public function setPostTopic(int $postTopic): void {
        $this->postTopic = $postTopic;
    }

    // Getter and Setter for postUser
    public function getPostUser(): User {
        return $this->postUser;
    }

    public function setPostUser(User $postUser): void {
        $this->postUser = $postUser;
    }
}
?>