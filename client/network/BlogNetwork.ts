import { Blog } from "../model/blog.js";
import IBlogNetwork from "./interfaces/IBlogNetwork.js";

export default class BlogNetwork implements IBlogNetwork {

    async createBlog(blog: Blog): Promise<boolean> {
        try {
            const response = await fetch(`../serveur/controller/blogController.php?action=create`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(blog),
            });
    
            if (!response.ok) {
                throw new Error(`Bad response from server: ${response.status}`);
            }
    
            const result = await response.json();
            console.log('Created blog:', result);
            return true;
        } catch (error: any) {
            console.error('Error when creating blog: ' + error.message);
            return false;
        }
    }

    async updateBlog(blog:Blog) : Promise<boolean>
    {
        try {
            const response = await fetch('../serveur/controller/blogController.php?action=update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(blog),
            });

            if (!response.ok) {
                throw new Error(`Bad response from server: ${response.status}`);
            }

            const result = await response.json();
            console.log('Updated blog :', result);
            return true;
        } catch (error: any) {
            console.error('Error when updating blogs: ' + error.message);
            return false;
        }
    }

    async getAllBlogs(): Promise<Blog[]> {
        let result = new Array<Blog>();
        try {
            const response = await fetch(`../serveur/controller/blogController.php?action=all`);

            if(!response.ok) {
                throw new Error(`Bad response from server: ${response.status}`);
            }
            
            const json = await response.json();
            result = json.map((obj : any) => Blog.createFromObject(obj));
            
        } catch (error: any) {
            console.error('Error when getting blogs: ' + error.message);
        }
        return result;
    }
}