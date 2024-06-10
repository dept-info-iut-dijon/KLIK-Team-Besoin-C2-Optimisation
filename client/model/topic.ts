import {Category} from "./category";
import {User} from "./user";
import {Post} from "./post";

export class Topic {
    private topicId: number;
    private topicSubject: string;
    private topicDate: Date;
    private topicCategory: Category;
    private topicUser: User;
    private topicPosts : Array<Post>

    public get TopicId(): number {
        return this.topicId;
    }

    public set TopicId(value: number) {
        this.topicId = value;
    }

    public get TopicSubject(): string {
        return this.topicSubject;
    }

    public set TopicSubject(value: string) {
        this.topicSubject = value;
    }

    public get TopicDate(): Date {
        return this.topicDate;
    }

    public set TopicDate(value: Date) {
        this.topicDate = value;
    }

    public get TopicCategory(): Category {
        return this.topicCategory;
    }

    public set TopicCategory(value: Category) {
        this.topicCategory = value;
    }

    public get TopicUser(): User {
        return this.topicUser;
    }

    public set TopicUser(value: User) {
        this.topicUser = value;
    }

    public set TopicPosts(value : Array<Post>){
        this.topicPosts = value;
    }

    public get TopicPosts() : Array<Post>{
        return this.topicPosts;
    }

    constructor() {
        this.topicId = 0;
        this.topicSubject = "";
        this.topicDate = new Date();
        this.topicCategory = new Category();
        this.topicUser = new User();
        this.topicPosts = new Array<Post>();
    }

    public static createFromObject(obj: any): Topic {
        const topic = new Topic();
        topic.TopicId = obj.topicId || 0;
        topic.TopicSubject = obj.topicSubject || "";
        topic.TopicDate = obj.topicDate ? new Date(obj.topicDate) : new Date();
        topic.TopicCategory = obj.topicCategory ? Category.createFromObject(obj.topicCategory) : new Category();
        topic.TopicUser = obj.topicUser ? User.createFromObject(obj.topicUser) : new User();
        topic.topicPosts = obj.topicPosts ? obj.topicPosts.map((vote: any) => Post.createFromObject(vote)) : new Array<Post>();
        return topic;
    }
}