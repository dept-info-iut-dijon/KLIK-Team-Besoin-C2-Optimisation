import { Blog } from "../../model/blog";

export default interface IBlogNetwork {
    createBlog(blog: Blog): Promise<boolean>;
}