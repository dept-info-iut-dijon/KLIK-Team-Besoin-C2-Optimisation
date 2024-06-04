"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.Blog = void 0;
const user_js_1 = require("./user.js");
/**
 * Represents a blog
 */
class Blog {
    constructor() {
        this.blogId = 0;
        this.blogTitle = "";
        this.blogImg = "";
        this.blogDate = new Date();
        this.blogContent = "";
        this.blogVotes = new Array;
        this.blogUser = new user_js_1.User();
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
}
exports.Blog = Blog;
