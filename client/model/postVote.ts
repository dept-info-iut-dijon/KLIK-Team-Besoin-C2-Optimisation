import { User } from "./user";

export class PostVote {
    private postVoteId: number;
    private postVoteDate: Date;
    private postVote: number;
    private postVoteUser: User;
    private postId: number;

    public get PostVoteId(): number {
        return this.postVoteId;
    }

    public set PostVoteId(value: number) {
        this.postVoteId = value;
    }

    public get PostVoteDate(): Date {
        return this.postVoteDate;
    }

    public set PostVoteDate(value: Date) {
        this.postVoteDate = value;
    }

    public get PostVote(): number {
        return this.postVote;
    }

    public set PostVote(value: number) {
        this.postVote = value;
    }

    public get PostVoteUser(): User {
        return this.postVoteUser;
    }

    public set PostVoteUser(value: User) {
        this.postVoteUser = value;
    }

    public get PostId(): number {
        return this.postId;
    }

    public set PostId(value: number) {
        this.postId = value;
    }

    constructor() {
        this.postVoteId = 0;
        this.postVoteDate = new Date();
        this.postVote = 0;
        this.postVoteUser = new User();
        this.postId = 0;
    }

    public static createFromObject(obj: any): PostVote {
        const postVote = new PostVote();
        postVote.PostVoteId = obj.postVoteId || 0;
        postVote.PostVoteDate = obj.postVoteDate ? new Date(obj.postVoteDate) : new Date();
        postVote.PostVote = obj.postVote || 0;
        postVote.PostVoteUser = obj.postVoteUser ? User.createFromObject(obj.postVoteUser) : new User();
        postVote.PostId = obj.postId || 0;
        return postVote;
    }
}
