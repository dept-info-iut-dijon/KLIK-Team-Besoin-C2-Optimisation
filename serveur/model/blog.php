<?php

require_once 'user.php';
require_once 'blogVote.php';

class Blog {
    private int $blogId;
    private string $blogTitle;
    private string $blogImg;
    private DateTime $blogDate;
    private string $blogContent;
    private array $blogVotes;
    private User $blogUser;

    public function __construct() {
        $this->blogId = 0;
        $this->blogTitle = "";
        $this->blogImg = "";
        $this->blogDate = new DateTime();
        $this->blogContent = "";
        $this->blogVotes = array();
        $this->blogUser = new User();
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

    public function getBlogVotes(): array {
        return $this->blogVotes;
    }

    public function getBlogUser(): User {
        return $this->blogUser;
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

    public function setBlogVotes(array $blogVotes): void {
        $this->blogVotes = $blogVotes;
    }

    public function setBlogUser(User $user): void {
        $this->blogUser = $user;
    }

    public function toArray(): array {
        return [
            'blogId' => $this->blogId,
            'blogTitle' => $this->blogTitle,
            'blogImg' => $this->blogImg,
            'blogDate' => $this->blogDate->format('Y-m-d H:i:s'), 
            'blogContent' => $this->blogContent,
            'blogVotes' => array_map(function($blogVote) { return $blogVote->toArray(); }, $this->blogVotes),
            'blogUser' => $this->blogUser->toArray()
        ];
    }

    public static function createFromObject($obj): Blog {
        $blog = new Blog();

        $blog->setBlogId($obj->blogId);
        $blog->setBlogTitle($obj->blogTitle);
        $blog->setBlogImg($obj->blogImg);
        $blog->setBlogDate(new DateTime($obj->blogDate));
        $blog->setBlogContent($obj->blogContent);
        $blog->setBlogVotes(array_map(function($blogVote) {
            return BlogVote::createFromObject($blogVote);
        }, $obj->blogVotes));
        $blog->setBlogUser(User::createFromObject($obj->blogId));

        return $blog;
    }

    public static function createFromDb($array): Blog
    {
        $blog = new Blog();

        $blog->setBlogId($array["blog_id"]);
        $blog->setBlogTitle($array["blog_title"]);
        $blog->setBlogImg($array["blog_img"]);
        $blog->setBlogDate(new DateTime($array["blog_date"]));
        $blog->setBlogContent($array["blog_content"]);

        return $blog;
    }
}
