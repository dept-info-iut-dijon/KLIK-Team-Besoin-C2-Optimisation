import { Poll } from "./poll.js";
import { PollVote } from "./pollVote.js";

/**
 * Represents a poll option
 */
export class PollOption{
    private pollOptionId: number;
    private pollOptionName: string;
    private pollOptionStatus: boolean;
    private pollVotes: Array<PollVote>;

    constructor(){
        this.pollOptionId = 0;
        this.pollOptionName = "";
        this.pollOptionStatus = false;
        this.pollVotes = new Array<PollVote>();
    }

    public get PollOptionId(){
        return this.pollOptionId;
    }
    public set PollOptionId(value: number){
        this.pollOptionId = value;
    }

    public get PollOptionName(){
        return this.pollOptionName;
    }
    public set PollOptionName(value: string){
        this.pollOptionName = value;
    }

    public get PollOptionStatus(){
        return this.pollOptionStatus;
    }
    public set PollOptionStatus(value: boolean){
        this.pollOptionStatus = value;
    }

    public get PollVotes(){
        return this.pollVotes;
    }
    public set PollVotes(value: Array<PollVote>){
        this.pollVotes = value;
    }

    public static createFromObject(obj: any): PollOption {
        const pollOption = new PollOption();
        pollOption.PollOptionId = obj.pollOptionId || 0;
        pollOption.PollOptionName = obj.pollOptionName || "";
        pollOption.PollOptionStatus = obj.pollOptionStatus || false;
        pollOption.PollVotes = obj.pollVotes ? obj.pollVotes.map((vote: any) => PollVote.createFromObject(vote)) : new Array<PollVote>();
        return pollOption;
    }
}