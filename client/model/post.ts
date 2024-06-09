import {Topic} from "./topic";
import {PostVote} from "./postVote";
import {User} from "./user";

export class Post {
    private postId: number;
    private postContent: string;
    private postDate: Date;
    private postTopic: Topic;
    private postVotes: Array<PostVote>;
    private postUser: User;

    public get PostId(): number {
        return this.postId;
    }

    public set PostId(value: number) {
        this.postId = value;
    }

    public get PostContent(): string {
        return this.postContent;
    }

    public set PostContent(value: string) {
        this.postContent = value;
    }

    public get PostDate(): Date {
        return this.postDate;
    }

    public set PostDate(value: Date) {
        this.postDate = value;
    }

    public get PostTopic(): Topic {
        return this.postTopic;
    }

    public set PostTopic(value: Topic) {
        this.postTopic = value;
    }

    public get PostVotes(): Array<PostVote> {
        return this.postVotes;
    }

    public set PostVotes(value: Array<PostVote>) {
        this.postVotes = value;
    }

    public get PostUser(): User {
        return this.postUser;
    }

    public set PostUser(value: User) {
        this.postUser = value;
    }

    constructor() {
        this.postId = 0;
        this.postContent = "";
        this.postDate = new Date();
        this.postTopic = new Topic();
        this.postVotes = new Array<PostVote>();
        this.postUser = new User();
    }
}