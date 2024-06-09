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
    static createFromObject(obj) {
        const pollVote = new PollVote();
        pollVote.PollVoteId = obj.pollVoteId || 0;
        pollVote.PollVoteDate = obj.pollVoteDate ? new Date(obj.pollVoteDate) : new Date();
        pollVote.PollVoteUser = obj.pollVoteUser ? User.createFromObject(obj.pollVoteUser) : new User();
        return pollVote;
    }
}
