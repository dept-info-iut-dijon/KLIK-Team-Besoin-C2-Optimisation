import { PostVote } from "./postVote";
import { User } from "./user";
export class Post {
    get PostId() {
        return this.postId;
    }
    set PostId(value) {
        this.postId = value;
    }
    get PostContent() {
        return this.postContent;
    }
    set PostContent(value) {
        this.postContent = value;
    }
    get PostDate() {
        return this.postDate;
    }
    set PostDate(value) {
        this.postDate = value;
    }
    get PostTopic() {
        return this.postTopic;
    }
    set PostTopic(value) {
        this.postTopic = value;
    }
    get PostVotes() {
        return this.postVotes;
    }
    set PostVotes(value) {
        this.postVotes = value;
    }
    get PostUser() {
        return this.postUser;
    }
    set PostUser(value) {
        this.postUser = value;
    }
    constructor() {
        this.postId = 0;
        this.postContent = "";
        this.postDate = new Date();
        this.postTopic = 0;
        this.postVotes = new Array();
        this.postUser = new User();
    }
    static createFromObject(obj) {
        const post = new Post();
        post.PostId = obj.postId || 0;
        post.PostContent = obj.postContent || "";
        post.PostDate = obj.postDate ? new Date(obj.postDate) : new Date();
        post.PostTopic = obj.postTopic || 0;
        post.PostVotes = obj.postVotes ? obj.postVotes.map((vote) => PostVote.createFromObject(vote)) : new Array();
        post.PostUser = obj.postUser ? User.createFromObject(obj.postUser) : new User();
        return post;
    }
}
