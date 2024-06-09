import { Blog } from "../model/blog";
import BlogNetwork from "../network/BlogNetwork";
import { IBlogController } from "./interfaces/IBlogController";

export default class BlogController implements IBlogController{
    private blogNetwork: BlogNetwork;

    constructor(){
        this.blogNetwork = new BlogNetwork();
    }

    async createBlog(blog: Blog): Promise<boolean> {
        return this.blogNetwork.createBlog(blog);
    }

    async updateBlog(blog : Blog) : Promise<boolean>{
        return this.blogNetwork.updateBlog(blog);
    }

}