import { User } from "./user.js";
export class BlogVote {
    constructor() {
        this.blogVoteId = 0;
        this.blogVoteDate = new Date();
        this.blogVote = 1;
        this.blogVoteUser = new User();
    }
    static createFromObject(object) {
        const blogVote = new BlogVote();
        blogVote.blogVoteId = object.blogVoteId;
        blogVote.blogVoteDate = object.blogVoteDate;
        blogVote.blogVote = object.blogVote;
        blogVote.blogVoteUser = new User();
        return blogVote;
    }
    get BlogVoteId() {
        return this.blogVoteId;
    }
    set BlogVoteId(value) {
        this.blogVoteId = value;
    }
    get BlogVoteDate() {
        return this.blogVoteDate;
    }
    set BlogVoteDate(value) {
        this.blogVoteDate = value;
    }
    get BlogVote() {
        return this.blogVote;
    }
    set BlogVote(value) {
        this.blogVote = value;
    }
    get BlogVoteUser() {
        return this.blogVoteUser;
    }
    set BlogVoteUser(value) {
        this.blogVoteUser = value;
    }
    static createFromObject(obj) {
        const blogVote = new BlogVote();
        blogVote.BlogVoteId = obj.blogVoteId || 0;
        blogVote.BlogVoteDate = obj.blogVoteDate ? new Date(obj.blogVoteDate) : new Date();
        blogVote.BlogVote = obj.blogVote || 1;
        blogVote.BlogVoteUser = obj.blogVoteUser ? User.createFromObject(obj.blogVoteUser) : new User();
        return blogVote;
    }
}
