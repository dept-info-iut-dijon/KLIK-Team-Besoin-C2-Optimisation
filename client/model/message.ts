import { User } from "./user";

export class Message {
    private messageId: number;
    private messageContent: string;
    private messageDate: Date;
    private conversationId: number;
    private messageUser: User;

    public get MessageId(): number {
        return this.messageId;
    }

    public set MessageId(value: number) {
        this.messageId = value;
    }

    public get MessageContent(): string {
        return this.messageContent;
    }

    public set MessageContent(value: string) {
        this.messageContent = value;
    }

    public get MessageDate(): Date {
        return this.messageDate;
    }

    public set MessageDate(value: Date) {
        this.messageDate = value;
    }

    public get ConversationId(): number {
        return this.conversationId;
    }

    public set ConversationId(value: number) {
        this.conversationId = value;
    }

    public get MessageUser(): User {
        return this.messageUser;
    }

    public set MessageUser(value: User) {
        this.messageUser = value;
    }

    constructor() {
        this.messageId = 0;
        this.messageContent = "";
        this.messageDate = new Date();
        this.conversationId = 0;
        this.messageUser = new User();
    }

    public static createFromObject(obj: any): Message {
        const message = new Message();
        message.MessageId = obj.messageId || 0;
        message.MessageContent = obj.messageContent || "";
        message.MessageDate = obj.messageDate ? new Date(obj.messageDate) : new Date();
        message.ConversationId = obj.conversationId || 0;
        message.MessageUser = obj.messageUser ? Object.assign(new User(), obj.messageUser) : new User();
        return message;
    }
}