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

    public static createFromObject(object: any): User{
        const user = new User();
        user.userId = object.userId;
        user.userLevel = object.userLevel;
        user.userFirstName = object.userFirstName;
        user.userLastName = object.userLastName;
        user.username = object.username;
        user.userEmail = object.userEmail;
        user.userPassword = object.userPassword;
        user.userGender = object.userGender;
        user.userHeadline = object.userHeadline;
        user.userBio = object.userBio;
        user.userImage = object.userimage;
        return user;
    }
}