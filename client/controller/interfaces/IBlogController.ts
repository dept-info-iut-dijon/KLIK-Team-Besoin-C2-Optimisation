import {Blog} from "../../model/blog.js";

export interface IBlogController {
    createBlog(blog: Blog): Promise<boolean>;

}