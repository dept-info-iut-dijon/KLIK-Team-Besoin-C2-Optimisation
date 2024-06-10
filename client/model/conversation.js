import { User } from "./user";
import { Message } from "./message";
export class Conversation {
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
    static createFromObject(obj) {
        const conversation = new Conversation();
        conversation.ConversationId = obj.conversationId || 0;
        conversation.ConversationDateCreation = obj.conversationDateCreation ? new Date(obj.conversationDateCreation) : new Date();
        conversation.Messages = obj.messages ? obj.messages.map((message) => Message.createFromObject(message)) : new Array();
        conversation.User1 = obj.user1 ? User.createFromObject(obj.user1) : new User();
        conversation.User2 = obj.user2 ? User.createFromObject(obj.user2) : new User();
        return conversation;
    }
}
