import BlogNetwork from "../network/BlogNetwork.js";
export default class BlogController {
    constructor() {
        this.blogNetwork = new BlogNetwork();
    }
    createBlog(blog) {
        return this.blogNetwork.createBlog(blog);
    }
    getAllBlogs() {
        return this.blogNetwork.getAllBlogs();
    }
}
