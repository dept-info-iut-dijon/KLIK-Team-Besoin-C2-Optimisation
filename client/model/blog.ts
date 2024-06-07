import { BlogVote } from "./blogVote.js";
import { User } from "./user.js";

/**
 * Represents a blog
 */
export class Blog{
    
    private blogId: number;
    private blogTitle: string;
    private blogImg: string;
    private blogDate: Date;
    private blogContent: string;
    private blogVotes: Array<BlogVote>
    private blogUser: User;

    constructor(){
        this.blogId = 0;
        this.blogTitle = "";
        this.blogImg = "";
        this.blogDate = new Date();
        this.blogContent = "";
        this.blogVotes = new Array<BlogVote>;
        this.blogUser = new User();
    }
    
    public get BlogId(){
        return this.blogId;
    }

    public set BlogId(value: number){
        this.blogId = value;
    }

    public get BlogTitle(){
        return this.blogTitle;
    }
    public set BlogTitle(value: string){
        this.blogTitle = value;
    }

    public get BlogImg(){
        return this.blogImg;
    }
    public set BlogImg(value: string){
        this.blogImg = value;
    }

    public get BlogDate(){
        return this.blogDate;
    }
    public set BlogDate(value: Date){
        this.blogDate = value;
    }

    public get BlogContent(){
        return this.blogContent;
    }
    public set BlogContent(value: string){
        this.blogContent = value;
    }

    public get BlogVotes(){
        return this.blogVotes;
    }
    public set BlogVotes(value: Array<BlogVote>){
        this.blogVotes = value;
    }

    public get BlogUser(){
        return this.blogUser;
    }
    public set BlogUser(value: User){
        this.blogUser = value;
    }
}