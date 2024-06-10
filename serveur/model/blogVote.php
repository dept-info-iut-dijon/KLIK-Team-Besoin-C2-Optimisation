<?php

require_once 'user.php';

class BlogVote {
    private int $blogVoteId;
    private DateTime $blogVoteDate;
    private int $blogVote;
    private User $blogVoteUser;
    private int $blogId;

    public function __construct() {
        $this->blogVoteId = 0;
        $this->blogVoteDate = new DateTime();
        $this->blogVote = 0;
        $this->blogVoteUser = new User();
        $this->blogId = 0;
    }

    // Getters
    public function getBlogVoteId(): int {
        return $this->blogVoteId;
    }

    public function getBlogVoteDate(): DateTime {
        return $this->blogVoteDate;
    }

    public function getBlogVote(): int {
        return $this->blogVote;
    }

    public function getBlogVoteUser(): User {
        return $this->blogVoteUser;
    }

    public function getBlogId(): int {
        return $this->blogVote;
    }

    // Setters
    public function setBlogVoteId(int $blogVoteId): void {
        $this->blogVoteId = $blogVoteId;
    }

    public function setBlogVoteDate(DateTime $blogVoteDate): void {
        $this->blogVoteDate = $blogVoteDate;
    }

    public function setBlogVote(int $blogVote): void {
        $this->blogVote = $blogVote;
    }

    public function setBlogVoteUser(User $user): void {
        $this->blogVoteUser = $user;
    }

    public function setBlogId(int $blogId): void {
        $this->blogId = $blogId;
    }

    public function toArray(): array {
        return [
            'blogVoteId' => $this->blogVoteId,
            'blogVoteDate' => $this->blogVoteDate->format('Y-m-d H:i:s'),
            'blogVote' => $this->blogVote,
            'blogVoteUser' => $this->blogVoteUser->toArray(),
            'blogId' => $this->blogId,
        ];
    }

    public static function createFromObject($obj): BlogVote {
        $blogVote = new BlogVote();

        $blogVote->setBlogVoteId($obj->blogVoteId);
        $blogVote->setBlogVoteDate(new DateTime($obj->blogVoteDate));
        $blogVote->setBlogVote($obj->blogVote);
        $blogVote->setBlogVoteUser(User::createFromObject($obj->blogId));
        $blogVote->setBlogId($obj->blogId);

        return $blogVote;
    }

    public static function createFromDb($array): BlogVote
    {
        $blogVote = new BlogVote();

        $blogVote->setBlogVoteId($array["blog_Vote_id"]);
        $blogVote->setBlogVoteDate(new DateTime($array["blog_Vote_date"]));
        $blogVote->setBlogVote($array["blog_Vote"]);
        $blogVote->setBlogId($array["blog_id"]);

        return $blogVote;
    }
}
