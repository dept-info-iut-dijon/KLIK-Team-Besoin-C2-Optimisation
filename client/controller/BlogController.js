var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import BlogNetwork from "../network/BlogNetwork.js";
export default class BlogController {
    constructor() {
        this.blogNetwork = new BlogNetwork();
    }
    createBlog(blog) {
        return __awaiter(this, void 0, void 0, function* () {
            return this.blogNetwork.createBlog(blog);
        });
    }
    getAllBlogs() {
        return this.blogNetwork.getAllBlogs();
    }
    updateBlog(blog) {
        return __awaiter(this, void 0, void 0, function* () {
            return this.blogNetwork.updateBlog(blog);
        });
    }
}
