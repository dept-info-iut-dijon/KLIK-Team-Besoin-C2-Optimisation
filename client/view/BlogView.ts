import { Navbar } from "./navbar.js";
import { ProfileCard } from "./ProfileCard.js";
import { Blog } from "../model/blog.js"
import{ User } from "../model/user.js";
import BlogController from "../controller/BlogController.js";
import { BlogVote } from "../model/blogVote.js";

export class BlogView {

    private h1Blog: HTMLTitleElement;
    private contentBlog: HTMLParagraphElement;
    private contentAuthor: HTMLParagraphElement;
    private imageAuthor : HTMLImageElement;
    private imageBlog : HTMLImageElement;
    private imageLike : HTMLImageElement;
    private blogController : BlogController;
    private contentLikeCounter : HTMLParagraphElement;

    private blog : Blog;
    private user : User;


    constructor() {

        //this.blog = Blog.createFromObject(sessionStorage.getItem('blog'));
        //this.user = User.createFromObject(sessionStorage.getItem('user'));
        this.blog = new Blog();
        this.user = new User();

        this.blogController = new BlogController();

        this.h1Blog = document.getElementById("h1Blog") as HTMLTitleElement;
        this.contentBlog = document.getElementById("contentBlog") as HTMLParagraphElement;
        this.contentAuthor = document.getElementById("contentAuthor") as HTMLParagraphElement;
        this.imageAuthor = document.getElementById("blogAuthor") as HTMLImageElement;
        this.imageBlog = document.getElementById("blogCover") as HTMLImageElement;
        this.imageLike = document.getElementById('imageLike') as HTMLImageElement;
        this.contentLikeCounter = document.getElementById('contentLikeCounter') as HTMLParagraphElement;

        this.imageLike.addEventListener('click', () => {this.LikeThePost()});
        

        Navbar.GenerateNavbar("headerBlog");
        ProfileCard.GenerateProfileCard("user-card");

        this.h1Blog.innerHTML=this.blog.BlogTitle;
        this.contentBlog.innerHTML=this.blog.BlogContent;
        this.contentAuthor.innerHTML=this.blog.BlogUser.Username;
        this.imageBlog.src=this.blog.BlogImg;
        this.imageAuthor.src = this.blog.BlogUser.UserImage;
        
        this.contentLikeCounter.innerHTML=this.blog.BlogVotes.length.toString();
    }

    private LikeThePost(){
        let vote = new BlogVote();
        vote.BlogVoteDate = new Date();
        vote.BlogVoteUser = this.user;
        
        this.blog.BlogVotes.push(vote);

        this.blogController.updateBlog(this.blog);
    }


}