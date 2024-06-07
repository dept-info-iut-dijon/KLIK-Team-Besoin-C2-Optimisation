import { User } from "./user";
class Conversation {
    get Messages() {
        return this.messages;
    }
    set Messages(value) {
        this.messages = value;
    }
    get User1() {
        return this.user1;
    }
    set User1(value) {
        this.user1 = value;
    }
    get User2() {
        return this.User2;
    }
    set User2(value) {
        this.user2 = value;
    }
    get ConversationId() {
        return this.conversationId;
    }
    set ConversationId(value) {
        this.conversationId = value;
    }
    get ConversationDateCreation() {
        return this.conversationDateCreation;
    }
    set ConversationDateCreation(value) {
        this.conversationDateCreation = value;
    }
    constructor() {
        this.messages = new Array;
        this.user1 = new User();
        this.user2 = new User();
        this.conversationId = 0;
        this.conversationDateCreation = new Date();
    }
}
