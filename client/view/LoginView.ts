import {AuthController} from "../controller/AuthController.js";

export class LoginView {
    private authController: AuthController;
    private errorMessage: HTMLDivElement;
    private userNameInput: HTMLInputElement;
    private passwordInput: HTMLInputElement;

    constructor() {
        this.authController = new AuthController();
        this.errorMessage = document.getElementById("errorField") as HTMLDivElement;
        this.userNameInput = document.getElementById("name") as HTMLInputElement;
        this.passwordInput = document.getElementById("password") as HTMLInputElement;

        document.getElementById("login-submit")!.addEventListener("click", () => this.login());
    }

    private login() {
        this.errorMessage.innerHTML = "";
        this.errorMessage.setAttribute("class", "");

        const username: string = this.userNameInput.value;
        const password: string = this.passwordInput.value;

        this.authController.Login(username, password).then(res =>  {
            if(!res) {
                this.errorMessage.setAttribute("class", "alert alert-danger");
                this.errorMessage.innerHTML = "Connection error";
            }
            else {
                window.location.href = "./index.html";
            }
        });
    }
}