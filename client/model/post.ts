import {Topic} from "./topic";
import {PostVote} from "./postVote";
import {User} from "./user";

export class Post {
    private postId: number;
    private postContent: string;
    private postDate: Date;
    private postTopic: number;
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

    public get PostTopic(): number {
        return this.postTopic;
    }

    public set PostTopic(value: number) {
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
        this.postTopic = 0;
        this.postVotes = new Array<PostVote>();
        this.postUser = new User();
    }

    public static createFromObject(obj: any): Post {
        const post = new Post();
        post.PostId = obj.postId || 0;
        post.PostContent = obj.postContent || "";
        post.PostDate = obj.postDate ? new Date(obj.postDate) : new Date();
        post.PostTopic = obj.postTopic || 0;
        post.PostVotes = obj.postVotes ? obj.postVotes.map((vote: any) => PostVote.createFromObject(vote)) : new Array<PostVote>();
        post.PostUser = obj.postUser ? User.createFromObject(obj.postUser) : new User();
        return post;
    }
}