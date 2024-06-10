"use strict";
class Message {
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
    constructor() {
        this.messageId = 0;
        this.messageContent = "";
        this.messageDate = new Date();
    }
    static createFromObject(obj) {
        const message = new Message();
        message.MessageId = obj.messageId || 0;
        message.MessageContent = obj.messageContent || "";
        message.MessageDate = obj.messageDate ? new Date(obj.messageDate) : new Date();
        return message;
    }
}
