import { Blog } from "../model/blog";
import IBlogNetwork from "./interfaces/IBlogNetwork";

export default class BlogNetwork implements IBlogNetwork {

    async createBlog(blog: Blog): Promise<boolean> {
        try {
            const response = await fetch('http://localhost/serveur/controller/blogController.php?action=create', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(blog),
            });
    
            if (!response.ok) {
                throw new Error("Aucune réponse du serveur");
            }
    
            const result = await response.json();
            console.log('Blog créé :', result);
            return true;
        } catch (error: any) {
            console.error('Erreur lors de la création du Blog : ' + error.message);
            return false;
        }
    }

    async updateBlog(blog:Blog) : Promise<boolean>
    {
        try {
            const response = await fetch('http://localhost/serveur/controller/blogController.php?action=update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(blog),
            });
    
            if (!response.ok) {
                throw new Error("Aucune réponse du serveur");
            }
    
            const result = await response.json();
            console.log('Blog mis à jour :', result);
            return true;
        } catch (error: any) {
            console.error('Erreur lors de la mise à jour du Blog : ' + error.message);
            return false;
        }
    }
    

}