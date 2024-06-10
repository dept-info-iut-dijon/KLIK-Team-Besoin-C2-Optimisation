<?php

require_once 'user.php';

class BlogVote {
    private int $blogVoteId;
    private DateTime $blogVoteDate;
    private int $blogVote;
    private User $blogVoteUser;

    public function __construct() {
        $this->blogVoteId = 0;
        $this->blogVoteDate = new DateTime();
        $this->blogVote = 0;
        $this->blogVoteUser = new User();

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


    public function toArray(): array {
        return [
            'blogVoteId' => $this->blogVoteId,
            'blogVoteDate' => $this->blogVoteDate->format('Y-m-d H:i:s'),
            'blogVote' => $this->blogVote,
            'blogVoteUser' => $this->blogVoteUser->toArray()
        ];
    }

    public static function createFromObject($obj): BlogVote {
        $blogVote = new BlogVote();

        $blogVote->setBlogVoteId($obj->blogVoteId);
        $blogVote->setBlogVoteDate(new DateTime($obj->blogVoteDate));
        $blogVote->setBlogVote($obj->blogVote);
        $blogVote->setBlogVoteUser(User::createFromObject($obj->blogId));

        return $blogVote;
    }

    public static function createFromDb($array): BlogVote
    {
        $blogVote = new BlogVote();

        $blogVote->setBlogVoteId($array["blog_Vote_id"]);
        $blogVote->setBlogVoteDate(new DateTime($array["blog_Vote_date"]));
        $blogVote->setBlogVote($array["blog_Vote"]);

        return $blogVote;
    }
}
