import { User } from "./user";
export class PostVote {
    get PostVoteId() {
        return this.postVoteId;
    }
    set PostVoteId(value) {
        this.postVoteId = value;
    }
    get PostVoteDate() {
        return this.postVoteDate;
    }
    set PostVoteDate(value) {
        this.postVoteDate = value;
    }
    get PostVote() {
        return this.postVote;
    }
    set PostVote(value) {
        this.postVote = value;
    }
    get PostVoteUser() {
        return this.postVoteUser;
    }
    set PostVoteUser(value) {
        this.postVoteUser = value;
    }
    get PostId() {
        return this.postId;
    }
    set PostId(value) {
        this.postId = value;
    }
    constructor() {
        this.postVoteId = 0;
        this.postVoteDate = new Date();
        this.postVote = 0;
        this.postVoteUser = new User();
        this.postId = 0;
    }
    static createFromObject(obj) {
        const postVote = new PostVote();
        postVote.PostVoteId = obj.postVoteId || 0;
        postVote.PostVoteDate = obj.postVoteDate ? new Date(obj.postVoteDate) : new Date();
        postVote.PostVote = obj.postVote || 0;
        postVote.PostVoteUser = obj.postVoteUser ? User.createFromObject(obj.postVoteUser) : new User();
        postVote.PostId = obj.postId || 0;
        return postVote;
    }
}
