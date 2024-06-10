import { Navbar } from "./navbar.js";
import { ProfileCard } from "./ProfileCard.js";
import { Blog } from "../model/blog.js";
import { User } from "../model/user.js";
import BlogController from "../controller/BlogController.js";
import { BlogVote } from "../model/blogVote.js";
export class BlogView {
    constructor() {
        this.blog = Blog.createFromObject(sessionStorage.getItem('blog'));
        this.user = User.createFromObject(sessionStorage.getItem('user'));
        this.blogController = new BlogController();
        this.h1Blog = document.getElementById("h1Blog");
        this.contentBlog = document.getElementById("contentBlog");
        this.contentAuthor = document.getElementById("contentAuthor");
        this.imageAuthor = document.getElementById("blogAuthor");
        this.imageBlog = document.getElementById("blogCover");
        this.imageLike = document.getElementById('imageLike');
        this.contentLikeCounter = document.getElementById('contentLikeCounter');
        this.imageLike.addEventListener('click', () => { this.LikeThePost(); });
        Navbar.GenerateNavbar("headerBlog");
        ProfileCard.GenerateProfileCard("user-card");
        this.h1Blog.innerHTML = this.blog.BlogTitle;
        this.contentBlog.innerHTML = this.blog.BlogContent;
        this.contentAuthor.innerHTML = this.blog.BlogUser.Username;
        this.imageBlog.src = "./src/img/" + this.blog.BlogImg;
        this.imageAuthor.src = "./src/img/" + this.blog.BlogUser.UserImage;
        this.contentLikeCounter.innerHTML = this.blog.BlogVotes.length.toString();
    }
    LikeThePost() {
        let vote = new BlogVote();
        vote.BlogVoteDate = new Date();
        vote.BlogVoteUser = this.user;
        this.blog.BlogVotes.push(vote);
        this.blogController.updateBlog(this.blog);
    }
}
