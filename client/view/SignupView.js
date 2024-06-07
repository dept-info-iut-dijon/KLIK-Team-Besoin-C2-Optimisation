import { AuthController } from "../controller/AuthController.js";
import { User } from "../model/user.js";
export class SignupView {
    constructor() {
        this.authController = new AuthController();
        this.errorMessage = document.getElementById("errorField");
        this.userNameInput = document.getElementById("name");
        this.emailInput = document.getElementById("email");
        this.passwordInput = document.getElementById("pwd");
        this.confirmPasswordInput = document.getElementById("pwd-repeat");
        this.firstnameInput = document.getElementById("f-name");
        this.lastnameInput = document.getElementById("l-name");
        this.genderInput = document.querySelector('input[name="gender"]:checked');
        this.imageInput = document.getElementById('imgInp');
        this.headlineInput = document.getElementById('headline');
        this.bioInput = document.getElementById('bio');
        document.getElementById("signup-submit").addEventListener("click", () => this.signup());
    }
    signup() {
        this.errorMessage.innerHTML = "";
        this.errorMessage.setAttribute("class", "");
        const username = this.userNameInput.value;
        const email = this.emailInput.value;
        const password = this.passwordInput.value;
        const confirmPassword = this.confirmPasswordInput.value;
        const firstname = this.firstnameInput.value;
        const lastname = this.lastnameInput.value;
        const gender = this.genderInput.value;
        let file = null;
        if (this.imageInput.files && this.imageInput.files[0]) {
            file = this.imageInput.files[0];
        }
        const headline = this.headlineInput.value;
        const bio = this.bioInput.value;
        const user = new User();
        user.Username = username;
        user.UserEmail = email;
        user.UserPassword = password;
        user.UserFirstName = firstname;
        user.UserLastName = lastname;
        user.UserGender = gender;
        user.UserHeadline = headline;
        user.UserBio = bio;
        if (password != confirmPassword) {
            this.sendError("Passwords don't match");
        }
        else {
            const formData = new FormData();
            formData.append("userImage", file ? file : "");
            formData.append("user", JSON.stringify(user));
            this.authController.Signup(formData).then(res => {
                if (!res) {
                    this.sendError("Connection error");
                }
                else {
                    window.location.href = "./index.html";
                }
            });
        }
    }
    sendError(message) {
        this.errorMessage.setAttribute("class", "alert alert-danger");
        this.errorMessage.innerHTML = message;
    }
}
