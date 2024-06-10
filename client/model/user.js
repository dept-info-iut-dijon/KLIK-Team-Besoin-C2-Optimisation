export class User {
    get UserId() {
        return this.userId;
    }
    set UserId(value) {
        this.userId = value;
    }
    get UserLevel() {
        return this.userLevel;
    }
    set UserLevel(value) {
        this.userLevel = value;
    }
    get UserFirstName() {
        return this.userFirstName;
    }
    set UserFirstName(value) {
        this.userFirstName = value;
    }
    get UserLastName() {
        return this.userLastName;
    }
    set UserLastName(value) {
        this.userLastName = value;
    }
    get Username() {
        return this.username;
    }
    set Username(value) {
        this.username = value;
    }
    get UserEmail() {
        return this.userEmail;
    }
    set UserEmail(value) {
        this.userEmail = value;
    }
    get UserPassword() {
        return this.userPassword;
    }
    set UserPassword(value) {
        this.userPassword = value;
    }
    get UserGender() {
        return this.userGender;
    }
    set UserGender(value) {
        this.userGender = value;
    }
    get UserHeadline() {
        return this.userHeadline;
    }
    set UserHeadline(value) {
        this.userHeadline = value;
    }
    get UserBio() {
        return this.userBio;
    }
    set UserBio(value) {
        this.userBio = value;
    }
    get UserImage() {
        return this.userImage;
    }
    set UserImage(value) {
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
    static createFromObject(obj) {
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
