"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.PollOption = void 0;
/**
 * Represents a poll option
 */
class PollOption {
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
}
exports.PollOption = PollOption;
