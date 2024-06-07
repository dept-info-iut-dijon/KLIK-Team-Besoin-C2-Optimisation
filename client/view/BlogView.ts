import { Navbar } from "./navbar.js";
import { Blog } from "../model/blog.js"

export class BlogView {

    private h1Blog: HTMLTitleElement;
    private contentBlog: HTMLParagraphElement;
    private contentAuthor: HTMLParagraphElement;

    constructor(blog : Blog) {

        this.h1Blog = document.getElementById("h1Blog") as HTMLTitleElement;
        this.contentBlog = document.getElementById("contentBlog") as HTMLParagraphElement;
        this.contentAuthor = document.getElementById("contentAuthor") as HTMLParagraphElement;
        

        Navbar.GenerateNavbar("headerBlog");
        this.h1Blog.innerHTML=blog.BlogTitle;
        this.contentBlog.innerHTML=blog.BlogContent;
        this.contentAuthor.innerHTML=blog.BlogUser.Username;
    }


}