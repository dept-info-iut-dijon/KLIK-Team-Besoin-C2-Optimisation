import { Category } from "./category";
import { User } from "./user";
import { Post } from "./post";
export class Topic {
    get TopicId() {
        return this.topicId;
    }
    set TopicId(value) {
        this.topicId = value;
    }
    get TopicSubject() {
        return this.topicSubject;
    }
    set TopicSubject(value) {
        this.topicSubject = value;
    }
    get TopicDate() {
        return this.topicDate;
    }
    set TopicDate(value) {
        this.topicDate = value;
    }
    get TopicCategory() {
        return this.topicCategory;
    }
    set TopicCategory(value) {
        this.topicCategory = value;
    }
    get TopicUser() {
        return this.topicUser;
    }
    set TopicUser(value) {
        this.topicUser = value;
    }
    constructor() {
        this.topicId = 0;
        this.topicSubject = "";
        this.topicDate = new Date();
        this.topicCategory = new Category();
        this.topicUser = new User();
        this.topicPosts = new Array();
    }
    static createFromObject(obj) {
        const topic = new Topic();
        topic.TopicId = obj.topicId || 0;
        topic.TopicSubject = obj.topicSubject || "";
        topic.TopicDate = obj.topicDate ? new Date(obj.topicDate) : new Date();
        topic.TopicCategory = obj.topicCategory ? Category.createFromObject(obj.topicCategory) : new Category();
        topic.TopicUser = obj.topicUser ? User.createFromObject(obj.topicUser) : new User();
        topic.topicPosts = obj.topicPosts ? obj.topicPosts.map((vote) => Post.createFromObject(vote)) : new Array();
        return topic;
    }
}
