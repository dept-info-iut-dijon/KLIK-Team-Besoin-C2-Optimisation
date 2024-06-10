export class User {
    private userId: number;
    private userLevel: number;
    private userFirstName: string;
    private userLastName: string;
    private username: string;
    private userEmail: string;
    private userPassword: string;
    private userGender: string;
    private userHeadline: string;
    private userBio: string;
    private userImage: string;

    public get UserId(): number {
        return this.userId;
    }

    public set UserId(value: number) {
        this.userId = value;
    }

    public get UserLevel(): number {
        return this.userLevel;
    }

    public set UserLevel(value: number) {
        this.userLevel = value;
    }

    public get UserFirstName(): string {
        return this.userFirstName;
    }

    public set UserFirstName(value: string) {
        this.userFirstName = value;
    }

    public get UserLastName(): string {
        return this.userLastName;
    }

    public set UserLastName(value: string) {
        this.userLastName = value;
    }

    public get Username(): string {
        return this.username;
    }

    public set Username(value: string) {
        this.username = value;
    }

    public get UserEmail(): string {
        return this.userEmail;
    }

    public set UserEmail(value: string) {
        this.userEmail = value;
    }

    public get UserPassword(): string {
        return this.userPassword;
    }

    public set UserPassword(value: string) {
        this.userPassword = value;
    }

    public get UserGender(): string {
        return this.userGender;
    }

    public set UserGender(value: string) {
        this.userGender = value;
    }

    public get UserHeadline(): string {
        return this.userHeadline;
    }

    public set UserHeadline(value: string) {
        this.userHeadline = value;
    }

    public get UserBio(): string {
        return this.userBio;
    }

    public set UserBio(value: string) {
        this.userBio = value;
    }

    public get UserImage(): string {
        return this.userImage;
    }

    public set UserImage(value: string) {
        this.userImage = value;
    }

    constructor() {
        this.userId = 0;
        this.userLevel = 0;
        this.userFirstName = "";
        this.userLastName = "";
        this.username = "";
        this.userEmail = "";
        this.userPassword = "";
        this.userGender = "";
        this.userHeadline = "";
        this.userBio = "";
        this.userImage = "";
    }


    public static createFromObject(obj: any): User {
        const user = new User();
        user.UserId = obj.userId || 0;
        user.UserLevel = obj.userLevel || 0;
        user.UserFirstName = obj.userFirstName || "";
        user.UserLastName = obj.userLastName || "";
        user.Username = obj.username || "";
        user.UserEmail = obj.userEmail || "";
        user.UserPassword = obj.userPassword || "";
        user.UserGender = obj.userGender || "";
        user.UserHeadline = obj.userHeadline || "";
        user.UserBio = obj.userBio || "";
        user.UserImage = obj.userImage || "";
        return user;
    }
}