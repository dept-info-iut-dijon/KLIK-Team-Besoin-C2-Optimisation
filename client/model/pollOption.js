import { PollVote } from "./pollVote.js";
/**
 * Represents a poll option
 */
export class PollOption {
    constructor() {
        this.pollOptionId = 0;
        this.pollOptionName = "";
        this.pollOptionStatus = false;
        this.pollVotes = new Array();
    }
    get PollOptionId() {
        return this.pollOptionId;
    }
    set PollOptionId(value) {
        this.pollOptionId = value;
    }
    get PollOptionName() {
        return this.pollOptionName;
    }
    set PollOptionName(value) {
        this.pollOptionName = value;
    }
    get PollOptionStatus() {
        return this.pollOptionStatus;
    }
    set PollOptionStatus(value) {
        this.pollOptionStatus = value;
    }
    get PollVotes() {
        return this.pollVotes;
    }
    set PollVotes(value) {
        this.pollVotes = value;
    }
    static createFromObject(obj) {
        const pollOption = new PollOption();
        pollOption.PollOptionId = obj.pollOptionId || 0;
        pollOption.PollOptionName = obj.pollOptionName || "";
        pollOption.PollOptionStatus = obj.pollOptionStatus || false;
        pollOption.PollVotes = obj.pollVotes ? obj.pollVotes.map((vote) => PollVote.createFromObject(vote)) : new Array();
        return pollOption;
    }
}
