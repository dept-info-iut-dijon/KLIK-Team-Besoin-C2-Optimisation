import {User} from "../../model/user.js";

export interface IAuthController {
    Login(login: string, password: string): Promise<boolean>;
    Signup(formData: FormData): Promise<boolean>;
}