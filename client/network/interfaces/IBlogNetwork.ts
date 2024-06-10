import { Blog } from "../../model/blog";

export default interface IBlogNetwork {
    createBlog(blog: Blog): Promise<boolean>;
    getAllBlogs(): Promise<Array<Blog>>;
    updateBlog(blog:Blog) : Promise<boolean>;
}