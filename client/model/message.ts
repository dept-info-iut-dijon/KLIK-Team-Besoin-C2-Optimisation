class Message {
    private messageId: number ;
    private messageContent : string;
    private messageDate : Date;

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


    constructor() {
        this.messageId = 0;
        this.messageContent = "";
        this.messageDate = new Date();
    }






}

