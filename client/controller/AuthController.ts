import { IAuthController } from "./interfaces/IAuthController.js";
import { IAuthNetwork } from "../network/interfaces/IAuthNetwork.js";
import { AuthNetwork } from "../network/AuthNetwork.js";

export class AuthController implements IAuthController {
    private authNetwork: IAuthNetwork;
    
    constructor() {
        this.authNetwork = new AuthNetwork();
    }

    public async Login(login: string, password: string): Promise<boolean> {
        return await this.authNetwork.Login(login, password);
    }

    public async Signup(formData: FormData): Promise<boolean> {
        return await this.authNetwork.Signup(formData);
    }
}