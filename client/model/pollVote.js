import { User } from "./user.js";
export class PollVote {
    constructor() {
        this.pollVoteId = 0;
        this.pollVoteDate = new Date();
        this.pollVoteUser = new User();
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
