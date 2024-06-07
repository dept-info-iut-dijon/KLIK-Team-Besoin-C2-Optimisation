<?php

require_once 'user.php';
require_once 'topic.php';

class Post {
    private int $postId;
    private string $postContent;
    private DateTime $postDate;
    private Topic $topic;
    private array $postVotes;
    private User $user;

    public function __construct(int $postId, string $postContent, DateTime $postDate, Topic $topic, array $postVotes, User $user) {
        $this->postId = $postId;
        $this->postContent = $postContent;
        $this->postDate = $postDate;
        $this->topic = $topic;
        $this->postVotes = $postVotes;
        $this->user = $user;
    }

    // Getters
    public function getPostId(): int {
        return $this->postId;
    }

    public function getPostContent(): string {
        return $this->postContent;
    }

    public function getPostDate(): DateTime {
        return $this->postDate;
    }

    public function getTopic(): Topic {
        return $this->topic;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function getPostVotes(): array {
        return $this->postVotes;
    }

    // Setters
    public function setPostId(int $postId): void {
        $this->postId = $postId;
    }

    public function setPostContent(string $postContent): void {
        $this->postContent = $postContent;
    }

    public function setPostDate(DateTime $postDate): void {
        $this->postDate = $postDate;
    }

    public function setTopic(Topic $topic): void {
        $this->topic = $topic;
    }

    public function setUser(User $user): void {
        $this->user = $user;
    }

    public function setPostVotes(array $postVotes): void{
        $this->postVotes = $postVotes;
    }

    public function toArray(): array {
        return [
            'postId' => $this->postId,
            'postContent' => $this->postContent,
            'postDate' => $this->postDate->format('Y-m-d H:i:s'),
            'topic' => $this->topic->toArray(),
            'postVotes' => $this->postVotes,
            'user' => $this->user->toArray()
        ];
    }

    public static function createFromObject(object $data): Post {
        $postId = $data->postId;
        $postContent = $data->postContent;
        $postDate = new DateTime($data->postDate);
        $topic = Topic::createFromObject($data->topic); // Assurez-vous que la classe Topic a une méthode similaire
        $postVotes = $data->postVotes;
        $user = User::createFromObject($data->user); // Assurez-vous que la classe User a une méthode similaire

        return new self($postId, $postContent, $postDate, $topic, $postVotes, $user);
    }
}
