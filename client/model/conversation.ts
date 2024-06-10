import { User } from "./user";




class Conversation {
    private messages: Array<Message>;
    private user1 : User;
    private user2 : User;
    private conversationId : number; 
    private conversationDateCreation : Date;

    public get Messages(): Array<Message>{
        return this.messages;
    }

    public set Messages(value : Array<Message>) {
        this.messages = value;
    }

    public get User1() : User {
        return this.user1;
    }

    public set User1(value : User) {
        this.user1 = value;
    }

    public get User2() : User {
        return this.User2;
    }

    public set User2(value : User) {
        this.user2 = value;
    }

    public get ConversationId(): number {
        return this.conversationId;
    }

    public set ConversationId(value: number) {
        this.conversationId = value;
    }

    public get ConversationDateCreation(): Date {
        return this.conversationDateCreation;
    }

    public set ConversationDateCreation(value: Date) {
        this.conversationDateCreation = value;
    }


    constructor() {
        this.messages = new Array<Message>;
        this.user1 = new User();
        this.user2 = new User();
        this.conversationId = 0;
        this.conversationDateCreation = new Date();
    }

    public static createFromObject(obj: any): Conversation {
        const conversation = new Conversation();
        conversation.ConversationId = obj.conversationId || 0;
        conversation.ConversationDateCreation = obj.conversationDateCreation ? new Date(obj.conversationDateCreation) : new Date();
        conversation.Messages = obj.messages ? obj.messages.map((message: any) => Message.createFromObject(message)) : new Array<Message>();
        conversation.User1 = obj.user1 ? User.createFromObject(obj.user1) : new User();
        conversation.User2 = obj.user2 ? User.createFromObject(obj.user2) : new User();
        return conversation;
    }

}


