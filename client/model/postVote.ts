import {User} from "./user";

export class PostVote {
    private postVoteId: number;
    private postVoteDate: Date;
    private postVote: number;
    private postVoteUser: User;

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

    constructor() {
        this.postVoteId = 0;
        this.postVoteDate = new Date();
        this.postVote = 0;
        this.postVoteUser = new User();
    }
}