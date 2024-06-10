import { User } from "./user";
export class Message {
    get MessageId() {
        return this.messageId;
    }
    set MessageId(value) {
        this.messageId = value;
    }
    get MessageContent() {
        return this.messageContent;
    }
    set MessageContent(value) {
        this.messageContent = value;
    }
    get MessageDate() {
        return this.messageDate;
    }
    set MessageDate(value) {
        this.messageDate = value;
    }
    get ConversationId() {
        return this.conversationId;
    }
    set ConversationId(value) {
        this.conversationId = value;
    }
    get MessageUser() {
        return this.messageUser;
    }
    set MessageUser(value) {
        this.messageUser = value;
    }
    constructor() {
        this.messageId = 0;
        this.messageContent = "";
        this.messageDate = new Date();
        this.conversationId = 0;
        this.messageUser = new User();
    }
    static createFromObject(obj) {
        const message = new Message();
        message.MessageId = obj.messageId || 0;
        message.MessageContent = obj.messageContent || "";
        message.MessageDate = obj.messageDate ? new Date(obj.messageDate) : new Date();
        message.ConversationId = obj.conversationId || 0;
        message.MessageUser = obj.messageUser ? Object.assign(new User(), obj.messageUser) : new User();
        return message;
    }
}
