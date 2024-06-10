import {Blog} from "../../model/blog.js";

export interface IBlogController {
    createBlog(blog: Blog): Promise<boolean>;

    updateBlog(blog : Blog) : Promise<boolean>;

    getAllBlogs(): Promise<Array<Blog>>;
}