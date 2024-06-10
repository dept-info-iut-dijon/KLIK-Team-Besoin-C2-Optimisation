import { PollOption } from "./pollOption.js";
import { User } from "./user.js";
/**
 * Represents a poll
 */
export class Poll {
    constructor() {
        this.pollId = 0;
        this.pollSubject = "";
        this.pollCreated = new Date();
        this.pollModified = new Date();
        this.pollStatus = false;
        this.pollDesc = "";
        this.pollLocked = false;
        this.pollOptions = new Array();
        this.pollUser = new User();
    }
    get PollId() {
        return this.pollId;
    }
    set PollId(value) {
        this.pollId = value;
    }
    get PollSubject() {
        return this.pollSubject;
    }
    set PollSubject(value) {
        this.pollSubject = value;
    }
    get PollCreated() {
        return this.pollCreated;
    }
    set PollCreated(value) {
        this.pollCreated = value;
    }
    get PollModified() {
        return this.pollModified;
    }
    set PollModified(value) {
        this.pollModified = value;
    }
    get PollStatus() {
        return this.pollStatus;
    }
    set PollStatus(value) {
        this.PollStatus = value;
    }
    get PollDesc() {
        return this.pollDesc;
    }
    set PollDesc(value) {
        this.pollDesc = value;
    }
    get PollLocked() {
        return this.pollLocked;
    }
    set PollLocked(value) {
        this.pollLocked = value;
    }
    get PollOptions() {
        return this.pollOptions;
    }
    set PollOptions(value) {
        this.pollOptions = value;
    }
    get PollUser() {
        return this.pollUser;
    }
    set PollUser(value) {
        this.pollUser = value;
    }
    static createFromObject(obj) {
        const poll = new Poll();
        poll.PollId = obj.pollId || 0;
        poll.PollSubject = obj.pollSubject || "";
        poll.PollCreated = obj.pollCreated ? new Date(obj.pollCreated) : new Date();
        poll.PollModified = obj.pollModified ? new Date(obj.pollModified) : new Date();
        poll.PollStatus = obj.pollStatus || false;
        poll.PollDesc = obj.pollDesc || "";
        poll.PollLocked = obj.pollLocked || false;
        poll.PollOptions = obj.pollOptions ? obj.pollOptions.map((option) => PollOption.createFromObject(option)) : new Array();
        poll.PollUser = obj.pollUser ? User.createFromObject(obj.pollUser) : new User();
        return poll;
    }
}
