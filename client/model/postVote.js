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
    constructor() {
        this.postVoteId = 0;
        this.postVoteDate = new Date();
        this.postVote = 0;
        this.postVoteUser = new User();
    }
}
