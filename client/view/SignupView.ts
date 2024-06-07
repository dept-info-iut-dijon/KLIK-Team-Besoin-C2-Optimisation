import {AuthController} from "../controller/AuthController.js";
import {User} from "../model/user.js";

export class SignupView {
    private authController: AuthController;
    private errorMessage: HTMLDivElement;
    private userNameInput: HTMLInputElement;
    private emailInput: HTMLInputElement;
    private passwordInput: HTMLInputElement;
    private confirmPasswordInput: HTMLInputElement;
    private firstnameInput: HTMLInputElement;
    private lastnameInput: HTMLInputElement;
    private genderInput: HTMLInputElement;
    private imageInput: HTMLInputElement;
    private headlineInput: HTMLInputElement;
    private bioInput: HTMLInputElement;

    constructor() {
        this.authController = new AuthController();
        this.errorMessage = document.getElementById("errorField") as HTMLDivElement;
        this.userNameInput = document.getElementById("name") as HTMLInputElement;
        this.emailInput = document.getElementById("email") as HTMLInputElement;
        this.passwordInput = document.getElementById("pwd") as HTMLInputElement;
        this.confirmPasswordInput = document.getElementById("pwd-repeat") as HTMLInputElement;
        this.firstnameInput = document.getElementById("f-name") as HTMLInputElement;
        this.lastnameInput = document.getElementById("l-name") as HTMLInputElement;
        this.genderInput = document.querySelector('input[name="gender"]:checked') as HTMLInputElement;
        this.imageInput = document.getElementById('imgInp') as HTMLInputElement;
        this.headlineInput = document.getElementById('headline') as HTMLInputElement;
        this.bioInput = document.getElementById('bio') as HTMLInputElement;

        document.getElementById("signup-submit")!.addEventListener("click", () => this.signup());
    }

    private signup() {
        this.errorMessage.innerHTML = "";
        this.errorMessage.setAttribute("class", "");

        const username: string = this.userNameInput.value;
        const email = this.emailInput.value;
        const password: string = this.passwordInput.value;
        const confirmPassword = this.confirmPasswordInput.value;
        const firstname = this.firstnameInput.value;
        const lastname = this.lastnameInput.value;
        const gender = this.genderInput.value;

        let file: File|null = null;
        if(this.imageInput.files && this.imageInput.files[0]) {
            file = this.imageInput.files[0]
        }

        const headline = this.headlineInput.value;
        const bio = this.bioInput.value;

        const user = new User();
        user.Username = username;
        user.UserEmail = email;
        user.UserPassword = password
        user.UserFirstName = firstname;
        user.UserLastName = lastname;
        user.UserGender = gender;
        user.UserHeadline = headline;
        user.UserBio = bio;

        if(password != confirmPassword) {
            this.sendError("Passwords don't match");
        }
        else {
            const formData: FormData = new FormData();
            formData.append("userImage", file ? file : "");
            formData.append("user", JSON.stringify(user));

            this.authController.Signup(formData).then(res =>  {
                if(!res) {
                    this.sendError("Connection error");
                }
                else {
                    window.location.href = "./index.html";
                }
            });
        }
    }

    private sendError(message: string) {
        this.errorMessage.setAttribute("class", "alert alert-danger");
        this.errorMessage.innerHTML = message;
    }
}