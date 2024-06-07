import { Navbar } from "./navbar.js";
export class BlogView {
    constructor(blog) {
        this.h1Blog = document.getElementById("h1Blog");
        this.contentBlog = document.getElementById("contentBlog");
        this.contentAuthor = document.getElementById("contentAuthor");
        Navbar.GenerateNavbar("headerBlog");
        this.h1Blog.innerHTML = blog.BlogTitle;
        this.contentBlog.innerHTML = blog.BlogContent;
        this.contentAuthor.innerHTML = blog.BlogUser.Username;
    }
}
