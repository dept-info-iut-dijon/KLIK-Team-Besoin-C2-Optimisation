"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.Topic = void 0;
const category_1 = require("./category");
const user_1 = require("./user");
class Topic {
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
        this.topicCategory = new category_1.Category();
        this.topicUser = new user_1.User();
    }
}
exports.Topic = Topic;
