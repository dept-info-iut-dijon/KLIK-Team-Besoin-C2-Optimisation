var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import BlogController from "../controller/BlogController.js";
import { Blog } from "../model/blog.js";
export default class CreateBlogView {
    constructor() {
        this.blog_title = document.getElementById('blog_title');
        this.blog_img = document.getElementById('blog_img');
        this.blog_date = document.getElementById('blog_date');
        this.blogController = new BlogController();
        document.getElementById('blogForm').addEventListener('submit', (event) => this.submit(event));
    }
    submit(event) {
        return __awaiter(this, void 0, void 0, function* () {
            const blogTitle = this.blog_title.value;
            const blogImg = this.blog_img.value;
            const blogDate = this.blog_date.value;
            const blogContent = this.blog_date.value;
            const blogUserString = sessionStorage.getItem("user");
            const blogUser = blogUserString ? JSON.parse(blogUserString) : null;
            const constblogVotes = (Array);
            const blog = new Blog();
            blog.BlogId = 0;
            blog.BlogTitle = blogTitle;
            blog.BlogContent = blogContent;
            blog.BlogImg = blogImg;
            blog.BlogDate = new Date(blogDate);
            blog.BlogUser = blogUser;
            blog.BlogVotes = new constblogVotes;
            this.blogController.createBlog(blog);
        });
    }
}
