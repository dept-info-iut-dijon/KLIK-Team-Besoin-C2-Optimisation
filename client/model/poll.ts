import { PollOption } from "./pollOption.js";
import { User } from "./user.js";

/**
 * Represents a poll
 */
export class Poll{
    private pollId: number;
    private pollSubject: string;
    private pollCreated: Date;
    private pollModified: Date;
    private pollStatus: boolean;
    private pollDesc: string;
    private pollLocked: boolean;
    private pollOptions: Array<PollOption>;
    private pollUser: User;

    constructor(){
        this.pollId = 0;
        this.pollSubject = "";
        this.pollCreated = new Date();
        this.pollModified = new Date();
        this.pollStatus = false;
        this.pollDesc = "";
        this.pollLocked = false;
        this.pollOptions = new Array<PollOption>();
        this.pollUser = new User();
    }

    public get PollId(){
        return this.pollId;
    }
    public set PollId(value: number){
        this.pollId = value;
    }

    public get PollSubject(){
        return this.pollSubject;
    }
    public set PollSubject(value: string){
        this.pollSubject = value;
    }

    public get PollCreated(){
        return this.pollCreated;
    }
    public set PollCreated(value: Date){
        this.pollCreated = value;
    }

    public get PollModified(){
        return this.pollModified;
    }
    public set PollModified(value: Date){
        this.pollModified = value;
    }

    public get PollStatus(){
        return this.pollStatus;
    }
    public set PollStatus(value: boolean){
        this.PollStatus = value;
    }

    public get PollDesc(){
        return this.pollDesc;
    }
    public set PollDesc(value: string){
        this.pollDesc = value;
    }

    public get PollLocked(){
        return this.pollLocked;
    }
    public set PollLocked(value: boolean){
        this.pollLocked = value;
    }

    public get PollOptions(){
        return this.pollOptions;
    }
    public set PollOptions(value: Array<PollOption>){
        this.pollOptions = value;
    }

    public get PollUser(){
        return this.pollUser
    }
    public set PollUser(value: User){
        this.pollUser = value;
    }
}