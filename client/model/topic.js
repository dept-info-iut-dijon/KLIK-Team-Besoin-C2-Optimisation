import { Category } from "./category";
import { User } from "./user";
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
    }
}
