"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.PostVote = void 0;
const user_1 = require("./user");
class PostVote {
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
        this.postVoteUser = new user_1.User();
    }
}
exports.PostVote = PostVote;
