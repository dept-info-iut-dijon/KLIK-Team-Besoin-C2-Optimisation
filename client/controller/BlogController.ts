import { Blog } from "../model/blog.js";
import BlogNetwork from "../network/BlogNetwork.js";
import { IBlogController } from "./interfaces/IBlogController.js";

export default class BlogController implements IBlogController{
    private blogNetwork: BlogNetwork;

    constructor(){
        this.blogNetwork = new BlogNetwork();
    }

    createBlog(blog: Blog): Promise<boolean> {
        return this.blogNetwork.createBlog(blog);
    }

    getAllBlogs(): Promise<Array<Blog>>{
        return this.blogNetwork.getAllBlogs();
    }
}