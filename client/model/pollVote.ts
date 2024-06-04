import { PollOption } from "./pollOption.js";
import { User } from "./user.js";

export class PollVote{
    private pollVoteId: number;
    private pollVoteDate: Date;
    private pollVoteUser: User;

    constructor(){
        this.pollVoteId = 0;
        this.pollVoteDate = new Date();
        this.pollVoteUser = new User();
    }

    public get PollVoteId(){
        return this.pollVoteId;
    }
    public set PollVoteId(value: number){
        this.pollVoteId = value;
    }

    public get PollVoteDate(){
        return this.pollVoteDate;
    }
    public set PollVoteDate(value: Date){
        this.pollVoteDate = value;
    }

    public get PollVoteUser(){
        return this.pollVoteUser;
    }
    public set PollVoteUser(value: User){
        this.pollVoteUser = value;
    }
}