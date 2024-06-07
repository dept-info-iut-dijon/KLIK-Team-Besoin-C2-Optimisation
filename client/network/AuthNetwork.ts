import {IAuthNetwork} from "./interfaces/IAuthNetwork.js";

export class AuthNetwork implements IAuthNetwork {
    public async Login(login: string, password: string): Promise<boolean> {
        let result = false;

        if(login == "test" && password == "test")
            result = true;

        return result;
    }

    public async Signup(formData: FormData): Promise<boolean> {
        for (const pair of formData.entries()) {
            console.log(`${pair[0]}: ${pair[1]}`);
        }

        return false;
    }
}