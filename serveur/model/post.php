<?php

require_once 'user.php';

class Post {
    private int $postId;
    private string $postContent;
    private DateTime $postDate;
    private int $topicId;
    private array $postVotes;
    private User $postUser;

    public function __construct() {
        $this->postId = 0;
        $this->postContent = "";
        $this->postDate = new DateTime();
        $this->topicId = 0;
        $this->postVotes = array();
        $this->postUser = new User();
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

    public function getTopicId(): int {
        return $this->topicId;
    }

    public function getPostUser(): User {
        return $this->postUser;
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

    public function setTopicId(int $topicId): void {
        $this->topicId = $topicId;
    }

    public function setPostUser(User $user): void {
        $this->postUser = $user;
    }

    public function setPostVotes(array $postVotes): void{
        $this->postVotes = $postVotes;
    }

    public function toArray(): array {
        return [
            'postId' => $this->postId,
            'postContent' => $this->postContent,
            'postDate' => $this->postDate->format('Y-m-d H:i:s'),
            'topicId' => $this->topicId,
            'postVotes' => array_map(function($postVote) { return $postVote->toArray(); }, $this->postVotes),
            'postUser' => $this->postUser->toArray()
        ];
    }

    public static function createFromObject($obj): Post {
        $post = new Post();

        $post->setPostId($obj->postId);
        $post->setPostContent($obj->postContent);
        $post->setPostDate(new DateTime($obj->postDate));
        $post->setTopicId($obj->topicId);
        $post->setPostVotes(array_map(function($postVote) {
            return PostVote::createFromObject($postVote);
        }, $obj->postVotes));
        $post->setPostUser(User::createFromObject($obj->postUser));

        return $post;
    }

    public static function createFromDb($array): Post {
        $post = new Post();

        $post->setPostId($array["post_id"]);
        $post->setPostContent($array["post_content"]);
        $post->setPostDate(new DateTime($array["post_date"]));
        $post->setTopicId($array["topic_id"]);

        return $post;
    }
}
