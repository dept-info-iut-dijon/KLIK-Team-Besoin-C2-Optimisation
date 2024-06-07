import { AuthController } from "../controller/AuthController.js";
export class LoginView {
    constructor() {
        this.authController = new AuthController();
        this.errorMessage = document.getElementById("errorField");
        this.userNameInput = document.getElementById("name");
        this.passwordInput = document.getElementById("password");
        document.getElementById("login-submit").addEventListener("click", () => this.login());
    }
    login() {
        this.errorMessage.innerHTML = "";
        this.errorMessage.setAttribute("class", "");
        const username = this.userNameInput.value;
        const password = this.passwordInput.value;
        this.authController.Login(username, password).then(res => {
            if (!res) {
                this.errorMessage.setAttribute("class", "alert alert-danger");
                this.errorMessage.innerHTML = "Connection error";
            }
            else {
                window.location.href = "./index.html";
            }
        });
    }
}
