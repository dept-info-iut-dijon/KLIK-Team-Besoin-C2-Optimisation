"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.PollVote = void 0;
const user_js_1 = require("./user.js");
class PollVote {
    constructor() {
        this.pollVoteId = 0;
        this.pollVoteDate = new Date();
        this.pollVoteUser = new user_js_1.User();
    }
    get PollVoteId() {
        return this.pollVoteId;
    }
    set PollVoteId(value) {
        this.pollVoteId = value;
    }
    get PollVoteDate() {
        return this.pollVoteDate;
    }
    set PollVoteDate(value) {
        this.pollVoteDate = value;
    }
    get PollVoteUser() {
        return this.pollVoteUser;
    }
    set PollVoteUser(value) {
        this.pollVoteUser = value;
    }
}
exports.PollVote = PollVote;
