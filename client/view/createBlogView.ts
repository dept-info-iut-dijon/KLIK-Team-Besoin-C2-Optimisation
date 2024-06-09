import BlogController from "../controller/BlogController.js";
import { Blog } from "../model/blog.js";
import { BlogVote } from "../model/blogVote.js";

export default class CreateBlogView {
    private blog_title: HTMLInputElement;
    private blog_img: HTMLInputElement;
    private blog_date: HTMLInputElement;

    private blogController: BlogController;

    constructor() {
        this.blog_title = document.getElementById('blog_title') as HTMLInputElement;
        this.blog_img = document.getElementById('blog_img') as HTMLInputElement;
        this.blog_date = document.getElementById('blog_date') as HTMLInputElement;

        this.blogController = new BlogController();

        document.getElementById('blogForm')!.addEventListener('submit', (event) => this.submit(event));
    }



    private async submit(event: Event){
        const blogTitle = this.blog_title.value;
        const blogImg = this.blog_img.value;
        const blogDate = this.blog_date.value;
        const blogContent = this.blog_date.value;
        
        const blogUserString  = sessionStorage.getItem("user");

        const blogUser = blogUserString ? JSON.parse(blogUserString) : null;

        const constblogVotes = Array<BlogVote>;

        const blog = new Blog();

        blog.BlogId = 0;
        blog.BlogTitle = blogTitle;
        blog.BlogContent = blogContent;
        blog.BlogImg = blogImg;
        blog.BlogDate = new Date(blogDate);
        blog.BlogUser = blogUser;
        blog.BlogVotes = new constblogVotes;

        this.blogController.createBlog(blog);
    }

}


