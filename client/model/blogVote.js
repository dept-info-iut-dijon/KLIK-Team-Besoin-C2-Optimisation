import { User } from "./user";
export class BlogVote {
    constructor() {
        this.blogVoteId = 0;
        this.blogVoteDate = new Date();
        this.blogVote = 0;
        this.blogVoteUser = new User();
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
}
