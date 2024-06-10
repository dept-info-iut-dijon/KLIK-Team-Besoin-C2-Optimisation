import { User } from "./user.js";

export class BlogVote{
    private blogVoteId: number;
    private blogVoteDate: Date;
    private blogVote: number;
    private blogVoteUser: User;

    constructor(){
        this.blogVoteId = 0;
        this.blogVoteDate = new Date();
        this.blogVote = 1;
        this.blogVoteUser = new User();
    }

    public get BlogVoteId(){
        return this.blogVoteId;
    }
    public set BlogVoteId(value: number){
        this.blogVoteId = value;
    }

    public get BlogVoteDate(){
        return this.blogVoteDate;
    }
    public set BlogVoteDate(value: Date){
        this.blogVoteDate = value;
    }

    public get BlogVote(){
        return this.blogVote;
    }
    public set BlogVote(value: number){
        this.blogVote = value;
    }

    public get BlogVoteUser(){
        return this.blogVoteUser;
    }
    public set BlogVoteUser(value: User){
        this.blogVoteUser = value;
    }

    public static createFromObject(obj: any): BlogVote {
        const blogVote = new BlogVote();
        blogVote.BlogVoteId = obj.blogVoteId || 0;
        blogVote.BlogVoteDate = obj.blogVoteDate ? new Date(obj.blogVoteDate) : new Date();
        blogVote.BlogVote = obj.blogVote || 1;
        blogVote.BlogVoteUser = obj.blogVoteUser ? User.createFromObject(obj.blogVoteUser) : new User();
        return blogVote;
    }
}