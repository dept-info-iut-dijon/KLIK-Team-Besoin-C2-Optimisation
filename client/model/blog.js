import { BlogVote } from "./blogVote.js";
import { User } from "./user.js";
/**
 * Represents a blog
 */
export class Blog {
    constructor() {
        this.blogId = 0;
        this.blogTitle = "";
        this.blogImg = "";
        this.blogDate = new Date();
        this.blogContent = "";
        this.blogVotes = new Array;
        this.blogUser = new User();
    }
    get BlogId() {
        return this.blogId;
    }
    set BlogId(value) {
        this.blogId = value;
    }
    get BlogTitle() {
        return this.blogTitle;
    }
    set BlogTitle(value) {
        this.blogTitle = value;
    }
    get BlogImg() {
        return this.blogImg;
    }
    set BlogImg(value) {
        this.blogImg = value;
    }
    get BlogDate() {
        return this.blogDate;
    }
    set BlogDate(value) {
        this.blogDate = value;
    }
    get BlogContent() {
        return this.blogContent;
    }
    set BlogContent(value) {
        this.blogContent = value;
    }
    get BlogVotes() {
        return this.blogVotes;
    }
    set BlogVotes(value) {
        this.blogVotes = value;
    }
    get BlogUser() {
        return this.blogUser;
    }
    set BlogUser(value) {
        this.blogUser = value;
    }
    static createFromObject(obj) {
        const blog = new Blog();
        blog.BlogId = obj.blogId || 0;
        blog.BlogTitle = obj.blogTitle || "";
        blog.BlogImg = obj.blogImg || "";
        blog.BlogDate = obj.blogDate ? new Date(obj.blogDate) : new Date();
        blog.BlogContent = obj.blogContent || "";
        blog.BlogVotes = obj.blogVotes ? obj.blogVotes.map((vote) => BlogVote.createFromObject(vote)) : new Array();
        blog.BlogUser = obj.blogUser ? User.createFromObject(obj.blogUser) : new User();
        return blog;
    }
}
