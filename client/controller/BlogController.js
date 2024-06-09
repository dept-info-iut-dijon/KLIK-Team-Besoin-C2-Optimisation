import BlogNetwork from "../network/BlogNetwork";
export default class BlogController {
    constructor() {
        this.blogNetwork = new BlogNetwork();
    }
    createBlog(blog) {
        return this.blogNetwork.createBlog(blog);
    }
}
