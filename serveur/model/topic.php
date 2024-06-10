<?php

require_once 'category.php';
require_once 'user.php';
require_once 'post.php';

class Topic {
    private int $topicId;
    private string $topicSubject;
    private DateTime $topicDate;
    private Category $topicCategory;
    private User $topicUser;
    private array $posts;

    public function __construct() {
        $this->topicId = 0;
        $this->topicSubject = "";
        $this->topicDate = new DateTime();
        $this->topicCategory = new Category();
        $this->topicUser = new User();
        $this->posts = array();
    }

    // Getters
    public function getTopicId(): int {
        return $this->topicId;
    }

    public function getTopicSubject(): string {
        return $this->topicSubject;
    }

    public function getTopicDate(): DateTime {
        return $this->topicDate;
    }

    public function getCategory(): Category {
        return $this->topicCategory;
    }

    public function getTopicUser(): User {
        return $this->topicUser;
    }

    public function getPosts(): array {
        return $this->posts;
    }

    // Setters
    public function setTopicId(int $topicId): void {
        $this->topicId = $topicId;
    }

    public function setTopicSubject(string $topicSubject): void {
        $this->topicSubject = $topicSubject;
    }

    public function setTopicDate(DateTime $topicDate): void {
        $this->topicDate = $topicDate;
    }

    public function setCategory(Category $category): void {
        $this->topicCategory = $category;
    }

    public function setTopicUser(User $user): void {
        $this->topicUser = $user;
    }

    public function setPosts(array $posts): void {
        $this->posts = $posts;
    }

    public function toArray(): array {
        return [
            'topicId' => $this->topicId,
            'subject' => $this->topicSubject,
            'date' => $this->topicDate->format('Y-m-d H:i:s'), // Formatage de la date
            'category' => $this->topicCategory->toArray(), // Appel de toArray sur l'objet Category
            'topicUser' => $this->topicUser->toArray(), // Appel de toArray sur l'objet User
            'posts' => array_map(function($post) { return $post->toArray(); }, $this->posts)
        ];
    }

    public static function createFromObject($obj): Topic {
        $topic = new Topic();

        $topic->setTopicId($obj->topicId);
        $topic->setTopicSubject($obj->topicSubject);
        $topic->setTopicDate(new DateTime($obj->topicDate));
        $topic->setCategory(Category::createFromObject($obj->topicCategory));
        $topic->setTopicUser(User::createFromObject($obj->topicUser));
        $topic->setPosts(array_map(function($post) {
            return Post::createFromObject($post);
        }, $obj->posts));

        return $topic;
    }

    public static function createFromDb($array): Topic {
        $topic = new Topic();

        $topic->setTopicId($array["topic_id"]);
        $topic->setTopicSubject($array["topic_subject"]);
        $topic->setTopicDate(new DateTime($array["topic_date"]));

        return $topic;
    }
}
