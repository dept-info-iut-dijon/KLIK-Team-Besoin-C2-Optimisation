<?php

require_once 'user.php';

class PostVote {
    private int $postVoteId;
    private DateTime $postVoteDate;
    private int $postVote;
    private int $postId;
    private User $postVoteUser;

    public function __construct() {
        $this->postVoteId = 0;
        $this->postVoteDate = new DateTime();
        $this->postVote = 0;
        $this->postId = 0;
        $this->postVoteUser = new User();
    }

    // Getters
    public function getPostVoteId(): int {
        return $this->postVoteId;
    }

    public function getPostVoteDate(): DateTime {
        return $this->postVoteDate;
    }

    public function getPostVote(): int {
        return $this->postVote;
    }

    public function getPostId(): int {
        return $this->postId;
    }

    public function getPostVoteUser(): User {
        return $this->postVoteUser;
    }

    // Setters
    public function setPostVoteId(int $postVoteId): void {
        $this->postVoteId = $postVoteId;
    }

    public function setPostVoteDate(DateTime $postVoteDate): void {
        $this->postVoteDate = $postVoteDate;
    }

    public function setPostVote(int $postVote): void {
        $this->postVote = $postVote;
    }

    public function setPostId(int $post): void {
        $this->postId = $post;
    }

    public function setPostVoteUser(User $user): void {
        $this->postVoteUser = $user;
    }

    public function toArray(): array {
        return [
            'postVoteId' => $this->postVoteId,
            'postVoteDate' => $this->postVoteDate->format('Y-m-d H:i:s'),
            'postVote' => $this->postVote,
            'postId' => $this->postId,
            'postVoteUser' => $this->postVoteUser->toArray()
        ];
    }

    public static function createFromObject($obj): PostVote {
        $postVote = new PostVote();

        $postVote->setPostVoteId($obj->postVoteId);
        $postVote->setPostVoteDate(new DateTime($obj->postVoteDate));
        $postVote->setPostVote($obj->postVote);
        $postVote->setPostId($obj->postId);
        $postVote->setPostVoteUser(User::createFromObject($obj->postVoteUser));

        return $postVote;
    }

    public static function createFromDb($array): PostVote {
        $postVote = new PostVote();

        $postVote->setPostVoteId($array["post_Vote_id"]);
        $postVote->setPostVoteDate(new DateTime($array["post_Vote_date"]));
        $postVote->setPostVote($array["post_Vote"]);
        $postVote->setPostId($array["post_id"]);

        return $postVote;
    }
}
